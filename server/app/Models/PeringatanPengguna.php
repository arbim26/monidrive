<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PeringatanPengguna extends Model
{
    use HasFactory;

    protected $table = 'peringatan_pengguna';

    protected $fillable = [
        'detail_perjalanan_id',
        'jenis_peringatan',
        'deskripsi',
        'waktu_peringatan',
        'status'
    ];

    // RELASI
    public function detailPerjalanan()
    {
        return $this->belongsTo(DetailPerjalanan::class);
    }
}
