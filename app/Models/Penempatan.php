<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Penempatan extends Model
{
    use HasFactory;

    public $incrementing = false;
    protected $keyType = 'string';
    protected $primaryKey = 'kodepenempatan';

    protected $table = 'penempatan';
    protected $fillable = [
        'kodepenempatan',
        'kodebrg',
        'ruangan',
        'namabrg',
        'tglpenempatan',
        'jumlah',
        'kategori'
    ];
    public function ruangan()
    {
    return $this->belongsTo(Ruangan::class, 'ruangan', 'namaruang');
    }
    public function barang()
    {
    return $this->belongsTo(Barang::class, 'kodebrg','kodebrg');
    }
}
