<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Model>
 */
class PartidaFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'user_id' => 2,
            'tiempo' => $this->faker->numberBetween(1, 7199),
            'errores' => $this->faker->numberBetween(1, 10),
            'dificultad' => $this->faker->randomElement(['Facil', 'Medio', 'Dificil','Heroe']),
        ];
    }
}
