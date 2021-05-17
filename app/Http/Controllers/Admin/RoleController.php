<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;

class RoleController extends Controller
{
    
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
            'name' => 'required',
        ]);

        $role = Role::create( $request->all());   //insercion masiva en la BD,
                                                    //todo lo util de request y que es fillable.

        $role->permissions()->sync( $request->permissions);     //llamo al metodo permissions->sync para actualizar en la tabla role_has_permissions que las relaciona a ambas, debido a que es una relacion muchos a muchos

        return redirect()->route('admin.roles.edit', $role)
                           ->with('info', 'El rol se creó con éxito');      //mensaje de sesion
        
    }


    public function show(Role $role)
    {
        return view('admin.roles.show', compact('role'));
    }


    public function edit(Role $role)
    {
        $permissions = Permission::all();

        return view('admin.roles.edit', compact('role', 'permissions'));
    }


    public function update(Request $request, Role $role)
    {
        //
    }


    public function destroy(Role $role)
    {
        //
    }
}
