<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Pembelian extends Model
{
    use HasFactory;

    public $incrementing = false;
    protected $keyType = 'string';
    protected $primaryKey = 'kodepembelian';

    protected $table='pembelian';
    protected $fillable= [
        'kodepembelian',
        'namabrg',
        'vendor',
        'tglbeli',
        'harga',
        'tglterima',
        'bukti',
        'jumlah',
        'spesifikasi',
        'catatan',
        'status'
    ];
}
