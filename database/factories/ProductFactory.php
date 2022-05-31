<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

class ProductFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {

        return [
            'category_id'=>$this->faker->numberBetween($min = 1, $max = 3),
            'name'=>$this->faker->name,
            'code'=>$this->faker->unique()->text,
            'description'=>$this->faker->text,
            'image'=>$this->faker->image,
            'new'=>$this->faker->numberBetween($min = 0, $max = 1),
            'hit'=>$this->faker->numberBetween($min = 0, $max = 1),
            'recommend'=>$this->faker->numberBetween($min = 0, $max = 1),
            'price'=>$this->faker->numberBetween($min = 1, $max = 10000),
        ];
    }
}
