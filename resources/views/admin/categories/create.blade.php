{{-- plantilla AdminLTE se escribe con etiquetas, clases y codigo de BOOTSTRAP --}}
@extends('adminlte::page')

@section('title', 'Administracion')

@section('content_header')
    <h1>Crear nueva categoria</h1>
@stop

@section('content')

	{{-- Si hay mansaje de session lo imprimo mediante mensaje de bootstrap --}}
	@if (session('info'))
		<div class="alert alert-success">
			<strong>{{ session('info') }}</strong>
		</div>
	@endif

	<div class="card">
    	<div class="card-body">
            {{-- Abro un formulario con 'open' con campos vacios --}}
    		{!! Form::open(['route' => 'admin.categories.store']) !!}	{{-- formulario de collective --}}

                {{-- incluyo la plantilla en comun --}}
                @include('admin.categories.partials.form')

    			{!! Form::submit('Guardar', ['class' => 'btn btn-primary mt-2']) !!}

    		{!! Form::close() !!}
    	</div>
    </div>
@stop


@section('js')

    {{-- esta seccion javascript me crea el slug dinamicamente a medida que tipeo en name. --}}
	{{-- plugin 'jQuery Plugin stringToSlug' desde https://leocaseiro.com.br/jquery-plugin-string-to-slug/ --}}
    <script src="{{ asset('vendor\jQuery-Plugin-stringToSlug-1.3\jquery.stringToSlug.min.js') }}"></script>
    <script>
    {{--pegado desde 'jThe values Default at Plugin Usage' https://leocaseiro.com.br/jquery-plugin-string-to-slug/--}}
    	$(document).ready( function() {
			$("#name").stringToSlug({
		    	setEvents: 'keyup keydown blur',
		    	getPut: '#slug',
		    	space: '-'
		  	});
		});
    </script>
@stop