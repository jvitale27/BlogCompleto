{{-- AdminLTE lleva codigo de BOOTSTRAP y de Tailwind --}}

@extends('adminlte::page')

@section('title', 'Administracion')

@section('content_header')
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
