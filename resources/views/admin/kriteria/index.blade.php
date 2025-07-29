@extends('layouts.admin')
@section('title', 'Alternatif')
@section('content')
    <div class="content-wrapper">
        <div class="container-xxl flex-grow-1 container-p-y">
            <div class="row">

                <div class="col-lg-12">
                    <div class="card">
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
                                <h5 class="pb-2 border-bottom">Table Kriteria</h5>

                                <div class="d-flex justify-content-between align-items-center">
                                    <!-- Form Search -->
                                    <form method="GET" class="d-flex align-items-center my-3" style="max-width: 350px;">
                                        <div class="input-group shadow-sm" style="height: 38px; width: 100%;">
                                            <input type="text" name="nama" value="{{ request('nama') }}"
                                                class="form-control border-end-0 py-2 px-3" style="font-size: 0.9rem;"
                                                placeholder="Cari Nama..." aria-label="Search">
                                            <button class="btn btn-outline-primary px-3" type="submit"
                                                style="font-size: 0.9rem;">
                                                <i class="bx bx-search"></i>
                                            </button>
                                        </div>
                                    </form>
                                    <!-- Judul -->
                                    <!-- Tombol Aksi -->
                                    @if (Auth::user()->role_id == 1)
                                        <div class="d-flex gap-2">
                                            <!-- Tombol Tambah -->
                                            <button type="button"
                                                class="btn btn-outline-success account-image-reset d-flex align-items-center"
                                                data-bs-toggle="modal" data-bs-target="#addProductModal">
                                                <i class="bx bx-plus me-2 d-block"></i>
                                                <span>Tambah</span>
                                            </button>
                                        </div>
                                    @endif
                                </div>
                                <!-- Modal tambah Data -->
                                <div class="modal fade" id="addProductModal" tabindex="-1"
                                    aria-labelledby="addProductModalLabel" aria-hidden="true">
                                    <div class="modal-dialog modal-dialog-centered modal-lg">
                                        <div class="modal-content">
                                            <!-- Judul -->
                                            <div class="modal-header">
                                                <h5 class="modal-title" id="addProductModalLabel">Tambah Kriteria</h5>
                                                <button type="button" class="btn-close" data-bs-dismiss="modal"
                                                    aria-label="Close"></button>
                                            </div>
                                            <form action="{{ route('kriteria.store') }}" method="POST"
                                                enctype="multipart/form-data">
                                                @csrf
                                                <div class="modal-body">
                                                    <div class="row">
                                                        <!-- Kolom Kiri -->
                                                        <div class="col-lg-6">
                                                            <!-- Kode -->
                                                            <div class="form-group mb-3">
                                                                <label for="kode" class="form-label">Kode
                                                                    Kriteria</label>
                                                                <input type="text" id="kode" name="kode"
                                                                    class="form-control"
                                                                    placeholder="Masukkan Kode Kriteria" required>
                                                            </div>

                                                            <!-- Nama -->
                                                            <div class="form-group mb-3">
                                                                <label for="nama" class="form-label">Nama
                                                                    Kriteria</label>
                                                                <input type="text" id="nama" name="nama"
                                                                    class="form-control"
                                                                    placeholder="Masukkan Nama Kriteria" required>
                                                            </div>
                                                        </div>

                                                        <!-- Kolom Kanan -->
                                                        <div class="col-lg-6">
                                                            <!-- Jenis -->
                                                            <div class="form-group mb-3">
                                                                <label for="jenis" class="form-label">Jenis
                                                                    Kriteria</label>
                                                                <select id="jenis" name="jenis" class="form-select"
                                                                    required>
                                                                    <option value="">Pilih Jenis</option>
                                                                    <option value="Benefit">Benefit</option>
                                                                    <option value="Cost">Cost</option>
                                                                </select>
                                                            </div>

                                                            <!-- Kepentingan -->
                                                            <div class="form-group mb-3">
                                                                <label for="kepentingan" class="form-label">Tingkat
                                                                    Kepentingan</label>
                                                                <select id="kepentingan" name="kepentingan"
                                                                    class="form-select" required>
                                                                    <option value="">Pilih Tingkat Kepentingan
                                                                    </option>
                                                                    <option value="1">(1) Tidak Penting</option>
                                                                    <option value="2">(2) Lumayan Penting</option>
                                                                    <option value="3">(3) Penting</option>
                                                                    <option value="4">(4) Sangat Penting</option>
                                                                    <option value="5">(5) Sangat Penting Sekali
                                                                    </option>
                                                                </select>
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
                                            <th>Kode</th>
                                            <th>Nama Kriteria</th>
                                            <th>Jenis Kriteria</th>
                                            <th style="text-align: center">Kepentingan</th>
                                            @if (Auth::user()->role_id == 1)
                                                <th style="width: 10%; text-align: center;">Aksi</th>
                                            @endif
                                        </tr>

                                    </thead>
                                    <tbody>
                                        @forelse ($kriterias as $index => $item)
                                            <tr>
                                                <td>{{ $kriterias->firstItem() + $index }}</td>
                                                <td>{{ $item->kode }}</td>
                                                <td>{{ $item->nama }}</td>
                                                <td>{{ $item->jenis }}</td>
                                                <td style="text-align: center">{{ $item->kepentingan }}</td>
                                                @if (Auth::user()->role_id == 1)
                                                    <td style="width: 10%;">
                                                        <div class="d-flex align-items-center gap-2">
                                                            <a href="{{ route('kriteria.sub', ['kriteria' => $item->id]) }}"
                                                                class="btn btn-icon btn-outline-info"
                                                                title="Lihat Sub-Kriteria">
                                                                <i class="bx bx-git-branch"></i>
                                                            </a>

                                                            <a href="{{ url('kriteria-edit/' . $item->id) }}"
                                                                class="btn btn-icon btn-outline-primary"
                                                                title="Edit Data">
                                                                <i class="bx bx-edit-alt"></i>
                                                            </a>

                                                            <button class="btn btn-icon btn-outline-danger"
                                                                onclick="confirmDeleteKriteria({{ $item->id }}, @js($item->nama))"
                                                                title="Hapus Data">
                                                                <i class="bx bx-trash"></i>
                                                            </button>
                                                        </div>
                                                    </td>
                                                @endif


                                            </tr>
                                        @empty
                                            <tr>
                                                <td colspan="6" class="text-center">Data Kosong</td>
                                            </tr>
                                        @endforelse
                                    </tbody>

                                </table>

                                <!-- Pagination -->
                                <div class="d-flex justify-content-end mt-3">
                                    {{ $kriterias->appends(request()->input())->links('pagination::bootstrap-4') }}
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
        function confirmDeleteKriteria(id, nama) {
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
                    window.location.href = `/kriteria-destroy/${id}`;
                }
            });
        }
    </script>



    <script>
        const today = new Date().toISOString().split('T')[0];

        document.getElementById('tanggal').setAttribute('min', today);
        document.getElementById('jatuh_tempo').setAttribute('min', today);
    </script>
    @include('sweetalert::alert')
@endsection
