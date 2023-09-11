@extends('layouts.dash')
@section('content')
<div class="page-breadcrumb bg-white">
    <div class="row align-items-center">
        <div class="col-lg-3 col-md-4 col-sm-4 col-xs-12">
            <h4 class="page-title">Cart</h4>
        </div>
    </div>
    <!-- /.col-lg-12 -->
</div>
<div class="container-fluid">
    <div class="row">
        <div class="col-sm-12">
            <div class="white-box">
                <h3 class="box-title">Cart [{{$carts->count()}}]</h3>
                <div class="table-responsive">
                    <table class="table text-nowrap">
                        <thead>
                            <tr>
                                <th class="border-top-0">#</th>
                                <th class="border-top-0">Item</th>
                                <th class="border-top-0">Qty</th>
                                <th class="border-top-0">Unit Price</th>
                                <th class="border-top-0">Total</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($carts as $key=>$cart)
                            <tr>
                                <td>{{$key+1}}</td>
                                <td>
                                    <img src="{{asset('storage/images/products/'.$cart->path)}}" width='100'>
                                    <p>{{$cart->product_name}}</p>
                                </td>
                                <td>{{$cart->quantity}}</td>
                                <td>{{$cart->price}}</td>
                                <td>{{($cart->quantity)*($cart->price)}}</td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                    <div class="text-end">
                        <p>
                            <b>Total </b> Kshs {{$total}}.00
                        </p>
                        <button class="btn btn-success" data-toggle="modal" data-target="#orderModal">Complete Order</button>
                        <div class="modal fade" id="orderModal" tabindex="-1" role="dialog" aria-labelledby="orderModal" aria-hidden="true">
                            <div class="modal-dialog" role="document">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h5 class="modal-title" id="orderModal">Complete Order</h5>
                                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                            <span aria-hidden="true">&times;</span>
                                        </button>
                                    </div>
                                    <form method="post" action="/order/makeOrder" enctype="multipart/form-data">
                                        @csrf
                                        <div class="modal-body">
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
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection