<?php

namespace Database\Factories;

use App\Models\Note;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Note>
 */
class NoteFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $score = fake()->numberBetween(0, 10);
        if ($score < 7) {
            $status = Note::NOTE_STATUS_FAIL;
        }else {
            $status = Note::NOTE_STATUS_APPROVED;
        }
        return [
            'type' => fake()->randomElement([Note::NOTE_TYPE_ACTIVITY, Note::NOTE_TYPE_EVALUATION, Note::NOTE_TYPE_HOMEWORK]),
            'comments' => fake()->paragraph(),
            'score' => $score,
            'status' => $status,
        ];
    }
}
