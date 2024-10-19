<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Barang extends Model
{
    use HasFactory;

    public $incrementing = false;
    protected $keyType = 'string';
    protected $primaryKey = 'kodebrg';

    protected $table= 'barang';
    protected $fillable = [
        'kodebrg',
        'namabrg',
        'kategori',
        'spesifikasi',
        'jumlah',
        'stok'
    ];

    public function penempatan()
    {
        return $this->hasMany(Penempatan::class, 'kodebrg', 'kodebrg');
    }
    public function barangRusak()
    {
        return $this->hasMany(BarangRusak::class, 'kodebrg', 'kodebrg');
    }
    public function peminjaman()
    {
        return $this->hasMany(Peminjaman::class, 'kodebrg', 'kodebrg');
    }
    public function pergantian()
    {
        return $this->hasMany(pergantian::class, 'kodebrg', 'kodebrg');
    }
    public function barangTerbuang()
    {
        return $this->hasMany(pergantian::class, 'kodebrg', 'kodebrg');
    }
    public function kategori()
    {
        return $this->belongsTo(Kategori::class);
    }
}
