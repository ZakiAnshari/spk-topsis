<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Subkriteria extends Model
{
    // Mass assignment protection
    protected $fillable = [
        'kriteria_id',
        'nama',
        'berat_kepentingan',
    ];

    // Relasi ke model Kriteria
    public function kriteria()
    {
        return $this->belongsTo(Kriteria::class, 'kriteria_id');
    }
}
