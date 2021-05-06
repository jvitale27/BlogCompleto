<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Admin\HomeController;

//todas las rutas tienen el prefijo 'admin'

Route::get('', [HomeController::class, 'index']);		

//Route::get('/', [PostController::class, 'index'])->name('posts.index');