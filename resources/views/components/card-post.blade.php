{{-- componente que arma las tarjetas de posts para una vista de una seleccionada categoria --}}
{{-- recibo los parametros --}}
@props(['post'])

<article class="mb-8 bg-white shadow-lg rounded-lg overflow-hidden">
	<img class="w-full h-72 object-cover object-center bg-gray-700"
	@if ($post->image)			{{-- si el post tiene imagen, entonces imagen de fondo --}}
		src="{{ Storage::url($post->image->url) }}"
	@endif
	 alt="">

	<div class="px-6 py-4">
		<h1 class="font-bold text-xl mb-2">
			<a href="{{ route('posts.show', $post) }}">{!! $post->name !!}</a>
		</h1>
		<div class="text-gray-700 text-base">
			{!! $post->extract !!}
		</div>
	</div>

	<div class="px-6 pt-4 pb-2">
		@foreach ($post->tags as $tag)
			<a href="{{ route('posts.tag', $tag) }}" class="inline-block bg-{{ $tag->color }}-600 text-white rounded-full px-3 py-1 text-sm mr-2">{{ $tag->name }}</a>
		@endforeach
	</div>

</article>
