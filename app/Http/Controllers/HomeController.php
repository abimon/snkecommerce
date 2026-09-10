<?php

namespace App\Http\Controllers;

use App\Models\Order;
use App\Models\Product;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {

        $orders = Order::with('items')->get();
        $stats = [
            'sales' => $orders->where('status', 'completed')->count(),
            'orders' => $orders->where('status', 'pending')->count(),
            'inventory' => Product::count(),
            'returned' => $orders->where('status', 'returned')->count(),
        ];
        $order_items = $orders->flatMap->items;
        return view('dashboard.index', compact('stats', 'order_items'));
        

    }
}
