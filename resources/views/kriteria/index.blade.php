@extends('layouts.app')

@section('content')
<div class="container">
    <h1>Kriteria Performance</h1>
    <a href="{{ route('kriteria.create') }}" class="btn btn-primary">Create Performance</a>
    
    @foreach ($kriteria as $item)
    <div class="card mt-4">
        <div class="card-body">
            <div class="row">
                <div class="col-md-8">
                   <!-- <div class="card-header">
                        <a href="{{ route('kriteria.create') }}" class="btn btn-primary">Create Performance</a>
                    </div>-->
                </div>
                <div class="col-md-10">
                    <table class="table table-bordered">
                        <tbody>
                            <tr>
                                <th>Bidang Kinerja Kritis</th>
                                <td>{{ $item->bidang_kinerja }}</td>
                            </tr>
                            <tr>
                                <th>Tujuan</th>
                                <td>{{ $item->tujuan }}</td>
                            </tr>
                            <tr>
                                <th>Penjelasan Tujuan</th>
                                <td>{{ $item->penjelasan_tujuan }}</td>
                            </tr>
                            <tr>
                                <th>Indikator</th>
                                <td>{{ $item->indikator }}</td>
                            </tr>
                            <tr>
                                <th>Teks</th>
                                <td>{{ $item->teks }}</td>
                            </tr>
                        </tbody>
                    </table>

                   <!--<h3>Rincian Indikator</h3>--> 
                        @if ($item->rincianIndikator->isNotEmpty())
                            <table class="table table-bordered">
                                <thead>
                                    <tr>
                                        <th>Rincian Indikator</th>
                                        <th>Kriteria/Parameter Penilaian</th>
                                        <th>Proses/Hasil Kegiatan/Output</th>
                                        <th>Skor</th>
                                        <th>Bukti</th>
                                        <th>Penanggung Jawab</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($item->rincianIndikator as $rincian)
                                        <tr>
                                            <td>{{ $rincian->rincian_indikator }}</td>
                                            <td>
                                                @if ($rincian->kriteria && $rincian->kriteria->count())
                                                    @foreach ($rincian->kriteria as $kriteriaItem)
                                                       <p> {{ $kriteriaItem->kriteria }}</p>
                                                    @endforeach
                                                @else
                                                    Tidak ada kriteria.
                                                @endif
                                            </td>
                                            <td>{{ $rincian->proses }}</td>
                                            <td>{{ $rincian->skor }}</td>
                                            <td>{{ $rincian->bukti }}</td>
                                            <td>{{ $rincian->penanggung_jawab }}</td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                    @else
                        <p>Tidak ada rincian indikator.</p>
                    @endif
                </div>
            </div>
        </div>
    </div>
    @endforeach
</div>
@endsection
