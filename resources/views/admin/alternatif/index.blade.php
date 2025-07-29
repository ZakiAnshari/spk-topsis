@extends('layouts.admin')
@section('title', 'Alternatif')
@section('content')
    <div class="content-wrapper">
        <div class="container-xxl flex-grow-1 container-p-y">
            <div class="row">

                <div class="col">
                    <div class="card">
                        <div class="card-body">
                            <div class="table-responsive text-nowrap">
                                @if ($errors->any())
                                    <div class="alert alert-danger">
                                        <ul class="mb-0">
                                            @foreach ($errors->all() as $error)
                                                <li>{{ $error }}</li>
                                            @endforeach
                                        </ul>
                                    </div>
                                @endif
                                <h5 class="pb-2 border-bottom">Table Alternatif</h5>
                                <div class="d-flex justify-content-between align-items-center">
                                    <!-- Form Search -->
                                    <form method="GET" class="d-flex align-items-center my-3" style="max-width: 350px;">
                                        <div class="input-group shadow-sm" style="height: 38px; width: 100%;">
                                            <input type="text" name="search" value="{{ request('search') }}"
                                                class="form-control border-end-0 py-2 px-3" style="font-size: 0.9rem;"
                                                placeholder="Cari Nama" aria-label="Search">
                                            <button class="btn btn-outline-primary px-3" type="submit"
                                                style="font-size: 0.9rem;">
                                                <i class="bx bx-search"></i>
                                            </button>
                                        </div>
                                    </form>

                                    <!-- Judul -->
                                    <!-- Tombol Aksi -->
                                    @auth
                                        @if (auth()->user()->role_id != 3)
                                            <div class="d-flex gap-2">
                                                <button type="button"
                                                    class="btn btn-outline-success account-image-reset d-flex align-items-center"
                                                    data-bs-toggle="modal" data-bs-target="#addProductModal">
                                                    <i class="bx bx-plus me-2 d-block"></i>
                                                    <span>Tambah</span>
                                                </button>
                                            </div>
                                        @endif
                                    @endauth

                                </div>

                                <!-- Modal tambah Data -->
                                <div class="modal fade" id="addProductModal" tabindex="-1"
                                    aria-labelledby="addProductModalLabel" aria-hidden="true">
                                    <div class="modal-dialog modal-dialog-centered modal-lg">
                                        <div class="modal-content">
                                            <!-- Judul -->
                                            <div class="modal-header border-bottom pb-2">
                                                <h5 class="modal-title" id="addProductModalLabel">Tambah Data Smartphone
                                                </h5>
                                                <button type="button" class="btn-close" data-bs-dismiss="modal"
                                                    aria-label="Close"></button>
                                            </div>

                                            <form action="{{ route('alternatif.store') }}" method="POST"
                                                enctype="multipart/form-data">
                                                @csrf
                                                <div class="modal-body">
                                                    <div class="row">
                                                        <!-- Kolom Kiri -->
                                                        <div class="col-lg-6">
                                                            <div class="mb-3">
                                                                <label for="nama_smartphone" class="form-label">Nama
                                                                    Smartphone</label>
                                                                <input type="text" name="nama_smartphone"
                                                                    class="form-control" id="nama_smartphone" required>
                                                            </div>

                                                            <div class="mb-3">
                                                                <label for="kode_produk" class="form-label">Kode
                                                                    Produk</label>
                                                                <input type="text" name="kode_produk"
                                                                    class="form-control" id="kode_produk" required>
                                                            </div>

                                                            <div class="mb-3">
                                                                <label for="harga" class="form-label">Harga (Rp)</label>
                                                                <input type="text" name="harga" class="form-control"
                                                                    id="harga"
                                                                    oninput="formatRupiah(this)"placeholder="Rp." required>
                                                            </div>



                                                            <div class="mb-3">
                                                                <label for="ram" class="form-label">RAM (GB)</label>
                                                                <input type="number" name="ram" class="form-control"
                                                                    id="ram" required>
                                                            </div>
                                                        </div>

                                                        <!-- Kolom Kanan -->
                                                        <div class="col-lg-6">
                                                            <div class="mb-3">
                                                                <label for="internal_storage" class="form-label">Internal
                                                                    Storage (ROM/GB)</label>
                                                                <input type="number" name="internal_storage"
                                                                    class="form-control" id="internal_storage" required>
                                                            </div>

                                                            <div class="mb-3">
                                                                <label for="kamera" class="form-label">Kamera Utama
                                                                    (MP)</label>
                                                                <input type="number" name="kamera" class="form-control"
                                                                    id="kamera" required>
                                                            </div>

                                                            <div class="mb-3">
                                                                <label for="baterai" class="form-label">Kapasitas Baterai
                                                                    (mAh)</label>
                                                                <input type="number" name="baterai" class="form-control"
                                                                    id="baterai" required>
                                                            </div>

                                                            <div class="mb-3">
                                                                <label for="stok" class="form-label">Stok
                                                                    Tersedia</label>
                                                                <input type="number" name="stok" class="form-control"
                                                                    id="stok" required>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>

                                                <!-- Tombol -->
                                                <div class="modal-footer">
                                                    <button type="button" class="btn btn-secondary"
                                                        data-bs-dismiss="modal">Batal</button>
                                                    <button type="submit" class="btn btn-primary">Simpan</button>
                                                </div>
                                            </form>
                                        </div>
                                    </div>
                                </div>


                                <!-- Table Data -->
                                <table class="table table-bordered">
                                    <thead>
                                        <tr>
                                            <th style="width: 5%">No</th>
                                            <th>Nama Smartphone</th>
                                            <th>Kode Produk</th>
                                            <th>Harga (Rp)</th>
                                            {{-- <th>RAM (GB)</th>
                                            <th>Internal Storage (GB)</th>
                                            <th>Kamera (MP)</th>
                                            <th>Baterai (mAh)</th>
                                            <th>Stok</th> --}}
                                            <th class="text-center" style="width: 100px;">Aksi</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @forelse ($alternatifs as $index => $item)
                                            <tr>
                                                <td>{{ $alternatifs->firstItem() + $index }}</td>
                                                <td>{{ $item->nama_smartphone }}</td>
                                                <td>{{ $item->kode_produk }}</td>
                                                <td>Rp {{ number_format($item->harga, 0, ',', '.') }}</td>
                                                <td class="text-center">
                                                    <a href="{{ url('alternatif-show/' . $item->id) }}"
                                                        class="btn btn-icon btn-outline-info" title="Lihat Data">
                                                        <i class="bx bx-show"></i>
                                                    </a>
                                                    <a href="{{ url('alternatif-edit/' . $item->id) }}"
                                                        class="btn btn-icon btn-outline-primary" title="Edit Data">
                                                        <i class="bx bx-edit-alt"></i>
                                                    </a>
                                                    <a href="javascript:void(0)"
                                                        onclick="confirmDeleteAlternatif({{ $item->id }}, @js($item->nama_smartphone))"
                                                        style="display:inline;">
                                                        <button class="btn btn-icon btn-outline-danger">
                                                            <i class="bx bx-trash"></i>
                                                        </button>
                                                    </a>
                                                </td>
                                            </tr>
                                        @empty
                                            <tr>
                                                <td colspan="10" class="text-center">Data smartphone belum tersedia.
                                                </td>
                                            </tr>
                                        @endforelse
                                    </tbody>
                                </table>



                                <!-- Pagination -->
                                <div class="d-flex justify-content-end mt-3">
                                    {{ $alternatifs->appends(request()->input())->links('pagination::bootstrap-4') }}

                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>


    </div>

    <script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script>
        function confirmDeleteAlternatif(id, nama) {
            Swal.fire({
                title: 'Yakin ingin menghapus?',
                text: `"${nama}" akan dihapus secara permanen!`,
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#d33',
                cancelButtonColor: '#6c757d',
                confirmButtonText: 'Ya, hapus!',
                cancelButtonText: 'Batal'
            }).then((result) => {
                if (result.isConfirmed) {
                    window.location.href = `/alternatif-destroy/${id}`;
                }
            });
        }
    </script>

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

            rupiah = split[1] != undefined ? rupiah + ',' + split[1] : rupiah;
            el.value = 'Rp. ' + rupiah;
        }
    </script>

    <script>
        const today = new Date().toISOString().split('T')[0];

        document.getElementById('tanggal').setAttribute('min', today);
        document.getElementById('jatuh_tempo').setAttribute('min', today);
    </script>


    @include('sweetalert::alert')
@endsection
