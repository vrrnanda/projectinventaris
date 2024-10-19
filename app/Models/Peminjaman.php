<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Peminjaman extends Model
{
    use HasFactory;

    public $incrementing = false;
    protected $keyType = 'string';
    protected $primaryKey = 'kodepeminjaman';

    protected $table = 'peminjaman';
    protected $fillable =[
        'kodepeminjaman',
        'barangpinjam',
        'ruangan',
        'tglpinjam',
        'jumlah',
        'spesifikasi',
        'keperluan',
        'tglterima',
        'tglpengembalian',
        'tglkembali',
        'namabrg',
        'status',
        'catatan',
        'statuskembali'
    ];
    public function barang()
    {
        return $this->belongsTo(Barang::class, 'kodebrg', 'kodebrg');
    }
    public function ruangan()
    {
        return $this->belongsTo(Ruangan::class, 'id_ruang', 'id_ruang');
    }
}
