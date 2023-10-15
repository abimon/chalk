@extends('layouts.dash')
@section('content')
<div class="page-breadcrumb bg-white">
    <div class="row align-items-center">
        <div class="col-lg-3 col-md-4 col-sm-4 col-xs-12">
            <h4 class="page-title">Stock</h4>
        </div>
        <div class="col-lg-9 col-sm-8 col-md-8 col-xs-12">
            <div class="d-md-flex">
                <ol class="breadcrumb ms-auto">
                    <li><a href="#" class="fw-normal"></a></li>
                </ol>
                @if(Auth()->user()->role=='Admin')
                <button type="button" data-toggle="modal" data-target="#exampleModal" class="btn btn-danger  d-none d-md-block pull-right ms-3 hidden-xs hidden-sm waves-effect waves-light text-white">Add Product</button>
                <div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                    <div class="modal-dialog" role="document">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title" id="exampleModalLabel">Add Product</h5>
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                </button>
                            </div>
                            <form method="post" action="/product/addProduct" enctype="multipart/form-data">
                                @csrf
                                <div class="modal-body">
                                    <div class="row mb-3">
                                        <label for="file" class="col-md-4 col-form-label text-md-end">{{ __('Product Image') }}</label>
                                        <div class="col-md-6">
                                            <input id="file" name='file' type="file" class="form-control">
                                            @error('price')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="row mb-3">
                                        <label for="name" class="col-md-4 col-form-label text-md-end">{{ __('Product Name') }}</label>
                                        <div class="col-md-6">
                                            <input id="name" type="text" class="form-control @error('name') is-invalid @enderror" name="name" value="{{ old('name') }}" required autocomplete="name">

                                            @error('name')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="row mb-3">
                                        <label for="price" class="col-md-4 col-form-label text-md-end">{{ __('Product Price') }}</label>
                                        <div class="col-md-6">
                                            <input id="price" type="number" class="form-control @error('price') is-invalid @enderror" name="price" value="{{ old('price') }}" required autocomplete="price">

                                            @error('price')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                            @enderror
                                        </div>
                                    </div>
                                    
                                    <div class="row mb-3">
                                        <label for="desc" class="col-md-4 col-form-label text-md-end">{{ __('Product description') }}</label>
                                        <div class="col-md-6">
                                            <textarea id="desc" type="number" class="form-control @error('desc') is-invalid @enderror" name="desc" value="{{ old('desc') }}" required autocomplete="desc"></textarea>

                                            @error('desc')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="row mb-3">
                                        <label for="category" class="col-md-4 col-form-label text-md-end">{{ __('Category') }}</label>

                                        <div class="col-md-6">
                                            <select class="form-select" name="category" aria-label="Default select example">
                                                <option selected disabled>Select Category</option>
                                                <?php $cats = ['Fruits', 'Vegetables', 'Cereals', 'Seedling', 'Literature', 'Others']; ?>
                                                @foreach($cats as $cat)
                                                <option value="{{$cat}}">{{$cat}}</option>
                                                @endforeach
                                            </select>

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
                                    <button type="submit" class="btn btn-primary">Save User</button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
                @endif
            </div>
        </div>
    </div>
    <!-- /.col-lg-12 -->
</div>
<div class="container-fluid">
    <div class="row">
        <div class="col-sm-12">
            <div class="white-box">
                <h3 class="box-title">Stock Inventory</h3>
                <div class="table-responsive">
                    <table class="table text-nowrap">
                        <thead>
                            <tr>
                                <th class="border-top-0">#</th>
                                <th class="border-top-0">Picture</th>
                                <th class="border-top-0">Product Name</th>
                                <th class="border-top-0">Category</th>
                                <th class="border-top-0">Price</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($items as $key=>$item)
                            <tr>
                                <td>{{$key+1}}</td>
                                <td>
                                    <img src="{{asset('storage/images/products/'.$item['path'])}}" width='60'>
                                </td>
                                <td>{{$item->product_name}}</td>
                                <td>{{$item->category}}</td>
                                <td>{{$item->price}}</td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
    <!-- ============================================================== -->
    <!-- End PAge Content -->
    <!-- ============================================================== -->
    <!-- ============================================================== -->
    <!-- Right sidebar -->
    <!-- ============================================================== -->
    <!-- .right-sidebar -->
    <!-- ============================================================== -->
    <!-- End Right sidebar -->
    <!-- ============================================================== -->
</div>
@endsection