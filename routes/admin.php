<?php

use App\Http\Controllers\Admin\CategoryController;
use App\Http\Controllers\Admin\HomeController;
use App\Http\Controllers\Admin\PostController;
use App\Http\Controllers\Admin\TagController;
use App\Http\Controllers\Admin\UserController;
use Illuminate\Support\Facades\Route;

//todas estas rutas tienen el prefijo 'admin'

Route::get('', [HomeController::class, 'index'])->name('admin.home');

Route::get('users', UserController::class)->name('admin.users');

Route::resource('categories', CategoryController::class)->names('admin.categories');	

Route::resource('tags', TagController::class)->names('admin.tags');	

Route::resource('posts', PostController::class)->names('admin.posts');	
