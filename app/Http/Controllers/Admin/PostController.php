<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Post;
use App\Models\Category;
use App\Models\Tag;
use App\Http\Requests\PostRequest;

use Illuminate\Support\Facades\Storage;


class PostController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $posts = Post::all();

        return view('admin.posts.index', compact('posts'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
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

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
//    public function store(Request $request)
    public function store(PostRequest $request)
    {
        /* Hace las validaciones de tipo request, en app\Http\Request\PostReques.php */

       $post = Post::create( $request->all());   //insercion masiva en la BD,
                                                    //todo lo util de request y que es fillable.

        //al seleccionar un archivo desde un formulario, este se copia a la carpeta xampp\tmp
        //este metodo copia el archivo seleccionado (que esta en xampp\tmp) a la carpeta storage\posts
       if($request->file('file')){
 
            $url = Storage::put('posts', $request->file('file'));

            /* completo la relacion polimorfica entre tablas 'posts' e 'images'. Los campos 'imageable_id' e 'imageable_type' toman la informacion del 'id' y modelo('App\Models\Post') de $post */
            $post->image()->create([
                'url' => $url
            ]);
       }


        if($request->tags){
            $post->tags()->attach($request->tags);     //llamo al metodo tags->attach para crear en la tabla post_tag que las relaciona a ambas, debido a que es una relacion muchos a muchos
        }

        return redirect()->route('admin.posts.edit', $post)
                           ->with('info', 'El post se creó con éxito');      //mensaje de sesion

    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(Post $post)
    {
        return view('admin.posts.show', compact('post'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(Post $post)
    {
        $this->authorize('author', $post);      //veo si tengo autorizacion para editar este 

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

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(PostRequest $request, Post $post)
    {
        /* Hace las validaciones de tipo request, en app\Http\Request\PostReques.php */

        $this->authorize('author', $post);      //veo si tengo autorizacion para editar este 


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

        return redirect()->route('admin.posts.edit', $post)
                           ->with('info', 'El post se actualizó con éxito');      //mensaje de sesion

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Post $post)
    {
        $this->authorize('author', $post);      //veo si tengo autorizacion para editar este 

        //aca deberia eliminar el archivo de imagen del post si existe. Esto lo puedo hacer como
        //if($post->image){
        //    Storage::delete($post->image->url); 
        //pero esta vez lo hago mediante el un Observer en App\Observers\PostObserver.php       

        $post->delete();

        return redirect()->route('admin.posts.index')
                           ->with('info', 'El post se eliminó con éxito');      //mensaje de sesion
    }
}
