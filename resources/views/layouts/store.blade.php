<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="shortcut icon" href="icon.png" type="image/x-icon">
    <title>{{ $title ?? 'Store' }} | SNK Wellness</title>
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=dm-sans:400,500,600,700|fraunces:400,500,600" rel="stylesheet">
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.15.4/css/all.css" />
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.4.1/font/bootstrap-icons.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="{{ asset('css/store.css') }}" rel="stylesheet">
</head>

<body>
    <nav class="site-nav navbar navbar-expand-lg sticky-top">
        <div class="container py-2">
            <a class="brand navbar-brand" href="{{ route('store.home') }}">
                <img src="/image.png" alt="SNK Wellness" height="40">
            </a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#storeNav">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="storeNav">
                <div class="navbar-nav ms-auto align-items-lg-center gap-lg-3">
                    <a class="nav-link" href="{{ route('store.shop') }}">Shop guides</a>
                    <a class="nav-link" href="/#story">Our approach</a>
                    <a class="nav-link" href="{{ route('store.cart') }}">
                        Basket <span
                            class="badge text-bg-warning rounded-pill">{{ collect(session('cart', []))->sum('quantity') }}

                        </span>
                    </a>
                    @auth
                    <a class="nav-link" href="{{ route('dashboard') }}">Account</a>
                    @else
                    <a class="nav-link" href="{{ route('login') }}">Sign in</a>
                    @endauth
                </div>
            </div>
        </div>
    </nav>
    @if (session('success'))
    <div class="alert alert-success alert-dismissible fade show rounded-0 mb-0 text-center" role="alert">
        {{ session('success') }}
        <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
    </div>
    @endif
    @if (session('error'))
    <div class="alert alert-warning alert-dismissible fade show rounded-0 mb-0 text-center" role="alert">
        {{ session('error') }}
        <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
    </div>
    @endif
    <div class="d-flex justify-content-center align-items-center" style="min-height: 70vh;">
        <div class="w-100">
            @yield('content')
        </div>
    </div>
    <div class="container-fluid text-white-50 footer pt-5 mt-5" style="background-color: black;">
        <div class="container py-5">
            <div class="pb-4 mb-4" style="border-bottom: 1px solid rgba(226, 175, 24, 0.5) ;">
                <div class="row g-4">
                    <div class="col-md-3">
                        <a href="#">
                            <img src="image.png" style="width:100%;" alt="">
                            <p class="text-secondary mb-0">Fresh Healthy Products</p>
                        </a>
                    </div>

                    <div class="col-md-3">
                        <div class="d-flex justify-content-end pt-3">
                            <a class="btn  btn-outline-secondary me-2 " href="https://www.instagram.com/snkwellnesscenter/"><i class="fab fa-instagram"></i></a>
                            <a class="btn btn-outline-secondary me-2" href="https://www.facebook.com/profile.php?id=61560528538534&mibextid=ZbWKwL"><i class="fab fa-facebook-f"></i></a>
                            <a class="btn btn-outline-secondary me-2" href="https://www.youtube.com/@snkwellnesscenter"><i class="fab fa-youtube"></i></a>
                            <!-- <a class="btn btn-outline-secondary btn-md-square rounded-circle" href=""><i class="fab fa-linkedin-in"></i></a> -->
                        </div>
                    </div>
                    <div class="col-md-6 d-flex justify-content-end">
                        <form action="/subscribe" method="post" class="w-75">
                            <input type="hidden" name="_token" value="tjALixWk5Fj44tgI0EHf8VpV6kcjQbvkfYsJtBaO" autocomplete="off">
                            <div class="position-relative mx-auto">
                                <input class="form-control border-0 w-100 py-3 px-4 rounded-pill" type="number" placeholder="Your Email">
                                <button type="submit" class="btn btn-warning border-0 border-secondary py-3 px-4 position-absolute rounded-pill text-white" style="top: 0; right: 0;">Subscribe Now</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
            <div class="row g-5">
                <div class="col-md-4">
                    <div class="footer-item">
                        <h4 class="text-light mb-3">Our Mission!</h4>
                        <p class="mb-4">To provide holistic, personalized wellness solutions that empower clients to achieve optimal health and well-being through compassionate care, and a supportive community</p>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="footer-item">
                        <h4 class="text-light mb-3">Our Vision</h4>
                        <p class="mb-3">To be a leading nutrition and wellness center that transforms lives by inspiring and educating clients to take charge of their health journeys</p>
                        <h4 class="text-light mb-3">Contact</h4>
                        <p>Email: info@snkwellnesscenter.co.ke</p>
                        <p>Phone: +254 745 878 245</p>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="d-flex flex-column text-start footer-item">
                        <h4 class="text-light mb-3">Quick Links</h4>
                        <a class="btn-link" href="/dashboard">My Account</a>
                        <a class="btn-link" href="/shop">Shop details</a>
                        <a class="btn-link" href="/carts">Shopping Cart</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- Footer End -->

    <!-- Copyright Start -->
    <div class="container-fluid copyright bg-dark py-4">
        <div class="container">
            <div class="row">
                <div class="col-md-6 text-center text-md-start mb-3 mb-md-0">
                    <span class="text-light"><a href="#"><i class="fas fa-copyright text-light me-2"></i>SNK Wellness Center</a>, All right reserved.</span>
                </div>
                <div class="col-md-6 my-auto text-center text-md-end text-white">
                    Designed By <a class="border-bottom" href="https://apektechinc.com">APEK TECHNOLOGIES</a>
                </div>
            </div>
        </div>
    </div>
    <!-- Copyright End -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
    <script src="{{ asset('js/store.js') }}"></script>
</body>

</html>