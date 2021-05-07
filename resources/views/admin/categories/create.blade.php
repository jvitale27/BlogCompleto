{{-- AdminLTE lleva codigo de BOOTSTRAP, no de Tailwind --}}

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
    		{!! Form::open(['route' => 'admin.categories.store']) !!}	{{-- formulario de collective --}}

    			<div class="form-group">
    				{!! Form::label('name', 'Nombre') !!}
    				{!! Form::text('name', null, ['class' => 'form-control', 'placeholder' => 'Ingrese el nombre de la categoria']) !!}

    				@error('name')
    					<span class="text-danger">{{ $message }}</span>
    				@enderror

    			</div>

    			<div class="form-group">
    				{!! Form::label('slug', 'Slug') !!}
    				{!! Form::text('slug', null, ['class' => 'form-control', 'placeholder' => 'Ingrese el slug de la categoria', 'readonly']) !!}

    				@error('slug')
    					<span class="text-danger">{{ $message }}</span>
    				@enderror

    			</div>

    			{!! Form::submit('Crear Categoria', ['class' => 'btn btn-primary']) !!}

    		{!! Form::close() !!}
    	</div>
    </div>
@stop

{{-- esta seccion javascript me crea el slug dinamicamente a medida que tipeo en name. --}}
@section('js')
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