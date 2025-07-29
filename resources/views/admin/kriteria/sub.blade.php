@extends('layouts.admin')
@section('title', 'Alternatif')
@section('content')
    <div class="content-wrapper">
        <div class="container-xxl flex-grow-1 container-p-y">


            <div class="row">
                <div class="d-flex align-items-center mb-3">
                    <!-- Tombol Kembali -->
                    <a href="/kriteria" class="me-3">
                        <button class="btn btn-outline-primary px-3 py-2 d-flex align-items-center" title="Kembali">
                            <i class="bi bi-arrow-left fs-6 me-1"></i>

                        </button>
                    </a>

                    <!-- Judul -->
                    <h4 class="fw-bold mb-0 d-flex align-items-center">
                        <span>Data SubKriteria [{{ $kriteria->kriteria_code }}]</span>
                    </h4>
                </div>



                <div class="col-lg-4">
                    <div class="card">
                        <form action="{{ route('subkriteria.store') }}" method="POST" enctype="multipart/form-data">
                            @csrf
                            {{-- Hidden input untuk relasi kriteria_id --}}
                            <input type="hidden" name="kriteria_id" value="{{ $kriteria->id }}">
                            <div class="card-body">
                                <h5 class="pb-2 border-bottom">Tambah SubKriteria</h5>

                                <!-- Nama Subkriteria -->
                                <div class="form-group mb-3">
                                    <label for="nama" class="form-label">Nama Subkriteria</label>
                                    <input type="text" id="nama" name="nama" class="form-control"
                                        placeholder="Masukkan nama subkriteria" required>
                                </div>

                                <!-- Berat Kepentingan -->
                                <div class="form-group mb-3">
                                    <label for="berat_kepentingan" class="form-label">Bobot / Skor</label>
                                    <input type="number" id="berat_kepentingan" name="berat_kepentingan"
                                        class="form-control" placeholder="Masukkan skor atau bobot" required min="1">
                                </div>

                                <!-- Tombol -->
                                <div class="text-end">
                                    <button type="submit" class="btn btn-primary">Simpan</button>
                                </div>
                            </div>

                        </form>

                    </div>
                </div>
                <div class="col-lg-8">
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
                                        c
                                @endif

                                <h5 class="pb-2 border-bottom">Table SubKriteria</h5>

                                <div class="d-flex justify-content-between align-items-center">
                                    <!-- Form Search -->
                                    <form method="GET" class="d-flex align-items-center my-3" style="max-width: 350px;">
                                        <div class="input-group shadow-sm" style="height: 38px; width: 100%;">
                                            <input type="text" name="nama_lengkap" value="{{ request('nama_lengkap') }}"
                                                class="form-control border-end-0 py-2 px-3" style="font-size: 0.9rem;"
                                                placeholder="Cari Nama..." aria-label="Search">
                                            <button class="btn btn-outline-primary px-3" type="submit"
                                                style="font-size: 0.9rem;">
                                                <i class="bx bx-search"></i>
                                            </button>
                                        </div>
                                    </form>
                                    <!-- Judul -->

                                </div>

                                <!-- Table Data -->
                                <table class="table table-bordered">
                                    <thead>
                                        <tr>
                                            <th style="width:15px;">No</th>
                                            <th>Nama</th>
                                            <th>Berat</th>
                                            <th style="width: 80px; text-align: center;">Aksi</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @forelse ($subkriterias as $index => $item)
                                            <tr>
                                                <td>{{ $loop->iteration }}</td>
                                                <td>{{ $item->nama }}</td>
                                                <td>{{ $item->berat_kepentingan }}</td>
                                                <td class="text-center">
                                                    <a href="javascript:void(0)"
                                                        onclick="confirmDeleteSubKriteria({{ $item->id }}, @js($item->nama))"
                                                        style="display:inline;">
                                                        <button class="btn btn-icon btn-outline-danger" title="Hapus">
                                                            <i class="bx bx-trash"></i>
                                                        </button>
                                                    </a>
                                                </td>
                                            </tr>
                                        @empty
                                            <tr>
                                                <td colspan="4" class="text-center">Data Kosong</td>
                                            </tr>
                                        @endforelse
                                    </tbody>
                                </table>

                            </div>
                        </div>
                    </div>
                </div>

            </div>
        </div>


    </div>

    <script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script>
        function confirmDeleteSubKriteria(id, nama) {
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
                    window.location.href = `/subkriteria-destroy/${id}`;
                }
            });
        }
    </script>

    @include('sweetalert::alert')
@endsection
