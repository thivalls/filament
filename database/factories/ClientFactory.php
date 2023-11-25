<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

class ClientFactory extends Factory
{
    public function definition()
    {
        $salary = fake()->numberBetween(1300, 50000);
        $range = $this->generateRange($salary);
        return [
            'name' => fake()->firstNameFemale(),
            'salary' => $salary,
            'start_financing' => $range["initial"],
            'end_financing' => $range["final"],
        ];
    }

    public function generateRange($salary): array {
        switch ($salary) {
            case $salary <= 1500:
                $initial = 150000;
                $final = 250000; 
                break;
            case $salary > 1500 && $salary <= 3000:
                $initial = 180000;
                $final = 350000; 
                break;
            case $salary > 3000 && $salary <= 5000:
                $initial = 250000;
                $final = 450000; 
                break;
            case $salary > 5000 && $salary <= 7000:
                $initial = 350000;
                $final = 650000; 
                break;
            case $salary > 7000 && $salary <= 10000:
                $initial = 550000;
                $final = 1000000; 
                break;
            default:
                $initial = 1000000;
                $final = rand(15000000, 99999999); 
                break;
        }
        return ["initial" => $initial, "final" => $final];
    }
}
