<?php

namespace App\Http\Controllers;

use App\Models\Post;
use App\Models\Like;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;

use App\Mail\SendEmailMailable;
use Illuminate\Support\Facades\Mail;
use App\Jobs\SendEmailjob;
use Carbon\Carbon;
use App\Notifications\OrderNotification;

class PostController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $posts= Post::all();
        return view('post.index',compact('posts'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('post.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        request()->validate(
            [
              'name'=>'required', 
              'excerpt'=>'required', 
              'body'=>'required',
              'image'=>'mimes:jpg,png,jpeg,webp|max:5048'
             
            ]);
            if(isset($request->image)) {
                $imagePath = time() . $request->name . '.'. $request->image->extension();
                $request->image->move(public_path('images'), $imagePath);
            }
            
            $posts = new Post();
            $posts->name = request('name');
            $posts->excerpt = request('excerpt');
            $posts->body = request('body');
            $posts->image_path = $imagePath ?? null;
            $posts->save();
            $jobs = (new SendEmailJob())->delay(Carbon::now()->addseconds());


            dispatch($jobs);

           
            return redirect('/post');

    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Post  $post
     * @return \Illuminate\Http\Response
     */
    public function show(Post $post)
    {
        return view('post.show',compact('post'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Post  $post
     * @return \Illuminate\Http\Response
     */
    public function edit(Post $post)
    {
        return view('post.edit',compact('post'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Post  $post
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Post $post)
    {
        request()->validate(
            [
              'name'=>'required', 
              'excerpt'=>'required', 
              'body'=>'required',
              'image'=>'mimes:jpg,png,jpeg,webp|max:5048'
             
            ]);

        $post->name = request('name');
        $post->excerpt = request('excerpt');
        $post->body = request('body');
        
        if (request()->hasFile('image'))
        {
            $imagePath = time() . $request->name. '.'. $request->image->extension();
            $request->image->move(public_path('images'), $imagePath);
            $oldImagePath = public_path('images') . "\\" . $post->image_path;
            
             if(File::exists($oldImagePath)) 
              {
                 File::delete($oldImagePath);
               }
            $post->image_path = $imagePath;
        }
            $post->save();
            $user = auth()->user();
            $user->notify(new OrderNotification());

           
            return redirect('/post/'.$post->id);
    
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Post  $post
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {   
        public_path('images') . "\\" . 
        $post =Post::find($id);
        $image_path = public_path('images') . "\\" . $post->image_path;
        File::delete($image_path);
        $post->delete($id);
        return redirect('/post');
    }

    public function likePost($post){
       
        $user = Auth::user();
        $likePost = $user->likedPosts()->where('post_id', $post)->count();
        if($likePost == 0){
            $user->likedPosts()->attach($post);
        } else{
            $user->likedPosts()->detach($post);
        }
       
        return redirect()->back()->with('success', 'Post has been Deleted Succesfully!!'); ;
    }
}
