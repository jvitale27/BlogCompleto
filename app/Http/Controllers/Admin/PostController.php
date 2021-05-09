<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Post;
use App\Models\Category;
use App\Models\Tag;
use App\Http\Requests\StorePostRequest;

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
    public function store(StorePostRequest $request)
    {
        /* Hace las validaciones de tipo request, en app\Http\Request\StorePostReques.php */

        //al seleccionar un archivo desde un formulario, este se copia a la carpeta xampp\tmp
        //este metodo copia el archivo seleccionado (que esta en xampp\tmp) a la carpeta storage\posts
        Storage::put('posts', $request->file('file'));

       $post = Post::create( $request->all());   //insercion masiva en la BD,
                                                    //todo lo util de request y que es fillable.

        if($request->tags){
            $post->tags()->attach($request->tags);     //llamo al metodo tags para guardar en la tabla post_tag que las relaciona a ambas
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

//VOY POR ACA

//        $categories = Category::all();
    /* Para que lo entienda el formulario de Collective, debo crear un array del tipo 
        {['id'=>'name',
          'id'=>'name',
          'id'=>'name' ]} 
    esto lo hago con el metodo pluck*/
        $categories = Category::pluck('name', 'id');
    
        $tags = Tag::all();

        return view('admin.posts.create', compact('post', 'categories', 'tags'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Post $post)
    {
/*        $request->validate([                    //validacion del request
            'name'  => 'required',
            'slug'  => "required|unique:posts,slug,$post->id"    //unico, sin tener en cta el actual slug. Con comillas
        ]);

       $post->update( $request->all());   //insercion masiva en la BD,
                                                    //todo lo util de request y que es fillable.

        return redirect()->route('admin.posts.edit', $post)
                           ->with('info', 'El post se actualizó con éxito');      //mensaje de sesion
*/
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Post $post)
    {
//        $post->delete();

        return redirect()->route('admin.posts.index')
                           ->with('info', 'El post se eliminó con éxito');      //mensaje de sesion
    }
}
