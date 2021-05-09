{{-- AdminLTE lleva codigo de BOOTSTRAP y de Tailwind --}}







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
            {{-- Abro un formulario con 'open' con campos vacios --}}
    		{!! Form::open(['route' => 'admin.posts.store', 'autocomplete' => 'off']) !!}	{{-- formulario de collective --}}

                {{-- incluyo la plantilla en comun
                    @include('admin.posts.partials.form', ['category_id' => null]
                    o tambien asi --}}
    			{{ $category_id = null }}
                @include('admin.posts.partials.form')

    			{!! Form::submit('Crear Post', ['class' => 'btn btn-primary']) !!}

    		{!! Form::close() !!}
    	</div>
    </div>
@stop

{{-- esta seccion javascript me crea el slug dinamicamente a medida que tipeo en name. --}}
@section('js')
	{{-- plugin 'jQuery Plugin stringToSlug' desde https://leocaseiro.com.br/jquery-plugin-string-to-slug/ --}}
    <script src="{{ asset('vendor\jQuery-Plugin-stringToSlug-1.3\jquery.stringToSlug.min.js') }}"></script>

{{-- plugin desde CKEditor5 desde https://ckeditor.com/ckeditor-5/download/  para ingresar texto enriquecido--}}
    <script src="https://cdn.ckeditor.com/ckeditor5/27.1.0/classic/ckeditor.js"></script>

    <script>
    {{--pegado desde 'jThe values Default at Plugin Usage' https://leocaseiro.com.br/jquery-plugin-string-to-slug/--}}
    	$(document).ready( function() {
			$("#name").stringToSlug({
		    	setEvents: 'keyup keydown blur',
		    	getPut: '#slug',
		    	space: '-'
		  	});
		});

{{-- plugin desde CKEditor5 desde https://ckeditor.com/ckeditor-5/download/  para ingresar texto enriquecido--}}
        ClassicEditor
        .create( document.querySelector( '#extract' ) )
        .catch( error => {
            console.error( error );
        } );
{{-- plugin desde CKEditor5 desde https://ckeditor.com/ckeditor-5/download/  para ingresar texto enriquecido--}}
        ClassicEditor
        .create( document.querySelector( '#body' ) )
        .catch( error => {
            console.error( error );
        } );

    </script>
@stop