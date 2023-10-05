<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Note extends Model
{
    use HasFactory;

    const NOTE_STATUS_APPROVED = 'aprovada';
    const NOTE_STATUS_FAIL = 'reprovada';

    const NOTE_TYPE_ACTIVITY = 'actividad';
    const NOTE_TYPE_HOMEWORK = 'tarea';
    const NOTE_TYPE_EVALUATION = 'evaluacion';

    protected $fillable = [
        'type',
        'comments',
        'score',
        'status',
        'student_id',
        'subject_id'
    ];

    /**
     * Get the student that owns the Note
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function student(): BelongsTo
    {
        return $this->belongsTo(Student::class);
    }

    /**
     * Get the subject that owns the Note
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function subject(): BelongsTo
    {
        return $this->belongsTo(Subject::class);
    }
}
