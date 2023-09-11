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
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($orders as $key=>$order)
                            <tr>
                                <td>{{$key+1}}</td>
                                <td>
                                    <img src="{{asset('storage/images/products/'.$order->path)}}" width='100'>
                                    <p>{{$order->product_name}}</p>
                                </td>
                                <td>{{$order->quantity}}</td>
                                <td>{{$order->price}}</td>
                                <td>{{($order->quantity)*($order->price)}}</td>
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