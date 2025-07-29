<?php

namespace App\Http\Controllers;

use App\Models\Kriteria;
use Illuminate\Http\Request;
use RealRashid\SweetAlert\Facades\Alert;

class KriteriaController extends Controller
{
    public function index(Request $request)
    {
        // Ambil input keyword pencarian dan jumlah item per halaman
        $nama = $request->input('search'); // bisa nama atau NIK
        $paginate = $request->input('itemsPerPage', 5); // default 5 item per halaman

        // Mulai query
        $query = Kriteria::query();

        // Jika ada keyword pencarian
        if (!empty($nama)) {
            $query->where(function ($q) use ($nama) {
                $q->where('nama', 'like', '%' . $nama . '%')
                    ->orWhere('nik', 'like', '%' . $nama . '%');
            });
        }

        // Eksekusi query dengan paginasi
        $kriterias = $query->paginate($paginate);

        // Kirim ke view
        return view('admin.kriteria.index', compact('kriterias', 'nama'));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'kode'       => 'required|string|max:255',
            'nama'       => 'required|string|max:255|unique:kriterias,nama',
            'jenis'      => 'required|in:Benefit,Cost',
            'kepentingan' => 'required|integer|min:1|max:5',
        ]);

        Kriteria::create($validated);

        Alert::success('Success', 'Data Kriteria berhasil ditambahkan');
        return back();
    }

    public function edit($id)
    {
        $kriterias = Kriteria::find($id);
        if (!$kriterias) {
            return redirect()->back()->with('error', 'Data tidak ditemukan');
        }
        return view('admin.kriteria.edit', compact('kriterias'));
    }

    public function update(Request $request, $id)
    {
        // Temukan data berdasarkan ID
        $kriteria = Kriteria::findOrFail($id);

        // Validasi data yang masuk
        $validatedData = $request->validate([
            'kode'       => 'required|string|max:255',
            'nama'       => 'required|string|max:255|unique:kriterias,nama,' . $id,
            'jenis'      => 'required|in:Benefit,Cost',
            'kepentingan' => 'required|integer|min:1|max:5',
        ]);

        // Perbarui data di database
        $kriteria->update($validatedData);

        // Redirect kembali dengan pesan sukses
        Alert::success('Success', 'Data Kriteria berhasil diperbarui');
        return redirect()->route('kriteria.index');
    }

    public function destroy($id)
    {
        $kriteria = Kriteria::with('subkriterias')->findOrFail($id);

        // Hapus semua subkriterias yang terkait
        $kriteria->subkriterias()->delete();

        // Hapus kriteria-nya
        $kriteria->delete();

        Alert::success('Success', 'Kriteria dan semua subkriteria berhasil dihapus');
        return redirect()->route('kriteria.index');
    }
}
