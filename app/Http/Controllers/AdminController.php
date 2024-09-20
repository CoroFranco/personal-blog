<?php

namespace App\Http\Controllers;

use App\Models\Blog;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;


class AdminController
{
    public function admin()
    {
        $blogs = Blog::all();

        return view('admin', compact('blogs'));
    }

    public function create()
    {
        return view('create');
    }

    public function createPost(Request $request)
    {
        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'content' => 'required|string',
        ]);

        Log::info($validated);

        $post = new Blog();
        $post->title = $validated['title'];
        $post->content = $validated['content'];
        $post->save();

        return redirect()->route('admin')->with('success', 'Post Created');
    }

    public function updatePost(Request $request)
    {
        $validated = $request->validate([
            'id' => 'required',
            'title' => 'required|string|max:255',
            'content' => 'required|string',
        ]);

        Log::info($validated);

        $post = Blog::findOrFail($validated['id']);
        $post->title = $validated['title'];
        $post->content = $validated['content'];
        $post->update();

        return redirect()->route('admin')->with('success', 'Post Created');
    }

    public function deletePost($id)
    {
        $blog = Blog::findOrFail($id);

        $blog->delete();

        return response()->json([
            'success' => true,
            'message' => 'Post eliminado correctamente'
        ], 200);
    }
}
