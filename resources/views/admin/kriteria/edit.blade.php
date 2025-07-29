@extends('layouts.admin')
@section('title', 'Edit')
@section('content')
    <div class="container-xxl flex-grow-1 container-p-y">

        <div class="card">
            <div class="d-flex align-items-center justify-content-between border-bottom pb-2 mb-3">
                <a class="mx-4 my-4" href="/kriteria">
                    <button class="btn btn-outline-primary border-1 rounded-1 px-3 py-1 d-flex align-items-center"
                        data-bs-toggle="tooltip" title="Kembali">
                        <i class="bi bi-arrow-left fs-5 mx-1"></i>
                        <span class="fw-normal">Kembali</span>
                    </button>
                </a>
            </div>


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
                    <form action="{{ url('kriteria-edit/' . $kriterias->id) }}" method="POST"
                        enctype="multipart/form-data">
                        @csrf
                        @method('post') <!-- Gunakan PUT agar semantik update -->

                        <div class="row">
                            <!-- Kolom Kiri -->
                            <div class="col-lg-6">
                                <div class="form-group my-2">
                                    <label class="form-label">Kode</label>
                                    <input type="text" name="kode" class="form-control" value="{{ $kriterias->kode }}"
                                        required>
                                </div>
                                <div class="form-group">
                                    <label class="form-label">Nama Kriteria</label>
                                    <input type="text" name="nama" class="form-control" value="{{ $kriterias->nama }}"
                                        required>
                                </div>
                            </div>

                            <!-- Kolom Kanan -->
                            <div class="col-lg-6">
                                <div class="form-group my-2">
                                    <label class="form-label">Jenis Kriteria</label>
                                    <select class="form-select" name="jenis" required>
                                        <option value="Benefit" {{ $kriterias->jenis == 'Benefit' ? 'selected' : '' }}>
                                            Benefit</option>
                                        <option value="Cost" {{ $kriterias->jenis == 'Cost' ? 'selected' : '' }}>Cost
                                        </option>
                                    </select>
                                </div>
                                <div class="form-group">
                                    <label class="form-label">Tingkat Kepentingan</label>
                                    <select class="form-select" name="kepentingan" required>
                                        <option value="">Pilih</option>
                                        <option value="1" {{ $kriterias->kepentingan == 1 ? 'selected' : '' }}>(1)
                                            Tidak Penting</option>
                                        <option value="2" {{ $kriterias->kepentingan == 2 ? 'selected' : '' }}>(2)
                                            Lumayan Penting</option>
                                        <option value="3" {{ $kriterias->kepentingan == 3 ? 'selected' : '' }}>(3)
                                            Penting</option>
                                        <option value="4" {{ $kriterias->kepentingan == 4 ? 'selected' : '' }}>(4)
                                            Sangat Penting</option>
                                        <option value="5" {{ $kriterias->kepentingan == 5 ? 'selected' : '' }}>(5)
                                            Sangat Penting Sekali</option>
                                    </select>
                                </div>
                            </div>

                            <!-- Tombol -->
                            <div class="text-end mt-3">
                                <a href="{{ route('kriteria.index') }}" class="btn btn-outline-secondary">Batal</a>
                                <button type="submit" class="btn btn-primary">Simpan Perubahan</button>
                            </div>
                        </div>
                    </form>


                </div>
            </div>
        </div>


    </div>

    @include('sweetalert::alert')
@endsection
