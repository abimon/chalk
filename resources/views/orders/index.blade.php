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
                                <th class="border-top-0">Unit Price</th>
                                <th class="border-top-0">Total</th>
                                <th class="border-top-0">Delivery</th>
                                <th class="border-top-0">Payment</th>

                            </tr>
                        </thead>
                        <tbody>
                            @foreach($orders as $key=>$order)
                            <tr>
                                <td>{{$order->receipt}}</td>
                                <td>
                                    <img src="{{asset('storage/images/products/'.$order->product->path)}}" width='100'>
                                    <p>{{$order->product->product_name}}</p>
                                </td>
                                <td>{{$order->quantity}}</td>
                                <td>{{$order->product->price}}</td>
                                <td>{{($order->quantity)*($order->product->price)}}</td>
                                <td>{{$order->delivery}}</td>
                                <td>@if($order->payment=='Pending')
                                    <button class="btn btn-success" data-toggle="modal" data-target="#payModal{{$order->id}}">Pay</button>
                                    <div class="modal fade" id="payModal{{$order->id}}" tabindex="-1" role="dialog" aria-labelledby="payModal{{$order->id}}" aria-hidden="true">
                                        <div class="modal-dialog" role="document">
                                            <div class="modal-content">
                                                <div class="modal-header">
                                                    <h5 class="modal-title" id="orderModal">Complete Order</h5>
                                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                        <span aria-hidden="true">&times;</span>
                                                    </button>
                                                </div>
                                                <form method="get" action="{{route('order.show',$order->id)}}" enctype="multipart/form-data">
                                                    @csrf
                                                    <div class="modal-body">
                                                    <div class="row mb-3">
                                                            <label for="category" class="col-md-4 col-form-label text-md-end">{{ __('Order No.') }}</label>

                                                            <div class="col-md-6">
                                                                <input type="text" name="receipt" value="{{$order->receipt}}" disabled>
                                                                @error('receipt')
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
                                                        <div class="row mb-3">
                                                            <label for="category" class="col-md-4 col-form-label text-md-end">{{ __('Total Amount') }}</label>

                                                            <div class="col-md-6">
                                                                <input type="number" name="amount" value="{{($order->quantity)*($order->product->price)}}">
                                                                @error('amount')
                                                                <span class="invalid-feedback" role="alert">
                                                                    <strong>{{ $message }}</strong>
                                                                </span>
                                                                @enderror
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="modal-footer">
                                                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                                                        <button type="submit" class="btn btn-success">Complete Payment</button>
                                                    </div>
                                                </form>
                                            </div>
                                        </div>
                                    </div>
                                    @else
                                    Paid
                                    @endif
                                </td>
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