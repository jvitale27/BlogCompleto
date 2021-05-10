{{-- AdminLTE lleva codigo de BOOTSTRAP y de Tailwind --}}




@extends('adminlte::page')

@section('title', 'Administracion')

@section('content_header')
    <h1>Editar post</h1>
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
            {{-- Abro un formulario 'model' para que se completen los campos con los valores de post --}}
            {!! Form::model($post, ['route' => ['admin.posts.update', $post], 'autocomplete' => 'off', 'files' => true, 'method' => 'put']) !!}   {{-- formulario de collective --}}

                {{-- incluyo la plantilla en comun --}}
                @include('admin.posts.partials.form')

                {!! Form::submit('Actualizar Post', ['class' => 'btn btn-primary']) !!}

            {!! Form::close() !!}
        </div>
    </div>

@stop

@section('css')
    <style>
        .image-wrapper{
            position: relative;
            padding-bottom: 56.25%;
        }
        .image-wrapper img{
            position: absolute;
            object-fit: cover;
            width: 100%;
            height: 100%;
        }
    </style>
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
