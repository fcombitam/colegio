<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Admin extends Model
{
    use HasFactory;

    const ADMIN_IDTYPE_DI = 'documento de identidad';
    const ADMIN_IDTYPE_PASSPORT = 'pasaporte';
    const ADMIN_IDTYPE_DE = 'documento de extranjeria';

    const ADMIN_GENDER_MALE = 'masculino';
    const ADMIN_GENDER_FEMALE = 'femenino';
    const ADMIN_GENDER_OTHER = 'otro';

    protected $fillable = [
        'idtype',
        'identification',
        'date_of_birth',
        'gender',
        'address',
        'profile_picture',
        'user_id'
    ];

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }
}
