<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

class PostFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
           
            'title' => $this->faker->sentence(),
            'content' => $this->faker->text(),
            'image' => 'posts/'.$this->faker->image('public/storage/posts', 640, 480, null, false),
            //si es true: public/storage/posts/image1
            //si es false: image1
            // nos interesa que sea: posts/image1
        ];
    }
}
