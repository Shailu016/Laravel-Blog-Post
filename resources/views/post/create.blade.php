@extends('welcome')
@section('content')


<div class=" m-auto my-3 w-75 p-3">
<div class="m-1 container justify-content-center w-75 p-3">
<h1 class ='p-3'>Create Post</h1>
<form method="post" action='/post' enctype ="multipart/form-data">
@csrf
  <div class="mb-3">
    <label for="title" class="form-label">Post Title</label>
    <input type="text" name = 'name' class="form-control">
     @if($errors->has('name'))
        <p style='color:red;'>{{$errors->first('name')}}</p>
     @endif
  </div>
   <label for="image">Choose a picture:</label>
   <input type="file" id="image" name="image">
  <div class="mb-3">
    <label for="excerpt" class="form-label">Excerpt</label>
    <input type="text" name = 'excerpt' class="form-control" >
    @if($errors->has('price'))
            <p style='color:red;'>{{$errors->first('excerpt')}}</p>
            @endif
  </div>

<div class="mb-3">
    <label  for="body" class="form-label">Body</label>
    <!-- <input type="text" name = 'body' id="editor" class="form-control" > -->
    <textarea  type="text" id="editor" class="form-control" name = 'body'></textarea>
    @if($errors->has('body'))
            <p style='color:red;'>{{$errors->first('body')}}</p>
            @endif
  </div>
  <button type="submit" class="btn btn-primary ">Submit</button>
</form>
</div>
</div>

@endsection