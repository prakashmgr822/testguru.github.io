<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Question extends Model
{
    use HasFactory;

    protected $guarded = ['id'];

    public function tests()
    {
        return $this->belongsToMany(Test::class, 'question_tests')->withTimestamps();
    }

    public function subject()
    {
        return $this->belongsTo(Subject::class);
    }
}
