<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Tag;


class TagController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $tags = Tag::all();

        return view('admin.tags.index', compact('tags'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
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

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
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

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(Tag $tag)
    {
        return view('admin.tags.show', compact('tag'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
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

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
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

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Tag $tag)
    {
        $tag->delete();

        return redirect()->route('admin.tags.index')
                           ->with('info', 'La etiqueta se eliminó con éxito');      //mensaje de sesion
    }
}
