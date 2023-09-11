@extends('layouts.dash')
@section('content')
<div class="container-fluid">
    <div class="row">
        <!-- Column -->
        <div class="col-lg-4 col-xlg-3 col-md-12">
            <div class="white-box">
                <div class="user-bg"> <img width="100%" alt="user" src="plugins/images/large/img1.jpg">
                    <div class="overlay-box">
                        <div class="user-content">
                            <a href="javascript:void(0)"><img src="plugins/images/users/genu.jpg"
                                    class="thumb-lg img-circle" alt="img"></a>
                            <h4 class="text-white mt-2">{{Auth()->user()->name}}</h4>
                            <h5 class="text-white mt-2">{{Auth()->user()->email}}</h5>
                        </div>
                    </div>
                </div>
                <div class="user-btm-box mt-5 text-center">
                    <div class="text-center">
                        <h1>{{Auth()->user()->contact}}</h1>
                    </div>
                </div>
            </div>
        </div>
        <!-- Column -->
        <!-- Column -->
        <div class="col-lg-8 col-xlg-9 col-md-12">
            <div class="card">
                <div class="card-body">
                    <form class="form-horizontal form-material" method="post" action="/updateProfile">
                        <div class="form-group mb-4">
                            <label class="col-md-12 p-0">Full Name</label>
                            <div class="col-md-12 border-bottom p-0">
                                <input type="text" disabled value="{{Auth()->user()->name}}" class="form-control p-0 border-0">
                            </div>
                        </div>
                        <div class="form-group mb-4">
                            <label for="example-email" class="col-md-12 p-0">Email</label>
                            <div class="col-md-12 border-bottom p-0">
                                <input type="email" name='email' value="{{Auth()->user()->email}}" class="form-control p-0 border-0"
                                    name="example-email" id="example-email">
                            </div>
                        </div>
                        <div class="form-group mb-4">
                            <label class="col-md-12 p-0">Phone No</label>
                            <div class="col-md-12 border-bottom p-0">
                                <input type="number" name='contact' value="{{Auth()->user()->contact}}" class="form-control p-0 border-0">
                            </div>
                        </div>
                        <div class="form-group mb-4">
                            <label class="col-md-12 p-0">Residence</label>
                            <div class="col-md-12 border-bottom p-0">
                                <input type="text" name='location' value="{{Auth()->user()->residence}}" class="form-control p-0 border-0">
                            </div>
                        </div>
                        <div class="form-group mb-4">
                            <div class="col-sm-12">
                                <button class="btn btn-success" type="submit">Update Profile</button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
        <!-- Column -->
    </div>
</div>
@endsection