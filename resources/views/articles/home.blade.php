<?php 
if(request()->path()!='articles'){
    $title = $item->title;
    $dec = $item->slug;
}
else{
    $title='Articles';
    $dec = '';
}
?>
@extends('layouts.app',['title'=>$title,'descr'=>$dec])
@section('content')
@if($items->count()>0)
<div class="container-xxl py-5 mt-5 row">
    <div class="container col-md-8 mt-3">
        <div class="g-0 gx-5 align-items-end">
            <div class="">
                <div class="section-header text-start  wow fadeInUp mt-2" data-wow-delay="0.1s">
                    <h1 class="display-5 mb-2">{{$item->title}}</h1>
                    <h4>By {{$item->writer->name}}</h4>
                </div>
            </div>
        </div>
        <div><?php echo htmlspecialchars_decode($item->body);?></div>
        <div class='text-bold'><i><b>To learn more with us, register for any of our online or physical programs <a href="https://school.healthandlifecentre.com/register">here</a> or 
        <a href="https://wa.me/+254722987365">WhatsApp</a> or <a href="tel:+254722987365">Call</a> for inquiries.
        You may also reach out for naturopathic help with various lifestyle and accidental conditions. 
        On the fees portal, you are free to make payments piecemeal. It is possible for you to track, on your own dashboard, all your transactions. </b></i></div>
        
        <h3>{{$comments->count()}} Comment(s)</h3>
        <div>
            @foreach($comments as $comment)
            <p><i class='fa fa-user'></i> <b>{{$comment->user->name}}: </b>{{$comment->comment}}</p>
            
            @endforeach
        </div>
        <p>{{$likes->count()}}<i class="fa fa-heart"></i> {{$views->count()}}<i class="fa fa-eye"></i></p>
        @guest
        <form action="{{route('comment.store',['post_id'=>$item->id])}}" method="post" class = 'card p-2'>
            @csrf
            <div class="mb-3">
                <input id="name" type="text" class="form-control @error('name') is-invalid @enderror" placeholder='Your Name' name="name" value="{{ old('name') }}" required autocomplete="name" autofocus>
                @error('name')
                <span class="invalid-feedback" role="alert">
                    <strong>{{ $message }}</strong>
                </span>
                    @enderror
            </div>
            <div class='row'>
                <div class="col-md-6 mb-3">
                        <input id="email" type="email" class="form-control @error('email') is-invalid @enderror" placeholder='Your Email' name="email" value="{{ old('email') }}" required autocomplete="email">
                        @error('email')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                        @enderror
                </div>
                <div class="col-md-6 mb-3">
                        <input id="contact" type="number" class="form-control @error('contact') is-invalid @enderror" placeholder='Phone Number' name="contact" value="{{ old('contact') }}" required autocomplete="contact" maxlength="13" minlength="9">
                        @error('contact')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                        @enderror
                </div>
            </div>
            <textarea class='form-control mb-3' name='comment' col=30 placeholder='Comment here...'></textarea>
            <div class="row mb-0">
                <div class="col-md-6 offset-md-4">
                    <button type="submit" class="btn btn-primary">
                        {{ __('Comment') }}
                    </button>
                </div>
            </div>
        </form>
        @else
            @if($likes->contains('user_id',Auth()->user()->id))
            <a href="{{route('like.create',['post_id'=>$item->id])}}">Unlike <i class="fa fa-heart text-danger"></i></a>
            @else
            <a href="{{route('like.create',['post_id'=>$item->id])}}">Like <i class="fa fa-heart"></i></a>
            @endif
            <form action="{{route('comment.store',['post_id'=>$item->id])}}" method="post">
            @csrf
            <div class="input-group mb-3">
                <input type="text" name="comment" id="" class="form-control" placeholder="Your comment goes here...">
                    <button class="input-group-text" type='submit' ><i class="fa fa-paper-plane"></i></button>
                </div>
            </form>
        @endguest
        <h3>Share</h3>
        <div class="a2a_kit a2a_kit_size_32 a2a_default_style">
            <a class="a2a_button_whatsapp"></a>
            <a class="a2a_button_copy_link"></a>
            <a class="a2a_button_facebook"></a>
            <a class="a2a_button_twitter"></a>
        </div>
        
    </div>
<div class="col-md-4 mt-3">
    <h3>Inspirational Articles</h3>
    @foreach($items->where('category','Inspirational') as $item)
    <a href="/article/view/{{$item->slug}}"><p>{{$item->title}}</p></a>
    @endforeach
    <hr>
    <h3>Articles on Organic Farming</h3>
    @foreach($items->where('category','Organic Farming') as $item)
    <a href="/article/view/{{$item->slug}}"><p>{{$item->title}}</p></a>
    @endforeach
    <hr>
    <h3>Articles on Naturopathy</h3>
    @foreach($items->where('category','Naturopathy') as $item)
    <a href="/article/view/{{$item->slug}}"><p>{{$item->title}}</p></a>
    @endforeach
    <hr>
    <h3>Other Articles</h3>
    @foreach($items->where('category','Other') as $item)
    <a href="/article/view/{{$item->slug}}"><p>{{$item->title}}</p></a>
    @endforeach
    
    <hr>
</div>

</div>
<script async src="https://static.addtoany.com/menu/page.js"></script>
@endif
@endsection