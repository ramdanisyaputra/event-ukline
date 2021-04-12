<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
   
class QuestionWriter extends Model
{
    use HasFactory;
    protected $table = 'question_writers';
    protected $guarded = [];
    public function school()
    {
        return $this->belongsTo(School::class);
    }
}
