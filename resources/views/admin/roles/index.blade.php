{{-- plantilla AdminLTE se escribe con etiquetas, clases y codigo de BOOTSTRAP --}}
@extends('adminlte::page')

@section('title', 'Administracion')

@section('content_header')
    @can('admin.roles.create')         {{-- si tengo el acceso requerido --}}
        <a href="{{ route('admin.roles.create') }}" class="btn btn-secondary btn-sm float-right">Agregar rol</a>
    @endcan
    <h1>Lista de roles</h1>
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
    		<table class="table table-striped">

    			<thead>
    				<tr>
    					<th>ID</th>
    					<th>Rol</th>
    					<th colspan="2"></th>
    				</tr>
    			</thead>

    			<tbody>
    				@foreach ($roles as $role)
    					<tr>
    						<td>{{ $role->id }}</td>
    						<td>{{ $role->name }}</td>

    						<td width="10px">
                                @can('admin.roles.edit')           {{-- si tengo el acceso requerido --}}
        							<a href="{{ route('admin.roles.edit', $role) }}" class="btn btn-primary btn-sm">Editar</a>
                                @endcan
    						</td>

    						<td width="10px">
                                @can('admin.roles.destroy')         {{-- si tengo el acceso requerido --}}
                                    {{-- doy nombre al formulario para captar el evento desde el script --}}
        							<form action="{{ route('admin.roles.destroy', $role) }}" class="formulario-eliminar" method="POST">
        								@csrf
        								@method('DELETE')
        								<button type="submit" class="btn btn-danger btn-sm">Eliminar</button>
        							</form>
                                @endcan
    						</td>
    					</tr>
    				@endforeach
    			</tbody>

    		</table>
    	</div>
    </div>

@stop

@section('css')
    {{-- <link rel="stylesheet" href="/css/admin_custom.css"> --}}
@stop

@section('js')

        {{-- include para incluir cualquier cuadro de dialog desde https://sweetalert2.github.io/ --}}
        <script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>

        {{-- capto el mansaje de session y aviso que ya se elimino con exito --}}
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
