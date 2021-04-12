<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class SchoolAdmin extends Authenticatable
{
    use HasFactory, Notifiable;
    protected $table = 'school_admins';
    protected $guarded = [];
    public function school()
    {
        return $this->belongsTo(School::class);
    }

    protected $hidden = [
        'password',
        'remember_token',
    ];
}
