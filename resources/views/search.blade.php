@extends('welcome')
@section('content')

<div class="container d-flex flex-wrap mx-auto mt-3 " style="width:1500px; background:white;">
  @foreach ($posts as $post )

  <div class="card m-3 mx-auto border-0" style="width: 24rem; ">
    <a href="/post/{{$post->id}}"><img class="card-img-top" style="width: 24rem;height:350px;" src="{{ URL::to('/') }}/images/{{$post->image_path}}" alt="Card image cap"></a>
    <div class="card-body">
      <h5><strong class="card-text" style="font-family: Arial, sans-serif;">{{$post->name}}</strong></h5><br>
      <span class="card-text" style="width: 18rem; font-family: Arial, Helvetica, sans-serif;color:grey;">{{$post->excerpt}}</span>
    </div>
    <div class="d-flex">
      <i class='fa fa-heart mx-1 m-1'></i>{{ $post->likes->count()}} <i class="fa fa-comments-o ml-2 " style="font-size:24px"></i><small class="m-1">{{ $post->comments->count()}}</small>
    </div>

    <a href="/post/{{$post->id}}"><strong class=" text-primary p-2">Read More..</strong></a>
  </div>

  @endforeach
</div>


@endsection