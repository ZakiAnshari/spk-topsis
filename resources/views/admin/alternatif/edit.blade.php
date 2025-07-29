@extends('layouts.admin')
@section('title', 'Edit')
@section('content')
    <div class="container-xxl flex-grow-1 container-p-y">
        <div class="card">
            <div class="d-flex align-items-center justify-content-between border-bottom pb-2 mb-3">
                <a class="mx-4 my-4" href="/alternatif">
                    <button class="btn btn-outline-primary border-1 rounded-1 px-3 py-1 d-flex align-items-center"
                        data-bs-toggle="tooltip" title="Kembali">
                        <i class="bi bi-arrow-left fs-5 mx-1"></i>
                        <span class="fw-normal">Kembali</span>
                    </button>
                </a>
            </div>
            <!-- Card Edit Data Smartphone -->
            <div class="card-body">
                <div class="text-nowrap">

                    @if ($errors->any())
                        <div class="alert alert-danger">
                            <ul class="mb-0">
                                @foreach ($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        </div>
                    @endif

                    <form action="{{ url('alternatif-edit/' . $alternatifs->id) }}" method="POST">
                        @csrf
                        @method('POST') {{-- Karena ini update data --}}
                        <div class="row">
                            <!-- Kolom Kiri -->
                            <div class="col-lg-6">
                                <div class="mb-3">
                                    <label for="nama_smartphone" class="form-label">Nama Smartphone</label>
                                    <input type="text" name="nama_smartphone" class="form-control" id="nama_smartphone"
                                        value="{{ old('nama_smartphone', $alternatifs->nama_smartphone) }}" required>
                                </div>

                                <div class="mb-3">
                                    <label for="kode_produk" class="form-label">Kode Produk</label>
                                    <input type="text" name="kode_produk" class="form-control" id="kode_produk"
                                        value="{{ old('kode_produk', $alternatifs->kode_produk) }}" required>
                                </div>

                                <div class="mb-3">
                                    <label for="harga" class="form-label">Harga (Rp)</label>
                                    <input type="text" name="harga" class="form-control" id="harga"
                                        value="{{ old('harga', number_format($alternatifs->harga, 0, ',', '.')) }}"
                                        oninput="formatRupiah(this)" placeholder="Rp." required>
                                </div>

                                <div class="mb-3">
                                    <label for="ram" class="form-label">RAM (GB)</label>
                                    <input type="number" name="ram" class="form-control" id="ram"
                                        value="{{ old('ram', $alternatifs->ram) }}" required>
                                </div>
                            </div>

                            <!-- Kolom Kanan -->
                            <div class="col-lg-6">
                                <div class="mb-3">
                                    <label for="internal_storage" class="form-label">Internal Storage (GB)</label>
                                    <input type="number" name="internal_storage" class="form-control" id="internal_storage"
                                        value="{{ old('internal_storage', $alternatifs->internal_storage) }}" required>
                                </div>

                                <div class="mb-3">
                                    <label for="kamera" class="form-label">Kamera Utama (MP)</label>
                                    <input type="number" name="kamera" class="form-control" id="kamera"
                                        value="{{ old('kamera', $alternatifs->kamera) }}" required>
                                </div>

                                <div class="mb-3">
                                    <label for="baterai" class="form-label">Kapasitas Baterai (mAh)</label>
                                    <input type="number" name="baterai" class="form-control" id="baterai"
                                        value="{{ old('baterai', $alternatifs->baterai) }}" required>
                                </div>

                                <div class="mb-3">
                                    <label for="stok" class="form-label">Stok Tersedia</label>
                                    <input type="number" name="stok" class="form-control" id="stok"
                                        value="{{ old('stok', $alternatifs->stok) }}" required>
                                </div>
                            </div>
                        </div>

                        <!-- Tombol -->
                        <div class="text-end mt-3">
                            <a href="{{ route('alternatif.index') }}" class="btn btn-outline-secondary">Batal</a>
                            <button type="submit" class="btn btn-primary">Simpan Perubahan</button>
                        </div>
                    </form>

                </div>
            </div>

        </div>


    </div>

    <script>
        function formatRupiah(el) {
            let value = el.value.replace(/[^,\d]/g, '').toString();
            let split = value.split(',');
            let sisa = split[0].length % 3;
            let rupiah = split[0].substr(0, sisa);
            let ribuan = split[0].substr(sisa).match(/\d{3}/gi);

            if (ribuan) {
                let separator = sisa ? '.' : '';
                rupiah += separator + ribuan.join('.');
            }

            rupiah = split[1] !== undefined ? rupiah + ',' + split[1] : rupiah;
            el.value = 'Rp. ' + rupiah;
        }
    </script>
    @include('sweetalert::alert')
@endsection
