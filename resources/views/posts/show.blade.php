{{-- instancio al componente 'app-layout' en App\View\Components\AppLayout.php que renderiza la view 'layouts.app' en view\layouts\app.blade.php --}}
<x-app-layout>

	{{-- todo lo de aqui adentro pasa a formar el {{ $slot }} del componente --}}

	<div class="container py-8">

		<h1 class="text-4xl font-bold text-gray-600">
			{!! $post->name !!} 						{{-- {!! !!} formatea(escapa) texto html con caracteres --}}
		</h1>

		<div class="text-lg text-gray-500 mb-2">
			{!! $post->extract !!} 						{{-- {!! !!} formatea(escapa) texto html con caracteres --}}
		</div>

		<div class="grid grid-cols-1 lg:grid-cols-3 gap-6">

			{{-- contenido principal --}}
			<div class="lg:col-span-2 ">
				<figure>
					<img class="w-full h-80 object-cover object-center bg-gray-700"
					@if ($post->image)					{{-- si el post tiene imagen, entonces imagen de fondo --}}
						 src="{{ Storage::url($post->image->url) }}"
					@endif
					alt="">
				</figure>
				
				<div class="text-base text-gray-500 mt-4">
					{!! $post->body !!} 			{{-- {!! !!} formatea(escapa) texto html con caracteres --}}
				</div>
			</div>

			{{-- contenido relacionado --}}
			<aside>
				<h1 class="text-2xl font-bold text-gray-500 mb-4">Mas en {{ $post->category->name }}</h1>

				<ul>
					@foreach ($similares as $similar)
						<li class="mb-4">
							<a class="flex" href="{{ route('posts.show', $similar) }}">
								<img class="flex-none w-28 h-20 object-cover object-center bg-gray-700"
								@if ($similar->image)		{{-- si el post tiene imagen, entonces imagen de fondo --}}
									 src="{{ Storage::url($similar->image->url) }}"
								@endif
								alt="">
								<span class="flex-1 ml-2 text-gray-600">{{ $similar->name }}</span>
							</a>
						</li>
					@endforeach
				</ul>
			</aside>
				
		</div>

	</div>

</x-app-layout>
