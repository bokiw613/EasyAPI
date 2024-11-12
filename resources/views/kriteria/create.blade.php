@extends('layouts.app')

@section('content')
<div class="container">
    <h1>Tambah Kriteria Performance</h1>

    @if ($errors->any())
        <div class="alert alert-danger">
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <form action="{{ route('kriteria.store') }}" method="POST">
        @csrf
        <div class="form-group">
            <label for="bidang_kinerja">Bidang Kinerja:</label>
            <input type="text" name="bidang_kinerja" id="bidang_kinerja" class="form-control" required>
        </div>

        <div class="form-group">
            <label for="tujuan">Tujuan:</label>
            <input type="text" name="tujuan" id="tujuan" class="form-control" required>
        </div>

        <div class="form-group">
            <label for="penjelasan_tujuan">Penjelasan Tujuan:</label>
            <textarea name="penjelasan_tujuan" id="penjelasan_tujuan" class="form-control" required></textarea>
        </div>

        <div class="form-group">
            <label for="indikator">Indikator:</label>
            <input type="text" name="indikator" id="indikator" class="form-control" required>
        </div>

        <div class="form-group">
            <label for="teks">Teks:</label>
            <textarea name="teks" id="teks" class="form-control" required></textarea>
        </div>

        <h3>Rincian Indikator</h3>
        <div id="rincian-indikator">
            <div class="rincian">
                <div class="form-group">
                    <label for="rincian_indikators[0][rincian_indikator]">Rincian Indikator:</label>
                    <input type="text" name="rincian_indikators[0][rincian_indikator]" class="form-control" required>
                </div>

                <div class="form-group">
                    <label for="rincian_indikators[0][kriteria_evaluasi]">Kriteria Evaluasi:</label>
                    <input type="text" name="rincian_indikators[0][kriteria_evaluasi]" class="form-control" required>
                </div>

                <div class="form-group">
                    <label for="rincian_indikators[0][proses]">Proses:</label>
                    <input type="text" name="rincian_indikators[0][proses]" class="form-control" step="0.01" required>
                </div>

                <div class="form-group">
                    <label for="rincian_indikators[0][skor]">Skor:</label>
                    <input type="number" name="rincian_indikators[0][skor]" class="form-control" step="0.01" required>
                </div>

                <div class="form-group">
                    <label for="rincian_indikators[0][bukti_pendukung]">Bukti Pendukung:</label>
                    <input type="text" name="rincian_indikators[0][bukti_pendukung]" class="form-control" required>
                </div>

                <div class="form-group">
                    <label for="rincian_indikators[0][penanggung_jawab]">Penanggung Jawab:</label>
                    <input type="text" name="rincian_indikators[0][penanggung_jawab]" class="form-control" required>
                </div>
            </div>
        </div>

        <button type="button" id="add-rincian" class="btn btn-primary mt-3">Tambah Rincian Indikator</button>
        <button type="submit" class="btn btn-primary mt-3">Simpan</button>
    </form>
</div>

<script>
    document.getElementById('add-rincian').addEventListener('click', function() {
        const rincianContainer = document.getElementById('rincian-indikator');
        const index = rincianContainer.children.length;
        const rincianDiv = document.createElement('div');
        rincianDiv.className = 'rincian';
        rincianDiv.innerHTML = `
            <div class="form-group">
                <label for="rincian_indikators[${index}][rincian_indikator]">Rincian Indikator:</label>
                <input type="text" name="rincian_indikators[${index}][rincian_indikator]" class="form-control" required>
            </div>

            <div class="form-group">
                <label for="rincian_indikators[${index}][kriteria_evaluasi]">Kriteria Evaluasi:</label>
                <input type="text" name="rincian_indikators[${index}][kriteria_evaluasi]" class="form-control" required>
            </div>

            <div class="form-group">
                <label for="rincian_indikators[${index}][proses_penilaian]">Proses Penilaian:</label>
                <input type="text" name="rincian_indikators[${index}][proses_penilaian]" class="form-control" required>
            </div>

            <div class="form-group">
                <label for="rincian_indikators[${index}][skor]">Skor:</label>
                <input type="number" name="rincian_indikators[${index}][skor]" class="form-control" step="0.01" required>
            </div>

            <div class="form-group">
                <label for="rincian_indikators[${index}][bukti_pendukung]">Bukti Pendukung:</label>
                <input type="text" name="rincian_indikators[${index}][bukti_pendukung]" class="form-control" required>
            </div>

            <div class="form-group">
                <label for="rincian_indikators[${index}][penanggung_jawab]">Penanggung Jawab:</label>
                <input type="text" name="rincian_indikators[${index}][penanggung_jawab]" class="form-control" required>
            </div>
        `;
        rincianContainer.appendChild(rincianDiv);
    });
</script>
@endsection
