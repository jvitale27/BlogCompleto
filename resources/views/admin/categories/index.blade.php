{{-- AdminLTE lleva codigo de BOOTSTRAP y de Tailwind --}}

@extends('adminlte::page')

@section('title', 'Administracion')

@section('content_header')

    @can('admin.categories.create')         {{-- si tengo el acceso requerido --}}
        <a href="{{ route('admin.categories.create') }}" class="btn btn-secondary btn-sm float-right">Agregar categoria</a>
    @endcan
    <h1>Lista de categorias</h1>

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
    					<th>Nombre</th>
    					<th colspan="2"></th>
    				</tr>
    			</thead>

    			<tbody>
    				@foreach ($categories as $category)
    					<tr>
    						<td>{{ $category->id }}</td>
    						<td>{{ $category->name }}</td>

    						<td width="10px">
                                @can('admin.categories.edit')           {{-- si tengo el acceso requerido --}}
        							<a href="{{ route('admin.categories.edit', $category) }}" class="btn btn-primary btn-sm">Editar</a>
                                @endcan
    						</td>

    						<td width="10px">
                                @can('admin.categories.destroy')         {{-- si tengo el acceso requerido --}}
        							<form action="{{ route('admin.categories.destroy', $category) }}" method="POST">
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
