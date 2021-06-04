{{-- plantilla AdminLTE se escribe con etiquetas, clases y codigo de BOOTSTRAP --}}
@extends('adminlte::page')

@section('title', 'Administracion')

@section('content_header')
    <h1>Crear nuevo post</h1>
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
            {{--Abro un formulario con 'open' con campos vacios. files' habilita el envio de archivos como objetos --}}
    		{!! Form::open(['route' => 'admin.posts.store', 'autocomplete' => 'off', 'files' => true]) !!}	{{-- formulario de collective --}}

				{{-- pongo id de usuario identificado en un campo oculto.--}}
                {{-- {!! Form::hidden('user_id', auth()->user()->id) !!}  lo saco,  lo resolvi con un Observer --}}          
				{{-- incluyo la plantilla en comun --}}
                @include('admin.posts.partials.form')

    			{!! Form::submit('Guardar', ['class' => 'btn btn-primary mt-2']) !!}

    		{!! Form::close() !!}
    	</div>
    </div>
@stop

@section('css')
    <style>                         {{-- estilos de la imagen cargada en admin.posts.partials.form--}}
      	.image-wrapper{
    		position: relative;
    		padding-bottom: 56.25%;
            background-color: #DCCCCC
    	}
    	.image-wrapper img{
    		position: absolute;
    		object-fit: cover;
    		width: 100%;
    		height: 100%;
    	}
    </style>
@stop

@section('js')

	{{-- plugin 'jQuery Plugin stringToSlug' desde https://leocaseiro.com.br/jquery-plugin-string-to-slug/ --}}
    <script src="{{ asset('vendor\jQuery-Plugin-stringToSlug-1.3\jquery.stringToSlug.min.js') }}"></script>
    <script>
    {{--pegado desde 'jThe values Default at Plugin Usage' https://leocaseiro.com.br/jquery-plugin-string-to-slug/--}}
    {{-- esta seccion javascript me crea el slug dinamicamente a medida que tipeo en name. --}}
        $(document).ready( function() {
			$("#name").stringToSlug({
		    	setEvents: 'keyup keydown blur',
		    	getPut: '#slug',
		    	space: '-'
		  	});
		});
    </script>

    {{-- plugin desde CKEditor5 desde https://ckeditor.com/ckeditor-5/download/ para ingresar texto enriquecido--}}
    <script src="https://cdn.ckeditor.com/ckeditor5/27.1.0/classic/ckeditor.js"></script>
    <script>
        ClassicEditor
        .create( document.querySelector( '#extract' ) )     {{-- aplica al elemento llamado 'extract' --}}
        .catch( error => {
            console.error( error );
        } );

        ClassicEditor
        .create( document.querySelector( '#body' ) )        {{-- aplica al elemento llamado 'body' --}}
        .catch( error => {
            console.error( error );
        } );
    </script>

    {{-- cambio dinamico de la imagen seleccionada mediante archivo. La imagen con propiedad id="picture" esta en form.blade.php --}}
    <script>
	    document.getElementById("file").addEventListener('change', cambiarImagen);

	        function cambiarImagen(event){
	            var file = event.target.files[0];

	            var reader = new FileReader();
	            reader.onload = (event) => {
	                document.getElementById("picture").setAttribute('src', event.target.result);
	            };

	            reader.readAsDataURL(file);
	        }
    </script>

@stop