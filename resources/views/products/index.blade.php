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
                <button type="button" data-toggle="modal" data-target="#exampleModal" class="btn btn-success  d-none d-md-block pull-right ms-3 hidden-xs hidden-sm waves-effect waves-light text-white">Add Product</button>
                <div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                    <div class="modal-dialog" role="document">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title" id="exampleModalLabel">Add Product</h5>
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                </button>
                            </div>
                            <form method="post" action="{{route('product.store')}}" enctype="multipart/form-data">
                                @csrf
                                <div class="modal-body">

                                    <div class="row mb-3">
                                        <label for="productImage" class="col-md-4 col-form-label">Product Image</label>
                                        <div class="col-md-6">
                                            <img id="output" src="{{asset('storage/profile/'.Auth()->User()->avatar)}}" style="width:100px;" />
                                            <input type="file" accept="image/jpeg, image/png" name="file" id="file" style="display: none;" class="form-control" onchange="loadFile(event)">

                                            <script>
                                                var loadFile = function(event) {
                                                    var image = document.getElementById('output');
                                                    image.src = URL.createObjectURL(event.target.files[0]);
                                                    document.getElementById('output').value == image.src;
                                                };
                                            </script>
                                            <div class="pt-2">
                                                <a href="#" class="btn btn-primary btn-sm " title="Upload new profile image"><label for="file" class="text-white"><i class="bi bi-upload"></i> Product Image</label></a>
                                            </div>
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
                                            <textarea id="desc" type="number" class="form-control @error('desc') is-invalid @enderror" name="desc" required autocomplete="desc">{{ old('desc') }}</textarea>

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
                                            <div class="accordion accordion-flush" id="accordionFlushExample">
                                                <div class="row">
                                                    <div class="form-check col-6">
                                                        <input class="form-check-input" type="radio" value="Ebook" name="cat" id="flexRadioDefault1" data-bs-toggle="collapse" data-bs-target="#flush-collapseOne" aria-expanded="false" aria-controls="flush-collapseOne">
                                                        <label class="form-check-label" for="flexRadioDefault1">
                                                            Ebook
                                                        </label>
                                                    </div>
                                                    <div class="form-check col-6">
                                                        <input class="form-check-input" type="radio" name="cat" id="flexRadioDefault2" value="others" data-bs-toggle="collapse" data-bs-target="#flush-collapseTwo" aria-expanded="false" aria-controls="flush-collapseTwo">
                                                        <label class="form-check-label" for="flexRadioDefault2">
                                                            Others
                                                        </label>
                                                    </div>
                                                </div>
                                                <div class="accordion-item">
                                                    <div id="flush-collapseOne" class="accordion-collapse collapse" aria-labelledby="flush-headingOne" data-bs-parent="#accordionFlushExample">
                                                        <div class="accordion-body">
                                                            <input type="file" name="ebook" id="" accept=".pdf" class="form-control">
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="accordion-item">
                                                    <div id="flush-collapseTwo" class="accordion-collapse collapse" aria-labelledby="flush-headingTwo" data-bs-parent="#accordionFlushExample">
                                                        <div class="accordion-body">
                                                            <select class="form-select" name="category" aria-label="Default select example">
                                                                <option class="form-control" selected disabled>Select Category</option>
                                                                <?php $cats = ['Fruits', 'Vegetables', 'Cereals', 'Seedling', 'Literature',  'Others']; ?>
                                                                @foreach($cats as $cat)
                                                                <option class="form-control" value="{{$cat}}">{{$cat}}</option>
                                                                @endforeach
                                                            </select>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            @error('category')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                            @enderror
                                        </div>
                                    </div>
                                </div>
                                <div class="modal-footer">
                                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                                    <button type="submit" class="btn btn-primary">Save Product</button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
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
                            @foreach($products as $key=>$product)
                            <tr>
                                <td>{{$key+1}}</td>
                                <td>
                                    <img src="{{asset('storage/images/products/'.$product['path'])}}" width='60'>
                                </td>
                                <td>{{$product->product_name}}</td>
                                <td>{{$product->category}}</td>
                                <td>{{$product->price}}</td>
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