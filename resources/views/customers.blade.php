@extends('layouts.dash')
@section('content')
<div class="page-breadcrumb bg-white">
    <div class="row align-items-center">
        <div class="col-lg-3 col-md-4 col-sm-4 col-xs-12">
            <h4 class="page-title">Customers</h4>
        </div>
        <!-- <div class="col-lg-9 col-sm-8 col-md-8 col-xs-12">
            <div class="d-md-flex">
                <ol class="breadcrumb ms-auto">
                    <li><a href="#" class="fw-normal"></a></li>
                </ol>
                <a href="" class="btn btn-danger  d-none d-md-block pull-right ms-3 hidden-xs hidden-sm waves-effect waves-light text-white"></a>
            </div>
        </div> -->
    </div>
    <!-- /.col-lg-12 -->
</div>
<div class="container-fluid">
    <div class="row">
        <div class="col-sm-12">
            <div class="white-box">
                <h3 class="box-title">Users</h3>
                <div class="table-responsive">
                    @if(($users->count())>0)
                    <table class="table text-nowrap">
                        <thead>
                            <tr>
                                <th class="border-top-0">#</th>
                                <th class="border-top-0">Name</th>
                                <th class="border-top-0">Email</th>
                                <th class="border-top-0">Contact</th>
                                <th class="border-top-0">Residence</th>
                                <th class="border-top-0">Role</th>
                                <th class="border-top-0">Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($users as $key=>$customer)
                            <tr>
                                <td>{{$key+1}}</td>
                                <td>{{$customer->name}}</td>
                                <td>{{$customer->email}}</td>
                                <td>{{$customer->contact}}</td>
                                <td>{{$customer->residence}}</td>
                                <td>{{$customer->role}}</td>
                                <td>
                                    <div class="dropdown">
                                      <a class="btn btn-danger dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                                        Action
                                      </a>
                                    
                                      <ul class="dropdown-menu">
                                        <li><a class="dropdown-item" href="/user/update/Admin/{{$customer->id}}">Make Admin</a></li>
                                        <li><a class="dropdown-item" href="/user/update/Author/{{$customer->id}}">Make Author</a></li>
                                        <li><a class="dropdown-item" href="#" data-bs-toggle="modal" data-bs-target="#exampleModal{{$customer->id}}">Destroy</a></li>
                                        <div class="modal fade" id="exampleModal{{$customer->id}}" tabindex="-1" aria-labelledby="exampleModalLabel{{$customer->id}}" aria-hidden="true">
                                          <div class="modal-dialog">
                                            <div class="modal-content">
                                              <div class="modal-header">
                                                <h1 class="modal-title fs-5" id="exampleModalLabel">Delete {{$customer->name}}</h1>
                                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                              </div>
                                              <div class="modal-body">
                                                <p>
                                                    Are you sure you want to destroy {{$customer->name}} as a user? Remember it is irreverseble
                                                </p>
                                              </div>
                                              <div class="modal-footer">
                                                <button type="button" class="btn btn-success" data-bs-dismiss="modal">Close</button>
                                                <a href='/user/destroy/{{$customer->id}}'><button type="button" class="btn btn-danger">Destroy</button>
                                              </div>
                                            </div>
                                          </div>
                                        </div>
                                      </ul>
                                    </div>
                                </td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                    @else
                    <p>No Customers Yet!</p>
                    @endif
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