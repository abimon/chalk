@extends('layouts.dash')
@section('content')
<div class="page-breadcrumb bg-white">
    <div class="row align-items-center">
        <div class="col-lg-3 col-md-4 col-sm-4 col-xs-12">
            <h4 class="page-title">Pickup Boookings</h4>
        </div>
    </div>
    <!-- /.col-lg-12 -->
</div>
<div class="container-fluid">
    <div class="row">
        <div class="col-sm-12">
            <div class="white-box">
                <div class="table-responsive">
                    @if(($items->count())>0)
                    <table class="table text-nowrap">
                        <thead>
                            <tr>
                                <th class="border-top-0">#</th>
                                <th class="border-top-0">Name</th>
                                <th class="border-top-0">Contact</th>
                                <th class="border-top-0">Residence</th>
                                <th class="border-top-0">Date</th>
                                <th class="border-top-0">Duration</th>
                                <th class="border-top-0">Balance</th>
                                <th class="border-top-0">Completed</th>
                            </tr>
                        </thead>
                        <tbody>
                            
                        </tbody>
                    </table>
                    @else
                    <p>No Bookings Yet!</p>
                    @endif
                </div>
            </div>
        </div>
    </div>
</div>
@endsection