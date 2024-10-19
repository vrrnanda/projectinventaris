<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Perbaikan extends Model
{
    use HasFactory;
    public $incrementing = false;
    protected $keyType = 'string';
    protected $primaryKey = 'kodeperbaikan';

    protected $table = 'perbaikan';
    protected $fillable = [
        'kodeperbaikan',
        'kodelaporan',
        'namabrg',
        'vendor',
        'deskripsi',
        'tglperbaikan',
        'tglselesai',
        'biaya',
        'bukti',
        'deskripsi',
        'status'
    ];

    public function barangRusak()
    {
        return $this->belongsTo(BarangRusak::class, 'kodebrg', 'kodebrg');
    }
}
