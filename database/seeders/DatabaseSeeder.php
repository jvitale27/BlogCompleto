<?php

namespace Database\Seeders;

use App\Models\Category;
use App\Models\Tag;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Cache;
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
    	Storage::deleteDirectory('posts');	//borro la carpeta public/storage/posts donde almaceno imagenes
    	Storage::makeDirectory('posts');	//creo la carpeta public/storage/posts donde almaceno imagenes

        //limpio los archivos de cache, para refrescar los cambios en la pagina cuando ejecuto los seeders
        Cache::flush();

        //utilizacion de seeders para crear registros. Archivos database\seeders 
        //primero va Role y luego User, sin no puedo vincularlos
        $this->call(RoleSeeder::class);

    	//utilizacion de seeders para crear registros. Archivos database\seeders 
        $this->call(UserSeeder::class);

    	//utilizacion de Factories para crear registros. Archivos database\factories 
         Category::factory(4)->create();
         Tag::factory(8)->create();

    	//utilizacion de seeders para crear registros. Archivos database\seeders 
         $this->call(PostSeeder::class);
    }
}
