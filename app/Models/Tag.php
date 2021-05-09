<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Post;

class Tag extends Model
{
    use HasFactory;

    /**
     * Fields that can be mass assigned.
     *
     * @var array
     */
//cuando hay insercion masiva, solo guardo en la BD estos campos indicados aqui. Es por seguridad
    protected $fillable = ['name', 'slug', 'color'];

//cuando hay insercion masiva, NO guardo en la BD estos campos indicados aqui. Lo contrario al anterior
    protected $guarded = [];            //nada que proteger 


    /* esta funcion hace que las urls se formen acon el slug y no con id de una dada categoria */
    public function getRouteKeyName(){
        return 'slug';
    }

    //relacion muchos a muchos
    public  function posts(){                              //metodo que me devuelve los posts de un tag
//        $posts = Role::find($this->tag_id);
//        return $posts;
        return $this->belongsToMany(Post::class);       //una manera mucho mas resumida que la anterior
//        return $this->belongsToMany(Post::class, 'tag_id');       //si el campos no se llaman segun convencion, hay que pasarlo como argumento para que relacione las tablas
//        return $this->belongsToMany('App\Models\Post');       //igual que el anterior, no requiere el 
                                                            //"use App\Models\Post"
    }

}
