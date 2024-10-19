<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Pengembalian extends Model
{
    use HasFactory;
    protected $table = 'pengembalian';
    protected $fillable = [
        'kodepeminjaman',
        'tglpinjam',
        'tglkembali',
        'ruangan',
        'namabrg',
        'jumlah',
        'status',
        'tglterima'
    ];
    public function peminjaman()
    {
        return $this->belongsTo(Peminjaman::class);
    }
}
