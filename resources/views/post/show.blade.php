@extends('welcome')
@section('content')


<style>
  body{
    background: white;
  }
  .aryan{
    color: red;
  }
  .btn-light:focus{
    outline:none;  
  }
  
.y{
    cursor: pointer;
    background-color: transparent;
    font-size: 1.5em;
 }

</style>
<div class="  mt-5 mx-auto  m-3p-3" style="width: 80vw; flex-direction: column; background: white; position:relative; ">
       
       <div class="card mx-auto item border-0 mt-3 " style="width: 900px;background: white;  object-fit: cover ; ">
           <img style="width: 900px;  height: 350px; object-fit: cover" class="card-img-top mx-auto" src="{{ URL::to('/') }}/images/{{$post->image_path}}" alt="Card image cap">
        </div>
        <div class="container" style="width: 900px;">
         
          <h4 class="pt-5" > <strong >{{$post->name}}</strong></h4> <br>
          
          <strong style=" color: grey;  margin-top:50px;">{!!$post->body!!}</strong> <br>
          <h6 style="margin-top:50px;"><strong >{{$users->name}}</strong></h6>
          <strong style="margin-top:1px; color: grey;">{{$post->created_at->format('y-m-d H:i:s')}}</strong> 
          <form method="POST" action="/post/{{$post->id}}/likes">
        @csrf
        <button  style=""class=" y border-0"  aria-hidden="false" type="submit"><i class="fa fa-heart {{  $like= App\Models\Like::where('user_id',auth()->user()->id)->where('post_id',$post->id)->first()  ? 'aryan' : '' }}"></i>
        {{ $post->likes->count()}} 
        <i class="fa fa-comments-o" style="font-size:24px">
      </i>{{ $post->comments->count()}}
    </button> 
</form>
    <form action="/post/{{$post->id}}/comments" method='POST'>
         
          @csrf
          
          <div class=" mt-3"  class="container" style="width: 900px;">
           
          <label for="body" class="form-label">Add an public comment...</label> 
          <textarea type="text" name = 'body' style="width: 880px; height:200px; " class="form-control" ></textarea>
          </div>
          <button class="btn btn-secondary my-2"  style="font-family: Arial,Helvetica,sans-serif;
           font-size: 14px;"type="submit">Comment</button>
        </form>
      </div>
     
      @foreach ($post->comments as $comment)
      <div class="card mx-auto item border-0 m-3 " style="width: 880px;background: whitesmoke;  object-fit: cover ;  box-shadow: 0 3px 10px rgb(0 0 0 / 0.2);">
      <strong class="p-2" style="margin-top:1px; color: grey;"><img src="https://i.pravatar.cc/300" alt="Avatar" class="avatar"> {{$comment->users['name']}}</strong>

      <p class="mx-5" style=" color: grey;  margin-top:5px;">{{$comment->body}} </p><span class="p-2" style="margin-left:auto;color: grey;">{{$comment->created_at->format('y-m-d H:i:s') }}</span>
   </div>
      @endforeach
      
</div>
</div>


@endsection


