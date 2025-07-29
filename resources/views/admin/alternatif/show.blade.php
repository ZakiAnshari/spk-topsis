@extends('layouts.admin')
@section('title', 'Detail Smartphone')
@section('content')
    <div class="container-xxl flex-grow-1 container-p-y">
        <div class="card">
            <div class="d-flex align-items-center justify-content-between border-bottom pb-2 mb-3">
                <a class="mx-4 my-4" href="{{ route('alternatif.index') }}">
                    <button class="btn btn-outline-primary border-1 rounded-1 px-3 py-1 d-flex align-items-center"
                        data-bs-toggle="tooltip" title="Kembali">
                        <i class="bi bi-arrow-left fs-5 mx-1"></i>
                        <span class="fw-normal">Kembali</span>
                    </button>
                </a>
            </div>

            <div class="card-body">
                <div class="text-nowrap">
                    <div class="row">
                        <!-- Gambar dan Nama Smartphone -->
                        <div class="col-lg-12 mb-4">
                            <div class="h-100">
                                <div class="position-relative">
                                    <div class="text-center mt-3">
                                        <div class="chat-avatar d-inline-flex mx-auto mb-3">
                                            <img src="https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcS_BBU3PCu4Us4mT2QbmtvBK3O9zhPNvOPCjQ&s"
                                                alt="smartphone-image" class="user-avatar img-fluid"
                                                style="width: 150px; height: 150px; object-fit: cover; border-radius: 11px;">
                                        </div>
                                        <h5 class="mb-1">{{ $alternatifs->nama_smartphone }}</h5>
                                        <hr class="my-3">
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- Detail Smartphone -->
                        <div class="col-lg-12 mb-4">
                            <div class="card h-100">
                                <div class="card-header">
                                    <h5 class="mb-0">Detail Data Smartphone</h5>
                                </div>
                                <div class="card-body">
                                    <div class="row">
                                        <!-- Baris 1 -->
                                        <div class="col-md-6 border-bottom pb-3 mb-3">
                                            <label class="text-muted mb-1">Kode Produk</label>
                                            <div class="fw-semibold">{{ $alternatifs->kode_produk }}</div>
                                        </div>
                                        <div class="col-md-6 border-bottom pb-3 mb-3">
                                            <label class="text-muted mb-1">Harga</label>
                                            <div class="fw-semibold">Rp {{ number_format($alternatifs->harga, 0, ',', '.') }}
                                            </div>
                                        </div>

                                        <!-- Baris 2 -->
                                        <div class="col-md-6 border-bottom pb-3 mb-3">
                                            <label class="text-muted mb-1">RAM</label>
                                            <div class="fw-semibold">{{ $alternatifs->ram }} GB</div>
                                        </div>
                                        <div class="col-md-6 border-bottom pb-3 mb-3">
                                            <label class="text-muted mb-1">Internal Storage</label>
                                            <div class="fw-semibold">{{ $alternatifs->internal_storage }} GB</div>
                                        </div>

                                        <!-- Baris 3 -->
                                        <div class="col-md-6 border-bottom pb-3 mb-3">
                                            <label class="text-muted mb-1">Kamera</label>
                                            <div class="fw-semibold">{{ $alternatifs->kamera }} MP</div>
                                        </div>
                                        <div class="col-md-6 border-bottom pb-3 mb-3">
                                            <label class="text-muted mb-1">Baterai</label>
                                            <div class="fw-semibold">{{ $alternatifs->baterai }} mAh</div>
                                        </div>

                                        <!-- Baris 4 -->
                                        <div class="col-md-6 border-bottom pb-3 mb-3">
                                            <label class="text-muted mb-1">Stok</label>
                                            <div class="fw-semibold">{{ $alternatifs->stok }} unit</div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    @include('sweetalert::alert')
@endsection
