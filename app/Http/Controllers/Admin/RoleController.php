<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;

class RoleController extends Controller
{
    
    //defino los permisos para ingresar por si tipean las urls directamente en el navegador
    //se basa en las tablas roles y permissions
    public function __construct()
    {
        $this->middleware('can:admin.roles.index')->only('index');
        $this->middleware('can:admin.roles.create')->only('create', 'store');
        $this->middleware('can:admin.roles.edit')->only('edit', 'update');
        $this->middleware('can:admin.roles.destroy')->only('destroy');
    }


    public function index()
    {
        $roles = Role::all();

        return view('admin.roles.index', compact('roles'));
    }


    public function create()
    {
        $permissions = Permission::all();

        return view('admin.roles.create', compact('permissions'));
    }


    public function store(Request $request)
    {
        $request->validate([                    //validacion del request
            'name' => 'required'
        ]);

        $role = Role::create( $request->all());   //insercion masiva en la BD,
                                                    //todo lo util de request y que es fillable.

        $role->permissions()->sync( $request->permissions);     //llamo al metodo permissions->sync para actualizar en la tabla role_has_permissions que las relaciona a ambas, debido a que es una relacion muchos a muchos

        return redirect()->route('admin.roles.edit', $role)
                           ->with('info', 'El rol se creó con éxito');      //mensaje de sesion
    }


    public function edit(Role $role)
    {
        $permissions = Permission::all();

        return view('admin.roles.edit', compact('role', 'permissions'));
    }


    public function update(Request $request, Role $role)
    {
        $request->validate([                    //validacion del request
            'name' => 'required'
        ]);

        $role->update( $request->all());    

        $role->permissions()->sync( $request->permissions);     //llamo al metodo permissions->sync para actualizar en la tabla role_has_permissions que las relaciona a ambas, debido a que es una relacion muchos a muchos

        return redirect()->route('admin.roles.edit', $role)
                           ->with('info', 'El rol se actualizó con éxito');      //mensaje de sesion
    }


    public function destroy(Role $role)
    {

        $role->permissions()->sync([]);     //llamo al metodo permissions->sync para actualizar en la tabla role_has_permissions que las relaciona a ambas, debido a que es una relacion muchos a muchos. Le paso un array vacio para que quite todas las relaciones de este rol

        $role->delete();

        return redirect()->route('admin.roles.index')
                           ->with('info', 'El rol se eliminó con éxito');      //mensaje de sesion   
    }
}
