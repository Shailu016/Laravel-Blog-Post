@extends('welcome')
@section('content')

<div class="container d-flex flex-wrap" style="width:1500px;">
@foreach ($posts as $post )

<div class="card m-3" style="width: 25rem;">
  <img class="card-img-top" style="width: 25rem;height:400px;"src="{{ URL::to('/') }}/images/{{$post->image_path}}"alt="Card image cap">
  <div class="card-body">
    <strong class="card-text">{{$post->name}}</strong><br>
    <strong class="card-text">{{$post->excerpt}}</strong><br>
   <a href="/post/{{$post->id}}"><strong class="card-text">Read More..</strong></a> <br>
  </div>
</div>
@endforeach
</div>
<script src="https://cdnjs.cloudflare.com/ajax/libs/axios/0.21.1/axios.min.js"></script>
<script>
  function deletePost() {
    console.log("test");
    axios({
      method: 'get',
      url: '/post/{{$post->id}}/destroy',
    }).then((response) => {               
              console.log(response)
            });
  }
</script>
 
    @endsection
