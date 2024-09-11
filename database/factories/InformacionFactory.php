<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Informacion>
 */
class InformacionFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            /* 'nombre_apellido' => fake()->name,
            'celular' => random_int(70000000,79999999),
            'correo' => fake()->unique()->safeEmail(),
            //'fecha_nacimiento' => fake()->date($format = 'Y-m-d', $max = 'now'),
            'insti_univer' => 'EISPDM',
            'carrera' => fake()->name,
            'año' => '3 año',
            'turno' => 'mañana',
            'invitado_visita' => fake()->name, */
        ];
    }
}
