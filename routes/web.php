<?php

use App\Http\Controllers\PostController;
use App\Http\Controllers\AdminController;
use Illuminate\Support\Facades\Route;

Route::get('/', [PostController::class,'blogs'])->name('home');
Route::get('/post/{id}', [PostController::class,'post'])->name('post');


Route::post('/login', [AdminController::class, 'login'])->name('login');  
Route::post('/logout', [AdminController::class, 'logout'])->name('logout');  

Route::get('blogs', [PostController::class, 'apiBlogs']); // Obtener todos los blogs
Route::get('blogs/{id}', [PostController::class, 'apiPost']); // Obtener un blog específico

Route::middleware('IsAdmin')->group(function () {
    Route::get('/admin', [AdminController::class, 'admin'])->name('admin');
    Route::delete('/admin/{id}', [AdminController::class, 'deletePost'])->name('delete');
    Route::get('/admin/create', [AdminController::class, 'create'])->name('create');
    Route::post('/admin/create', [AdminController::class, 'createPost'])->name('create-post');
    Route::post('/admin/update', [AdminController::class, 'updatePost'])->name('update-post');
});



