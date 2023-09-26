@extends('layouts.dash')
@section('content')
<div class="page-breadcrumb bg-white">
    <div class="row align-items-center">
        <div class="col-lg-3 col-md-4 col-sm-4 col-xs-12">
            <h4 class="page-title">Orders</h4>
        </div>
    </div>
    <!-- /.col-lg-12 -->
</div>
<div class="container-fluid">
    <div class="row">
        <div class="col-sm-12">
            <div class="white-box">
                <h3 class="box-title">Orders [{{$orders->count()}}]</h3>
                <div class="table-responsive">
                    <table class="table text-nowrap">
                        <thead>
                            <tr>
                                <th class="border-top-0">#</th>
                                <th class="border-top-0">Item</th>
                                <th class="border-top-0">Qty</th>
                                <th class="border-top-0">Payment</th>
                                <th class="border-top-0">Delivery</th>
                                <th class="border-top-0">Buyer</th>
                                <th class="border-top-0">Contact</th>
                                <th class="border-top-0">Destination</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($orders as $key=>$order)
                            <tr>
                                <td>{{$key+1}}</td>
                                <td>{{$order->product_name}}</td>
                                <td>{{$order->quantity}}</td>
                                <td>@if($order->payment=='Pending')
                                <button class="btn btn-success" data-toggle="modal" data-target="#orderModal">Complete Order</button>
                        <div class="modal fade" id="orderModal" tabindex="-1" role="dialog" aria-labelledby="orderModal" aria-hidden="true">
                            <div class="modal-dialog" role="document">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h5 class="modal-title" id="orderModal">Pay</h5>
                                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                            <span aria-hidden="true">&times;</span>
                                        </button>
                                    </div>
                                    <form method="post" action="/order/payOrder/{{$order->id}}" enctype="multipart/form-data">
                                        @csrf
                                        <div class="modal-body">
                                        <div class="row mb-3">
                                                <label for="category" class="col-md-4 col-form-label text-md-end">{{ __('Order No.') }}</label>
                                                <div class="col-md-6">
                                                    <input type="text" name="orderNo" value="{{$order->id}}" disabled>
                                                    @error('county')
                                                    <span class="invalid-feedback" role="alert">
                                                        <strong>{{ $message }}</strong>
                                                    </span>
                                                    @enderror
                                                </div>
                                            </div>
                                            <div class="row mb-3">
                                                <label for="category" class="col-md-4 col-form-label text-md-end">{{ __('M-Pesa Number') }}</label>
                                                <div class="col-md-6">
                                                    <input type="text" name="phone" value="{{Auth()->user()->contact}}">
                                                    @error('county')
                                                    <span class="invalid-feedback" role="alert">
                                                        <strong>{{ $message }}</strong>
                                                    </span>
                                                    @enderror
                                                </div>
                                            </div>
                                        </div>
                                        <div class="modal-footer">
                                            <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                                            <button type="submit" class="btn btn-success">Complete Order</button>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                                    @else
                                    <div class="btn-success"><i class="fa fa-check"></i>{{$order->payment}}</div>
                                    @endif
                                </td>
                                <td>{{$order->delivery}}</td>
                                <td>{{$order->name}}</td>
                                <td>{{$order->contact}}</td>
                                <td>{{$order->pickup}}</td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection