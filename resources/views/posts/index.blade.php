{{-- instancio al componente 'app-layout' en App\View\Components\AppLayout.php que renderiza la view 'layouts.app' en view\layouts\app.blade.php --}}
<x-app-layout>
<!-- OJO que en este proyecto redefini la clase container. La anule desde tailwind.config.js y la cree en resources/css/commom.css -->
	<div class="container py-8">
		<div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">

			@foreach ($posts as $post)
				<article class="w-full h-80 bg-cover bg-center bg-gray-700 
				@if ($loop->first) 						{{-- ejemplo de if dentro de clase --}}
					md:col-span-2
				@endif"
				@if ($post->image)			{{-- si el post tiene imagen, entonces imagen de fondo --}}
					style="background-image: url({{ Storage::url($post->image->url) }})"
				@endif>
					<div class="w-full h-full px-8 flex flex-col justify-center">

						<div>
							@foreach ($post->tags as $tag)
								<a href="{{ route('posts.tag', $tag) }}" class="inline-block px-3 h-6 bg-{{ $tag->color }}-600 text-white rounded-full">
									{{ $tag->name }}
								</a>
							@endforeach
						</div>

						<h1 class="text-4xl text-white leading-8 font-bold mt-3">
							<a href="{{ route('posts.show', $post) }}">
								{!! $post->name !!}
							</a>
						</h1>
					</div>
				</article>
			@endforeach
		
		</div>

		<div class="mt-4">
			{{ $posts->links() }} 			{{-- botones de paginacion --}}
		</div>
	</div>

</x-app-layout>