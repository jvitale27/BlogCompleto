<?php

use App\Http\Controllers\Admin\CategoryController;
use App\Http\Controllers\Admin\HomeController;
use App\Http\Controllers\Admin\PostController;
use App\Http\Controllers\Admin\RoleController;
use App\Http\Controllers\Admin\TagController;
use App\Http\Controllers\Admin\UserController;
use Illuminate\Support\Facades\Route;

//todas estas rutas tienen el prefijo 'admin'

//el middleware('can:admin.home') verifica el acceso en caso de que tipeen la url directamente
Route::get('', [HomeController::class, 'index'])->middleware('can:admin.home')->name('admin.home');

//solo habilito 3 metodos de los 7 del CRUD. Los permisos con middleware los discrimino en el controlador
Route::resource('users', UserController::class)->only('index', 'edit', 'update')->names('admin.users');	

Route::resource('roles', RoleController::class)->names('admin.roles');	

//Los 7 metodos del CRUD menos el metodo 'show'. Los permisos con middleware los discrimino en el controlador
Route::resource('categories', CategoryController::class)->except('show')->names('admin.categories');	

//Los 7 metodos del CRUD menos el metodo 'show'. Los permisos con middleware los discrimino en el controlador
Route::resource('tags', TagController::class)->except('show')->names('admin.tags');	

//Los 7 metodos del CRUD menos el metodo 'show'. Los permisos con middleware los discrimino en el controlador
Route::resource('posts', PostController::class)->except('show')->names('admin.posts');	
