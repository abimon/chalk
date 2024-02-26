<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    @isset($title)
    <title>Health & Life Centre - {{$title}}</title>
    @else
    <title>Health & Life Centre </title>
    @endisset

    <meta content="width=device-width, initial-scale=1.0" name="viewport">
    <meta content="health, life, sanatorium, online, ecommerce, healthandlife, center, books, organic, plants, school, lifestyle," name="keywords">
    @isset($descr)
    <meta content={{$descr}} name="description">
    @else
    <meta content="Health and Life Center is an organization that aims at meeting one's spiritual, financial, social, physical and intellectual needs in one way or another. Through various avenues such as literature, written articles, organic products, various online courses and sanatorium services, we try to meet this vision." name="description">
    @endisset
    <!-- Favicon -->
    <link href="{{asset('storage/assets/img/logo.png')}}" rel="icon">

    <!-- Google Web Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Open+Sans:wght@400;500&family=Lora:wght@600;700&display=swap" rel="stylesheet">

    <!-- Icon Font Stylesheet -->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.10.0/css/all.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.4.1/font/bootstrap-icons.css" rel="stylesheet">

    <!-- Libraries Stylesheet -->
    <link href="{{asset('storage/assets/lib/animate/animate.min.css')}}" rel="stylesheet">
    <link href="{{asset('storage/assets/lib/owlcarousel/assets/owl.carousel.min.css')}}" rel="stylesheet">

    <!-- Customized Bootstrap Stylesheet -->
    <link href="{{asset('storage/assets/css/bootstrap.min.css')}}" rel="stylesheet">

    <!-- Template Stylesheet -->
    <link href="{{asset('storage/assets/css/style.css')}}" rel="stylesheet">

</head>

