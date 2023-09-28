<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <title>CHALK Organic</title>
    <meta content="width=device-width, initial-scale=1.0" name="viewport">
    <meta content="" name="keywords">
    <meta content="" name="description">

    <!-- Favicon -->
    <link href="img/favicon.ico" rel="icon">

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
    <style>
        .total-count {
            position: absolute;
            top: 10px;
            right: 32px;
            background: #f6931d;
            width: 18px;
            height: 18px;
            line-height: 18px;
            text-align: center;
            color: #fff;
            border-radius: 100%;
            font-size: 11px;
        }
    </style>
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
                <small class="ms-4"><i class="fa fa-envelope me-2"></i>info@chalkorganic.com</small>
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
            <a href="index.html" class="navbar-brand ms-4 ms-lg-0">
                <h1 class="fw-bold text-primary m-0">Health & Life <span class="text-secondary">Center</span></h1>
            </a>
            <button type="button" class="navbar-toggler me-4" data-bs-toggle="collapse" data-bs-target="#navbarCollapse">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarCollapse">
                <div class="navbar-nav ms-auto p-4 p-lg-0">
                    <a href="/" class="nav-item nav-link">Home</a>
                    <a href="/products" class="nav-item nav-link">Farm Products</a>
                    <a href="/products/Literature" class="nav-item nav-link">Literature</a>
                    <a href="/lifestyle" class="nav-item nav-link">Lifestyle Support Center</a>
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

                </div>
                <div class="d-none d-lg-flex ms-2">
                    @guest
                    <a class="btn-sm-square bg-white rounded-circle ms-3" href="/login">
                        <small class="fa fa-user text-body"></small>
                    </a>
                    @else
                    <a class="btn-sm-square bg-white rounded-circle ms-3" href="/dashboard">
                        <small class="fa fa-user text-body"></small>
                    </a>
                    @endif
                    <a class="btn-sm-square bg-white rounded-circle ms-3" href="/cart">
                        <small class="fa fa-shopping-bag text-body"><span class="total-count">0</span></small>
                    </a>
                </div>
            </div>
        </nav>
    </div>
    <!-- Navbar End -->

    @yield('content')
    <!-- Footer Start -->
    <div class="container-fluid bg-dark footer mt-5 pt-5 wow fadeIn" data-wow-delay="0.1s">
        <div class="container py-5">
            <div class="row g-5">
                <div class="col-lg-3 col-md-6">
                    <h1 class="fw-bold text-primary mb-4">Health & Life <span class="text-secondary">Center</span></h1>
                    <p>We're a home. Come and visit us. We've adapted ourselves to provide your organic farming needs, your health food requirements and naturopathy. We also offer a variety of other useful products and services that might interest you. Be our guest.</p>
                    <div class="d-flex pt-2">
                        <a class="btn btn-square btn-outline-light rounded-circle me-1" href=""><i class="fab fa-twitter"></i></a>
                        <a class="btn btn-square btn-outline-light rounded-circle me-1" href=""><i class="fab fa-facebook-f"></i></a>
                        <a class="btn btn-square btn-outline-light rounded-circle me-1" href=""><i class="fab fa-youtube"></i></a>
                        <a class="btn btn-square btn-outline-light rounded-circle me-0" href=""><i class="fab fa-whatsapp"></i></a>
                    </div>
                </div>
                <div class="col-lg-3 col-md-6">
                    <h4 class="text-light mb-4">Address</h4>
                    <p><i class="fa fa-map-marker-alt me-3"></i>Chalk Home Complex; Off Namba-Ndiru Road; Homa-Bay County</p>
                    <p><i class="fa fa-phone-alt me-3"></i>+254 722 987 365</p>
                    <p><i class="fa fa-envelope me-3"></i>info@healthandlifecenter.com</p>
                </div>
                <div class="col-lg-3 col-md-6">
                    <h4 class="text-light mb-4">Quick Links</h4>
                    <a class="btn btn-link" href="">About Us</a>
                    <a class="btn btn-link" href="">Contact Us</a>
                    <a class="btn btn-link" href="">Our Services</a>
                    <a class="btn btn-link" href="">Terms & Condition</a>
                    <a class="btn btn-link" href="">Support</a>
                </div>
                <div class="col-lg-3 col-md-6">
                    <h4 class="text-light mb-4">Newsletter</h4>
                    <p>Subscribe to our periodical magazines, articles and notifications on trainings and new products here.</p>
                    <div class="position-relative mx-auto" style="max-width: 400px;">
                        <input class="form-control bg-transparent w-100 py-3 ps-4 pe-5" type="text" placeholder="Your email">
                        <button type="button" class="btn btn-primary py-2 position-absolute top-0 end-0 mt-2 me-2">SignUp</button>
                    </div>
                </div>
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
    <a href="#" class="btn btn-lg btn-primary btn-lg-square rounded-circle back-to-top" style="left: 100px;"><i class="bi bi-arrow-up"></i></a>


    <!-- JavaScript Libraries -->
    <!--Start of Tawk.to Script-->
    <script type="text/javascript">
        var Tawk_API = Tawk_API || {},
            Tawk_LoadStart = new Date();
        (function() {
            var s1 = document.createElement("script"),
                s0 = document.getElementsByTagName("script")[0];
            s1.async = true;
            s1.src = 'https://embed.tawk.to/65151a6ce6bed319d003acf5/1hbd6uehc';
            s1.charset = 'UTF-8';
            s1.setAttribute('crossorigin', '*');
            s0.parentNode.insertBefore(s1, s0);
        })();
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