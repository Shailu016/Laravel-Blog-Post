<?php

namespace App\Http\Controllers;

use App\Models\Like;
use App\Models\Post;
use Illuminate\Http\Request;
use App\Events\LikeCreated;


class LikeController extends Controller
{
    public function store(Post $post)
    {

        $like= Like::where('user_id',auth()->user()->id)->where('post_id',$post->id)->first();
     
        if (!$like) {
            $post->likes()->create([
            'user_id' => auth()->user()->id,
            'like'=>1
        ]);
        }else{
            $like->delete();
        }
        event(new LikeCreated("you have created new post"));
       return back();
    }
    
}
