@extends('layouts.store')
@section('content')
<section class="page-hero">
    <div class="container">
        <p class="eyebrow">Your basket</p>
        <h1>A little goodness,<br>coming right up.</h1>
    </div>
</section>
<section class="section-pad">
    <div class="container">
        <div class="row g-5">
            <div class="col-lg-8">
                <h2 class="h4 mb-4">{{ count($items) }} {{ count($items) === 1 ? 'guide' : 'guides' }}</h2>@forelse($items as $item)<div class="d-flex align-items-center gap-3 border-bottom pb-4 mb-4">
                    <div class="product-art flex-shrink-0" style="height:100px;width:90px;border-radius:12px">
                        <div class="product-sheet" style="height:70px;width:54px;padding:8px"><span style="font-size:.55rem">{{ $item['name'] }}</span></div>
                    </div>
                    <div class="flex-grow-1"><span class="tag">{{ $item['category'] }}</span>
                        <h3 class="h5 mb-1">{{ $item['name'] }}</h3><span class="text-muted">Ksh. {{ number_format($item['price'], 2) }}</span>
                    </div>
                    <form method="POST" action="{{ route('store.cart.update', $item['slug']) }}" class="d-flex align-items-center gap-2">@csrf @method('PATCH')<input class="form-control" name="quantity" type="number" min="0" value="{{ $item['quantity'] }}" style="width:70px"><button class="btn btn-sm btn-outline-secondary">Update</button></form>
                    <form method="POST" action="{{ route('store.cart.remove', $item['slug']) }}">@csrf @method('DELETE')<button class="btn btn-sm text-danger">Remove</button></form>
                </div>@empty <p class="text-muted">Your basket is empty. Start with something nourishing.</p><a class="btn btn-snk" href="{{ route('store.shop') }}">Browse guides</a>@endforelse
            </div>@if($items)<div class="col-lg-4">
                <div class="summary-card">
                    <p class="tag">Order summary</p>
                    <div class="d-flex justify-content-between py-3 border-bottom"><span>Subtotal</span><strong>Ksh. {{ number_format($subtotal, 2) }}</strong></div>
                    <p class="small text-muted mt-3">Instant PDF delivery. No shipping, no waiting.</p><a href="{{ route('store.checkout') }}" class="btn btn-snk w-100 mt-2">Continue to checkout</a>
                </div>
            </div>@endif
        </div>
    </div>
</section>
@endsection