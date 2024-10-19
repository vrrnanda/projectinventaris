<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Permintaan extends Model
{
    use HasFactory;
    public $incrementing = false;
    protected $keyType = 'string';
    protected $primaryKey = 'kodepermintaan';

    protected $table = 'permintaan';
    protected $fillable = [
        'kodepermintaan',
        'tglpermintaan',
        'namabrg',
        'ruangan',
        'keterangan',
        'jumlah',
        'status',
        'catatan'
    ];
    public function ruangan()
    {
    return $this->belongsTo(Ruangan::class, 'id_ruang','id_ruang');
    }
}
