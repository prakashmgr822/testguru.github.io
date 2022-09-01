<?php

namespace App\Models;


use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Spatie\MediaLibrary\HasMedia;
use Spatie\MediaLibrary\InteractsWithMedia;

class Admin extends Authenticatable implements HasMedia
{
    use HasFactory, InteractsWithMedia, Notifiable;

    protected $guard = 'admins';

    protected $guarded = ['id'];

    protected $hidden = [
        'password',
        'remember_token',
    ];

    public function questions()
    {
        return $this->hasMany(Question::class);
    }
}
