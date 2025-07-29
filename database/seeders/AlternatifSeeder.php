<?php

namespace Database\Seeders;

use App\Models\Alternatif;
use Illuminate\Database\Seeder;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class AlternatifSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $smartphones = [
            ['Xiami Redmi 13', 1800000, 256, 8, 5030, 108],
            ['Infinix Note 40 Pro+', 3900000, 256, 12, 4600, 108],
            ['Realme C67', 2800000, 256, 8, 5000, 108],
            ['Xiaomi Redmi 14C', 1600000, 256, 8, 5160, 50],
            ['Realme C75', 2400000, 128, 8, 6000, 50],
            ['Realme C61', 1799000, 128, 8, 5000, 50],
            ['Vivo Y29 256GB', 2899000, 256, 8, 6500, 50],
            ['Vivo Y29 128GB', 2399000, 128, 6, 6500, 50],
            ['Realme C63', 2299000, 256, 8, 5000, 50],
            ['Infinix Hot 50 Pro', 2400000, 256, 8, 5000, 50],
            ['Infinix Smart 9 64GB', 1300000, 64, 8, 5000, 13],
            ['Infinix Hot 50i', 1700000, 128, 6, 5000, 48],
            ['Infinix Smart 9 128GB', 1400000, 128, 8, 5000, 13],
            ['Infinix GT 20 Pro', 4300000, 256, 8, 5000, 108],
            ['Infinix Hot 50', 2000000, 256, 6, 5000, 50],
            ['OPPO A60', 2800000, 256, 8, 5100, 50],
            ['Realme Note 60', 1500000, 128, 6, 5000, 32],
            ['Samsung A16', 2799000, 128, 8, 5000, 50],
            ['Realme C65', 2800000, 256, 8, 5000, 50],
            ['Infinix Hot 50 Pro Plus', 2800000, 256, 8, 5000, 50],
            ['Vivo Y19s', 1700000, 128, 4, 5500, 50],
            ['Samsung A05s', 2099000, 128, 6, 5000, 50],
            ['Samsung A06', 1399000, 64, 4, 5000, 50],
            ['Realme 13', 3000000, 128, 8, 5000, 50],
            ['OPPO A78', 3200000, 256, 8, 5000, 50],
            ['Vivo Y18', 1800000, 128, 4, 5000, 50],
            ['Infinix Note 50 Pro', 3400000, 256, 8, 5200, 50],
            ['Samsung A15', 2699000, 128, 6, 5000, 50],
            ['Realme 12+ 5G', 3500000, 256, 8, 5000, 50],
            ['Vivo V40 Lite', 3600000, 256, 8, 5000, 50],
            ['Vivo Y03t', 1250000, 32, 4, 5000, 13],
            ['OPPO A3pro', 4000000, 256, 8, 5100, 50],
            ['OPPO A3x', 2200000, 128, 6, 5100, 13],
            ['OPPO Reno 13F 4G', 4700000, 256, 8, 5800, 50],
            ['Samsung A6', 1699000, 128, 4, 3000, 50],
        ];

        foreach ($smartphones as $index => $data) {
            Alternatif::create([
                'nama_smartphone' => $data[0],
                'kode_produk' => 'HP' . str_pad($index + 1, 3, '0', STR_PAD_LEFT),
                'harga' => $data[1],
                'internal_storage' => $data[2],
                'ram' => $data[3],
                'baterai' => $data[4],
                'kamera' => $data[5],
                'stok' => rand(5, 20), // stok random
            ]);
        }
    }
}
