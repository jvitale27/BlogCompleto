{{-- Las view de Livewire SIEMPRE deben estar encerradas en un solo div padre, no puede haber mas de uno --}}
<div>
    <div class="card">

    	<div class="card-header">
    		<input wire:model="search" class="form-control" placeholder="ingrese el nombre o correo de un usuario">
    	</div>

    	@if ($users->count())

	    	<div class="card-body">
	    		<table class="table table-striped">
	    			<thead>
	    				<tr>
	    					<th>ID</th>
	    					<th>Nombre</th>
	    					<th>Correo</th>
	    					<th colspan="1"></th>
	    				</tr>
	    			</thead>

	    			<tbody>
	    				@foreach ($users as $user)
	    					<tr>
	    						<td>{!! $user->id !!}</td>
	    						<td>{!! $user->name !!}</td>
	    						<td>{!! $user->email !!}</td>

	    						<td width="10px">
	    							<a href="{{ route('admin.users.edit', $user) }}" class="btn btn-primary btn-sm">Editar</a>
	    						</td>
	    					</tr>
	    				@endforeach
	    			</tbody>
	    		</table>
	    	</div>

	    	<div class="card-footer">
	    		{{ $users->links() }}
	    	</div>

	    @else
	    	<div class="card-body">
	    		<strong>No hay ningun registro</strong>
	    	</div>

    	@endif

    </div>
</div>
