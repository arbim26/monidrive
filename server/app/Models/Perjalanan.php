<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Perjalanan extends Model
{
    use HasFactory;

    protected $table = 'perjalanan';

    protected $fillable = [
        'detail_user_id',
        'tanggal_perjalanan',
        'lokasi_awal',
        'lokasi_tujuan',
        'status_perjalanan',
        'durasi_perjalanan'
    ];

    // RELASI
    public function detailUser()
    {
        return $this->belongsTo(DetailUser::class);
    }

    public function detailPerjalanan()
    {
        return $this->hasMany(DetailPerjalanan::class);
    }
}
