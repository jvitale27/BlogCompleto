{{-- AdminLTE lleva codigo de BOOTSTRAP y de Tailwind --}}

@extends('adminlte::page')

@section('title', 'Administracion')

@section('content_header')

    <a href="{{ route('admin.tags.create') }}" class="btn btn-secondary float-right">Agregar etiqueta</a>

    <h1>Lista de etiquetas</h1>
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
    					<th>Name</th>
    					<th colspan="2"></th>
    				</tr>
    			</thead>

    			<tbody>
    				@foreach ($tags as $tag)
    					<tr>
    						<td>{{ $tag->id }}</td>
    						<td>{{ $tag->name }}</td>

    						<td width="10px">
    							<a href="{{ route('admin.tags.edit', $tag) }}" class="btn btn-primary btn-sm">Editar</a>
    						</td>

    						<td width="10px">
    							<form action="{{ route('admin.tags.destroy', $tag) }}" method="POST">
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
