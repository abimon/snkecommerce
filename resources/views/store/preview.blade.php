@php $art = ['Meal plans' => '', 'Recipes' => 'orange', 'Guides' => 'lilac'][$product['category']] ?? 'rose'; @endphp
@extends('layouts.store')
@section('content')
<section class="preview-hero">
    <div class="container">
        <a class="back-link" href="{{ route('store.shop') }}">&#8592; Back to the library</a>
        <div class="row align-items-center g-5">
            <div class="col-lg-5">
                <div class="preview-cover product-art {{ $art }}">
                    <div class="product-sheet"><span>{{ $product['name'] }}</span><small>{{ $product['pages'] }} pages of good ideas</small></div>
                </div>
            </div>
            <div class="col-lg-7">
                <p class="eyebrow">{{ $product['category'] }} · A closer look</p>
                <h1>{{ $product['name'] }}</h1>
                <p class="preview-lede">{{ $product['description'] }}</p>
                <div class="d-flex flex-wrap align-items-center gap-3 mt-4">
                    <span class="price">KSh. {{ number_format($product['price'], 2) }}</span>
                    @if($product['compare_price']) <span class="old-price">KSh. {{ number_format($product['compare_price'], 2) }}</span> @endif
                    <span class="preview-detail">{{ $product['pages'] }} pages · instant PDF</span>
                </div>
                <div class="d-flex flex-wrap gap-2 mt-4">
                    <form method="POST" action="{{ route('store.cart.add', $product['slug']) }}">@csrf<button class="btn btn-snk">Add to basket <span class="ms-2">&#8594;</span></button></form>
                    <a class="btn btn-outline-snk" href="#inside">See inside</a>
                </div>
            </div>
        </div>
    </div>
</section>
<section class="section-pad preview-inside" id="inside">
    <div class="container">
        <div class="row justify-content-between align-items-end g-4 mb-5">
            <div class="col-lg-7"><p class="eyebrow">A little taste</p><h2 class="section-heading mb-0">Made to be opened<br>on an ordinary day.</h2></div>
            <div class="col-lg-4"><p class="mb-0 text-muted">A few pages from {{ $product['name'] }}, so you can feel the rhythm before you make it yours.</p></div>
        </div>
        <div class="row g-4">
            <div class="col-md-4"><article class="sample-page"><span class="sample-number">01</span><p class="tag">Start here</p><h3>Make room for one good thing.</h3><p class="text-muted">A simple first step, with enough space left over for the rest of your day.</p><div class="sample-line"></div><div class="sample-line short"></div></article></div>
            <div class="col-md-4"><article class="sample-page sample-page-green"><span class="sample-number">02</span><p class="tag">The good part</p><h3>Small rituals, real flavor.</h3><p class="text-muted">Practical notes and gentle prompts you can return to whenever you need them.</p><div class="sample-check">&#10003; Keep it simple</div><div class="sample-check">&#10003; Make it yours</div></article></div>
            <div class="col-md-4"><article class="sample-page sample-page-orange"><span class="sample-number">03</span><p class="tag">A note to keep</p><h3>There is no perfect version.</h3><p class="text-muted">Just a collection of ideas that meet you where you are and help you begin.</p><div class="sample-quote">“Good enough is a place to start.”</div></article></div>
        </div>
    </div>
</section>
@endsection