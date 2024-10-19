<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Kategori extends Model
{
    use HasFactory;

    protected $table = 'kategori';
    protected $fillable = [
        'id_kategori',
        'kategor'
    ];
    public function barang()
    {
        return $this->hasMany(Barang::class);
    }
}
