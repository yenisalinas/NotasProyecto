<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Categoria>
 */
class CategoriaFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {

        //creo un arreglo con libreria falsa
        return [
            
            'nombre_categoria'=> fake()->randomElement(['Personal', 'Trabajo', 'Escuela', 'Salud', 'Finanzas', 'Viajes']),
            'user_id' => fake()->numberBetween(1, 3),
        ];
        
    }
}
