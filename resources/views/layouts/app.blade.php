<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }} | Booking System</title>

    <link href="https://fonts.googleapis.com/css?family=Poppins:200,300,400,500,600,700,800,900&display=swap" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css?family=Playfair+Display:400,400i,500,500i,600,600i,700,700i&display=swap" rel="stylesheet">
    <link rel="dns-prefetch" href="//fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=Nunito" rel="stylesheet">

    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    
    <link rel="stylesheet" href="{{ asset('assets/css/animate.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/css/owl.carousel.min.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/css/owl.theme.default.min.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/css/magnific-popup.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/css/bootstrap-datepicker.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/css/jquery.timepicker.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/css/flaticon.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/css/override.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/css/style.css') }}">

    @vite(['resources/sass/app.scss', 'resources/js/app.js'])
</head>
<body>
    <div id="app">

        <div class="wrap bg-light border-bottom d-none d-lg-block">
            <div class="container">
                <div class="row justify-content-between">
                    <div class="col-md-8 d-flex align-items-center">
                        <p class="mb-0 d-flex align-items-center gap-4">
                            <span class="d-flex align-items-center gap-2 text-dark">
                                <i class="fas fa-phone"></i>
                                <a href="tel:+001234567" class="text-decoration-none text-dark">+00 1234 567</a>
                            </span>
                            <span class="d-flex align-items-center gap-2 text-dark">
                                <i class="fas fa-envelope"></i>
                                <a href="mailto:emailsample@email.com" class="text-decoration-none text-dark">emailsample@email.com</a>
                            </span>
                        </p>
                    </div>

                    <div class="col-md-4 d-flex justify-content-end align-items-center">
                        <div class="social-media d-flex gap-2">
                            <a href="#" class="text-dark p-2"><i class="fab fa-facebook-f"></i></a>
                            <a href="#" class="text-dark p-2"><i class="fab fa-twitter"></i></a>
                            <a href="#" class="text-dark p-2"><i class="fab fa-instagram"></i></a>
                            <a href="#" class="text-dark p-2"><i class="fab fa-dribbble"></i></a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <nav class="navbar navbar-expand-lg navbar-dark bg-dark ftco_navbar ftco-navbar-light sticky-top" id="ftco-navbar">
            <div class="container">
                <a class="navbar-brand text-light" href="{{ url('/') }}">
                    <i class="fa fa-calendar-check-o me-2"></i> Booking<span>System</span> 
                </a>
                <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#ftco-nav" aria-controls="ftco-nav" aria-expanded="false" aria-label="Toggle navigation">
                    <span class="fa fa-bars"></span> Menu
                </button>
                <div class="collapse navbar-collapse" id="ftco-nav">
                    <ul class="navbar-nav ms-auto">
                        <li class="nav-item active"><a href="{{ route('home') }}" class="nav-link">Home</a></li>
                        <li class="nav-item"><a href="{{ route('about') }}" class="nav-link">About</a></li>
                        <li class="nav-item"><a href="{{ route('services') }}" class="nav-link">Services</a></li>
                        <li class="nav-item"><a href="{{ route('contact')}}" class="nav-link">Contact</a></li>

                        @guest
                            @if (Route::has('login'))
                                <li class="nav-item">
                                    <a href="{{ route('login') }}" class="nav-link btn btn-outline-light rounded-pill ms-lg-3 px-3">LOGIN</a>
                                </li>
                            @endif
                            @if (Route::has('register'))
                                <li class="nav-item">
                                    <a href="{{ route('register') }}" class="nav-link btn btn-danger rounded-pill ms-lg-2 px-3">REGISTER</a>
                                </li>
                            @endif
                        @else
                            <li class="nav-item dropdown">
                                <a id="navbarDropdown" class="nav-link dropdown-toggle text-light" href="#" role="button" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                                    <i class="fa fa-user-circle me-1"></i> {{ Auth::user()->name }}
                                </a>

                                <div class="dropdown-menu dropdown-menu-end" aria-labelledby="navbarDropdown">
                                    <a class="dropdown-item" href="{{ route('users.bookings') }}">
                                        <i class="fa fa-calendar-check-o me-2"></i> My Bookings
                                    </a>
                                    <a class="dropdown-item" href="{{ route('logout') }}"
                                        onclick="event.preventDefault();
                                                    document.getElementById('logout-form').submit();">
                                        <i class="fa fa-sign-out me-2"></i> {{ __('Logout') }}
                                    </a>

                                    <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                                        @csrf
                                    </form>
                                </div>
                            </li>
                        @endguest
                    </ul>
                </div>
            </div>
        </nav>
        <main class="py-5">
            @yield('content')
        </main>
    </div>

    <footer class="footer bg-dark text-light pt-5 pb-4">
        <div class="container">
            <div class="row">
                <div class="col-md-6 col-lg-3 mb-4">
                    <h2 class="footer-heading mb-4"><a href="#" class="logo text-light text-decoration-none">Booking<span>System</span></a></h2>
                    <p class="text-secondary">Sistem pemesanan yang mudah, cepat, dan terpercaya untuk semua kebutuhan akomodasi atau layanan Anda.</p>
                    <a href="#" class="text-primary text-decoration-none">Read more <span class="fa fa-chevron-right ms-1" style="font-size: 11px;"></span></a>
                </div>

                <div class="col-md-6 col-lg-3 mb-4">
                    <h2 class="footer-heading mb-4 text-light">Services</h2>
                    <ul class="list-unstyled">
                        <li><a href="#" class="py-1 d-block text-secondary text-decoration-none"><i class="fa fa-map-marker me-2"></i> Map Direction</a></li>
                        <li><a href="#" class="py-1 d-block text-secondary text-decoration-none"><i class="fa fa-building me-2"></i> Accomodation Services</a></li>
                        <li><a href="#" class="py-1 d-block text-secondary text-decoration-none"><i class="fa fa-star me-2"></i> Great Experience</a></li>
                        <li><a href="#" class="py-1 d-block text-secondary text-decoration-none"><i class="fa fa-location-arrow me-2"></i> Perfect central location</a></li>
                    </ul>
                </div>

                <div class="col-md-6 col-lg-3 mb-4">
                    <h2 class="footer-heading mb-4 text-light">Tag Cloud</h2>
                    <div class="tagcloud">
                        <a href="#" class="tag-cloud-link badge bg-secondary text-light p-2 m-1">apartment</a>
                        <a href="#" class="tag-cloud-link badge bg-secondary text-light p-2 m-1">home</a>
                        <a href="#" class="tag-cloud-link badge bg-secondary text-light p-2 m-1">vacation</a>
                        <a href="#" class="tag-cloud-link badge bg-secondary text-light p-2 m-1">rental</a>
                        <a href="#" class="tag-cloud-link badge bg-secondary text-light p-2 m-1">rent</a>
                        <a href="#" class="tag-cloud-link badge bg-secondary text-light p-2 m-1">house</a>
                        <a href="#" class="tag-cloud-link badge bg-secondary text-light p-2 m-1">place</a>
                    </div>
                </div>

                <div class="col-md-6 col-lg-3 mb-4">
                    <h2 class="footer-heading mb-4 text-light">Subscribe</h2>
                    <form action="#" class="subscribe-form">
                        <div class="input-group mb-3">
                            <input type="email" class="form-control rounded-start" placeholder="Enter email address" aria-label="Email address for subscription">
                            <button type="submit" class="btn btn-primary rounded-end">
                                <span class="sr-only">Submit</span><i class="fa fa-paper-plane"></i>
                            </button>
                        </div>
                    </form>
                    
                    <h2 class="footer-heading mt-4 mb-3 text-light">Follow us</h2>
                    <ul class="ftco-footer-social p-0 d-flex gap-2">
                        <li class="ftco-animate">
                            <a href="#" data-bs-toggle="tooltip" data-bs-placement="top" title="Twitter" class="btn btn-outline-light btn-sm">
                                <i class="fab fa-twitter"></i>
                            </a>
                        </li>
                        <li class="ftco-animate">
                            <a href="#" data-bs-toggle="tooltip" data-bs-placement="top" title="Facebook" class="btn btn-outline-light btn-sm">
                                <i class="fab fa-facebook-f"></i>
                            </a>
                        </li>
                        <li class="ftco-animate">
                            <a href="#" data-bs-toggle="tooltip" data-bs-placement="top" title="Instagram" class="btn btn-outline-light btn-sm">
                                <i class="fab fa-instagram"></i>
                            </a>
                        </li>
                        <li class="ftco-animate">
                             <a href="#" data-bs-toggle="tooltip" data-bs-placement="top" title="Dribbble" class="btn btn-outline-light btn-sm">
                                <i class="fab fa-dribbble"></i>
                            </a>
                        </li>
                    </ul>
                </div>
            </div>
        </div>

        <div class="w-100 mt-5 border-top border-secondary py-3">
            <div class="container">
                <div class="row">
                    <div class="col-md-6 col-lg-8">
                        <p class="copyright mb-0 text-secondary">
                            Copyright &copy;<script>document.write(new Date().getFullYear());</script> All rights reserved | This template is made with <i class="fa fa-heart text-danger" aria-hidden="true"></i> by <a href="https://colorlib.com" target="_blank" class="text-primary text-decoration-none">Colorlib.com</a>
                        </p>
                    </div>
                    <div class="col-md-6 col-lg-4 text-md-end">
                        <p class="mb-0 list-unstyled d-flex justify-content-md-end gap-3">
                            <a class="text-secondary text-decoration-none" href="#">Terms</a>
                            <a class="text-secondary text-decoration-none" href="#">Privacy</a>
                            <a class="text-secondary text-decoration-none" href="#">Compliances</a>
                        </p>
                    </div>
                </div>
            </div>
        </div>
    </footer>
    <script src="{{ asset('assets/js/jquery.min.js') }}"></script>
    <script src="{{ asset('assets/js/jquery-migrate-3.0.1.min.js') }}"></script>
    <script src="{{ asset('assets/js/popper.min.js') }}"></script>
    <script src="{{ asset('assets/js/jquery.easing.1.3.js') }}"></script>
    <script src="{{ asset('assets/js/jquery.waypoints.min.js') }}"></script>
    <script src="{{ asset('assets/js/jquery.stellar.min.js') }}"></script>
    <script src="{{ asset('assets/js/jquery.animateNumber.min.js') }}"></script>
    <script src="{{ asset('assets/js/bootstrap-datepicker.js') }}"></script>
    <script src="{{ asset('assets/js/jquery.timepicker.min.js') }}"></script>
    <script src="{{ asset('assets/js/owl.carousel.min.js') }}"></script>
    <script src="{{ asset('assets/js/jquery.magnific-popup.min.js') }}"></script>
    <script src="{{ asset('assets/js/scrollax.min.js') }}"></script>
    <script src="{{ asset('assets/js/main.js') }}"></script>
</body>
</html>