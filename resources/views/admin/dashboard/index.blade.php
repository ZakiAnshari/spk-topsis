@extends('layouts.admin')
@section('title', 'Dashboard')
@section('content')
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">

    <div class="container-xxl flex-grow-1 container-p-y">
        <div class="row">
            <div class="col-lg-12 mb-4 order-0">
                <div class="card">
                    <div class="d-flex align-items-end row">
                        <div class="col-sm-7">
                            <div class="card-body">
                                <h5 class="card-title text-primary">Selamat Datang {{ $user->username }} 🎉</h5>
                                <p class="mb-4">
                                    Anda berperan penting dalam menentukan prioritas persediaan smartphone
                                    di Toko Fantasi Smartphone melalui sistem pendukung keputusan berbasis
                                    metode TOPSIS.
                                </p>

                            </div>
                        </div>
                        <div class="col-sm-5 text-center text-sm-left">
                            <div class="card-body pb-0 px-0 px-md-4">
                                <img src="{{ asset('backend/assets/img/illustrations/man-with-laptop-light.png') }}"
                                    height="140" alt="View Badge User"
                                    data-app-dark-img="illustrations/man-with-laptop-dark.png"
                                    data-app-light-img="illustrations/man-with-laptop-light.png" />
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            {{-- <div class="col-3 mb-4">
                <div class="card">
                    <div class="card-body">
                        <div class="d-flex flex-column align-items-center">
                            <h5 class="card-title text-center mb-3">Total Masyarakat</h5>
                            <div class="d-flex align-items-center gap-3">
                                <i class="fa fa-users" style="font-size: 3rem;"></i>
                                <span class="badge bg-label-warning rounded-pill"
                                    style="font-size: 1.5rem; padding: 0.5rem 1rem;">
                                    {{ $masyarakatCount }}
                                </span>
                            </div>
                        </div>
                    </div>

                </div>
            </div>
            <div class="col-3 mb-4">
                <div class="card">
                    <div class="card-body">
                        <div class="d-flex flex-column align-items-center">
                            <h5 class="card-title text-center mb-3">Total Kriteria</h5>
                            <div class="d-flex align-items-center gap-3">
                                <i class="fa fa-clipboard-list" style="font-size: 3rem;"></i>
                                <span class="badge bg-label-warning rounded-pill"
                                    style="font-size: 1.5rem; padding: 0.5rem 1rem;">
                                    {{ $kriteriaCount }}
                                </span>
                            </div>
                        </div>
                    </div>

                </div>
            </div>
            <div class="col-3 mb-4">
                <div class="card">
                    <div class="card-body">
                        <div class="d-flex flex-column align-items-center">
                            <h5 class="card-title text-center mb-3">Total Penilaian</h5>
                            <div class="d-flex align-items-center gap-3">
                                <i class="fa fa-clipboard-check" style="font-size: 3rem;"></i>
                                <span class="badge bg-label-warning rounded-pill"
                                    style="font-size: 1.5rem; padding: 0.5rem 1rem;">
                                    {{ $penilaianCount }}
                                </span>
                            </div>
                        </div>
                    </div>

                </div>
            </div>
            <div class="col-3 mb-4">
                <div class="card">
                    <div class="card-body">
                        <div class="d-flex flex-column align-items-center">
                            <h5 class="card-title text-center mb-3">Total Hak Akses</h5>
                            <div class="d-flex align-items-center gap-3">
                                <i class="fa fa-users" style="font-size: 3rem;"></i> <!-- Ikon pengguna -->
                                <span class="badge bg-label-warning rounded-pill"
                                    style="font-size: 1.5rem; padding: 0.5rem 1rem;">
                                    {{ $hakaksesCount }}
                                </span>
                            </div>
                        </div>
                    </div>
                </div>
            </div> --}}
        </div>

    </div>
    @include('sweetalert::alert')
@endsection
