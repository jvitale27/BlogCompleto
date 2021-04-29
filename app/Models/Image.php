<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Image extends Model
{
    use HasFactory;

    protected $guarded = [];	//declaro todos los campos sin proteccon para insercion masiva

    public function imageable(){

    	return $this->morphTo();	//le indico que esta tabla es de relacion polimorfica

    }
}
