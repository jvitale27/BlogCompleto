{{-- AdminLTE lleva codigo de BOOTSTRAP, no de Tailwind --}}

@extends('adminlte::page')

@section('title', 'Administracion')

@section('content_header')
    <h1>Mostrar detalle de categoria</h1>
@stop

@section('content')
    <p>Welcome to this beautiful admin panel.</p>
@stop

@section('css')
    <link rel="stylesheet" href="/css/admin_custom.css">
@stop

@section('js')
    <script> console.log('Hi!'); </script>
@stop