@php $art = ['Meal plans' => '', 'Recipes' => 'orange', 'Guides' => 'lilac'][$product['category']] ?? 'rose'; @endphp
<div class="col-md-6 col-lg-4">
    <article class="product-card">
        <a class="product-art {{ $art }}" href="#" aria-label="Preview {{ $product['name'] }}">
            <div class="product-sheet">
                <span>{{ $product['name'] }}</span>
                <small>{{ $product['pages'] }} pages of good ideas</small>
            </div>
        </a>
        <div class="product-meta"><span class="tag">{{ $product['category'] }}</span>
            <h3 class="mt-2 mb-2"><a href="{{ route('store.preview', $product['slug']) }}">{{ $product['name'] }}</a></h3>
            <p>{{ $product['short_description'] }}</p>
            <div class="d-flex justify-content-between align-items-center mt-3">
                <div><span class="price">KSh. {{ number_format($product['price'], 2) }}</span> @if($product['compare_price']) <span class="old-price">KSh. {{ number_format($product['compare_price'], 2) }}</span> @endif</div>
                <div class="d-flex align-items-center gap-2">
                    <!-- <a class="btn btn-outline-primary rounded-pill px-2 btn-sm" href="{{ route('store.preview', $product['slug']) }}">Preview</a> -->
                    <form method="POST" action="{{ route('store.cart.add', $product['slug']) }}">
                        @csrf
                        <button class="btn btn-warning rounded-pill px-2 btn-sm">Add to basket</button>
                    </form>
                </div>
            </div>
        </div>
    </article>
</div>