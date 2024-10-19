<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Pergantian extends Model
{
    use HasFactory;

    public $incrementing = false;
    protected $keyType = 'string';
    protected $primaryKey = 'kodepergantian';

    protected $table= 'pergantian';
    protected $fillable = [
        'kodepergantian',
        'namabrg',
        'ruangan',
        'jumlah',
        'tglpergantian',
        'tglterima',
        'keterangan',
        'status'
    ];
    public function barang(){
        return $this->belongsTo(Barang::class, 'kodebrg','kodebrg');
    }
    public function ruangan(){
        return $this->belongsTo(Ruangan::class, 'id_ruang','id_ruang');
    }
}
