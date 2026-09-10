@extends('layouts.store')
@section('content')
<section class="page-hero">
    <div class="container">
        <p class="eyebrow">The SNK library</p>
        <h1>Small guides.<br>Big exhale.</h1>
        <p class="hero-lede mb-0">Choose a starting point, download instantly, and make it yours.</p>
    </div>
</section>
<section class="section-pad">
    <div class="container">
        <div class="d-flex flex-wrap gap-2 mb-5">
            <a class="filter-pill {{ !$category ? 'active' : '' }}" href="{{ route('store.shop') }}">Everything</a>
            @foreach(['Recipes','Meal plans','Guides'] as $filter)
            <a class="filter-pill {{ $category === $filter ? 'active' : '' }}" href="{{ route('store.shop', ['category' => $filter]) }}">{{ $filter }}</a>
            @endforeach
        </div>
        <div class="row g-4">
            @forelse($products as $product)
            @include('store._product-card', ['product' => $product])
            @empty
            <p class="text-center">Nothing here yet.</p>
            @endforelse
        </div>
    </div>
</section>
@endsection