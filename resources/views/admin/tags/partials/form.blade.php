{{-- Formulario comun de Edit/Create etiquetas --}}

<div class="form-group">
	{!! Form::label('name', 'Nombre') !!}
	{!! Form::text('name', null, ['class' => 'form-control', 'placeholder' => 'Ingrese el nombre de la etiqueta']) !!}

	@error('name')
		<span class="text-danger">{{ $message }}</span>
	@enderror

</div>

<div class="form-group">
	{!! Form::label('slug', 'Slug') !!}
	{!! Form::text('slug', null, ['class' => 'form-control', 'placeholder' => 'Ingrese el slug de la etiqueta', 'readonly']) !!}

	@error('slug')
		<span class="text-danger">{{ $message }}</span>
	@enderror
</div>

<div class="form-group">
{{--            mediante html clasico
    <label for="">Color</label>

    <select name="color" id="" class="form-control">
        <option value="red">Rojo</option>
        <option value="green">Verde</option>
        <option value="blue" selected>Azul</option>
    </select>
--}}
{{-- mediante collective --}}
    {!! Form::label('color', 'Color') !!}
    {!! Form::select('color', $colors, $color, ['class' => 'form-control']) !!}

    @error('color')
        <span class="text-danger">{{ $message }}</span>
    @enderror

</div>