<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Subject extends Model
{
    use HasFactory;

    protected $guarded = ['id'];

    public function grade()
    {
        return $this->belongsTo(Grade::class);
    }

    public function questions()
    {
        return $this->hasMany(Question::class);
    }
}

