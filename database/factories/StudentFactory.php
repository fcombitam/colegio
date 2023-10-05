<?php

namespace Database\Factories;

use App\Models\Course;
use App\Models\Student;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Student>
 */
class StudentFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'code' => fake()->unique()->bothify('?????#####'),
            'idtype' => fake()->randomElement([Student::STUDENT_IDTYPE_PASSPORT, Student::STUDENT_IDTYPE_TI, Student::STUDENT_IDTYPE_DE]),
            'identification' => fake()->unique()->numerify('##########'),
            'date_of_birth' => fake()->dateTimeBetween('-30 year', '-20 year')->format('Y-m-d'),
            'gender' => fake()->randomElement([Student::STUDENT_GENDER_OTHER, Student::STUDENT_GENDER_FEMALE, Student::STUDENT_GENDER_MALE]),
            'address' => fake()->address(),
            'rh' => fake()->randomElement(['O+', 'O-', 'A+', 'A-']),
            'diseases' => fake()->paragraph(),
            'father_name' => fake()->firstNameMale() . ' ' . fake()->lastName(),
            'father_mobile' => fake()->numerify('##########'),
            'mother_name' => fake()->firstNameFemale() . ' ' . fake()->lastName(),
            'mother_mobile' => fake()->numerify('##########'),
            'course_id' => Course::all()->random()
        ];
    }
}
