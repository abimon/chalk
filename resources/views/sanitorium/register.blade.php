@extends('layouts.app')
@section('content')
<div class="container-xxl py-6" style="margin-top: 50px;">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header text-center">{{ __('Sanitorium Register') }}</div>

                <div class="card-body">
                    <form method="POST" action="/patient/create">
                        @csrf

                        <div class="row mb-3">
                            <label for="name" class="col-md-4 col-form-label text-md-end">{{ __('Name') }}</label>

                            <div class="col-md-6">
                                <input id="name" type="text" class="form-control @error('name') is-invalid @enderror" name="name" value="{{ old('name') }}" required autocomplete="name" autofocus>

                                @error('name')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                                @enderror
                            </div>
                        </div>

                        <div class="row mb-3">
                            <label for="email" class="col-md-4 col-form-label text-md-end">{{ __('Email Address') }}</label>

                            <div class="col-md-6">
                                <input id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" required autocomplete="email">

                                @error('email')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                                @enderror
                            </div>
                        </div>
                        <div class="row mb-3">
                            <label for="contact" class="col-md-4 col-form-label text-md-end">{{ __('Phone No.') }}</label>

                            <div class="col-md-6">
                                <input id="contact" type="number" class="form-control @error('contact') is-invalid @enderror" name="contact" value="{{ old('contact') }}" required autocomplete="contact" maxlength="13" minlength="9">

                                @error('contact')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                                @enderror
                            </div>
                        </div>
                        <div class="row mb-3">
                            <label for="ages" class="col-md-4 col-form-label text-md-end">{{ __('Gender') }}</label>

                            <div class="col-md-6">
                                <select name="gender" id="" class="form-control" required>
                                    <option value="" selected disabled>Select your Gender</option>
                                    <option value="Male">Male</option>
                                    <option value="Female">Female</option>
                                </select>

                                @error('gender')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                                @enderror
                            </div>
                        </div>
                        <?php $ages = ['0–2', '3–5', '6–13', '14–18', '19–33', '34–48', '49–64', '65–78', '78+']; ?>
                        <div class="row mb-3">
                            <label for="ages" class="col-md-4 col-form-label text-md-end">{{ __('Age Group') }}</label>

                            <div class="col-md-6">
                                <select name="agegroup" id="" class="form-control" required>
                                    <option value="" selected disabled>Select your age group</option>
                                    @foreach($ages as $age)
                                    <option value="{{$age}}">{{$age}}</option>
                                    @endforeach
                                </select>

                                @error('agegroup')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                                @enderror
                            </div>
                        </div>
                        <div class="row mb-3">
                            <label for="County" class="col-md-4 col-form-label text-md-end">{{ __('County') }}</label>

                            <div class="col-md-6">
                                <select class="form-select" name="county" aria-label="Default select example">
                                    <option selected disabled>Select County</option>
                                    @foreach($counties as $county)
                                    <option value="{{$county->county}}">{{$county->county}}</option>
                                    @endforeach
                                </select>

                                @error('county')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                                @enderror
                            </div>
                        </div>
                        <div class="row mb-3">
                            <label for="town" class="col-md-4 col-form-label text-md-end">{{ __('Town') }}</label>

                            <div class="col-md-6">
                                <select class="form-select" name="town" aria-label="Default select example">
                                    <option selected disabled>Select Town</option>
                                    @foreach($towns as $town)
                                    <option value="{{$town->town}}">{{$town->town}}</option>
                                    @endforeach
                                </select>
                                @error('county')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                                @enderror
                            </div>
                        </div>
                        <div class="row mb-3">
                            <label for="condition" class="col-md-4 col-form-label text-md-end">{{ __("What is the patient's condition?") }}</label>
                            <div class="col-md-6">
                                <input type="text" name="condition" id="" class="form-control">
                                @error('service')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                                @enderror
                            </div>
                        </div>
                        <div class="row mb-3">
                            <label for="ages" class="col-md-4 col-form-label text-md-end">{{ __('Preffered Service') }}</label>

                            <div class="col-md-6">
                                <select name="pref_service" id="" class="form-control" required>
                                    <option value="" selected disabled>Select your preffered service</option>
                                    <option value="Our home care">Our home care</option>
                                    <option value="Care at you home">Care at you home</option>
                                    <option value="Regular visits">Regular visits</option>
                                </select>

                                @error('service')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                                @enderror
                            </div>
                        </div>
                        <div class="row mb-0">
                            <div class="col-md-6 offset-md-4">
                                <button type="submit" class="btn btn-primary">
                                    {{ __('Register') }}
                                </button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection