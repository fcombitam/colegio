<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\hasMany;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Student extends Model
{
    use HasFactory;

    const STUDENT_IDTYPE_TI = 'tarjeta de identidad';
    const STUDENT_IDTYPE_PASSPORT = 'pasaporte';
    const STUDENT_IDTYPE_DE = 'documento de extranjeria';

    const STUDENT_GENDER_MALE = 'masculino';
    const STUDENT_GENDER_FEMALE = 'femenino';
    const STUDENT_GENDER_OTHER = 'otro';

    protected $fillable = [
        'code',
        'idtype',
        'identification',
        'date_of_birth',
        'gender',
        'address',
        'rh',
        'diseases',
        'father_name',
        'father_mobile',
        'mother_name',
        'mother_mobile',
        'profile_picture',
        'course_id',
        'user_id'
    ];

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    public function course(): BelongsTo
    {
        return $this->belongsTo(Course::class);
    }

    public function notes(): hasMany
    {
        return $this->hasMany(Note::class);
    }
}
