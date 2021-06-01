<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Post;
use App\Models\Tag;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cache;

class PostController extends Controller
{

    public function index()
    {

        //si deseo utilizar CACHE para agilizar la muestra de los posts sin consultar tanto a ala DB debo
        //hacer lo siguiente. De lo contrario solo ejecuto la consulta de $posts = Post::where
        //el cache se guarda donde indica la vble de entorno CACHE_DRIVER, que se usa en config/cache.php
        //y puede setearse en .env
        if(request()->page)                     //si hay paginado, debe haber un cache por pagina
            $key = 'posts' . request()->page;
        else
            $key = 'posts';
        
        if (Cache::has( $key))              //si ya hay una consulta igual cargada en cache de archivo, la tomo
            $posts = Cache::get( $key);
        else                                //sino consulto a la DB y guardo cache
        {
//          $posts = Post::where('status', 2)->get();                       //todos sin paginar
            $posts = Post::where('status', 2)->latest('id')->paginate(8);   //del ultimo al primero por 'id'
            Cache::put( $key, $posts);                                  //guardo cache en key='posts{pagina}'
        }
        
    	return view('posts.index', compact('posts'));
    }

    public function show(Post $post)
    {
        $this->authorize('published', $post);      //veo si el post esta publicado o no 

    	$similares = Post::where('category_id', $post->category_id)
    					->where('status', 2)
    					->where('id', '!=', $post->id)
    					->latest('id')
    					->take(4)
    					->get();					/* take() acepta el metodo get() */

       	return view('posts.show', compact('post', 'similares'));

    }

    public function category(Category $category)
    {
 /*   
    	$posts = Post::where('category_id', $category->id)
    					->where('status', 2)
    					->latest('id')
    					->paginate(4);
*/
		//Algo equivalente a lo anterior.    paginate() no necesita el metodo get()
//      $posts = $category->posts()->where('status',2)->latest('updated_at')->paginate(4);
    	$posts = $category->posts()->where('status',2)->latest('id')->paginate(4);


    	return view('posts.category', compact('posts', 'category'));
    }

    public function tag(Tag $tag)
    {
//      $posts = $tag->posts()->where('status',2)->latest('updated_at')->paginate(4);
    	$posts = $tag->posts()->where('status',2)->latest('id')->paginate(4);

    	return view('posts.tag', compact('posts', 'tag'));
    }
}
