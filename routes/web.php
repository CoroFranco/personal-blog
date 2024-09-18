<?php

use App\Http\Controllers\PostController;
use Illuminate\Support\Facades\Route;

Route::get('/', [PostController::class,'blogs']);
Route::get('/post/{id}', [PostController::class,'post'])->name('post');


