<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ExamScore extends Model
{
    use HasFactory;
    protected $table = 'exam_scores';
    protected $guarded = [];
    public function student()
    {
        return $this->belongsTo(Student::class);
    }
    public function exam()
    {
        return $this->belongsTo(Exam::class);
    }
    public function class()
    {
        return $this->belongsTo(Classes::class);
    }
    public function school()
    {
        return $this->belongsTo(School::class);
    }
}
