<?php

namespace App\Http\Controllers;

use App\Models\Like;
use App\Models\Post;
use Illuminate\Http\Request;


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

        $count=Like::where('post_id',$post->id)->count();
        

       return back();
    }
    
}
