<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Tag;


class TagController extends Controller
{

    //defino los permisos para ingresar por si tipean las urls directamente en el navegador
    //se basa en las tablas roles y permissions
    public function __construct()
    {
        $this->middleware('can:admin.tags.index')->only('index');
        $this->middleware('can:admin.tags.create')->only('create', 'store');
        $this->middleware('can:admin.tags.edit')->only('edit', 'update');
        $this->middleware('can:admin.tags.destroy')->only('destroy');
    }

    public function index()
    {
        $tags = Tag::all();

        return view('admin.tags.index', compact('tags'));
    }


    public function create()
    {
        $colors = [
            'red'    => 'Rojo',
            'yellow' => 'Amarillo',
            'green'  => 'Verde',
            'blue'   => 'Azul',
            'indigo' => 'Indigo',
            'purple' => 'Morado',
            'pink'   => 'Rosado'
        ];

        return view('admin.tags.create', compact('colors'));
    }


    public function store(Request $request)
    {
        $request->validate([                    //validacion del request
            'name'  => 'required',
            'slug'  => 'required|unique:tags',
            'color' => 'required'
        ]);

       $tag = Tag::create( $request->all());   //insercion masiva en la BD,
                                                    //todo lo util de request y que es fillable.

        return redirect()->route('admin.tags.edit', $tag)
                           ->with('info', 'La etiqueta se creó con éxito');      //mensaje de sesion
    }


    public function show(Tag $tag)
    {
        return view('admin.tags.show', compact('tag'));
    }


    public function edit(Tag $tag)
    { 
       $colors = [
            'red'    => 'Rojo',
            'yellow' => 'Amarillo',
            'green'  => 'Verde',
            'blue'   => 'Azul',
            'indigo' => 'Indigo',
            'purple' => 'Morado',
            'pink'   => 'Rosado'
        ];

        return view('admin.tags.edit', compact('tag', 'colors'));
    }


    public function update(Request $request, Tag $tag)
    {
        $request->validate([                    //validacion del request
            'name'  => 'required',
            'slug'  => "required|unique:tags,slug,$tag->id",    //unico, sin tener en cta el actual slug. Con comillas
            'color' => 'required'
        ]);

       $tag->update( $request->all());   //insercion masiva en la BD,
                                                    //todo lo util de request y que es fillable.

        return redirect()->route('admin.tags.edit', $tag)
                           ->with('info', 'La etiqueta se actualizó con éxito');      //mensaje de sesion

    }


    public function destroy(Tag $tag)
    {
        $tag->delete();

        return redirect()->route('admin.tags.index')
                           ->with('info', 'La etiqueta se eliminó con éxito');      //mensaje de sesion
    }
}
