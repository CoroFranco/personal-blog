<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Blog;

class PostController
{
    public function blogs(){
        $blogs = Blog::all();

        return(view('welcome', compact('blogs')));
    }

    public function post ($id){
        $blog = Blog::where('id', $id)->first();
        return view('post', compact('blog'));
    }
}
