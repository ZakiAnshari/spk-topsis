<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <title>Laporan Hasil Perhitungan TOPSIS</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        body {
            font-size: 13px;
            color: #000;
        }

        .header-logo {
            width: 80px;
            height: auto;
        }

        .kop-text {
            line-height: 1.3;
        }

        .kop-border {
            border-top: 3px solid #000;
            margin-top: 10px;
            margin-bottom: 20px;
        }

        .table th,
        .table td {
            border: 1px solid #000 !important;
            padding: 6px !important;
        }

        .signature-block {
            margin-top: 60px;
        }

        @media print {
            .no-print {
                display: none;
            }

            .table th,
            .table td {
                font-size: 12px !important;
                border: 1px solid #000 !important;
            }

            .header-logo {
                width: 70px;
            }
        }
    </style>
</head>

<body class="bg-white">

    <div class="container py-3">
        <!-- Kop Surat -->
        <div class="row align-items-center">
            <div class="col-2 text-start">
                <img src="{{ asset('/backend/assets/img/avatars/logo.png') }}" class="header-logo"
                    alt="Logo Dinas Sosial">
            </div>
            <div class="col-8 text-center kop-text">
                <h5 class="mb-0 fw-bold text-uppercase">Toko Fantasi Smartphone</h5>
                <h6 class="mb-0 text-uppercase">Sistem Pendukung Keputusan Prioritas Persediaan Smartphone</h6>
                <p class="mb-0">
        
                    Kota Padang , Sumatera Barat
                </p>
            </div>


        </div>

        <!-- Garis Pembatas -->
        <div class="kop-border"></div>

        <!-- Judul Laporan -->


        <!-- Tabel Hasil TOPSIS -->
        <div class="table-responsive text-nowrap">
            <table class="table table-bordered align-middle text-center">
                <thead class="table-light">
                    <tr>
                        <th>Ranking</th>
                        <th>Kode</th>
                        <th>Nama Alternatif</th>
                        <th>Si⁺</th>
                        <th>Si⁻</th>
                        <th>Nilai Preferensi (V<sub>i</sub>)</th>
                    </tr>
                </thead>
                <tbody>
                    @php $rank = 1; @endphp
                    @forelse ($preferensi as $id => $nilai)
                        @php $alternatif = $alternatifs->firstWhere('id', $id); @endphp
                        <tr>
                            <td>{{ $rank++ }}</td>
                            <td>{{ $alternatif->kode_produk }}</td>
                            <td>{{ $alternatif->nama_smartphone }}</td>
                            <td>{{ number_format($jarakPositif[$id] ?? 0, 4) }}</td>
                            <td>{{ number_format($jarakNegatif[$id] ?? 0, 4) }}</td>
                            <td><strong>{{ number_format($nilai, 4) }}</strong></td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="6" class="text-center">Data Kosong</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>

        <!-- Tanda Tangan -->
        <div class="row signature-block">
            <div class="col-6"></div>
            <div class="col-6 text-end">
                <p class="mb-1">{{ \Carbon\Carbon::now()->translatedFormat('l, d F Y') }}</p>
                <p class="mb-5">Pimpinan</p>
                <p class="fw-bold text-uppercase mb-1"></p>
                <p class="mb-0">NIP: 19720304 199601 1 003</p>
            </div>
        </div>

    </div>

    <!-- Script Print -->
    <script type="text/javascript">
        window.print();
    </script>

</body>

</html>
