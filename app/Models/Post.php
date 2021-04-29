<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\User;
use App\Models\Category;
use App\Models\Tag;
use App\Models\Image;

class Post extends Model
{
    use HasFactory;

    //relacion 1 a muchos inversa
    public  function user(){                              //metodo que me devuelve el usuario de un perfil
//        $user = User::find($this->user_id);
//        return $user;
        return $this->belongsTo(User::class);       //una manera mucho mas resumida que la anterior
//        return $this->belongsTo(User::class, 'user_id');       //si el campos no se llaman segun convencion, hay que pasarlo como argumento para que relacione las tablas
//        return $this->belongsTo('App\Models\User');       //igual que el anterior, no requiere el 
                                                            //"use App\Models\Users"
    }

    //relacion 1 a muchos inversa
    public  function category(){                          //metodo que me devuelve la categoria de un post
//        $categoria = Category::find($this->category_id);
//        return $categoria;
        return $this->belongsTo(Category::class);       //una manera mucho mas resumida que la anterior
//        return $this->belongsTo(Categoria::class, 'category_id');       //si el campos no se llaman segun convencion, hay que pasarlo como argumento para que relacione las tablas
//        return $this->belongsTo('App\Models\Category');       //igual que el anterior, no requiere el 
                                                            //"use App\Models\Category"
    }

    //relacion muchos a muchos
    public  function tags(){                              //metodo que me devuelve los tags de un post
//        $tags = Role::find($this->post_id);
//        return $tags;
        return $this->belongsToMany(Tag::class);       //una manera mucho mas resumida que la anterior
//        return $this->belongsToMany(Tag::class, 'post_id');       //si el campos no se llaman segun convencion, hay que pasarlo como argumento para que relacione las tablas
//        return $this->belongsToMany('App\Models\Tag');       //igual que el anterior, no requiere el 
                                                            //"use App\Models\Tag"
    }

    //relacion 1 a 1 polimorfica
    public function image(){
        return $this->morphOne(Image::class, 'imageable');    //imageable es el metodo a usar
    }

}
