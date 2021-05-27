<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\PostRequest;
use App\Models\Category;
use App\Models\Post;
use App\Models\Tag;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Storage;


class PostController extends Controller
{

    //defino los permisos para ingresar por si tipean las urls directamente en el navegador
    //se basa en las tablas roles y permissions
    public function __construct()
    {
        $this->middleware('can:admin.posts.index')->only('index');
        $this->middleware('can:admin.posts.create')->only('create', 'store');
        $this->middleware('can:admin.posts.edit')->only('edit', 'update');
        $this->middleware('can:admin.posts.destroy')->only('destroy');
    }


    public function index()
    {
        $posts = Post::all();

        return view('admin.posts.index', compact('posts'));
    }


    public function create()
    {
//        $categories = Category::all();
    /* Para que lo entienda el formulario de Collective, debo crear un array del tipo 
        {['id'=>'name',
          'id'=>'name',
          'id'=>'name' ]} 
    esto lo hago con el metodo pluck*/
        $categories = Category::pluck('name', 'id');
    
        $tags = Tag::all();

        return view('admin.posts.create', compact('categories', 'tags'));
    }


//    public function store(Request $request)
    public function store(PostRequest $request)
    {
        /* Hace las validaciones de tipo request, en app\Http\Request\PostReques.php */

       $post = Post::create( $request->all());   //insercion masiva en la BD,
                                                    //todo lo util de request y que es fillable.

       //al seleccionar un archivo desde un formulario, este se copia a la carpeta xampp\tmp
       //este metodo copia el archivo seleccionado (que esta en xampp\tmp) a la carpeta public\storage\posts
       //renombrando el nombre del archivo, dandole un nombre aleatorio
       if($request->file('file')){
            //$url = $request->file('file')->store('posts');     //me devuelve posts/{nombre imagen}
            //esto de abajo es lo mismo que el anterior 
            $url = Storage::put('posts', $request->file('file'));   //me devuelve posts/{nombre imagen}

            //esto luego me devuelve la url completa, http://blogcompleto.test/storage/posts/{nombre imagen}
            //$url = Storage::url($url); 

            /* completo la relacion polimorfica entre tablas 'posts' e 'images'. Los campos 'imageable_id' e 'imageable_type' toman la informacion del 'id' y modelo('App\Models\Post') de $post */
            $post->image()->create([
                'url' => $url
            ]);
       }


        if($request->tags){
            $post->tags()->attach($request->tags);     //llamo al metodo tags->attach para crear en la tabla post_tag que las relaciona a ambas, debido a que es una relacion muchos a muchos
        }

        Cache::flush();     //limpio la cache del navegador, para refrescar los cambios en la pagina

        return redirect()->route('admin.posts.edit', $post)
                           ->with('info', 'El post se creó con éxito');      //mensaje de sesion

    }


    public function edit(Post $post)
    {
        //verifico mediante la Policy PostPolicy 'autor' la autorizacion sobre este post, si es mio
        $this->authorize('author', $post);

//        $categories = Category::all();
    /* Para que lo entienda el formulario de Collective, debo crear un array del tipo 
        {['id'=>'name',
          'id'=>'name',
          'id'=>'name' ]} 
    esto lo hago con el metodo pluck*/
        $categories = Category::pluck('name', 'id');
    
        $tags = Tag::all();

        return view('admin.posts.edit', compact('post', 'categories', 'tags'));
    }


    public function update(PostRequest $request, Post $post)
    {
        /* Hace las validaciones de tipo request, en app\Http\Request\PostReques.php */

        //verifico mediante la Policy PostPolicy 'autor' la autorizacion sobre este post, si es mio
        $this->authorize('author', $post);

        $post->update( $request->all());   //actualizo en la BD,

        //al seleccionar un archivo desde un formulario, este se copia a la carpeta xampp\tmp
        //este metodo copia el archivo seleccionado (que esta en xampp\tmp) a la carpeta storage\posts
        if($request->file('file')){
 
            $url = Storage::put('posts', $request->file('file'));

            //si existia una imagen para el post, elimino el archivo
            if($post->image){
                Storage::delete($post->image->url);

                /* actualizo la relacion polimorfica entre tablas 'posts' e 'images'. Los campos 'imageable_id' e 'imageable_type' toman la informacion del 'id' y modelo('App\Models\Post') de $post */
                $post->image()->update([
                   'url' => $url
                ]);
            }
            else{
                /* completo la relacion polimorfica entre tablas 'posts' e 'images'. Los campos 'imageable_id' e 'imageable_type' toman la informacion del 'id' y modelo('App\Models\Post') de $post */
                $post->image()->create([
                    'url' => $url
                ]);
            }
        }


        if($request->tags){
            $post->tags()->sync($request->tags);     //llamo al metodo tags->sync para actualizar en la tabla post_tag que las relaciona a ambas, debido a que es una relacion muchos a muchos
        }

        Cache::flush();     //limpio la cache del navegador, para refrescar los cambios en la pagina

        return redirect()->route('admin.posts.edit', $post)
                           ->with('info', 'El post se actualizó con éxito');      //mensaje de sesion

    }


    public function destroy(Post $post)
    {
        //verifico mediante la Policy PostPolicy 'autor' la autorizacion sobre este post, si es mio
        $this->authorize('author', $post);

        //aca deberia eliminar el archivo de imagen del post si existe. Esto lo puedo hacer como
        //if($post->image){
        //    Storage::delete($post->image->url); 
        //pero esta vez lo hago mediante el un Observer en App\Observers\PostObserver.php       

        $post->delete();

        Cache::flush();     //limpio la cache del navegador, para refrescar los cambios en la pagina

        return redirect()->route('admin.posts.index')
                           ->with('info', 'El post se eliminó con éxito');      //mensaje de sesion
    }
}
