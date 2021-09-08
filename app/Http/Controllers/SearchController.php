<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Post;
class SearchController extends Controller
{
    public function search(Request $request)
    {

        if($request->has('query')){
    		$posts = Post::search($request->get('query'))->get();	
    	}else{
    		$posts = Post::get();
    	}
       return view('search',compact('posts'));
  
    }
}
