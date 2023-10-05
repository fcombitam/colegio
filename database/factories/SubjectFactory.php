<?php

namespace Database\Factories;

use App\Models\Subject;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Subject>
 */
class SubjectFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'name' => fake()->unique()->randomElement(['Matematicas', 'Ingles', 'Español', 'Fisica', 'Biologia', 'Artes']),
            'description' => fake()->paragraph(),
            'code' => fake()->unique()->bothify('?????#####'),
            'teacher' => fake()->name(),
            'classroom' => fake()->randomElement(['732', '733', '734', '735', '736', '737']),
            'status' => Subject::SUBJECT_STATUS_ACTIVE
        ];
    }
}
