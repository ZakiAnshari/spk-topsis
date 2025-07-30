@extends('layouts.admin')
@section('title', 'Alternatif')
@section('content')
    <div class="content-wrapper">
        <div class="container-xxl flex-grow-1 container-p-y">
            <div class="row">
                <div class="col-lg-12 mb-3">
                    <div class="card">
                        <div class="card-body">
                            <h5 class="pb-2 border-bottom">Table Normalisasi Bobot Kriteria</h5>
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

                                <!-- Table Data -->
                                <table class="table table-hover table-bordered align-middle text-nowrap mb-0">
                                    <thead class="table-primary table-light">
                                        <tr>
                                            <th style="width: 5px">No</th>
                                            <th style="width: 5px">Kode</th>
                                            <th>Kriteria</th>
                                            <th>Nilai Kepentingan</th>
                                            <th>Bobot</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @forelse ($kriterias as $item)
                                            <tr>
                                                <td>{{ $loop->iteration }}</td>
                                                <td>{{ $item->kode }}</td>
                                                <td>{{ $item->nama }}</td>
                                                <td>{{ $item->kepentingan }}</td>
                                                <td>{{ number_format($item->bobot_normalisasi, 4) }}</td>

                                            </tr>
                                        @empty
                                            <tr>
                                                <td colspan="5" class="text-center">Data Kosong</td>
                                            </tr>
                                        @endforelse
                                    </tbody>
                                </table>

                            </div>
                        </div>
                    </div>
                </div>


                <div class="col-lg-12 mb-3">
                    <div class="card">
                        <div class="card-body">
                            <h5 class="pb-2 border-bottom">Table Penilaian</h5>
                            <div class="table-responsive text-nowrap">

                                <!-- Table Data -->
                                <table class="table table-hover table-bordered align-middle text-nowrap mb-0">
                                    <thead class="table-primary table-light">
                                        <tr>
                                            <th style="width: 5px">No</th>
                                            <th>Nama Smartphone</th>

                                            @foreach ($kriterias as $kriteria)
                                                <th>({{ $kriteria->kode }})</th>
                                            @endforeach

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

                <div class="col-lg-12 mb-3">
                    <div class="card">
                        <div class="card-body">
                            <h5 class="pb-2 border-bottom">Matriks Ternormalisasi</h5>

                            @if ($errors->any())
                                <div class="alert alert-danger">
                                    <ul class="mb-0">
                                        @foreach ($errors->all() as $error)
                                            <li>{{ $error }}</li>
                                        @endforeach
                                    </ul>
                                </div>
                            @endif

                            <div class="table-responsive text-nowrap">
                                <table class="table table-hover table-bordered align-middle text-nowrap mb-0">
                                    <thead class="table-primary table-light">
                                        <tr>
                                            <th style="width: 5px">No</th>
                                            <th>Nama Smartphone</th>

                                            @foreach ($kriterias as $kriteria)
                                                <th>({{ $kriteria->kode }})</th>
                                            @endforeach
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @php $no = 1; @endphp
                                        @foreach ($alternatifs as $item)
                                            @php
                                                // Ambil penilaian untuk alternatif ini
                                                $penilaianAlternatif = $penilaians->where('alternatif_id', $item->id);

                                                // Cek kelengkapan penilaian
                                                $lengkap =
                                                    $penilaianAlternatif
                                                        ->pluck('subkriteria.kriteria_id')
                                                        ->unique()
                                                        ->count() === $kriterias->count();
                                            @endphp

                                            @if ($lengkap && isset($normalisasi[$item->id]))
                                                <tr>
                                                    <td>{{ $no++ }}</td>
                                                    <td>{{ $item->nama_smartphone }}</td>

                                                    @foreach ($kriterias as $kriteria)
                                                        <td>
                                                            {{ number_format($normalisasi[$item->id][$kriteria->id] ?? 0, 4) }}
                                                        </td>
                                                    @endforeach
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


                <div class="col-lg-12 mb-3">
                    <div class="card">
                        <div class="card-body">
                            <h5 class="pb-2 border-bottom">Solusi Ideal Positif dan Negatif</h5>

                            <div class="table-responsive text-nowrap">
                                <table class="table table-hover table-bordered align-middle text-nowrap mb-0">
                                    <thead class="table-primary text-center">
                                        <tr>
                                            <th style="width: 150px">Jenis Solusi</th>
                                            @foreach ($kriterias as $kriteria)
                                                <th>{{ $kriteria->kode }}</th>
                                            @endforeach
                                        </tr>
                                    </thead>
                                    <tbody class="text-center">
                                        @php
                                            // Cek apakah ada data nyata di database
                                            $adaData =
                                                isset($solusiPositif, $solusiNegatif) &&
                                                $kriterias->count() > 0 &&
                                                !empty(array_filter($solusiPositif)) &&
                                                !empty(array_filter($solusiNegatif));
                                        @endphp

                                        @if ($adaData)
                                            <tr>
                                                <td><strong>Positif (+)</strong></td>
                                                @foreach ($kriterias as $kriteria)
                                                    <td>
                                                        {{ isset($solusiPositif[$kriteria->id]) ? number_format($solusiPositif[$kriteria->id], 4) : '' }}
                                                    </td>
                                                @endforeach
                                            </tr>
                                            <tr>
                                                <td><strong>Negatif (−)</strong></td>
                                                @foreach ($kriterias as $kriteria)
                                                    <td>
                                                        {{ isset($solusiNegatif[$kriteria->id]) ? number_format($solusiNegatif[$kriteria->id], 4) : '' }}
                                                    </td>
                                                @endforeach
                                            </tr>
                                        @else
                                            <tr>
                                                <td colspan="{{ 1 + $kriterias->count() }}" class="text-center">Data Kosong
                                                </td>
                                            </tr>
                                        @endif
                                    </tbody>
                                </table>
                            </div>

                        </div>
                    </div>
                </div>


                <div class="col-lg-12 mb-3">
                    <div class="card">
                        <div class="card-body">
                            <h5 class="pb-2 border-bottom">Jarak ke Solusi Ideal Positif (Si⁺)</h5>

                            <div class="table-responsive text-nowrap">
                                <table class="table table-hover table-bordered align-middle text-nowrap mb-0">
                                    <thead class="table-primary text-center">
                                        <tr>
                                            <th style="width: 120px;">Kode Produk</th>
                                            <th>Nama Smartphone</th>
                                            <th>Si⁺</th>
                                        </tr>
                                    </thead>
                                    <tbody class="text-center">
                                        @php
                                            // Ambil semua penilaian dari database
                                            $totalPenilaian = \App\Models\Penilaian::count();

                                            // Filter alternatif yang benar-benar punya nilai Si+
                                            $dataSiPlus = collect($alternatifs)->filter(function ($alt) use (
                                                $jarakPositif,
                                            ) {
                                                return isset($jarakPositif[$alt->id]) &&
                                                    $jarakPositif[$alt->id] !== null;
                                            });
                                        @endphp

                                        @if ($totalPenilaian > 0 && $dataSiPlus->isNotEmpty())
                                            @foreach ($dataSiPlus as $alternatif)
                                                <tr>
                                                    <td>{{ $alternatif->kode_produk }}</td>
                                                    <td>{{ $alternatif->nama_smartphone }}</td>
                                                    <td>{{ number_format($jarakPositif[$alternatif->id], 4) }}</td>
                                                </tr>
                                            @endforeach
                                        @else
                                            <tr>
                                                <td colspan="3" class="text-center">Data Kosong</td>
                                            </tr>
                                        @endif
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>



                {{-- //NILAI PREFERENSI --}}
                <div class="col-lg-12 mb-3">
                    <div class="card">
                        <div class="card-body">
                            <h5 class="pb-2 border-bottom">
                                Hasil Akhir : Si⁺, Si⁻, Nilai Preferensi (V<sub>i</sub>), dan Ranking
                            </h5>

                            <div class="table-responsive text-nowrap">
                                <div class="d-flex justify-content-end align-items-center mb-3">
                                    <a href="{{ route('laporan.cetak') }}"
                                        class="btn btn-warning d-flex align-items-center" role="button" target="_blank">
                                        <i class="bx bx-printer me-1"></i> Cetak
                                    </a>
                                </div>

                                @php
                                    // Cek apakah ada data penilaian di database
                                    $totalPenilaian = \App\Models\Penilaian::count();
                                    // Filter preferensi yang valid (tidak kosong/null)
                                    $dataPreferensi = collect($preferensi ?? [])->filter(fn($val) => !is_null($val));
                                @endphp

                                <table class="table table-bordered">
                                    <thead class="table-primary text-center">
                                        <tr>
                                            <th>Ranking</th>
                                            <th>Kode</th>
                                            <th>Nama Alternatif</th>
                                            <th>Si⁺</th>
                                            <th>Si⁻</th>
                                            <th>Nilai Preferensi (V<sub>i</sub>)</th>
                                        </tr>
                                    </thead>
                                    <tbody class="text-center">
                                        @if ($totalPenilaian > 0 && $dataPreferensi->isNotEmpty())
                                            @php $ranking = 1; @endphp
                                            @foreach ($dataPreferensi as $id => $nilaiPreferensi)
                                                @php
                                                    $alternatif = $alternatifs->firstWhere('id', $id);
                                                @endphp
                                                <tr>
                                                    <td>{{ $ranking++ }}</td>
                                                    <td>{{ $alternatif->kode_produk }}</td>
                                                    <td>{{ $alternatif->nama_smartphone }}</td>
                                                    <td>{{ number_format($jarakPositif[$id] ?? 0, 4) }}</td>
                                                    <td>{{ number_format($jarakNegatif[$id] ?? 0, 4) }}</td>
                                                    <td><strong>{{ number_format($nilaiPreferensi, 4) }}</strong></td>
                                                </tr>
                                            @endforeach
                                        @else
                                            <tr>
                                                <td colspan="6" class="text-center">Data Kosong</td>
                                            </tr>
                                        @endif
                                    </tbody>
                                </table>

                                {{-- Kesimpulan --}}
                              
                            </div>
                        </div>
                    </div>
                </div>




            </div>
        </div>
    </div>
    @include('sweetalert::alert')
@endsection
