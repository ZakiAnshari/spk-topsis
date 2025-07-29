<?php

namespace App\Http\Controllers;

use App\Models\Kriteria;
use App\Models\Subkriteria;
use Illuminate\Http\Request;
use RealRashid\SweetAlert\Facades\Alert;

class SubkriteriaController extends Controller
{
    public function showSubPage($kriteria_id)
    {
        $kriteria = Kriteria::findOrFail($kriteria_id);
        $subkriterias = $kriteria->subkriterias;

        return view('admin.kriteria.sub', compact('kriteria', 'subkriterias'));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'kriteria_id'       => 'required|exists:kriterias,id',
            'nama'              => 'required|string|max:255',
            'berat_kepentingan' => 'required|numeric|min:0',
        ]);

        Subkriteria::create($validated);

        Alert::success('Berhasil', 'Subkriteria berhasil ditambahkan');
        return back();
    }

    public function destroy($id)
    {
        $subkriterias = Subkriteria::where('id', $id)->first();
        $subkriterias->delete();
        Alert::success('Success', 'Data berhasil di Hapus');
        return back();
    }
}
