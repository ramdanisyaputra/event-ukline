<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Regency extends Model
{
    use HasFactory;
    protected $table = 'regencies';
    protected $guarded = [];
    public function province()
    {
        return $this->belongsTo(Province::class);
    }
    public function schools()
    {
        return $this->hasMany(School::class);
    }
}
