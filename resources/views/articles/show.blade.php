@extends('layouts.app')
@section('content')
<div class="container-xxl py-5 mt-5">
    <div class="container">
        <div class="g-0 gx-5 align-items-end">
            <div class="">
                <div class="section-header text-start  wow fadeInUp mt-2" data-wow-delay="0.1s">
                    <h1 class="display-5 mb-2">{{$item->title}}</h1>
                    <!-- <p>Tempor ut dolore lorem kasd vero ipsum sit eirmod sit. Ipsum diam justo sed rebum vero dolor duo.</p> -->
                </div>
            </div>
        </div>
        <div><?php echo htmlspecialchars_decode($item->body); ?></div>
        {{$likes->count()}} <a href="/article/like/{{$item->id}}">@if($likes->contains('user_id',Auth()->user()->id))<i class="fa fa-heart text-secondary"></i>@else<i class="fa fa-heart"></i>@endif</a>
        <form action="/article/comment/{{$item->id}}" method="post">
            @csrf
            <div class="input-group mb-3">
            <input type="text" name="comment" id="" class="form-control" placeholder="Your comment goes here...">
                <button class="input-group-text" type='submit' ><i class="fa fa-paper-plane"></i></button>
            </div>
        </form>
    </div>

</div>

@endsection