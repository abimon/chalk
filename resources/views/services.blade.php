@extends('layouts.app')
@section('content')
<div class="container-fluid bg-light bg-icon my-5 py-6">
    <div class="container">
        <div class="section-header text-center mx-auto mb-5 wow fadeInUp" data-wow-delay="0.1s" style="max-width: 500px;">
            <h1 class="display-5 mb-3">Our Lifestyle Center</h1>
            
        </div>
        <div class="row g-4">
            <div class="col-lg-6 col-md-6 wow fadeInUp" data-wow-delay="0.1s">
                <div class="bg-white text-center h-100 p-4 p-xl-5">
                    <img class="img-fluid mb-4" style="width: 50px;" src="{{asset('storage/assets/img/school.png')}}" alt="">
                    <h4 class="mb-3">E-learning</h4>
                    <p class="mb-4">We offer both online and physical classes for different skills. Our learning systems are friendly and our fee policies affordable.</p>
                    <a class="btn btn-outline-primary border-2 py-2 px-4 rounded-pill" href="/studentreg">Register</a>
                </div>
            </div>
            <div class="col-lg-6 col-md-6 wow fadeInUp" data-wow-delay="0.3s">
                <div class="bg-white text-center h-100 p-4 p-xl-5">
                    <img class="img-fluid mb-4 " style="width: 50px;" src="{{asset('storage/assets/img/clinic.png')}}" alt="">
                    <h4 class="mb-3">Sanitorium</h4>
                    <p class="mb-4">We offer health services ranging from consultation, prescriprions, home-care etc.</p>
                    <a class="btn btn-outline-primary border-2 py-2 px-4 rounded-pill" href="/patientreg">Register</a>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection