<?php

namespace Database\Factories;

use App\Models\Post;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;


class PostFactory extends Factory
{
    protected $model = Post::class;

    public function definition()
    {
        return [
            'post_title' => $this->faker->sentence(),
            'post_body' => $this->faker->paragraph(),
            'featured_image' => $this->faker->imageUrl($width = 840, $height = 580),
            'status' => 1,
            'added_by' => User::all()->random()->id,
        ];
    }

}
