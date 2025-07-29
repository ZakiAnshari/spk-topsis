<?php

namespace Database\Seeders;

use App\Models\Kriteria;
use Illuminate\Database\Seeder;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class KriteriaSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {

        // Seeder Data Kriteria
        $kriterias = [
            ['kode' => 'C1', 'nama' => 'Harga',    'jenis' => 'Cost',    'kepentingan' => 5],
            ['kode' => 'C2', 'nama' => 'Internal', 'jenis' => 'Benefit', 'kepentingan' => 4],
            ['kode' => 'C3', 'nama' => 'RAM',      'jenis' => 'Benefit', 'kepentingan' => 3],
            ['kode' => 'C4', 'nama' => 'Baterai',  'jenis' => 'Benefit', 'kepentingan' => 2],
            ['kode' => 'C5', 'nama' => 'Kamera',   'jenis' => 'Benefit', 'kepentingan' => 1],
        ];

        foreach ($kriterias as $kriteria) {
            \App\Models\Kriteria::create($kriteria);
        }
    }
}
