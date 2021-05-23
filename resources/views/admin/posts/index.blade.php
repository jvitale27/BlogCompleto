{{-- plantilla AdminLTE se escribe con etiquetas, clases y codigo de BOOTSTRAP --}}
@extends('adminlte::page')

@section('title', 'Administracion')

@section('content_header')
    @can('admin.posts.create')           {{-- si tengo el acceso requerido --}}
        <a href="{{ route('admin.posts.create') }}" class="btn btn-secondary btn-sm float-right">Nuevo post</a>
    @endcan
    <h1>Lista de posts de {{ auth()->user()->name }}</h1>
@stop

@section('content')

    {{-- Si hay mansaje de session lo imprimo mediante mensaje de bootstrap --}}
    @if (session('info'))
        <div class="alert alert-success">
            <strong>{{ session('info') }}</strong>
        </div>
    @endif

<!-- instancio el componente de livewire 'PostsIndex' que esta en la carpeta App\Http\Livewire\Admin\PostsIndex.php -->
    @livewire('admin.posts-index')      {{-- siempre lo instancio en minusculas --}}

@stop

@section('css')
    {{-- <link rel="stylesheet" href="/css/admin_custom.css"> --}}
@stop

@section('js')
    {{-- <script> console.log('Hi!'); </script> --}}
@stop