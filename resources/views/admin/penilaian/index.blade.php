@extends('layouts.admin')
@section('title', 'Alternatif')
@section('content')
    <div class="content-wrapper">
        <div class="container-xxl flex-grow-1 container-p-y">
            <div class="row">
                <div class="col-lg-12 mb-3">
                    <div class="card">

                        <div class="card-body">
                            <h5 class="pb-2 border-bottom">Form Penilaian</h5>
                            <form action="{{ route('penilaian.store') }}" method="POST" enctype="multipart/form-data">
                                @csrf
                                <div class="row justify-content-center">
                                    <!-- Kolom: Pilih Masyarakat -->
                                    <div class="col-lg-6 mb-3">
                                        <div class="form-group mb-3">
                                            <label class="form-label">Nama Smartphone</label>
                                            <select name="alternatif_id" class="form-select" required>
                                                <option value="">-- Pilih --</option>
                                                @foreach ($alternatifs as $item)
                                                    <option value="{{ $item->id }}">{{ $item->nama_smartphone }}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                        <hr class="mb-3">

                                        <!-- Loop Kriteria dan Subkriteria -->
                                        @foreach ($kriterias as $kriteria)
                                            <div class="mb-3">
                                                <label class="form-label">
                                                    ({{ $kriteria->kode }}) {{ $kriteria->nama }}
                                                </label>
                                                <select name="subkriteria_id[{{ $kriteria->id }}]" class="form-select"
                                                    required>
                                                    <option value="">-- Pilih --</option>
                                                    @foreach ($kriteria->subkriterias as $sub)
                                                        <option value="{{ $sub->id }}">
                                                            [{{ $sub->berat_kepentingan }}]
                                                            {{ $sub->nama }}
                                                        </option>
                                                    @endforeach
                                                </select>
                                            </div>
                                        @endforeach
                                    </div>
                                </div>
                                <!-- Tombol Submit -->
                                <div class="text-end mt-3">
                                    <button type="submit" class="btn btn-primary">Simpan</button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>

                <div class="col-lg-12">
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
                                <h5 class="pb-2 border-bottom">Table Penilaian</h5>
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
                                </div>
                                <!-- Table Data -->
                                <table class="table table-hover table-bordered align-middle text-nowrap mb-0">
                                    <thead class="table-light">
                                        <tr>
                                            <th style="width: 5px">No</th>
                                            <th>Nama Smartphone</th>

                                            @foreach ($kriterias as $kriteria)
                                                <th>({{ $kriteria->kode }}) {{ $kriteria->nama }}</th>
                                            @endforeach

                                            <th class="text-center" style="width: 50px;">Aksi</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @php $no = 1; @endphp
                                        @foreach ($alternatifs as $item)
                                            @php
                                                // Ambil penilaian untuk masyarakat ini
                                                $penilaianAlternatif = $penilaians->where('alternatif_id', $item->id);

                                                // Cek apakah lengkap (jumlah kriteria = jumlah penilaian unik)
                                                $lengkap =
                                                    $penilaianAlternatif
                                                        ->pluck('subkriteria.kriteria_id')
                                                        ->unique()
                                                        ->count() === $kriterias->count();
                                            @endphp

                                            @if ($lengkap)
                                                <tr>
                                                    <td>{{ $no++ }}</td>
                                                    <td>{{ $item->nama_smartphone }}</td>

                                                    @foreach ($kriterias as $kriteria)
                                                        @php
                                                            $nilai = $penilaianAlternatif
                                                                ->where('subkriteria.kriteria_id', $kriteria->id)
                                                                ->first();
                                                        @endphp
                                                        <td>
                                                            {{ $nilai?->subkriteria?->berat_kepentingan ?? '-' }}
                                                        </td>
                                                    @endforeach

                                                    <td class="text-center">

                                                        <a href="javascript:void(0)"
                                                            onclick="confirmDeletePenilaian({{ $item->id }}, @js($item->nama))"
                                                            style="display:inline;">
                                                            <button class="btn btn-icon btn-outline-danger">
                                                                <i class="bx bx-trash"></i>
                                                            </button>
                                                        </a>

                                                    </td>
                                                </tr>
                                            @endif
                                        @endforeach

                                        @if ($no === 1)
                                            <tr>
                                                <td colspan="{{ 2 + count($kriterias) }}" class="text-center">Data Kosong
                                                </td>
                                            </tr>
                                        @endif
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
        function confirmDeletePenilaian(id, nama) {
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
                    window.location.href = `/penilaian-destroy/${id}`;
                }
            });
        }
    </script>


    @include('sweetalert::alert')
@endsection
