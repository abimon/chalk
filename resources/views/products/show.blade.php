@extends('layouts.app')
@section('content')

<!-- Product Start -->
<div class="container-xxl py-5 mt-5">
    <div class="container">
        <div class="row g-0 gx-5 align-items-end">
            <div class="col-lg-4 ">
                <div class="section-header text-start mb-5 wow fadeInUp mt-5" data-wow-delay="0.1s" style="max-width: 500px;">
                    <h1 class="display-5 mb-3">Our Products</h1>
                    <!-- <p>Tempor ut dolore lorem kasd vero ipsum sit eirmod sit. Ipsum diam justo sed rebum vero dolor duo.</p> -->
                </div>
            </div>
            <div class="col-lg-8 col-12 text-start text-lg-end wow slideInRight" data-wow-delay="0.1s">
                <ul class="nav nav-pills d-inline-flex justify-content-end mb-5">
                    <li class="nav-item me-2 mt-1">
                        <a class="btn btn-outline-primary border-2 {{request()->path()=='products'?'active':''}}"  href="/products">All</a>
                        
                    </li>
                    <li class="nav-item me-2 mt-1">
                        <a class="btn btn-outline-primary border-2 {{request()->path()=='products/Vegetables'?'active':''}}"  href="/products/Vegetables">Vegetables </a>
                    </li>
                    <li class="nav-item me-2 mt-1">
                        <a class="btn btn-outline-primary border-2 {{request()->path()=='products/Fruits'?'active':''}}"  href="/products/Fruits">Fruits </a>
                    </li>
                    <li class="nav-item me-2 mt-1">
                        <a class="btn btn-outline-primary border-2 {{request()->path()=='products/Seedling'?'active':''}}"  href="/products/Seedling">Seedlings </a>
                    </li>
                    <li class="nav-item me-2 mt-1">
                        <a class="btn btn-outline-primary border-2 {{request()->path()=='products/Cereals'?'active':''}}"  href="/products/Cereals">Cereals</a>
                    </li>
                    <li class="nav-item me-2 mt-1">
                        <a class="btn btn-outline-primary border-2 {{request()->path()=='products/Literature'?'active':''}}"  href="/products/Literature">Literature</a>
                    </li>
                    <li class="nav-item me-2 mt-1">
                        <a class="btn btn-outline-primary border-2 {{request()->path()=='products/Ebook'?'active':''}}"  href="/products/Ebook">E-Books</a>
                    </li>
                </ul>
            </div>
        </div>
        <div class="tab-content">
            <div id="tab-1" class="tab-pane fade show p-0 active">
                <div class="row g-4">
                    @foreach($products as $key=>$product)
                    <div class="col-xl-3 col-lg-4 col-md-6 wow fadeInUp" data-wow-delay="{{(($key+1)%4)==1?'0.1s':((($key+1)%3)==1?'0.3s':((($key+1)%2)==0?'0.5s':'0.7s'))}}">
                        <div class="product-item" >
                            <div class="position-relative bg-light overflow-hidden">
                                <img class="img-fluid" src="{{asset('storage/images/products/'.$product['path'])}}" style='height:300px;width:100%;object-fit:scale-down;'alt="">
                                <div class="bg-secondary rounded text-white position-absolute start-0 top-0 m-4 py-1 px-3">New</div>
                            </div>
                            <div class="text-center p-4">
                                <a class="d-block h5 mb-2" href="">{{$product->product_name}}</a>
                                <span class="text-primary me-1">KShs {{$product->price}}.00</span>
                                <span class="text-body text-decoration-line-through">KShs {{($product->price)+20}}.00</span>
                            </div>
                            <div class="d-flex border-top">
                                <small class="w-50 text-center border-end py-2">
                                    <a class="text-body" href=""><i class="fa fa-eye text-primary me-2"></i>View detail</a>
                                </small>
                                <small class="w-50 text-center py-2">
                                    <a class="text-body" href="{{route('cart.create',['id'=>$product->id])}}"><i class="fa fa-shopping-bag text-primary me-2"></i>Add to cart</a>
                                </small>
                            </div>
                        </div>
                    </div>
                    @endforeach
                </div>
            </div>
        </div>
    </div>
</div>
<!-- Product End -->
@endsection