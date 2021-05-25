<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Category;


class CategoryController extends Controller
{

    //defino los permisos para ingresar por si tipean las urls directamente en el navegador
    //se basa en las tablas roles y permissions
    public function __construct()
    {
        $this->middleware('can:admin.categories.index')->only('index');
        $this->middleware('can:admin.categories.create')->only('create', 'store');
        $this->middleware('can:admin.categories.edit')->only('edit', 'update');
        $this->middleware('can:admin.categories.destroy')->only('destroy');
    }


    public function index()
    {
        $categories = Category::all();

        return view('admin.categories.index', compact('categories'));
    }


    public function create()
    {
        return view('admin.categories.create');
    }


    public function store(Request $request)
    {
        $request->validate([                    //validacion del request
            'name' => 'required',
            'slug' => 'required|unique:categories'
        ]);

       $category = Category::create( $request->all());   //insercion masiva en la BD,
                                                    //todo lo util de request y que es fillable.

        return redirect()->route('admin.categories.edit', $category)
                           ->with('info', 'La categoría se creó con éxito');      //mensaje de sesion
    }


    public function edit(Category $category)
    {
        return view('admin.categories.edit', compact('category'));
    }


    public function update(Request $request, Category $category)
    {
        $request->validate([                    //validacion del request
            'name' => 'required',
            'slug' => "required|unique:categories,slug,$category->id"   //unico, sin tener en cta el actual slug.
        ]);

       $category->update( $request->all());   //insercion masiva en la BD,
                                                    //todo lo util de request y que es fillable.

        return redirect()->route('admin.categories.edit', $category)
                           ->with('info', 'La categoría se actualizó con éxito');      //mensaje de sesion
    }


    public function destroy(Category $category)
    {
        $category->delete();

        return redirect()->route('admin.categories.index')
                           ->with('info', 'La categoría se eliminó con éxito');      //mensaje de sesion
    }
}
