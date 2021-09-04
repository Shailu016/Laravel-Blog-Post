@extends('welcome')
@section('content')
<div class="  mt-5 mx-auto  m-3p-3" style="width: 80vw; flex-direction: column; background: white; position:relative; ">
       
       <div class="card mx-auto item border-0 m-3 " style="width: 900px;background: white;  object-fit: cover ; box-shadow: 3px 3px 3px 3px grey;">
           <img style="width: 900px;  height: 350px; object-fit: cover" class="card-img-top mx-auto" src="{{ URL::to('/') }}/images/{{$post->image_path}}" alt="Card image cap">
        </div>
        <div class="container" style="width: 900px;">
         
          <h4 style="margin-left:350px;"> <strong >{{$post->name}}</strong></h4> <br>
          
          <strong style=" color: grey;  margin-top:50px;">{!!$post->body!!}</strong> <br>
          <h6 style="margin-top:50px;"><strong >Author</strong></h6>
          <strong style="margin-top:1px; color: grey;">{{$post->created_at}}</strong> 
          <form method="POST" action="/post/{{$post->id}}/likes">
        @csrf
        <button class="fa fa-heart" aria-hidden="true" type="submit"></button>{{$post->likes->count()}}
        
      </form>
    <form action="/post/{{$post->id}}/comments" method='POST'>
         
          @csrf
          
          <div class=" mt-3"  class="container" style="width: 900px;">
           
          <label for="body" class="form-label">Add an public comment...</label> 
          <textarea type="text" name = 'body' style="width: 880px; height:200px;" class="form-control" ></textarea>
          </div>
          <button class="btn btn-primary mt-1" type="submit">comment</button>
        </form>
      </div>
     
      @foreach ($post->comments as $comment)
      <div class="card mx-auto item border m-3 " style="width: 880px;background: white;  object-fit: cover ; ">
      <strong class="p-2" style="margin-top:1px; color: grey;"> {{$comment->users['name']}}</strong>

      <p class="mx-5" style=" color: grey;  margin-top:5px;">{{$comment->body}} </p></div>
      @endforeach
      
</div>
</div>


@endsection


