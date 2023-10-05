<?php

namespace Database\Factories;

use App\Models\Course;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Course>
 */
class CourseFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'name' => fake()->unique()->randomElement(['6A', '6B', '7A', '7B', '8A', '8B']),
            'description' => fake()->paragraph(),
            'code' => fake()->unique()->numerify('##########'),
            'status' => Course::COURSE_STATUS_ACTIVE
        ];
    }
}
