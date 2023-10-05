<?php

namespace Database\Seeders;

use App\Models\Note;
use App\Models\Student;
use Illuminate\Database\Seeder;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class NoteSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $students = Student::all();
        foreach ($students as $student) {
            $subjects = $student->course->subjects;
            foreach ($subjects as $subject) {
                Note::factory()->state([
                    'subject_id' => $subject->id,
                    'student_id' => $student->id
                ])->count(8)->create();
            }
        }
    }
}
