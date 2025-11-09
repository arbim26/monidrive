<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Laravel\Sanctum\HasApiTokens;
use Illuminate\Notifications\Notifiable;
use Vinkla\Hashids\Facades\Hashids;

class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable;

    protected $fillable = [
        'username',
        'email',
        'password',
        'role',
        'phone',
        'preferred_language'
    ];

    protected $hidden = [
        'password',
        'remember_token'
    ];

    // RELASI
    public function detailUser()
    {
        return $this->hasOne(DetailUser::class);
    }

    public function perjalanan()
    {
        return $this->hasMany(Perjalanan::class);
    }

    protected $appends = ['hashid'];

    public function getHashidAttribute()
    {
        return Hashids::encode($this->attributes['id']);
    }
}
