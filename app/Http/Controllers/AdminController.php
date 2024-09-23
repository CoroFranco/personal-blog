<?php

namespace App\Http\Controllers;

use App\Models\Blog;
use App\Models\User;
use Dotenv\Exception\ValidationException;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;
use Illuminate\Validation\ValidationException as ValidationValidationException;

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

    public function login(Request $request)
    {
        $credentials = $request->validate([
            'email' => 'required|string|email',
            'password' => 'required|string',
        ]);
    
        // Intenta autenticar al usuario con las credenciales proporcionadas
        if (Auth::attempt($credentials)) {
            // Regenera la sesión para prevenir ataques de fijación de sesión
            $request->session()->regenerate();
    
            // Redirecciona a la página de admin
            return redirect()->route('admin');
        }
    
        // Si las credenciales no son correctas, redirige de nuevo a la página de login con un mensaje de error
        return back()->withErrors([
            'email' => 'Las credenciales proporcionadas no coinciden con nuestros registros.',
        ])->onlyInput('email');
    }

    public function logout(Request $request)
    {
        Auth::logout();
        request()->session()->invalidate();
        request()->session()->regenerateToken();
        return redirect('/');
    }
}
