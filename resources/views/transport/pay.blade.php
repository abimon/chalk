@extends('layouts.app')
@section('content')
<div class="container-xxl py-6" style="margin-top: 50px;">
    <div class="row justify-content-center">
        @if (session('message'))
        <div class="alert alert-danger">{{ session('message') }}</div>
        @endif
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">{{ __('Make Payment') }}</div>
                <div class="card-body">
                    <form method="POST" action="transport/pay/{{$service->id)}}">
                        @csrf
                        <div class="row mb-3">
                            <label for="contact" class="col-md-4 col-form-label text-md-end">{{ __('Phone No.') }}</label>
                            <div class="col-md-6">
                                <input id="contact"  class="form-control @error('contact') is-invalid @enderror" name="contact" value="{{$service->contact}}" required >
                                <small>Edit to a phone number you want to pay with. Ensure it starts with 07 or 01</small>
                                @error('contact')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                                @enderror
                            </div>
                        </div>
                        <div class="row mb-3">
                            <label for="amount" class="col-md-4 col-form-label text-md-end">{{ __('Amount') }}</label>

                            <div class="col-md-6">
                                <input id="amount" type="number" class="form-control @error('amount') is-invalid @enderror" name="amount" value="{{$service->balance}}" required autocomplete="amount">
                                <small><i>You can edit the amount to pay.</i></small>
                                @error('amount')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                                @enderror
                            </div>
                        </div>
                        <div class="row mb-0">
                            <div class="col-md-6 offset-md-4">
                                <button type="submit" class="btn btn-primary">
                                    {{ __('Pay') }}
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