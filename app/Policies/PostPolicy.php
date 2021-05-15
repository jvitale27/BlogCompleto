<?php

namespace App\Policies;

use App\Models\Post;
use App\Models\User;
use Illuminate\Auth\Access\HandlesAuthorization;

class PostPolicy
{
    use HandlesAuthorization;

    /* Creo el metodo de autorizacion para editar/borrar un post. El argumento $user no necesito pasarlo, viene por defecto en cada llamada */
    public function author(User $user, Post $post){
        if($user->id == $post->user_id)
            return true;
        else
            return false;
    }

    /* Creo el metodo de autorizacion para mostrar un post. El argumento $user no necesito pasarlo, viene por defecto en cada llamada. El signo ? indica que puede faltar la informacion del usuario, es opcional que este logueado o no */
    public function published( ?User $user, Post $post){
        if($post->status == 2)                              //si esta publicado
            return true;
        else
            return false;
    }

}
