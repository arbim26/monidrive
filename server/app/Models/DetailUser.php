<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DetailUser extends Model
{
    use HasFactory;

    protected $table = 'detail_user';

    protected $fillable = [
        'user_id',
        'foto_wajah',
        'nomor_darurat',
        'alamat',
        'status_aktif',
        'terakhir_login'
    ];

    // RELASI
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function perjalanan()
    {
        return $this->hasMany(Perjalanan::class);
    }
}
