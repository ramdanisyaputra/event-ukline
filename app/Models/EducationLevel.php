<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class EducationLevel extends Model
{
    use HasFactory;
    protected $table = 'education_levels';
    protected $guarded = [];
    public function schools()
    {
        return $this->hasMany(School::class);
    }

    public function grades()
    {
        return $this->hasMany(Grade::class);
    }
}
