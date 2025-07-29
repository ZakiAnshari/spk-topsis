<?php

namespace App\Http\Controllers;

use App\Models\Alternatif;
use Illuminate\Http\Request;
use RealRashid\SweetAlert\Facades\Alert;

class AlternatifMerekhp extends Controller
{
    public function index(Request $request)
    {
        // Ambil input keyword pencarian dan jumlah item per halaman
        $nama = $request->input('search'); // bisa nama atau NIK
        $paginate = $request->input('itemsPerPage', 5); // default 5 item per halaman

        // Mulai query
        $query = Alternatif::query();

        // Jika ada keyword pencarian
        if (!empty($nama)) {
            $query->where(function ($q) use ($nama) {
                $q->where('nama', 'like', '%' . $nama . '%')
                    ->orWhere('nik', 'like', '%' . $nama . '%');
            });
        }

        // Eksekusi query dengan paginasi
        $alternatifs = $query->paginate($paginate);

        // Kirim data ke view
        return view('admin.alternatif.index', compact('alternatifs', 'nama'));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'nama_smartphone'   => 'required|string|max:255',
            'kode_produk'       => 'required|string|max:100|unique:alternatifs,kode_produk',
            'harga'             => 'required|string',
            'ram'               => 'required|integer|min:1',
            'internal_storage'  => 'required|integer|min:1',
            'kamera'            => 'required|integer|min:1',
            'baterai'           => 'required|integer|min:1000',
            'stok'              => 'required|integer|min:0',
        ]);

        // Bersihkan format harga: "Rp 200.000" => 200000
        $validated['harga'] = str_replace(['Rp', '.', ' '], '', $validated['harga']);

        // Simpan ke database
        Alternatif::create($validated);

        Alert::success('Sukses', 'Data Smartphone berhasil ditambahkan');
        return redirect()->route('alternatif.index');
    }

    public function edit($id)
    {
        $alternatifs = Alternatif::find($id);
        // Validasi apakah data ditemukan
        if (!$alternatifs) {
            return redirect()->back()->with('error', 'Data tidak ditemukan');
        }
        return view('admin.alternatif.edit', compact('alternatifs'));
    }

    public function update(Request $request, $id)
    {
        $validated = $request->validate([
            'nama_smartphone'   => 'required|string|max:255',
            'kode_produk'       => 'required|string|max:100|unique:alternatifs,kode_produk,' . $id,
            'harga'             => 'required|string',
            'ram'               => 'required|integer|min:1',
            'internal_storage'  => 'required|integer|min:1',
            'kamera'            => 'required|integer|min:1',
            'baterai'           => 'required|integer|min:1000',
            'stok'              => 'required|integer|min:0',
        ]);

        // Bersihkan format harga: "Rp 1.500.000" => 1500000
        $validated['harga'] = str_replace(['Rp', '.', ' '], '', $validated['harga']);

        $alternatif = Alternatif::findOrFail($id);
        $alternatif->update($validated);

        Alert::success('Sukses', 'Data smartphone berhasil diperbarui');
        return redirect()->route('alternatif.index');
    }

    public function show($id)
    {
        $alternatifs = Alternatif::findOrFail($id);
        return view('admin.alternatif.show', compact('alternatifs'));
    }

    public function destroy($id)
    {

        $alternatifs = Alternatif::where('id', $id)->first();
        $alternatifs->delete();

        Alert::success('Success', 'Data berhasil di Hapus');
        return redirect()->route('alternatif.index');
    }
}
