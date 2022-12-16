<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <title>Booking online</title>
    <meta content="width=device-width, initial-scale=1.0" name="viewport">
    <meta content="" name="keywords">
    <meta content="" name="description">

    <!-- Favicon -->
    <link href="{{ asset('front-end/img/favicon.ico')}}" rel="icon">

    <!-- Google Web Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Work+Sans:wght@400;500;600;700&display=swap" rel="stylesheet">

    <!-- Icon Font Stylesheet -->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.10.0/css/all.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.4.1/font/bootstrap-icons.css" rel="stylesheet">

    <!-- Libraries Stylesheet -->
    <link href="{{ asset('front-end/lib/animate/animate.min.css') }}" rel="stylesheet">
    <link href="{{ asset('front-end/lib/owlcarousel/assets/owl.carousel.min.css') }}" rel="stylesheet">

    <!-- Customized Bootstrap Stylesheet -->
    <link href="{{ asset('front-end/css/bootstrap.min.css')}}" rel="stylesheet">

    <!-- Template Stylesheet -->
    <link href="{{ asset('front-end/css/style.css')}}" rel="stylesheet">
</head>

<body>
    <!-- Spinner Start -->
    <div id="spinner" class="show bg-white position-fixed translate-middle w-100 vh-100 top-50 start-50 d-flex align-items-center justify-content-center">
        <div class="spinner-grow text-primary" role="status"></div>
    </div>
    <!-- Spinner End -->


    <!-- Topbar Start -->

    <!-- Topbar End -->


    <!-- Navbar Start -->
    <nav class="navbar navbar-expand-lg bg-white navbar-light sticky-top p-0">
        <a href="index.html" class="navbar-brand d-flex align-items-center border-end px-4 px-lg-5">
            <h2 class="m-0"><i class="fa fa-building" aria-hidden="true"></i>Booking Online</h2>
        </a>
        <button type="button" class="navbar-toggler me-4" data-bs-toggle="collapse" data-bs-target="#navbarCollapse">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarCollapse">
            <div class="navbar-nav ms-auto p-4 p-lg-0">
               
            </div>
            @auth
            <a href="{{ route('login') }}" class="btn btn-primary py-4 px-lg-5 d-none d-lg-block"> Account <i class="fa fa-user ms-3"></i></a>
            @else
            <a href="{{ route('login') }}" class="btn btn-primary py-4 px-lg-5 d-none d-lg-block">Sign in/Sign up<i class="fa fa-arrow-right ms-3"></i></a>
            @endauth
        </div>
    </nav>
    <!-- Navbar End -->


    <!-- Carousel Start -->
    <div class="container-fluid p-0 wow fadeIn" data-wow-delay="0.1s">
        <div id="header-carousel" class="carousel slide" data-bs-ride="carousel">
            <div class="carousel-inner">

                @php
                    $hotels = App\Models\Hotel::with('bookings')->orderBy('id', 'asc')->get();
                    $restaurants = App\Models\Restaurant::with('bookings')->orderBy('id', 'asc')->get();
                    $spots = App\Models\TouristSpot::with('bookings')->orderBy('id', 'asc')->get();
                   
                    $sortedHotels = [];
                    $sortedRestaurants = [];
                    $sortedSpots = [];

                    foreach ($hotels as $key => $hotel){
                        if(count($hotel->bookings) != 0){
                            $sortedHotels[count($hotel->bookings)] = $hotel;
                        }
                    }

                    foreach ($restaurants as $key => $restaurant){
                        if(count($restaurant->bookings) != 0){
                            $sortedRestaurants[count($restaurant->bookings)] = $restaurant;
                        }
                    }

                    foreach ($spots as $key => $spot){
                        if(count($spot->bookings) != 0){
                            $sortedSpots[count($spot->bookings)] = $spot;
                        }
                    }


                    $limit = 5;
                    $h = 1;
                    $r = 1;
                    $t = 1;
                @endphp


                @if (empty($sortedHotels) && empty($sortedRestaurants) && empty($sortedSpots))
                    <div class="carousel-item active">   
                        
                        <img class="w-100" src="{{ asset('front-end/img/luxe.jpg')}}" alt="Image">
                        
                        <div class="carousel-caption">
                            <div class="container">
                                <div class="row justify-content-center">
                                    <div class="col-lg-7">
                                        <h1 class="display-2 text-light mb-5 animated slideInDown">Choose in your own convenience</h1>
                                        <a href="{{ route('login') }}" class="btn btn-primary py-sm-3 px-sm-5">Book Now!</a>
                                    </div>
                                </div>
                            </div>
                        </div>

                    </div>
                @endif
                
                @foreach ($sortedHotels as $hotel)    
                     @if( $h >= $limit )
                        @break
                     @endif
                    <div class="carousel-item {{ $h == 1 ? 'active':'' }}">   
                        @if($hotel->picture == null)
                        <img class="w-100" src="{{ asset('front-end/img/luxe.jpg')}}" alt="Image">
                        @else
                        <img class="w-100" src="{{ asset("storage/pictures/hotel/$hotel->id/$hotel->picture") }}" alt="Image">
                        @endif
                        <div class="carousel-caption">
                            <div class="container">
                                <div class="row justify-content-center">
                                    <div class="col-lg-7">
                                        <h1 class="display-2 text-light mb-5 animated slideInDown">{{ $hotel->name }}</h1>
                                        <a href="{{ route('login') }}" class="btn btn-primary py-sm-3 px-sm-5">Book Now!</a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    
                    {{ $h++ }}
                @endforeach

                @foreach ($sortedRestaurants as $restaurant)    
                     @if( $r >= $limit )
                        @break
                     @endif
                    <div class="carousel-item ">   
                        @if($restaurant->picture == null)
                        <img class="w-100" src="{{ asset('front-end/img/luxe.jpg')}}" alt="Image">
                        @else
                        <img class="w-100" src="{{ asset("storage/pictures/restaurant/$restaurant->id/$restaurant->picture") }}" alt="Image">
                        @endif
                        <div class="carousel-caption">
                            <div class="container">
                                <div class="row justify-content-center">
                                    <div class="col-lg-7">
                                        <h1 class="display-2 text-light mb-5 animated slideInDown">{{ $restaurant->name }}</h1>
                                        <a href="{{ route('login') }}" class="btn btn-primary py-sm-3 px-sm-5">Book Now!</a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    
                    {{ $r++ }}
                @endforeach

                @foreach ($sortedSpots as $touristSpot)    
                     @if( $t >= $limit )
                        @break
                     @endif
                    <div class="carousel-item ">   
                        @if($touristSpot->picture == null)
                        <img class="w-100" src="{{ asset('front-end/img/luxe.jpg')}}" alt="Image">
                        @else
                        <img class="w-100" src="{{ asset("storage/pictures/tourist_spot/$touristSpot->id/$touristSpot->picture") }}" alt="Image">
                        @endif
                        <div class="carousel-caption">
                            <div class="container">
                                <div class="row justify-content-center">
                                    <div class="col-lg-7">
                                        <h1 class="display-2 text-light mb-5 animated slideInDown">{{ $touristSpot->name }}</h1>
                                        <a href="{{ route('login') }}" class="btn btn-primary py-sm-3 px-sm-5">Book Now!</a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    
                    {{ $t++ }}
                @endforeach
                
            </div>

            <button class="carousel-control-prev" type="button" data-bs-target="#header-carousel"
                data-bs-slide="prev">
                <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                <span class="visually-hidden">Previous</span>
            </button>
            <button class="carousel-control-next" type="button" data-bs-target="#header-carousel"
                data-bs-slide="next">
                <span class="carousel-control-next-icon" aria-hidden="true"></span>
                <span class="visually-hidden">Next</span>
            </button>
        </div>
    </div>
    <!-- Carousel End -->


    <!-- Facts Start -->
    <div class="container-fluid facts py-5 pt-lg-0">
        <div class="container py-5 pt-lg-0">
            <div class="row gx-0">
                <div class="col-lg-4 wow fadeIn" data-wow-delay="0.1s">
                    <div class="bg-white shadow d-flex align-items-center h-100 p-4" style="min-height: 150px;">
                        <div class="d-flex">
                            <div class="ps-4">
                                <h5>Find places </h5>
                                <span>Find hotels, restaurants, and Tourist spots</span>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-lg-4 wow fadeIn" data-wow-delay="0.3s">
                    <div class="bg-white shadow d-flex align-items-center h-100 p-4" style="min-height: 150px;">
                        <div class="d-flex">
                            <div class="ps-4">
                                <h5>Make reservations</h5>
                                <span>There are lots of choices</span>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-lg-4 wow fadeIn" data-wow-delay="0.5s">
                    <div class="bg-white shadow d-flex align-items-center h-100 p-4" style="min-height: 150px;">
                        <div class="d-flex">
                            <div class="ps-4">
                                <h5>Enjoy your stay</h5>
                                <span>Ambot say ibutang dri</span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- Facts End -->


    <!-- About Start -->
    <div class="container-xxl py-6">
        <div class="container">
            <div class="row g-5">
                <div class="col-lg-6 wow fadeInUp" data-wow-delay="0.1s">
                    <div class="position-relative overflow-hidden ps-5 pt-5 h-100" style="min-height: 400px;">
                        <img class="position-absolute w-100 h-100" src="{{ asset('front-end/img/cagayan.webp')}}" alt="" style="object-fit: cover;">
                        <img class="position-absolute top-0 start-0 bg-white pe-3 pb-3" src="{{ asset('front-end/img/about-2')}}.jpg" alt="" style="width: 200px; height: 200px;">
                    </div>
                </div>
                <div class="col-lg-6 wow fadeInUp" data-wow-delay="0.5s">
                    <div class="h-100">
                        <h6 class="text-primary text-uppercase mb-2">About Us</h6>
                        <h1 class="display-6 mb-4">We help people in discovering the businesses in Cagayan de Oro.</h1>
                        <p>Tempor erat elitr rebum at clita. Diam dolor diam ipsum sit. Aliqu diam amet diam et eos. Clita erat ipsum et lorem et sit, sed stet lorem sit clita duo justo magna dolore erat amet</p>
                        <p class="mb-4">Tempor erat elitr rebum at clita. Diam dolor diam ipsum sit. Aliqu diam amet diam et eos. Clita erat ipsum et lorem et sit, sed stet lorem sit clita duo justo magna dolore erat amet</p>
                        <div class="row g-2 mb-4 pb-2">
                            <div class="col-sm-6">
                                <i class="fa fa-check text-primary me-2"></i>Fully Licensed
                            </div>
                            <div class="col-sm-6">
                                <i class="fa fa-check text-primary me-2"></i>Online Tracking
                            </div>
                            <div class="col-sm-6">
                                <i class="fa fa-check text-primary me-2"></i>Afordable Fee
                            </div>
                            <div class="col-sm-6">
                                <i class="fa fa-check text-primary me-2"></i>Best Trainers
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- About End -->


    <!-- Courses Start -->
    
    <section class="details-card">
        <div class="container">
            <h4 class="black-text d-block py-4 text-center">CHEAPEST HOTELS, RESTAURANTS, AND TOURIST SPOTS IN THE CITY!</h4>
            <div class="justify-content-between d-flex">
                @if($get_hotel):
                <div class="col-md-4">
                    <div class="card-content">
                        <div class="card-img">
                            <img class="h-100 w-100" style="max-width: 100%; max-height: 200px" src="{{ ($get_hotel->picture) ? asset("/storage/pictures/hotel/$get_hotel->id/" . $get_hotel->picture):asset('/assets/img/home-decor-1.jpg') }}"" alt="">
                            <p class="pt-4"><strong>PHP {{ $get_hotel->min_price }}</strong></p>
                            <span><p class="fs-6">{{ $get_hotel->location }}</p></span>
                        </div>
                        <div class="card-desc">
                            <h3>{{ $get_hotel->name }}</h3>
                            <p>{{ $get_hotel->description }}</p> 
                        </div>
                    </div>
                </div>
                @endif
                @if($get_restaurant):
                <div class="col-md-4">
                    <div class="card-content">
                        <div class="card-img">
                            <img class="h-100 w-100" style="max-width: 100%; max-height: 200px" src="{{ ($get_restaurant->picture) ? asset("/storage/pictures/restaurant/$get_restaurant->id/" . $get_restaurant->picture):asset('/assets/img/home-decor-1.jpg') }}"" alt="">
                            <p class="pt-4"><strong>PHP {{$get_restaurant->min_price}}</strong></p>
                            <span><p class="fs-6">{{ $get_restaurant->location }}</p></span>
                        </div>
                        <div class="card-desc">
                            <h3>{{ $get_restaurant->name }}</h3>
                            <p>{{  $get_restaurant->description }}</p>
                        </div>
                    </div>
                </div>
                @endif
                @if($get_touristSpot):
                <div class="col-md-4">
                    <div class="card-content">
                        <div class="card-img">
                            <img class="h-100 w-100" style="max-width: 100%; max-height: 200px" src="{{ ($get_touristSpot->picture) ? asset("/storage/pictures/tourist_spot/$get_touristSpot->id/" . $get_touristSpot->picture):asset('/assets/img/home-decor-1.jpg') }}"" alt="">
                            <p class="pt-4"><strong>PHP {{$get_touristSpot->price}}</strong></p>
                            <span><p class="fs-6">{{ $get_touristSpot->location }}</p></span>
                        </div>
                        <div class="card-desc">
                            <h3>{{ $get_touristSpot->name }}</h3>
                            <p>{{ $get_touristSpot->description }}</p>
                        </div>
                    </div>
                </div>
                @endif
            </div>
        </div>
    </section>
    <!-- Courses End -->


    <!-- Features Start -->
    <div class="container-xxl py-6">
        <div class="container">
            <div class="row g-5">
                <div class="col-lg-6 wow fadeInUp" data-wow-delay="0.1s">
                    <h6 class="text-primary text-uppercase mb-2">Why Choose Us!</h6>
                    <h1 class="display-6 mb-4">Find the top cagayan de oro hotels, dining places, and tourist hotspots.</h1>
                    <p class="mb-5">Tempor erat elitr rebum at clita. Diam dolor diam ipsum sit. Aliqu diam amet diam et eos. Clita erat ipsum et lorem et sit, sed stet lorem sit clita duo justo magna dolore erat amet</p>
                    <div class="row gy-5 gx-4">
                        <div class="col-sm-6 wow fadeIn" data-wow-delay="0.1s">
                            <div class="d-flex align-items-center mb-3">
                                <div class="flex-shrink-0 btn-square bg-primary me-3">
                                    <i class="fa fa-check text-white"></i>
                                </div>
                                <h5 class="mb-0">Fully Licensed</h5>
                            </div>
                            <span>Magna sea eos sit dolor, ipsum amet ipsum lorem diam eos</span>
                        </div>
                        <div class="col-sm-6 wow fadeIn" data-wow-delay="0.2s">
                            <div class="d-flex align-items-center mb-3">
                                <div class="flex-shrink-0 btn-square bg-primary me-3">
                                    <i class="fa fa-check text-white"></i>
                                </div>
                                <h5 class="mb-0">Online Tracking</h5>
                            </div>
                            <span>Magna sea eos sit dolor, ipsum amet ipsum lorem diam eos</span>
                        </div>
                        <div class="col-sm-6 wow fadeIn" data-wow-delay="0.3s">
                            <div class="d-flex align-items-center mb-3">
                                <div class="flex-shrink-0 btn-square bg-primary me-3">
                                    <i class="fa fa-check text-white"></i>
                                </div>
                                <h5 class="mb-0">Afordable Fee</h5>
                            </div>
                            <span>Magna sea eos sit dolor, ipsum amet ipsum lorem diam eos</span>
                        </div>
                        <div class="col-sm-6 wow fadeIn" data-wow-delay="0.4s">
                            <div class="d-flex align-items-center mb-3">
                                <div class="flex-shrink-0 btn-square bg-primary me-3">
                                    <i class="fa fa-check text-white"></i>
                                </div>
                                <h5 class="mb-0">Best Trainers</h5>
                            </div>
                            <span>Magna sea eos sit dolor, ipsum amet ipsum lorem diam eos</span>
                        </div>
                    </div>
                </div>
                <div class="col-lg-6 wow fadeInUp" data-wow-delay="0.5s">
                    <div class="position-relative overflow-hidden pe-5 pt-5 h-100" style="min-height: 400px;">
                        <img class="position-absolute w-100 h-100" src="{{ asset('front-end/img/cagayan.webp')}}" alt="" style="object-fit: cover;">
                        <img class="position-absolute top-0 end-0 bg-white ps-3 pb-3" src="{{ asset('front-end/img/about-2')}}.jpg" alt="" style="width: 200px; height: 200px">
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- Features End -->


    <!-- Team Start -->

    <!-- Team End -->


    <!-- Testimonial Start -->

    <!-- Testimonial End -->


    <!-- Footer Start -->
    <div class="container-fluid bg-dark text-light footer my-6 mb-0 py-6 wow fadeIn" data-wow-delay="0.1s">
        <div class="container">
            <div class="row g-5">
                <div class="col-lg-3 col-md-6">
                    
                </div>
                <div class="col-lg-3 col-md-6">
                    
                </div>
                <div class="col-lg-3 col-md-6">
                    
                </div>
                <div class="col-lg-3 col-md-6">
                    
                </div>
            </div>
        </div>
    </div>
    <!-- Footer End -->


    <!-- Copyright Start -->
    <div class="container-fluid copyright text-light py-4 wow fadeIn" data-wow-delay="0.1s">
        <div class="container">
            <div class="row">
                <div class="col-md-6 text-center text-md-start mb-3 mb-md-0">
                    &copy; <a href="#">Booking Application</a>, All Right Reserved.
                </div>
                <div class="col-md-6 text-center text-md-end">
                    <!--/*** This template is free as long as you keep the footer author’s credit link/attribution link/backlink. If you'd like to use the template without the footer author’s credit link/attribution link/backlink, you can purchase the Credit Removal License from "https://htmlcodex.com/credit-removal". Thank you for your support. ***/-->
                    Designed By <a href="#">The Bantols</a>
                </div>
            </div>
        </div>
    </div>
    <!-- Copyright End -->


    <!-- Back to Top -->
    <a href="#" class="btn btn-lg btn-primary btn-lg-square back-to-top"><i class="bi bi-arrow-up"></i></a>


    <!-- JavaScript Libraries -->
    <script src="https://code.jquery.com/jquery-3.4.1.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0/dist/js/bootstrap.bundle.min.js"></script>
    <script src="{{ asset('front-end/lib/wow/wow.min.js') }}"></script>
    <script src="{{ asset('front-end/lib/easing/easing.min.js') }}"></script>
    <script src="{{ asset('front-end/lib/waypoints/waypoints.min.js') }}"></script>
    <script src="{{ asset('front-end/lib/owlcarousel/owl.carousel.min.js') }}"></script>

    <!-- Template Javascript -->
    <script src="{{ asset('front-end/js/main.js') }}"></script>
</body>

</html>
