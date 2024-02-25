@extends('layouts.dash')
@section('content')


<div class="page-breadcrumb bg-white">
    <div class="row align-articles-center">
        <div class="col-lg-3 col-md-4 col-sm-4 col-xs-12">
            <h4 class="page-title">Articles</h4>
        </div>
        <div class="col-lg-9 col-sm-8 col-md-8 col-xs-12">
            <div class="d-md-flex">
                <ol class="breadcrumb ms-auto">
                    <li><a href="#" class="fw-normal"></a></li>
                </ol>
                <a href="/article/create"><button type="button" class="btn btn-primary  d-none d-md-block pull-right ms-3 hidden-xs hidden-sm waves-effect waves-light text-white">Create Article</button></a>
                
            </div>
        </div>
    </div>
    <!-- /.col-lg-12 -->
</div>
<div class="container-fluid">
    <div class="row">
        <div class="col-sm-12">
            <div class="white-box">
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
                            @foreach($articles as $key=>$article)
                            <tr>
                                <td>{{$key+1}}</td>
                                <td><a href="/article/view/{{$article->slug}}">{{$article->title}}</a></td>
                                <td>{{$article->category}}</td>
                                <td>{{$likes->where('post_id',$article->id)->count()}} <i class="fa fa-heart"></i></td>
                                <td>{{$comments->where('post_id',$article->id)->count()}} <i class="fa fa-comment"></i></td>
                                <td><a href="/article/edit/{{$article->id}}"><i class="fa fa-pen"></i></a></td>
                                <td><a href="#" data-toggle="modal" data-target="#destroy{{$key+1}}"><i class="fa fa-trash text-danger"></i></a></td>
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
                                                <a href="/article/destroy/{{$article->id}}"><button type="submit" class="btn btn-primary">Okay</button></a>
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
</div>
@endsection