{{-- plantilla AdminLTE se escribe con etiquetas, clases y codigo de BOOTSTRAP --}}
@extends('adminlte::page')

@section('title', 'Administracion')

@section('content_header')
    @can('admin.posts.create')           {{-- si tengo el acceso requerido --}}
        <a href="{{ route('admin.posts.create') }}" class="btn btn-secondary btn-sm float-right">Nuevo post</a>
    @endcan
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

@section('css')
    {{-- <link rel="stylesheet" href="/css/admin_custom.css"> --}}
@stop

@section('js')

        {{-- CDN para incluir cualquier cuadro de dialog desde https://sweetalert2.github.io/ --}}
        <script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>

        {{-- capto el mansaje de session y aviso que ya se elimino con exito utilizando sweetalert2--}}
        @if (session('info'))
            <script>
                Swal.fire(
                   'Eliminado!',
                   'Elemento eliminado',
                   'success'                    {{-- icono --}}
                )
            </script>
        @endif

        <script>
            {{-- capturo el evento de envio del formulario 'formulario-eliminar' --}}
            $('.formulario-eliminar').submit( function( event ) {  {{-- el evento esta en la vble event --}}

                event.preventDefault();     {{-- detengo el envio del formulario --}}

                {{-- cartel de alerta extraido de https://sweetalert2.github.io/ --}}
                Swal.fire({
                  title: 'Esta seguro?',
                  text: "Esta accion no se podrá revertir!",
                  icon: 'warning',                              {{-- icono --}}
                  showCancelButton: true,
                  confirmButtonColor: '#3085d6',
                  cancelButtonColor: '#d33',
                  confirmButtonText: 'Si, eliminarlo!',
                  cancelButtonText: 'Cancelar'
                }).then((result) => {
                  if (result.isConfirmed) {
/*                    Swal.fire(
                      'Eliminado!',
                      'Elemento eliminado',
                      'success'
                    )*/
                    this.submit();        //prosigo con el envio del formulario llamado 'formulario-eliminar'
                  }
                })
            });
        </script>
@stop