<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ExamClass extends Model
{
    use HasFactory;

    public $fillable = ['exam_id', 'subject_id', 'school_id', 'class_ids'];

    public function exam()
    {
        return $this->belongsTo(Exam::class, 'exam_id');
    }

    public function subject()
    {
        return $this->belongsTo(Subject::class, 'subject_id');
    }

    public function school()
    {
        return $this->belongsTo(School::class, 'school_id');
    }
}
