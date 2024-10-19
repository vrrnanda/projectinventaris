<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Ruangan extends Model
{
    use HasFactory;

    protected $table='ruangan';
    protected $primaryKey = 'id_ruang';
    protected $fillable = [
        'namaruang'
    ];

    public function users()
    {
    return $this->belongsToMany(User::class, 'id_ruang');
    }
    public function penempatan()
    {
        return $this->hasMany(Penempatan::class, 'id_ruang', 'id_ruang');
    }
    public function barangRusak()
    {
        return $this->hasMany(BarangRusak::class, 'id_ruang', 'kodebrg');
    }
    public function peminjaman()
    {
        return $this->hasMany(Peminjaman::class, 'id_ruang', 'id_ruang');
    }
    public function permintaan()
    {
        return $this->hasMany(Permintaan::class, 'id_ruang', 'id_ruang');
    }
    public function pergantian()
    {
        return $this->hasMany(pergantian::class, 'id_ruang', 'id_ruang');
    }
}
