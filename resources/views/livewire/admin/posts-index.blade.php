{{-- Las view de Livewire SIEMPRE deben estar encerradas en un solo div padre, no puede haber mas de uno --}}
<div>
    <div class="card">

    	<div class="card-header">
    		<input wire:model="search" class="form-control" placeholder="ingrese el nombre de un post">
    	</div>

    	@if ($posts->count())

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
	    				@foreach ($posts as $post)
	    					<tr>
	    						<td>{!! $post->id !!}</td>
	    						<td>{!! $post->name !!}</td>

	    						<td width="10px">
	    							@can('admin.posts.edit')           {{-- si tengo el acceso requerido --}}
	    								<a href="{{ route('admin.posts.edit', $post) }}" class="btn btn-primary btn-sm">Editar</a>
	    							@endcan
	    						</td>

	    						<td width="10px">
	    							@can('admin.posts.destroy')           {{-- si tengo el acceso requerido --}}
	    								{{-- doy nombre al formulario para captar el evento desde el script --}}
		    							<form action="{{ route('admin.posts.destroy', $post) }}" class="formulario-eliminar" method="POST">
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

	    	<div class="card-footer">
	    		{{ $posts->links() }}
	    	</div>

	    @else
	    	<div class="card-body">
	    		<strong>No hay ningun registro</strong>
	    	</div>

    	@endif

    </div>
</div>
