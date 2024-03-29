<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Grade extends Model
{
    use HasFactory;
    protected $table = 'grades';
    protected $guarded = [];
    public function classes()
    {
        return $this->hasMany(Classes::class);
    }
    public function educationLevel()
    {
        return $this->belongsTo(EducationLevel::class);
    }
}
