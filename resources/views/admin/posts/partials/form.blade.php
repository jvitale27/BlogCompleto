{{-- Formulario comun de Edit/Create posts --}}

{{-- Nombre --}}
<div class="form-group">
	{!! Form::label('name', 'Nombre') !!}
	{!! Form::text('name', null, ['class' => 'form-control', 'placeholder' => 'Ingrese el nombre del post']) !!}

	@error('name')
		<span class="text-danger">{{ $message }}</span>
	@enderror
</div>

{{-- Slug --}}
<div class="form-group">
	{!! Form::label('slug', 'Slug') !!}
	{!! Form::text('slug', null, ['class' => 'form-control', 'placeholder' => 'Ingrese el slug del post', 'readonly']) !!}

	@error('slug')
		<span class="text-danger">{{ $message }}</span>
	@enderror
</div>

{{-- Categoria --}}
<div class="form-group">
    {!! Form::label('category_id', 'Categoria') !!}
    {!! Form::select('category_id', $categories, null, ['class' => 'form-control']) !!}

    @error('category_id')
        <span class="text-danger">{{ $message }}</span>
    @enderror
</div>

{{-- Etiquetas --}}
<div class="form-group">
	<p class="font-weight-bold">Etiquetas</p>

	@foreach ($tags as $tag)

		<label class="mr-2">
		    {!! Form::checkbox('tags[]', $tag->id, null) !!}
		    {{ $tag->name }}
		</label>

	@endforeach

    @error('tags')
    	<br>
        <span class="text-danger">{{ $message }}</span>
    @enderror
</div>

{{-- Estado --}}
<div class="form-group">
	<p class="font-weight-bold">Estado</p>

	<label class="mr-2">
	    {!! Form::radio('status', 1, true) !!}
	    Borrador
	</label>
	<label>
	    {!! Form::radio('status', 2, false) !!}
	    Publicado
	</label>

    @error('status')
    	<br>
        <span class="text-danger">{{ $message }}</span>
    @enderror
</div>

{{-- Imagen --}}
<div class="row mb-3">
	<div class="col">
		<div class="image-wrapper">{{--ver propiedades en seccion 'css' de create.blade.php o edit.blade.php --}}
			@isset ($post->image) 			{{-- utilizo isset y no if porque en create post no esta definida --}}
				<img id="picture" src="{{ Storage::url($post->image->url) }}"> {{-- el id="picture" se utiliza en la seccion 'js' de create.blade.php o edit.blade.php --}}
			@else
				<img id="picture" src="{{-- {{ Storage::url('imagen_por_defecto.png') }} --}}">
				<br>
				-- Sin imagen seleccionada --		
			@endif
		</div>
	</div>
	<div class="col">
		<div class="form-group">
		    {!! Form::label('file', 'Imagen que se mostrara en el post') !!}
	   		{!! Form::file('file', ['class' => 'form-control-file', 'accept' => 'image/*']) !!}

		    @error('file')
		        <span class="text-danger">{{ $message }}</span>
		    @enderror
		</div>
		Seleccione un archivo de imagen para incluir como fondo del post
	</div>
</div>

{{-- Extracto --}}
{{-- con el plugin js CKEditor5 agregado en la view padre(create o edit) logro ingresar texto enriquecido--}}
<div class="form-group">
    {!! Form::label('extract', 'Extracto') !!}
    {!! Form::textarea('extract', null, ['class' => 'form-control']) !!}

    @error('extract')
        <span class="text-danger">{{ $message }}</span>
    @enderror
</div>

{{-- Cuerpo o texto --}}
{{-- con el plugin js CKEditor5 agregado en la view padre(create o edit) logro ingresar texto enriquecido--}}
<div class="form-group">
    {!! Form::label('body', 'Texto del post') !!}
    {!! Form::textarea('body', null, ['class' => 'form-control']) !!}

    @error('body')
        <span class="text-danger">{{ $message }}</span>
    @enderror
</div>
