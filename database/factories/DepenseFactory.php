<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Depense>
 */
class DepenseFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'titre_depense' => fake()->text(150),
            'montant_depense' => fake()->randomFloat(2, 20, 1500),
            'created_at' => fake()->dateTimeThisYear(),
        ];
    }
}
