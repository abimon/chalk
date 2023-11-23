@extends('layouts.app')
@section('content')
<!-- Page Header Start -->
<div class="container-fluid page-header wow fadeIn" data-wow-delay="0.1s">
    <div class="container">
        <h1 class="display-3 mb-3 animated slideInDown">Contact Us</h1>
        <nav aria-label="breadcrumb animated slideInDown">
            <ol class="breadcrumb mb-0">
                <li class="breadcrumb-item"><a class="text-body" href="/">Home</a></li>
                <li class="breadcrumb-item text-dark active" aria-current="page">Contact Us</li>
            </ol>
        </nav>
    </div>
</div>
<!-- Page Header End -->

<!-- Contact Start -->
<div class="container-xxl py-6">
    <div class="container">
        <div class="section-header text-center mx-auto mb-5 wow fadeInUp" data-wow-delay="0.1s" style="max-width: 500px;">
            <h1 class="display-5 mb-3">Contact Us</h1>
            <p>Inquire from us through any of the contact media below. We purpose to get back to you as soon as possible.</p>
        </div>
        <div class="row g-5 justify-content-center">
            <div class="col-lg-5 col-md-12 wow fadeInUp" data-wow-delay="0.1s">
                <div class="bg-primary text-white d-flex flex-column justify-content-center h-100 p-5">
                    <h5 class="text-white">Call Us</h5>
                    <p class="mb-5"><i class="fa fa-phone-alt me-3"></i>+254 722 987 365</p>
                    <h5 class="text-white">Email Us</h5>
                    <p class="mb-5"><i class="fa fa-envelope me-3"></i>info@healthandlifecenter.com</p>
                    <h5 class="text-white">Office Address</h5>
                    <p class="mb-5"><i class="fa fa-map-marker-alt me-3"></i>Chalk Home Complex; Off Namba-Ndiru Road; Homa-Bay County</p>
                    <h5 class="text-white">Follow Us</h5>
                    <div class="d-flex pt-2">
                        <a class="btn btn-square btn-outline-light rounded-circle me-1" href=""><i class="fab fa-twitter"></i></a>
                        <a class="btn btn-square btn-outline-light rounded-circle me-1" href=""><i class="fab fa-facebook-f"></i></a>
                        <a class="btn btn-square btn-outline-light rounded-circle me-1" href=""><i class="fab fa-youtube"></i></a>
                        <a class="btn btn-square btn-outline-light rounded-circle me-0" href=""><i class="fab fa-whatsapp"></i></a>
                    </div>
                </div>
            </div>
            <div class="col-lg-7 col-md-12 wow fadeInUp" data-wow-delay="0.5s">
                <p class="mb-4">Any information shared through this form is kept private as per our user policy. It will only be used to respond to you appropriately.</p>
                <form>
                    <div class="row g-3">
                        <div class="col-md-6">
                            <div class="form-floating">
                                <input type="text" class="form-control" id="name" placeholder="Your Name">
                                <label for="name">Your Name</label>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-floating">
                                <input type="email" class="form-control" id="email" placeholder="Your Email">
                                <label for="email">Your Email</label>
                            </div>
                        </div>
                        <div class="col-12">
                            <div class="form-floating">
                                <input type="text" class="form-control" id="subject" placeholder="Subject">
                                <label for="subject">Subject</label>
                            </div>
                        </div>
                        <div class="col-12">
                            <div class="form-floating">
                                <textarea class="form-control" placeholder="Leave a message here" id="message" style="height: 200px"></textarea>
                                <label for="message">Message</label>
                            </div>
                        </div>
                        <div class="col-12">
                            <button class="btn btn-primary rounded-pill py-3 px-5" type="submit">Send Message</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
<!-- Contact End -->
<!-- Google Map Start -->
<div class="container-xxl px-0 wow fadeIn" data-wow-delay="0.1s" style="margin-bottom: -6px;">
    <iframe class="w-100" style="height: 450px;" src="https://www.google.com/maps/embed?pb=!1m16!1m12!1m3!1d997.374356719495!2d34.6363576789762!3d-0.7266820245689479!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!2m1!1skamagambo!5e0!3m2!1sen!2ske!4v1693202663871!5m2!1sen!2ske" frameborder="0" allowfullscreen="" aria-hidden="false" tabindex="0"></iframe>
        
</div>
<!-- Google Map End -->
@endsection