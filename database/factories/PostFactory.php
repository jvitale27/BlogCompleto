<?php

namespace Database\Factories;

use App\Models\Post;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;
use App\Models\Category;
use App\Models\User;

class PostFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Post::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        $name = $this->faker->unique()->sentence();      //fake me asigna sentencias predefinidas

        return [
            'name'        => $name,
            'slug'        => Str::slug($name),         //genero la url amigable, cambio ' ' por '-'
            'extract'     => $this->faker->text(250),
            'body'        => $this->faker->text(2000),
            'status'      => $this->faker->randomElement([1, 2]),
            'user_id'     => User::all()->random()->id,           //un id random de los usuarios existentes
            'category_id' => Category::all()->random()->id   //un id random de las categorias existentes
        ];
    }
}
