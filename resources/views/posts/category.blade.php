<x-app-layout>

	<div class="max-w-5xl mx-auto px-4 sm:px-6 lg:px-8 py-8">
		<h1 class="text-center text-3xl mb-4 font-bold">Categoria: {{ $category->name }}</h1>

		@foreach ($posts as $post)
 			<x-card-post :post="$post" />	{{-- llamo al componente --}}
		@endforeach

		<div class="mt-4">
			{{ $posts->links() }} 			{{-- botones de paginacion --}}
		</div>
	</div>

</x-app-layout>