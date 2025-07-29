<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Alternatif extends Model
{
    protected $fillable = [
        'nama_smartphone',
        'kode_produk',
        'harga',
        'ram',
        'internal_storage',
        'kamera',
        'baterai',
        'stok',
    ];
}
