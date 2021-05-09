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
	    					<th>Name</th>
	    					<th colspan="2"></th>
	    				</tr>
	    			</thead>

	    			<tbody>
	    				@foreach ($posts as $post)
	    					<tr>
	    						<td>{{ $post->id }}</td>
	    						<td>{{ $post->name }}</td>

	    						<td width="10px">
	    							<a href="{{ route('admin.posts.edit', $post) }}" class="btn btn-primary btn-sm">Editar</a>
	    						</td>

	    						<td width="10px">
	    							<form action="{{ route('admin.posts.destroy', $post) }}" method="POST">
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
