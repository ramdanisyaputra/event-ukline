<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class Student extends Authenticatable
{
    use HasFactory, Notifiable;

    protected $table = 'students';
    protected $guarded = [];
    public function school()
    {
        return $this->belongsTo(School::class);
    }
    public function class()
    {
        return $this->belongsTo(Classes::class);
    }
    public function examScores()
    {
        return $this->hasMany(ExamScore::class);
    }
}
