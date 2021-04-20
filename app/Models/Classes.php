<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Classes extends Model
{
    use HasFactory;
    protected $table = 'classes';
    protected $guarded = [];
    public function school()
    {
        return $this->belongsTo(School::class);
    }
    public function grade()
    {
        return $this->belongsTo(Grade::class);
    }
    public function students()
    {
        return $this->hasMany(Student::class, 'class_id');
    }
    public function examScores()
    {
        return $this->hasMany(ExamScore::class);
    }
}
