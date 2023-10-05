<?php

namespace Database\Seeders;

use App\Models\Course;
use App\Models\Subject;
use Illuminate\Database\Seeder;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class SubjectSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $subjects = Subject::factory()->count(6)->create();

        foreach ($subjects as $subject) {
            $courses = Course::all()->random(3);
            foreach ($courses as $course) {
                $subject->courses()->attach($course->id);
            }
        }
    }
}
