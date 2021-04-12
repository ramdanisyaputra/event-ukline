<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class School extends Model
{
    use HasFactory;
    protected $table = 'schools';
    protected $guarded = [];
    public function regency()
    {
        return $this->belongsTo(Regency::class);
    }
    public function educationLevel()
    {
        return $this->belongsTo(EducationLevel::class);
    }
    public function schoolAdmins()
    {
        return $this->hasMany(SchoolAdmin::class);
    }
    public function faqs()
    {
        return $this->hasMany(Faq::class);
    }
    public function subject()
    {
        return $this->hasMany(Subject::class);
    }
    public function classes()
    {
        return $this->hasMany(Classes::class);
    }
}
