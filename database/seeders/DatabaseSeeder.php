<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Category;
use App\Models\Tag;
use Illuminate\Support\Facades\Storage;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */

    public function run()		//cuando ejecuto "php artisan db:seed" se generan estos registros en la tabla
    {
        //ESTAS DOS INSTRUCCIONES NO FUNCIONAN POR UN TEMA DE PERMISOS DE WINDOWS !!!!!!!!!!!!!!!
    	Storage::deleteDirectory('posts');	//borro la carpeta public/storage/posts donde almaceno imagenes
    	Storage::makeDirectory('posts');	//creo la carpeta public/storage/posts donde almaceno imagenes

    	//utilizacion de seeders para crear registros. Archivos database\seeders 
        $this->call(UserSeeder::class);

    	//utilizacion de Factories para crear registros. Archivos database\factories 
         Category::factory(4)->create();
         Tag::factory(8)->create();

    	//utilizacion de seeders para crear registros. Archivos database\seeders 
         $this->call(PostSeeder::class);
    }
}
