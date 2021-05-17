<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Spatie\Permission\Models\Role;

class UserController extends Controller
{
    public function index()
    {
        return view('admin.users.index');
    }

    public function edit(User $user)
    {
        $roles = Role::all();

        return view('admin.users.edit', compact('user', 'roles'));
    }

    public function update(Request $request, User $user)
    {
        $user->roles()->sync( $request->roles);      //llamo al metodo roles->sync para actualizar en la tabla model_has_roles que las relaciona a ambas, debido a que es una relacion muchos a muchos

        return redirect()->route('admin.users.edit', $user)
                           ->with('info', 'Se asignaron los roles con éxito');      //mensaje de sesion

    }
}
