<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Test extends Model
{
    use HasFactory;

    protected $guarded = ['id'];

    public function grade(){
        return $this->belongsTo(Grade::class);
    }

    public function questions()
    {
        return $this->belongsToMany(Question::class, 'question_tests')->withTimestamps();
    }

    public function marksheets()
    {
        return $this->hasMany(Marksheet::class);
    }
}
