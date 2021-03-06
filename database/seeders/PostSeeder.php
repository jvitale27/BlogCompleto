<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Post;
use App\Models\Image;

class PostSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $posts = Post::factory(30)->create();

        foreach ($posts as $post) {
        	Image::factory(1)->create([
				'imageable_id'   => $post->id,
				'imageable_type' => Post::class
        	]);
        	$post->tags()->attach([		//supiestamente agrego a la tabla post_tag, pero no entiendo
        		rand(1, 4),				//random entre 1 y 4
        		rand(5, 8)
        	]);
        }
    }
}
