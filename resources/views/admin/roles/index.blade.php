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
        							<form action="{{ route('admin.roles.destroy', $role) }}" method="POST">
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
   {{--  <script> console.log('Hi!'); </script> --}}
@stop