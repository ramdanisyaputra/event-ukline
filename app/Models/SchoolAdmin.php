<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SchoolAdmin extends Model
{
    use HasFactory;
    protected $table = 'school_admins';
    protected $guarded = [];
    public function school()
    {
        return $this->belongsTo(School::class);
    }
}
