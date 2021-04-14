<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Subject extends Model
{
    use HasFactory;
    protected $table = 'subjects';
    protected $guarded = [];
    public function school()
    {
        return $this->belongsTo(School::class);
    }

    public function examClassess()
    {
        return $this->hasMany(ExamClass::class, 'subject_id');
    }
}
