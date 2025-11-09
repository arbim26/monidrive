<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DetailPerjalanan extends Model
{
    use HasFactory;

    protected $table = 'detail_perjalanan';

    protected $fillable = [
        'perjalanan_id',
        'waktu',
        'latitude',
        'longitude',
        'kecepatan',
        'status_mata',
        'status_konsentrasi'
    ];

    // RELASI
    public function perjalanan()
    {
        return $this->belongsTo(Perjalanan::class);
    }

    public function peringatan()
    {
        return $this->hasMany(PeringatanPengguna::class);
    }
}
