@extends('layouts.store')
@section('content')
<section class="checkout-wrap d-flex align-items-center">
    <div class="container text-center">
        <p class="eyebrow">Order {{ $order->order_number }}</p>
        <h1 class="section-heading">Your good stuff<br>is on its way.</h1>
        <p class="hero-lede mx-auto my-4">We sent your PDF guides to <strong>{{ $order->customer_email }}</strong>. Check your inbox in the next few minutes.</p><a class="btn btn-snk" href="{{ route('store.shop') }}">Keep browsing</a>
    </div>
</section>
@endsection