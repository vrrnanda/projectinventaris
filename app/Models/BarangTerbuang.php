<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class BarangTerbuang extends Model
{
    use HasFactory;
    public $incrementing = false;
    protected $keyType = 'string';
    protected $primaryKey = 'kodehapus';

    protected $table= 'barangterbuang';
    protected $fillable = [
        'kodehapus',
        'namabrg',
        'tglhapus',
        'jumlah',
        'status'
    ];

    public function barang()
    {
        return $this->belongsTo(Barang::class, 'kodebrg', 'kodebrg');
    }
}
