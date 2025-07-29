<?php

namespace App\Http\Controllers;

use App\Models\Kriteria;
use App\Models\Penilaian;
use App\Models\Alternatif;
use App\Models\Subkriteria;
use Illuminate\Http\Request;
use RealRashid\SweetAlert\Facades\Alert;

class PenilaianController extends Controller
{
    public function index()
    {

        $alternatifs   = Alternatif::orderBy('created_at', 'desc')->get(); // Data masyarakat terbaru
        $kriterias     = Kriteria::with('subkriterias')->get();            // Kriteria + sub
        $subkriterias  = Subkriteria::all();

        // ✅ Perbaikan di sini
        $penilaians    = Penilaian::with(['alternatif', 'subkriteria'])
            ->orderBy('created_at', 'desc')
            ->get();



        return view('admin.penilaian.index', compact('kriterias', 'subkriterias', 'alternatifs', 'penilaians'));
    }

    public function store(Request $request)
    {
        // Validasi input
        $request->validate([
            'alternatif_id'     => 'required|exists:alternatifs,id',
            'subkriteria_id'    => 'required|array',
            'subkriteria_id.*'  => 'required|exists:subkriterias,id',
        ]);

        // Periksa apakah penilaian untuk alternatif ini sudah ada
        $sudahDinilai = Penilaian::where('alternatif_id', $request->alternatif_id)->exists();

        if ($sudahDinilai) {
            return redirect()->back()->withErrors(['alternatif_id' => 'Penilaian untuk alternatif ini sudah ada.']);
        }

        // Simpan setiap penilaian berdasarkan subkriteria
        foreach ($request->subkriteria_id as $kriteria_id => $subkriteria_id) {
            $sub = Subkriteria::find($subkriteria_id);

            Penilaian::create([
                'alternatif_id'   => $request->alternatif_id,
                'kriteria_id'     => $kriteria_id,
                'subkriteria_id'  => $subkriteria_id,
                'nilai'           => optional($sub)->berat_kepentingan ?? 0,
            ]);
        }

        Alert::success('Berhasil', 'Penilaian berhasil ditambahkan');
        return back();
    }


    public function destroy($alternatif_id)
    {
        $penilaians = Penilaian::where('alternatif_id', $alternatif_id)->get();

        if ($penilaians->isEmpty()) {
            return back()->with('error', 'Data penilaian tidak ditemukan');
        }

        foreach ($penilaians as $penilaian) {
            $penilaian->delete();
        }
        Alert::success('Berhasil', 'Data penilaian berhasil dihapus');
        return back();
    }
}
