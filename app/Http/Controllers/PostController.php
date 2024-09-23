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

     // Nuevo método para obtener todos los blogs en formato JSON
     public function apiBlogs()
     {
         $blogs = Blog::all();
         return response()->json($blogs);
     }
 
     // Nuevo método para obtener un blog específico en formato JSON
     public function apiPost($id)
     {
         $blog = Blog::find($id);
         
         if (!$blog) {
             return response()->json(['message' => 'Blog not found'], 404);
         }
 
         return response()->json($blog);
     }
}
