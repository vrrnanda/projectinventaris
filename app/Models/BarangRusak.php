<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Session;

class BarangRusak extends Model
{
    use HasFactory;
    public $incrementing = false;
    protected $keyType = 'string';
    protected $primaryKey = 'kodelaporan';

    protected $table = 'barangrusak';
    protected $fillable = [
        'kodelaporan',
        'id_ruang',
        'kodebrg',
        'tgllaporan',
        'ruangan',
        'namabrg',
        'deskripsi',
        'penanganan',
        'status'
    ];

    public function ruangan()
    {
    return $this->belongsTo(Ruangan::class,  'ruangan', 'namaruang');
    }
    public function barang()
    {
    return $this->belongsTo(Barang::class, 'barang','namabrg');
    }
    public function perbaikan()
    {
        return $this->hasMany(Perbaikan::class, 'kodebrg', 'kodebrg');
    }
}
