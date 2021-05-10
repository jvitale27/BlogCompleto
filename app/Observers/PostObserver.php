<?php

namespace App\Observers;

use App\Models\Post;

use Illuminate\Support\Facades\Storage;

//TODOS ESTOS METODOS SE EJECUTAN "DESPUES" DE EJECUTADO EL METODO CORRESPONDIENTE EN EL CONTROLADOR OBSERVADO.
//PARA QUE SE EJECUTEN ANTES DEL METODO DEL CONTROLADOR, SE LE CAMBIA EL NOMBRE. EJ. deleted() por deleting()

//RECORDAR REGISTRAR EL OBSERVER EN EL ARCHIVO App\Providers\EventServiceProvider

class PostObserver
{
    /**
     * Handle the Post "created" event.
     *
     * @param  \App\Models\Post  $post
     * @return void
     */
    public function created(Post $post)
    {
        //
    }
//este se ejecuta antes del metodo del controlador
    public function creating(Post $post)
    {
        $post->user_id = auth()->user()->id;    //cargo el usuario autentificado al nuevo post
    }

    /**
     * Handle the Post "updated" event.
     *
     * @param  \App\Models\Post  $post
     * @return void
     */
    public function updated(Post $post)
    {
        //
    }

    /**
     * Handle the Post "deleted" event.
     *
     * @param  \App\Models\Post  $post
     * @return void
     */
    public function deleted(Post $post)
    {
        //
    }
//este se ejecuta antes del metodo del controlador
    public function deleting(Post $post)
    {
        if($post->image)
            Storage::delete($post->image->url);
    }

    /**
     * Handle the Post "restored" event.
     *
     * @param  \App\Models\Post  $post
     * @return void
     */
    public function restored(Post $post)
    {
        //
    }

    /**
     * Handle the Post "force deleted" event.
     *
     * @param  \App\Models\Post  $post
     * @return void
     */
    public function forceDeleted(Post $post)
    {
        //
    }
}
