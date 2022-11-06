<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

class ServiceFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
           
            'title' => $this->faker->sentence(15),
            'content' => $this->faker->text(20),
            'price' => $this->faker->randomElement([19.99,49.99,99.99]),
            'image' => 'posts/'.$this->faker->image('public/storage/posts', 640, 480, null, false),
            //si es true: public/storage/posts/image1
            //si es false: image1
            // nos interesa que sea: posts/image1
        ];
    }
}
