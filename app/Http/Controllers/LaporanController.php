<?php

namespace App\Http\Controllers;

use App\Models\Kriteria;
use App\Models\Penilaian;
use App\Models\Alternatif;
use Illuminate\Http\Request;

class LaporanController extends Controller
{
    public function cetaklaporan()
    {
        $kriterias = Kriteria::all();
        $alternatifs = Alternatif::all();
        $penilaians = Penilaian::with('alternatif', 'subkriteria', 'subkriteria.kriteria')->get();

        // Matriks keputusan awal: [alternatif_id][kriteria_id] = nilai
        $matrix = [];
        foreach ($penilaians as $penilaian) {
            $matrix[$penilaian->alternatif_id][$penilaian->kriteria_id] = $penilaian->nilai;
        }

        // Tahap 1: Hitung matriks normalisasi
        $pembagi = [];
        foreach ($kriterias as $kriteria) {
            $jumlahKuadrat = 0;
            foreach ($alternatifs as $a) {
                $nilai = $matrix[$a->id][$kriteria->id] ?? 0;
                $jumlahKuadrat += pow($nilai, 2);
            }
            $pembagi[$kriteria->id] = sqrt($jumlahKuadrat);
        }

        $normalisasi = [];
        foreach ($alternatifs as $a) {
            foreach ($kriterias as $kriteria) {
                $nilai = $matrix[$a->id][$kriteria->id] ?? 0;
                $normalisasi[$a->id][$kriteria->id] = $pembagi[$kriteria->id] != 0
                    ? $nilai / $pembagi[$kriteria->id]
                    : 0;
            }
        }

        // Tahap 2: Matriks terbobot
        $terbobot = [];
        foreach ($normalisasi as $idAlternatif => $nilaiKriteria) {
            foreach ($nilaiKriteria as $idKriteria => $nilai) {
                $bobot = Kriteria::find($idKriteria)->bobot_normalisasi;
                $terbobot[$idAlternatif][$idKriteria] = $nilai * $bobot;
            }
        }

        // Tahap 3: Solusi ideal positif dan negatif
        $solusiPositif = [];
        $solusiNegatif = [];
        foreach ($kriterias as $kriteria) {
            $id = $kriteria->id;
            $nilaiKriteria = array_column(array_map(fn($a) => $a[$id], $terbobot), null);

            if (strtolower($kriteria->jenis) === 'benefit') {
                $solusiPositif[$id] = max($nilaiKriteria);
                $solusiNegatif[$id] = min($nilaiKriteria);
            } else {
                $solusiPositif[$id] = min($nilaiKriteria);
                $solusiNegatif[$id] = max($nilaiKriteria);
            }
        }

        // Tahap 4: Hitung jarak ke solusi ideal
        $jarakPositif = [];
        $jarakNegatif = [];
        foreach ($terbobot as $idAlternatif => $nilaiKriteria) {
            $jarakPositif[$idAlternatif] = 0;
            $jarakNegatif[$idAlternatif] = 0;
            foreach ($nilaiKriteria as $idKriteria => $nilai) {
                $jarakPositif[$idAlternatif] += pow($nilai - $solusiPositif[$idKriteria], 2);
                $jarakNegatif[$idAlternatif] += pow($nilai - $solusiNegatif[$idKriteria], 2);
            }
            $jarakPositif[$idAlternatif] = sqrt($jarakPositif[$idAlternatif]);
            $jarakNegatif[$idAlternatif] = sqrt($jarakNegatif[$idAlternatif]);
        }

        // Tahap 5: Nilai preferensi
        $preferensi = [];
        foreach ($alternatifs as $a) {
            $id = $a->id;
            $dPlus = $jarakPositif[$id] ?: 1; // Hindari pembagian 0
            $dMinus = $jarakNegatif[$id];
            $preferensi[$id] = round($dMinus / ($dMinus + $dPlus), 4);
        }

        arsort($preferensi); // Urutkan dari terbesar

        return view('admin.laporan.cetak', compact(
            'kriterias',
            'alternatifs',
            'matrix',
            'normalisasi',
            'terbobot',
            'solusiPositif',
            'solusiNegatif',
            'jarakPositif',
            'jarakNegatif',
            'preferensi',
            'penilaians'
        ));
    }
}
