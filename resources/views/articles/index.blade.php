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
                <button type="button" data-toggle="modal" data-target="#exampleModal" class="btn btn-primary  d-none d-md-block pull-right ms-3 hidden-xs hidden-sm waves-effect waves-light text-white">Create Article</button>
                <div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                    <div class="modal-dialog" role="document">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title" id="exampleModalLabel">Create Article</h5>
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                </button>
                            </div>
                            <form method="post" action="/article/create" enctype="multipart/form-data">
                                @csrf
                                <div class="modal-body">
                                    <div class="row mb-2">
                                        <div class="col-md-6">
                                            <div class="form-floating">
                                                <input type="text" name="title" id="" class="form-control" placeholder=" ">
                                                <label for="">Title</label>
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="form-floating">
                                                <input type="text" name="category" id="" class="form-control" placeholder=" ">
                                                <label for="">Category</label>
                                            </div>
                                        </div>
                                    </div>
                                    <textarea name="body" id="editor" class="form-control" rows="15" placeholder="Your article goes here..."></textarea>

                                </div>
                                <div class="modal-footer">
                                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                                    <button type="submit" class="btn btn-primary">Save</button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
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
                                <th class="border-top-0">Title</th>
                                <th class="border-top-0">Category</th>
                                <th colspan="2" >Feedback</th>
                                <th colspan="2" style="text-align: center;">Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($items as $key=>$item)
                            <tr>
                                <td>{{$key+1}}</td>
                                <td><a href="/article/view/{{$item->title}}">{{$item->title}}</a></td>
                                <td>{{$item->category}}</td>
                                <td>{{$likes->where('post_id',$item->id)->count()}} <i class="fa fa-heart"></i></td>
                                <td>{{$comments->where('post_id',$item->id)->count()}} <i class="fa fa-comment"></i></td>
                                <td><a href="#" data-toggle="modal" data-target="#edit{{$key+1}}"><i class="fa fa-pen"></i></a></td>
                                <td><a href="#" data-toggle="modal" data-target="#destroy{{$key+1}}"><i class="fa fa-trash text-danger"></i></a></td>
                                <div class="modal fade" id="edit{{$key+1}}" tabindex="-1" role="dialog" aria-labelledby="edit{{$key+1}}Label" aria-hidden="true">
                                    <div class="modal-dialog" role="document">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <h5 class="modal-title" id="edit{{$key+1}}Label">Edit Article</h5>
                                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                    <span aria-hidden="true">&times;</span>
                                                </button>
                                            </div>
                                            <form method="post" action="/article/edit/{{$item->id}}" enctype="multipart/form-data">
                                                @csrf
                                                <div class="modal-body">
                                                    <div class="row mb-2">
                                                        <div class="col-md-6">
                                                            <div class="form-floating">
                                                                <input type="text" name="title" id="" class="form-control" value="{{$item->title}}">
                                                                <label for="">Title</label>
                                                            </div>
                                                        </div>
                                                        <div class="col-md-6">
                                                            <div class="form-floating">
                                                                <input type="text" name="category" id="" class="form-control" value="{{$item->category}}">
                                                                <label for="">Category</label>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <textarea name="body" id="editor" class="form-control" rows="15">{{$item->body}}</textarea>
                                                </div>
                                                <div class="modal-footer">
                                                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                                                    <button type="submit" class="btn btn-primary">Update</button>
                                                </div>
                                            </form>
                                        </div>
                                    </div>
                                </div>
                                <div class="modal fade" id="destroy{{$key+1}}" tabindex="-1" role="dialog" aria-labelledby="edit{{$key+1}}Label" aria-hidden="true">
                                    <div class="modal-dialog" role="document">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <h5 class="modal-title" id="destroy{{$key+1}}Label">Delete Article</h5>
                                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                    <span aria-hidden="true">&times;</span>
                                                </button>
                                            </div>
                                            <div class="modal-body">
                                                <p class="text-center"><i class="fa fa-triangle-exclamation fa-2x text-danger"></i></p>
                                                <p class="text-center">Are you sure you want to delete this article?</p>
                                            </div>
                                            <div class="modal-footer">
                                                <button type="button" class="btn btn-danger" data-dismiss="modal">Cancel</button>
                                                <a href="/article/destroy/{{$item->id}}"><button type="submit" class="btn btn-primary">Okay</button></a>
                                            </div>
                                        </div>
                                    </div>
                                </div>
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
<script src="https://cdn.ckeditor.com/ckeditor5/40.0.0/classic/ckeditor.js"></script>
<script>
    ClassicEditor
        .create( document.querySelector( '#editor' ) )
        .catch( error => {
            console.error( error );
        } );
</script>

@endsection