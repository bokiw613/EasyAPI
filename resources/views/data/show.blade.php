@extends('layouts.app')

@section('content')
<style>
    /* Container for centering the content */
    .centered-container {
        max-width: 900px; /* Maksimal lebar kontainer */
        margin: 0 auto; /* Membuat kontainer berada di tengah */
    }

    /* Custom table styles */
    table {
        width: 100%;
        border-collapse: collapse;
        margin-bottom: 2rem; /* Jarak bawah tabel */
    }
    th, td {
        padding: 16px; /* Padding dalam sel */
        text-align: left; /* Rata kiri */
        vertical-align: top; /* Rata atas */
        border: 1px solid #dee2e6; /* Border sel */
        word-wrap: break-word; /* Pecah kata */
    }
    th {
        background-color: #f8f9fa; /* Warna latar belakang untuk header */  
        padding: 16px; /* Padding dalam header */
    }
    td {
        max-width: 250px; /* Lebar maksimum untuk sel */
        padding: 16px; /* Padding dalam sel */
    }

    @media (min-width: 992px) {
        .container {
            margin-top: 20px;
        }
    }

    /* Custom styles for scrollable cells */
    .scrollable-cell {
        max-width: 250px; /* Lebar maksimum untuk sel dengan scroll */
        overflow-x: auto; /* Menambahkan scroll horizontal jika konten melebihi lebar */
        white-space: nowrap; /* Mencegah pembungkusan teks */
    }

    /* Button styles */
    .btn-back {
        display: block;
        width: 100px;
        margin: 20px auto; /* Center the button horizontally */
        padding: 10px;
        text-align: center;
        background-color: #007bff; /* Primary button color */
        color: white;
        border: none;
        border-radius: 5px;
        text-decoration: none;
    }
    .btn-back:hover {
        background-color: #0056b3; /* Darker color on hover */
    }
</style>

<div class="container">
    <h1 class="text-center mb-4">Detail Data Indikator</h1>

    <!-- Detail Table -->
    <div class="centered-container">
        <div class="card">
            <div class="card-header d-block d-sm-flex border-0">
                <div class="me-3">
                    <h4 class="card-title mb-2">Details</h4>
                </div>
                @can('data.create') <!-- Menampilkan tombol Create hanya jika pengguna memiliki izin data.create -->
                <div class="card-tabs mt-3 mt-sm-0">
                    <a href="{{ route('data.index') }}" class="btn btn-primary">Kembali</a>
                </div>
                @endcan
            </div>
            <div class="card-body p-0">
                <div class="table-responsive">
                    <table class="table table-bordered">
                        <tbody>
                            <tr>
                                <th scope="row" class="text-nowrap">Bidang Kinerja Kritis</th>
                                <td colspan="5" class="scrollable-cell">{{ $data->bidang_kerja }}</td>
                            </tr>
                            <tr>
                                <th scope="row">Tujuan</th>
                                <td colspan="5" class="scrollable-cell">{{ $data->tujuan }}</td>
                            </tr>
                            <tr>
                                <th scope="row">Penjelasan Tujuan</th>
                                <td colspan="5" class="scrollable-cell">{{ $data->penjelasan }}</td>
                            </tr>
                            <tr>
                                <th scope="row">Indikator {{ request()->get('nomor') }}</th>
                                <td colspan="5" class="scrollable-cell">{{ $data->indikator }}</td>
                            </tr>
                            <tr>
                                <td colspan="7" class="scrollable-cell">{{ $data->text }}</td>
                            </tr>

                            <!-- Header Rincian Indikator -->
                            <tr>
                                <th>Rincian Indikator</th>
                                <th>Kriteria/Parameter Penilaian</th>
                                <th>Proses/Hasil Kegiatan/Output</th>
                                <th>Skor</th>
                                <th>Bukti</th>
                                <th>Penanggung Jawab</th>
                            </tr>

                            <!-- Rincian Indikator -->
                            @php
                                $currentRincian = null;
                                $rowspan = 0;
                            @endphp

                            @foreach ($data->rincianIndikator as $rincian)
                                @php
                                    $rowspan = $rincian->kriterias->count();
                                @endphp

                                @foreach ($rincian->kriterias as $kriteriaIndex => $kriteria)
                                    <tr>
                                        @if ($kriteriaIndex === 0)
                                            <td rowspan="{{ $rowspan }}" class="scrollable-cell">{{ $rincian->rincian_indikator }}</td>
                                        @endif
                                        
                                        <td class="scrollable-cell">{!! nl2br(e($kriteria->kriteria)) !!}</td>
                                        <td class="scrollable-cell">
                                            @foreach ($kriteria->kriteriaDetails as $detail)
                                                {!! nl2br(e($detail->proses)) !!}<br>
                                            @endforeach
                                        </td>
                                        <td class="scrollable-cell">
                                            @foreach ($kriteria->kriteriaDetails as $detail)
                                                {!! nl2br(e($detail->skor)) !!}<br>
                                            @endforeach
                                        </td>
                                        <td class="scrollable-cell">
                                            @foreach ($kriteria->kriteriaDetails as $detail)
                                                @if ($detail->bukti)
                                                    <a href="{{ route('file.show', basename($detail->bukti)) }}" target="_blank">
                                                        {{ basename($detail->bukti) }}
                                                    </a><br>
                                                @else
                                                    -
                                                @endif
                                            @endforeach
                                        </td>
                                        <td class="scrollable-cell">
                                            {{ $kriteria->penanggung_jawab }}
                                        </td>
                                    </tr>
                                @endforeach 
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>

@endsection
