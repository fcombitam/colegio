<?php

namespace Database\Factories;

use App\Models\Admin;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Admin>
 */
class AdminFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'idtype' => fake()->randomElement([Admin::ADMIN_IDTYPE_DE, Admin::ADMIN_IDTYPE_DI, Admin::ADMIN_IDTYPE_PASSPORT]),
            'identification' => fake()->unique()->bothify('?##???####'),
            'date_of_birth' => fake()->dateTimeBetween('-30 year', '-20 year')->format('Y-m-d'),
            'gender' => fake()->randomElement([Admin::ADMIN_GENDER_FEMALE, Admin::ADMIN_GENDER_MALE, Admin::ADMIN_GENDER_OTHER]),
            'address' => fake()->address(),
        ];
    }
}
