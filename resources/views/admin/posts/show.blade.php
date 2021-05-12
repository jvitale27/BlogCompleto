{{-- AdminLTE lleva codigo de BOOTSTRAP y de Tailwind --}}

@extends('adminlte::page')

@section('title', 'Administracion')

@section('content_header')
    <h1>Mostrar detalle de categoria</h1>
@stop

@section('content')
    <p>Welcome to this beautiful admin panel.</p>

    <div class="card">
    	<div class="card-body">
            {{-- Abro un formulario 'model' para que se completen los campos con los valores de post --}}
    		{!! Form::model([$post,$categories,$tags], ['route' => ['admin.posts.update', $post], 'method' => 'put']) !!}	{{-- formulario de collective --}}

                {{-- incluyo la plantilla en comun --}}
                @include('admin.posts.partials.form')

    			{!! Form::submit('Actualizar Post', ['class' => 'btn btn-primary']) !!}

    		{!! Form::close() !!}
    	</div>
    </div>


@stop

@section('css')
    {{-- <link rel="stylesheet" href="/css/admin_custom.css"> --}}
@stop

@section('js')
    {{-- <script> console.log('Hi!'); </script> --}}
@stop