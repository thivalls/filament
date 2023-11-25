<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

class PropertyFactory extends Factory
{
    public function definition()
    {
        return [
            'name' => 'Property - ' . rand(1, 5000),
            'price' => fake()->numberBetween(150000, 99999999),
        ];
    }
}
