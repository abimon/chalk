@extends('layouts.app')
@section('content')
<div class="container-fluid bg-light bg-icon my-5 py-6">
    <div class="container">
        <div class="section-header text-center mx-auto mb-5 wow fadeInUp" data-wow-delay="0.1s" style="">
            <h2 class="display-5 mb-3">Our Lifestyle and Activity Center</h2>

        </div>
        <div class="row g-4">
            <div class="col-lg-4 col-md-4 wow fadeInUp" data-wow-delay="0.3s">
                <div class="bg-white text-center h-100 p-4 p-xl-5">
                    <img class="img-fluid mb-4 " style="width: 50px;" src="{{asset('storage/assets/img/pickup.gif')}}" alt="">
                    <h4 class="mb-3">Transport Services</h4>
                    <p class="mb-4">Hire a Pick-up truck for only Kshs 2950* per day</p>
                    
                    <p>Make inquiry before payment by calling, <a href="tel:+254705325860">+254 705 325860</a></p>
                    <p><i><small>*The fees includes the drivers' fee, but excludes fuel</small>.</i></p>
                    <a class="btn btn-outline-primary border-2 py-2 px-4 rounded-pill" href="#" data-bs-toggle="modal" data-bs-target="#exampleModal">Book</a>

                    <!-- Modal -->
                    <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                        <div class="modal-dialog">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h1 class="modal-title fs-5" id="exampleModalLabel">Transport Booking</h1>
                                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                </div>
                                <form action="/transport/create" method='post' enctype='multpart/form-data'>
                                    @csrf
                                    <div class="modal-body">
                                        <div class="row mb-3">
                                            <label for="name" class="col-md-4 col-form-label text-md-end">{{ __('Name') }}</label>
                                            <div class="col-md-8">
                                                <input id="name" type="text" class="form-control @error('name') is-invalid @enderror" name="name" value="{{ old('name') }}" required autocomplete="name">

                                                @error('name')
                                                <span class="invalid-feedback" role="alert">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                                @enderror
                                            </div>
                                        </div>
                                        <div class="row mb-3">
                                            <label for="contact" class="col-md-4 col-form-label text-md-end">{{ __('Phone No.') }}</label>
                                            <div class="col-md-8">
                                                <input id="contact" type="number" class="form-control @error('contact') is-invalid @enderror" name="contact" value="{{ old('contact') }}" required autocomplete="contact" maxlength="13" minlength="9">

                                                @error('contact')
                                                <span class="invalid-feedback" role="alert">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                                @enderror
                                            </div>
                                        </div>
                                        <div class="row mb-3">
                                            <label for="location" class="col-md-4 col-form-label text-md-end">{{ __('Demand Location') }}</label>
                                            <div class="col-md-8">
                                                <input id="location" type="text" class="form-control @error('location') is-invalid @enderror" name="location" value="{{ old('location') }}" required autocomplete="location" >

                                                @error('location')
                                                <span class="invalid-feedback" role="alert">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                                @enderror
                                            </div>
                                        </div>
                                        <div class="row mb-3">
                                            <label for="for" class="col-md-4 col-form-label text-md-end">{{ __('Demanded Date') }}</label>
                                            <div class="col-md-8">
                                                <input id="date" type="date" class="form-control @error('date') is-invalid @enderror" name="date" value="{{ old('date') }}" required >
                                                @error('date')
                                                <span class="invalid-feedback" role="alert">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                                @enderror
                                            </div>
                                        </div>
                                        <div class="row mb-3">
                                            <label for="duration" class="col-md-4 col-form-label text-md-end">{{ __('Duration(days)') }}</label>
                                            <div class="col-md-8">
                                                <input id="duration" type="number" class="form-control @error('duration') is-invalid @enderror" name="duration" value="{{ old('duration') }}" required autocomplete="duration" >
                                                @error('duration')
                                                <span class="invalid-feedback" role="alert">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                                @enderror
                                            </div>
                                        </div>
                                        <div class="row mb-3">
                                            <label for="desc" class="col-md-4 col-form-label text-md-end">{{ __('Short description of the work to be done') }}</label>
                                            <div class="col-md-8">
                                                <textarea id="desc" type="number" class="form-control @error('desc') is-invalid @enderror" name="desc" value="{{ old('desc') }}" required ></textarea>
                                                @error('desc')
                                                <span class="invalid-feedback" role="alert">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                                @enderror
                                            </div>
                                        </div>
                                    </div>
                                    <div class="modal-footer">
                                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                                        <button type="submit" class="btn btn-primary">Book</button>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-lg-4 col-md-4 wow fadeInUp" data-wow-delay="0.1s">
                <div class="bg-white text-center h-100 p-4 p-xl-5">
                    <img class="img-fluid mb-4" style="width: 50px;" src="{{asset('storage/assets/img/school.png')}}" alt="">
                    <h4 class="mb-3">Learning Center</h4>
                    <p class="mb-1">We offer both online and physical classes for different skills. Our learning systems are friendly and our fee policies affordable.</p>
                    <p class='mb-1'>Each training programme within respective cohorts takes from 10 days to 3 weeks.</p>
                    <a class="btn btn-outline-primary border-2 py-2 px-4 rounded-pill" href="/studentreg">Register</a>
                </div>
            </div>
            <div class="col-lg-4 col-md-4 wow fadeInUp" data-wow-delay="0.3s">
                <div class="bg-white text-center h-100 p-4 p-xl-5">
                    <img class="img-fluid mb-4 " style="width: 50px;" src="{{asset('storage/assets/img/clinic.png')}}" alt="">
                    <h4 class="mb-3">Sanatorium</h4>
                    <p class="mb-4">We offer health services ranging from consultation, home-care etc.</p>
                    <a class="btn btn-outline-primary border-2 py-2 px-4 rounded-pill" href="/patientreg">Register</a>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection