<?php

namespace App\Http\Controllers;

use App\Mail\OrderReady;
use App\Models\Order;
use App\Models\Payment;
use App\Models\Product;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Mail;
use Illuminate\View\View;

use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;
use Symfony\Component\HttpFoundation\Response;

class StoreController extends Controller
{
    public function home(): View
    {
        return view('welcome', ['products' => $this->products()]);
    }

    public function shop(Request $request): View
    {
        $products = collect($this->products());
        $category = $request->string('category')->toString();

        if ($category) {
            $products = $products->where('category', $category);
        }

        return view('store.shop', ['products' => $products, 'category' => $category]);
    }

    public function preview(string $slug): View
    {
        $product = collect($this->products())->firstWhere('slug', $slug);
        abort_unless($product, 404);

        return view('store.preview', compact('product'));
    }

    public function cart(Request $request): View
    {
        $cart = $request->session()->get('cart', []);
        return view('store.cart', ['items' => $cart, 'subtotal' => $this->subtotal($cart)]);
    }

    public function add(Request $request, string $slug): RedirectResponse
    {
        $product = collect($this->products())->firstWhere('slug', $slug);
        abort_unless($product, 404);

        $cart = $request->session()->get('cart', []);
        $cart[$slug] = [
            ...($cart[$slug] ?? $product),
            'quantity' => ($cart[$slug]['quantity'] ?? 0) + 1,
        ];
        $request->session()->put('cart', $cart);

        return back()->with('success', 'Added to your basket.');
    }

    public function update(Request $request, string $slug): RedirectResponse
    {
        $cart = $request->session()->get('cart', []);
        $quantity = max(0, (int) $request->integer('quantity'));

        if ($quantity === 0) {
            unset($cart[$slug]);
        } elseif (isset($cart[$slug])) {
            $cart[$slug]['quantity'] = $quantity;
        }

        $request->session()->put('cart', $cart);
        return back();
    }

    public function remove(Request $request, string $slug): RedirectResponse
    {
        $cart = $request->session()->get('cart', []);
        unset($cart[$slug]);
        $request->session()->put('cart', $cart);
        return back();
    }

    public function checkout(Request $request): View|RedirectResponse
    {
        $items = $request->session()->get('cart', []);
        return empty($items) ? redirect()->route('store.shop')->with('error', 'Your basket is waiting for something good.') : view('store.checkout', ['items' => $items, 'subtotal' => $this->subtotal($items)]);
    }

    public function placeOrder(Request $request): RedirectResponse
    {
        $data = $request->validate([
            'customer_name' => ['required', 'string', 'max:120'],
            'customer_email' => ['required', 'email', 'max:190'],
            'customer_phone' => ['nullable', 'string', 'max:40'],
        ]);
        $items = $request->session()->get('cart', []);
        abort_if(empty($items), 422, 'Your basket is empty.');

        $subtotal = $this->subtotal($items);
        $orderNumber = 'SNK-' . strtoupper(uniqid());
        $order = DB::transaction(function () use ($data, $items, $subtotal, $orderNumber) {
            $order = Order::create([
                ...$data,
                'order_number' => $orderNumber,
                'subtotal' => $subtotal,
                'total' => $subtotal,
                'status' => 'pending',
                'paid_at' => null,
            ]);

            foreach ($items as $item) {
                $product = Product::where('slug', $item['slug'])->first();
                $order->items()->create([
                    'product_id' => $product?->id,
                    'product_name' => $item['name'],
                    'product_category' => $item['category'],
                    'unit_price' => $item['price'],
                    'quantity' => $item['quantity'],
                    'line_total' => $item['price'] * $item['quantity'],
                ]);
            }

            return $order->load('items.product');
        });
        $request->session()->forget('cart');
        $phone = str_replace([' ', '-', '(', ')'], '', $data['customer_phone']);
        // add +254 if not present
        if (!str_starts_with($phone, '254')) {
            $phone = '254' . ltrim($phone, '0');
        }
        $this->Pay($subtotal, $phone, $orderNumber);
        // Mail::to($order->customer_email)->send(new OrderReady($order));
        

        return redirect()->route('store.complete', $order);
    }

    public function complete(Order $order): View
    {
        return view('store.complete', compact('order'));
    }

    private function subtotal(array $items): float
    {
        return round(collect($items)->sum(fn ($item) => $item['price'] * $item['quantity']), 2);
    }

    private function products(): array
    {
        $fallback = [];

        try {
            $products = Product::where('is_active', true)->latest()->get()->toArray();
            return $products ?: $fallback;
        } catch (\Throwable) {
            return $fallback;
        }
    }

    public function generateToken()
    {
        $consumer_key = env('MPESA_CONSUMER_KEY');
        $consumer_secret = env('MPESA_CONSUMER_SECRET');
        $url = 'https://api.safaricom.co.ke/oauth/v1/generate?grant_type=client_credentials';
        $res = Http::withBasicAuth($consumer_key, $consumer_secret)
            ->get($url);
        $response = json_decode($res, true);
        return $response['access_token'];
    }
    public function lipaNaMpesaPassword()
    {
        $passkey = env('MPESA_PASSKEY');
        $BusinessShortCode = env('MPESA_SHORT_CODE');
        $timestamp = date('YmdHis');
        $lipa_na_mpesa_password = base64_encode($BusinessShortCode . $passkey . $timestamp);
        return $lipa_na_mpesa_password;
    }
    public function Callback($id)
    {
        $res = request();
        Log::channel('mpesaSuccess')->info(json_encode(['whole' => $res['Body']]));
        // if ($res['Body']['stkCallback']['ResultCode'] == 0) {
        $message = $res['Body']['stkCallback']['ResultDesc'];
        $amount = $res['Body']['stkCallback']['CallbackMetadata']['Item'][0]['Value'];
        $TransactionId = $res['Body']['stkCallback']['CallbackMetadata']['Item'][1]['Value'];
        $phne = $res['Body']['stkCallback']['CallbackMetadata']['Item'][4]['Value'];
        Payment::create([
            'TransactionType' => 'M-PESA STK Push',
            'TrackingId' => $id,
            'TransAmount' => $amount,
            'MpesaReceiptNumber' => $TransactionId,
            'TransactionDate' => date('d-m-Y'),
            'PhoneNumber' => '+' . $phne,
            'response' => $message
        ]);
        // if ($amount >= 2) {
        Order::where('order_number', $id)->update(['status' => 'paid','paid_at' => now()]);
        foreach (Order::where('order_number', $id)->get() as $order) {
            Mail::to($order->customer_email)->send(new OrderReady($order));
            $order->status='completed';
        }
        $response = new Response();
        $response->headers->set("Content-Type", "text/xml; charset=utf-8");
        $response->setContent(json_encode(["C2BPaymentConfirmationResult" => "Success"]));
        return $response;
    }
    function Pay($amount, $contact, $id)
    {
        $url = (env('MPESA_ENV') == 'live') ? 'https://api.safaricom.co.ke/mpesa/stkpush/v1/processrequest' : 'https://sandbox.safaricom.co.ke/mpesa/stkpush/v1/processrequest';
        $data = [
            'BusinessShortCode' => env('MPESA_SHORT_CODE'),
            'Password' => $this->lipaNaMpesaPassword(),
            'Timestamp' => date('YmdHis'),
            'TransactionType' => 'CustomerPayBillOnline',
            'Amount' => $amount,
            'PartyA' => $contact,
            'PartyB' => env('MPESA_SHORT_CODE'),
            'PhoneNumber' => $contact,
            'CallBackURL' => 'https://snkecommerce.apektechinc.com/api/payments/callback/' . $id,
            'AccountReference' => 'Purchases',
            'TransactionDesc' => 'Purchases',
        ];
        $response = Http::withToken($this->generateToken())
            ->post($url, $data);
        $res = $response->json();
        return $res;
    }
}