<body>
    <!-- Spinner Start -->
    <div id="spinner" class="show bg-white position-fixed translate-middle w-100 vh-100 top-50 start-50 d-flex align-items-center justify-content-center">
        <div class="spinner-border text-primary" role="status"></div>
    </div>
    <!--Spinner End -->
    <!-- Navbar Start -->
    <div class="container-fluid fixed-top px-0 wow fadeIn" data-wow-delay="0.1s">
        <div class="top-bar row gx-0 align-items-center d-none d-lg-flex">
            <div class="col-lg-8 px-2 text-start">
                <small><i class="fa fa-map-marker-alt me-2"></i>Chalk Home Complex; Off Namba-Ndiru Road; Homa-Bay County</small>
                <small class="ms-4"><i class="fa fa-envelope me-2"></i>info@healthandlifecenter.com</small>
            </div>
            <div class="col-lg-4 px-2 text-end">
                <small>Follow us:</small>
                <a class="text-body ms-3" href=""><i class="fab fa-facebook-f"></i></a>
                <a class="text-body ms-3" href=""><i class="fab fa-twitter"></i></a>
                <a class="text-body ms-3" href=""><i class="fab fa-whatsapp"></i></a>
                <a class="text-body ms-3" href=""><i class="fab fa-instagram"></i></a>
            </div>
        </div>

        <nav class="navbar navbar-expand-lg navbar-light py-lg-0 px-lg-5 wow fadeIn" data-wow-delay="0.1s">
            <a href="/" class="navbar-brand ms-4 ms-lg-0">
                <h1 class="fw-bold text-primary m-0">Health & Life <span class="text-secondary">Center</span></h1>
            </a>
            <button type="button" class="navbar-toggler me-4" data-bs-toggle="collapse" data-bs-target="#navbarCollapse">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarCollapse">
                <div class="navbar-nav ms-auto p-4 p-lg-0">
                    <a href="/" class="nav-item nav-link">Home</a>
                    <a href="/products" class="nav-item nav-link">Products</a>
                    <a href="/services" class="nav-item nav-link">Services</a>
                    <a href="/articles" class="nav-item nav-link">Articles</a>
                    <div class="nav-item dropdown">
                        <a href="#" class="nav-link" data-bs-toggle="dropdown">
                            <small class="fa fa-search text-body"></small>
                        </a>
                        <div class="dropdown-menu ">
                            <form action="/search" method="post" class="m-3">
                                @csrf
                                <input type="text" name="search" id="" class="form-control" placeholder="Keyword...">
                            </form>
                        </div>
                    </div>
                    <a href="/contact" class="nav-item nav-link">Contact Us</a>


                    @guest
                    <div class='nav-item nav-link'>
                        <a class="btn-sm-square bg-white rounded-circle " href="/login">
                            <small class="fa fa-user text-body"></small>
                        </a>
                    </div>

                    @else
                    <div class='nav-item nav-link'>
                        <a class="btn-sm-square bg-white rounded-circle" href="/dashboard">
                            <small class="fa fa-user text-body"></small>
                        </a>
                    </div>

                    @endif


                    <div class='nav-item nav-link'>
                        <a class="btn-sm-square bg-white rounded-pill text-secondary" href="{{route('cart.index')}}"> 
                            @guest
                            <small class="fa fa-shopping-cart"></small>
                                @else
                                <?php
                                $carts = App\Models\cart::where('buyer_id', auth()->user()->id)
                                ?>
                                <small class="fa fa-shopping-cart"></small> {{$carts->count()}}
                                @endguest
                        </a>
                    </div>

                </div>
            </div>
        </nav>
    </div>
    <!-- Navbar End -->
    <div style="min-height: 500px;">
        @yield('content')
    </div>

    <!-- Footer Start -->
    <div class="container-fluid bg-dark footer mt-5 pt-5 wow fadeIn" data-wow-delay="0.1s">
        <div class="container py-5">
            <div class="row g-5">
                <div class="col-lg-4 col-md-6">
                    <h1 class="fw-bold text-primary mb-4">Health & Life <span class="text-secondary">Center</span></h1>
                    <p>We're a home. Come and visit us. We've adapted ourselves to provide your organic farming needs, your health food requirements and naturopathy. We also offer a variety of other useful products and services that might interest you. Be our guest.</p>
                    <div class="d-flex pt-2">
                        <a class="btn btn-square btn-outline-light rounded-circle me-1" href=""><i class="fab fa-twitter"></i></a>
                        <a class="btn btn-square btn-outline-light rounded-circle me-1" href=""><i class="fab fa-facebook-f"></i></a>
                        <a class="btn btn-square btn-outline-light rounded-circle me-1" href=""><i class="fab fa-youtube"></i></a>
                        <a class="btn btn-square btn-outline-light rounded-circle me-0" href=""><i class="fab fa-whatsapp"></i></a>
                    </div>
                </div>
                <div class="col-lg-4 col-md-6">
                    <h4 class="text-light mb-4">Address</h4>
                    <p><i class="fa fa-map-marker-alt me-3"></i>Chalk Home Complex; Off Namba-Ndiru Road; Homa-Bay County</p>
                    <p><i class="fa fa-phone-alt me-3"></i>+254 722 987 365</p>
                    <p><i class="fa fa-envelope me-3"></i>info@healthandlifecenter.com</p>
                </div>
                <div class="col-lg-4 col-md-6">
                    <h4 class="text-light mb-4">Quick Links</h4>
                    <a class="btn btn-link" href="">About Us</a>
                    <a class="btn btn-link" href="">Contact Us</a>
                    <a class="btn btn-link" href="">Our Services</a>
                    <a class="btn btn-link" href="">Terms & Condition</a>
                    <a class="btn btn-link" href="">Support</a>
                </div>
                <!-- <div class="col-lg-3 col-md-6">
                    <h4 class="text-light mb-4">Newsletter</h4>
                    <p>Subscribe to our periodical magazines, articles and notifications on trainings and new products here.</p>
                    <div class="position-relative mx-auto" style="max-width: 400px;">
                        <input class="form-control bg-transparent w-100 py-3 ps-4 pe-5" type="text" placeholder="Your email">
                        <button type="button" class="btn btn-primary py-2 position-absolute top-0 end-0 mt-2 me-2">SignUp</button>
                    </div>
                </div> -->
            </div>
        </div>
        <div class="container-fluid copyright">
            <div class="container">
                <div class="row">
                    <div class="col-md-6 text-center text-md-start mb-3 mb-md-0">
                        &copy; <a href="#">Health & Life Center</a>, All Right Reserved.
                    </div>
                    <div class="col-md-6 text-center text-md-end">
                        Designed By <a href="https://apekinc.top">APEK INC</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- Footer End -->

    <!-- Back to Top -->
    <a href="#" class="btn btn-lg btn-primary btn-lg-square rounded-circle back-to-top" style="left: 20px;"><i class="bi bi-arrow-up"></i></a>


    <!-- JavaScript Libraries -->
    <!--Start of Tawk.to Script-->
    // <script type="text/javascript">
        //     var Tawk_API = Tawk_API || {},
        //         Tawk_LoadStart = new Date();
        //     (function() {
        //         var s1 = document.createElement("script"),
        //             s0 = document.getElementsByTagName("script")[0];
        //         s1.async = true;
        //         s1.src = 'https://embed.tawk.to/65151a6ce6bed319d003acf5/1hbd6uehc';
        //         s1.charset = 'UTF-8';
        //         s1.setAttribute('crossorigin', '*');
        //         s0.parentNode.insertBefore(s1, s0);
        //     })();
        // 
    </script>
    <!--End of Tawk.to Script-->
    <script src="https://code.jquery.com/jquery-3.4.1.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0/dist/js/bootstrap.bundle.min.js"></script>
    <script src="{{asset('storage/assets/lib/wow/wow.min.js')}}"></script>
    <script src="{{asset('storage/assets/lib/easing/easing.min.js')}}"></script>
    <script src="{{asset('storage/assets/lib/waypoints/waypoints.min.js')}}"></script>
    <script src="{{asset('storage/assets/lib/owlcarousel/owl.carousel.min.js')}}"></script>

    <!-- Template Javascript -->
    <script src="{{asset('storage/assets/js/main.js')}}"></script>
</body>

</html>