{{-- plantilla AdminLTE se escribe con etiquetas, clases y codigo de BOOTSTRAP --}}
@extends('adminlte::page')

@section('title', 'Administracion')

@section('content_header')
    <h1>Asignar roles a un usuario</h1>
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
            <p class="h5">Nombre:</p>
            <p class="form-control">{{ $user->name }}</p>

            <h2 class="h5">Listado de roles</h2>
            {{-- Abro un formulario 'model' para que se completen los campos con los valores de roles --}}
            {{-- 'class' => 'formulario-editar' es el nombre para captar el evento desde el script. Aqui no pregunto confirmacion por lo que no lo utilizo, pero asi es como funciona --}}
            {!! Form::model($user, ['route' => ['admin.users.update', $user], 'method' => 'put', 'class' => 'formulario-editar']) !!}  {{-- formulario de collective --}}
                @foreach ($roles as $role)
                    <div>
                        <label for="">
                            {!! Form::checkbox('roles[]', $role->id, null, ['class' => 'mr-1']) !!}
                            {{ $role->name }}
                        </label>
                    </div>
                @endforeach

                {!! Form::submit('Guardar', ['class' => 'btn btn-primary mt-2']) !!}

            {!! Form::close() !!}

    	</div>
    </div>
@stop

@section('css')
    {{-- <link rel="stylesheet" href="/css/admin_custom.css"> --}}
@stop

@section('js')
    {{-- include para incluir cualquier cuadro de dialog desde https://sweetalert2.github.io/ --}}
    <script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    {{-- capto el mansaje de session y aviso que ya se elimino con exito utilizando sweetalert2--}}
    @if (session('info'))
        <script>
            Swal.fire(
               'Actualizado!',
               'Los roles se actualizaron con éxito',
               'success'                    {{-- icono --}}
            )
        </script>
    @endif

@stop
