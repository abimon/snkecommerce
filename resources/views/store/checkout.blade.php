@extends('layouts.store')
@section('content')
<section class="checkout-wrap">
    <div class="container">
        <div class="row justify-content-center g-5">
            <div class="col-lg-7">
                <p class="eyebrow">Almost there</p>
                <h1 class="section-heading mb-4">Make it yours.</h1>
                <div class="checkout-card">
                    <form method="POST" action="{{ route('store.checkout.place') }}">@csrf<div class="row g-3">
                            <div class="col-12">
                                <label class="form-label">Full name</label><input class="form-control" name="customer_name" value="{{ old('customer_name')??auth()->user()?auth()->user()->name:'' }}" required>
                            </div>
                            <div class="col-md-6">
                                <label class="form-label">Email address*</label>
                                <input class="form-control" name="customer_email" type="email" value="{{ old('customer_email')??auth()->user()?auth()->user()->email:'' }}" required>
                            </div>
                            <div class="col-md-6">
                                <label class="form-label">M-Pesa Phone Number*
                                </label>
                                <input class="form-control" name="customer_phone" value="{{ old('customer_phone')??auth()->user()?auth()->user()->phone:'' }}" required>
                            </div>
                        </div>
                        @if($errors->any())
                        <div class="alert alert-danger mt-4 mb-0">
                            {{ $errors->first() }}
                        </div>
                        @endif
                        <button class="btn btn-snk w-100 mt-4 py-3">
                            Place order &amp; email my PDFs
                            <span class="ms-2">&#8594;</span>
                        </button>
                        <p class="small text-muted text-center mt-3 mb-0">This checkout records the order and uses your configured Laravel mailer.</p>
                    </form>
                </div>
            </div>
            <div class="col-lg-4">
                <div class="summary-card">
                    <p class="tag">Your guides</p>@foreach($items as $item)<div class="d-flex justify-content-between gap-3 py-3 border-bottom"><span>{{ $item['name'] }} <small class="text-muted">x{{ $item['quantity'] }}</small></span><strong>Ksh. {{ number_format($item['price'] * $item['quantity'], 2) }}</strong></div>@endforeach<div class="d-flex justify-content-between pt-4"><span>Total</span><strong>Ksh. {{ number_format($subtotal, 2) }}</strong></div>
                </div>
            </div>
        </div>
    </div>
</section>
@endsection