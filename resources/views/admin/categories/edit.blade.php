{{-- plantilla AdminLTE se escribe con etiquetas, clases y codigo de BOOTSTRAP --}}
@extends('adminlte::page')

@section('title', 'Administracion')

@section('content_header')
    <h1>Editar categoria</h1>
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
            {{-- Abro un formulario 'model' para que se completen los campos con los valores de category --}}
            {{-- 'class' => 'formulario-editar' es el nombre para captar el evento desde el script. Aqui no pregunto confirmacion por lo que no lo utilizo, pero asi es como funciona --}}
    		{!! Form::model($category, ['route' => ['admin.categories.update', $category], 'method' => 'put', 'class' => 'formulario-editar']) !!}	{{-- formulario de collective --}}

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

    {{-- include para incluir cualquier cuadro de dialog desde https://sweetalert2.github.io/ --}}
    <script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    {{-- capto el mansaje de session y aviso que ya se elimino con exito utilizando sweetalert2--}}
    @if (session('info'))
        <script>
            Swal.fire(
               'Guardado!',
               'La categor??a se guard?? con ??xito',
               'success'                    {{-- icono --}}
            )
        </script>
    @endif
@stop