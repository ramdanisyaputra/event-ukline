<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Student extends Model
{
    use HasFactory;
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
