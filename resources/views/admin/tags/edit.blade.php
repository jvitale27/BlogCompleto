{{-- AdminLTE lleva codigo de BOOTSTRAP y de Tailwind --}}

@extends('adminlte::page')

@section('title', 'Administracion')

@section('content_header')
    <h1>Editar etiqueta</h1>
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
    		{!! Form::model($tag, ['route' => ['admin.tags.update', $tag], 'method' => 'put']) !!}	{{-- formulario de collective --}}

                {{-- incluyo la plantilla en comun
                    @include('admin.tags.partials.form', ['color' => $tag->color]
                    o tambien asi --}}
                {{ $color =  $tag->color}}
                @include('admin.tags.partials.form')

    			{!! Form::submit('Actualizar Etiqueta', ['class' => 'btn btn-primary']) !!}

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