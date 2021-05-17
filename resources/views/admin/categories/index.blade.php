{{-- AdminLTE lleva codigo de BOOTSTRAP y de Tailwind --}}

@extends('adminlte::page')

@section('title', 'Administracion')

@section('content_header')
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

    	<div class="card-header">
    		<a href="{{ route('admin.categories.create') }}" class="btn btn-secondary">Agregar categoria</a>
    	</div>

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
    							<a href="{{ route('admin.categories.edit', $category) }}" class="btn btn-primary btn-sm">Editar</a>
    						</td>

    						<td width="10px">
    							<form action="{{ route('admin.categories.destroy', $category) }}" method="POST">
    								@csrf
    								@method('DELETE')
    								<button type="submit" class="btn btn-danger btn-sm">Eliminar</button>
    							</form>
    						</td>

    					</tr>
    				@endforeach
    			</tbody>

    		</table>
    	</div>
    </div>
@stop
