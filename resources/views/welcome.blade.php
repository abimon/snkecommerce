@extends('layouts.store')
@section('content')
<section class="hero">
    <div class="container">
        <div class="row align-items-center py-5">
            <div class="col-lg-7 hero-copy fade-up">
                <p class="eyebrow mb-4">Eat well, gently</p>
                <h1>Good food for your <em>real life.</em></h1>
                <p class="hero-lede my-4">Digital recipes, meal plans, and everyday rituals for feeling more at home in your body.</p><a class="btn btn-snk" href="{{ route('store.shop') }}">Browse the guides <span class="ms-2">&#8594;</span></a>
            </div>
            <div class="col-lg-5 hero-art mt-5 mt-lg-0 fade-up delay-1">
                <div class="hero-plate"><span class="hero-food one"></span>
                    <span class="hero-food two"></span><span class="hero-food three"></span><span class="hero-food four"></span>
                </div><span class="hero-leaf a"></span><span class="hero-leaf b"></span>
            </div>
        </div>
    </div>
</section>
<section class="section-pad" id="shop">
    <div class="container">
        <div class="d-flex flex-column flex-md-row justify-content-between align-items-md-end gap-3 mb-4">
            <div>
                <p class="eyebrow">The little library</p>
                <h2 class="section-heading mb-0">Start where you are.</h2>
            </div><a class="btn btn-outline-snk" href="{{ route('store.shop') }}">View all guides</a>
        </div>
        <div class="row g-4">@foreach ($products as $product) @include('store._product-card', ['product' => $product]) @endforeach</div>
    </div>
</section>
<section class="feature-band section-pad" id="story">
    <div class="container">
        <div class="row align-items-center g-5">
            <div class="col-lg-7">
                <p class="eyebrow text-warning">A softer way in</p>
                <h2 class="section-heading">Wellness is not a performance.</h2>
                <p class="mt-3 mb-0">Our guides are made for the in-between days. No perfect routines, no complicated ingredients. Just considered tools that help you make one good choice, then another.</p>
            </div>
            <div class="col-lg-4 offset-lg-1">
                <div class="row g-4">
                    <div class="col-6 mini-stat"><strong>{{App\Models\Product::where('is_active',true)->count()}}</strong><span>thoughtful guides</span></div>
                    <div class="col-6 mini-stat"><strong>100%</strong><span>downloadable</span></div>
                </div>
            </div>
        </div>
    </div>
</section>
@endsection