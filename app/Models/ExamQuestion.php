<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ExamQuestion extends Model
{
    use HasFactory;
    protected $table = 'exam_questions';
    protected $guarded = [];
    public function exam()
    {
        return $this->belongsTo(Exam::class);
    }
}
