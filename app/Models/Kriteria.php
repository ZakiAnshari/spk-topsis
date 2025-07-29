<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Kriteria extends Model
{
    protected $fillable = [
        'kode',
        'nama',
        'jenis',
        'kepentingan'
    ];

    // Relasi ke subkriteria
    public function subkriterias()
    {
        return $this->hasMany(Subkriteria::class);
    }


    // RUMUS Hitung Normalisasi
    public static function totalBobot()
    {
        return self::sum('kepentingan'); // Disesuaikan dari 'kriteria_berat'
    }

    public function getBobotNormalisasiAttribute()
    {
        $total = self::totalBobot();
        return $total > 0 ? $this->kepentingan / $total : 0; // Disesuaikan dari 'kriteria_berat'
    }

    public function getKriteriaBobotAttribute()
    {
        return $this->bobot_normalisasi;
    }
}
