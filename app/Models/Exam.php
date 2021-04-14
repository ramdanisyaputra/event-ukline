<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Exam extends Model
{
    use HasFactory;
    protected $table = 'exams';
    protected $guarded = [];
    public function examType()
    {
        return $this->belongsTo(ExamType::class);
    }
    public function regency()
    {
        return $this->belongsTo(Regency::class);
    }
    public function examQuestions()
    {
        return $this->hasMany(ExamQuestion::class);
    }
    public function examScores()
    {
        return $this->hasMany(ExamScore::class);
    }
    public function examClass()
    {
        return $this->hasMany(ExamClass::class, 'exam_id');
    }
}
