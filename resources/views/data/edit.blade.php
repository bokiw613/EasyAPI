@extends('layouts.app')

@section('content')
<div class="container-edit">

    @if (session('success'))
        <div class="alert alert-success">
            {{ session('success') }}
        </div>
    @endif

    @if ($errors->any())
        <div class="alert alert-danger">
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <form action="{{ route('data.update', $data->id) }}" method="POST" enctype="multipart/form-data">
        @csrf
        @method('PUT')

        <div class="row">
            <!-- Card 1 -->
<!-- Card 1 -->
<div class="col-md-6" style="margin: -30px; margin-left:20px">
    <div class="card" style="margin-bottom:-30px">
        <div class="card-body scrollable-card-body">
            <div class="form-group">
                <label for="bidang_kerja">Bidang Kinerja Kritis:</label>
                <input type="text" class="form-control" id="bidang_kerja" name="bidang_kerja" value="{{ $data->bidang_kerja }}" required>
            </div>
            <div class="form-group">
                <label for="tujuan">Tujuan:</label>
                <input type="text" class="form-control" id="tujuan" name="tujuan" value="{{ $data->tujuan }}" required>
            </div>
            <div class="form-group">
                <label for="penjelasan">Penjelasan Tujuan:</label>
                <input type="text" class="form-control" id="penjelasan" name="penjelasan" value="{{ $data->penjelasan }}" required>
            </div>
            <div class="form-group">
                <label for="indikator">Indikator:</label>
                <input type="text" class="form-control" id="indikator" name="indikator" value="{{ $data->indikator }}" required>
            </div>
            <div class="form-group">
                <label for="text">Teks:</label>
                <textarea class="form-control" style="height:50px" id="text" name="text" rows="4" required>{{ $data->text }}</textarea>
            </div>
        </div>
    </div>
</div>


            <!-- Card 2 -->
            <div class="col-md-6 " style="margin: -30px;margin-left:20px">
                <div class="card" style="margin-bottom:-30px">
                    <div class="card-body rincian-indikator-body">
                        <h4>Rincian Indikator</h4>
                        <div id="rincian-indikator-wrapper" class="grid-container">
                            @foreach ($data->rincianIndikator as $index => $rincian)
                                <div class="rincian-indikator-item grid-item" style="width: 420px;">
                                    <div class="form-group">
                                        <label for="rincian_indikator_{{ $index }}">Rincian Indikator:</label>
                                        <textarea class="form-control" id="rincian_indikator_{{ $index }}" name="rincianIndikator[{{ $index }}][rincian_indikator]" required>{{ $rincian->rincian_indikator }}</textarea>
                                    </div>
                                    @foreach ($rincian->kriterias as $kriteriaIndex => $kriteria)
                                        <div class="form-group">
                                            <label for="kriteria_{{ $index }}_{{ $kriteriaIndex }}">Kriteria/Parameter Penilaian:</label>
                                            <textarea class="form-control"  id="kriteria_{{ $index }}_{{ $kriteriaIndex }}" name="rincianIndikator[{{ $index }}][kriteria][{{ $kriteriaIndex }}][kriteria]" required>{{ $kriteria->kriteria }}</textarea>
                                        </div>
                                        <div class="form-group">
                                            <label for="proses_{{ $index }}_{{ $kriteriaIndex }}">Proses/Hasil Kegiatan/Output:</label>
                                            <div id="proses-group-{{ $index }}-{{ $kriteriaIndex }}">
                                                @foreach ($kriteria->kriteriaDetails as $detailIndex => $detail)
                                                    <textarea class="form-control" style="margin-bottom: 20px" name="rincianIndikator[{{ $index }}][kriteria][{{ $kriteriaIndex }}][proses][{{ $detailIndex }}]" required >{{ $detail->proses }}</textarea>
                                                @endforeach
                                            </div>
                                            <button type="button" class="btn btn-primary add-proses" data-rincian-index="{{ $index }}" data-kriteria-index="{{ $kriteriaIndex }}">Tambah Proses</button>
                                        </div>
                                        <div class="form-group">
                                            <label for="skor_{{ $index }}_{{ $kriteriaIndex }}">Skor:</label>
                                            <div id="skor-group-{{ $index }}-{{ $kriteriaIndex }}">
                                                @foreach ($kriteria->kriteriaDetails as $detailIndex => $detail)
                                                    <textarea class="form-control" style="margin-bottom: 20px"name="rincianIndikator[{{ $index }}][kriteria][{{ $kriteriaIndex }}][skor][{{ $detailIndex }}]" required>{{ $detail->skor }}</textarea>
                                                @endforeach
                                            </div>
                                            <button type="button" class="btn btn-primary add-skor" data-rincian-index="{{ $index }}" data-kriteria-index="{{ $kriteriaIndex }}">Tambah Skor</button>
                                        </div>
                                        <div class="form-group">
                                            <label for="bukti_{{ $index }}_{{ $kriteriaIndex }}">Bukti:</label>
                                            @foreach ($kriteria->kriteriaDetails as $detailIndex => $detail)
                                                @if ($detail->bukti)
                                                    <p>File saat ini:
                                                        <a href="{{ Storage::url('upload/bukti/' . basename($detail->bukti)) }}" target="_blank">
                                                            {{ basename($detail->bukti) }}
                                                        </a>
                                                    </p>
                                                @endif
                                                <input type="file" class="form-control" id="bukti_{{ $index }}_{{ $kriteriaIndex }}_{{ $detailIndex }}" 
                                                    name="rincianIndikator[{{ $index }}][kriteria][{{ $kriteriaIndex }}][bukti][{{ $detailIndex }}]" 
                                                    accept=".pdf,.doc,.docx">
                                                <input type="text" class="form-control mt-2" id="nama_file_{{ $index }}_{{ $kriteriaIndex }}_{{ $detailIndex }}" 
                                                    name="rincianIndikator[{{ $index }}][kriteria][{{ $kriteriaIndex }}][bukti][{{ $detailIndex }}][nama_file]" 
                                                    value="{{ old('rincianIndikator.'.$index.'.kriteria.'.$kriteriaIndex.'.bukti.'.$detailIndex.'.nama_file', $detail->nama_file) }}">
                                            @endforeach
                                        </div>
                                        <div class="form-group">
                                            <label for="penanggung_jawab_{{ $index }}_{{ $kriteriaIndex }}">Penanggung Jawab:</label>
                                            <textarea class="form-control" id="penanggung_jawab_{{ $index }}_{{ $kriteriaIndex }}" name="rincianIndikator[{{ $index }}][kriteria][{{ $kriteriaIndex }}][penanggung_jawab]" required>{{ $kriteria->penanggung_jawab }}</textarea>
                                        </div>
                                    @endforeach
                                    <div class="kriteria-wrapper"></div>
                                    <button type="button" class="btn btn-secondary mt-3 add-kriteria" data-rincian-index="{{ $index }}">Add Kriteria</button>
                                </div>
                            @endforeach 
                        </div>
                        <button type="button" class="btn btn-secondary mt-3 add-rincian-indikator">Add Rincian Indikator</button>
                    </div>
                    

                </div>
            </div>
        </div>

        <div class="form-group mt-3">
        <button type="submit" class="btn btn-primary" style="width:120px; margin-left:40px">Update</button>
        </div>
    </form>
</div>

<!-- JavaScript (Opsional, untuk penambahan dinamika jika diperlukan) -->
<script>
    document.addEventListener('DOMContentLoaded', function () {
        document.querySelectorAll('.add-proses').forEach(button => {
            button.addEventListener('click', function () {
                const rincianIndex = button.dataset.rincianIndex;
                const kriteriaIndex = button.dataset.kriteriaIndex;
                const prosesGroup = document.getElementById(`proses-group-${rincianIndex}-${kriteriaIndex}`);
                const newProses = document.createElement('textarea');
                newProses.className = 'form-control';
                newProses.name = `rincianIndikator[${rincianIndex}][kriteria][${kriteriaIndex}][proses][]`;
                prosesGroup.appendChild(newProses);
            });
        });

        document.querySelectorAll('.add-skor').forEach(button => {
            button.addEventListener('click', function () {
                const rincianIndex = button.dataset.rincianIndex;
                const kriteriaIndex = button.dataset.kriteriaIndex;
                const skorGroup = document.getElementById(`skor-group-${rincianIndex}-${kriteriaIndex}`);
                const newSkor = document.createElement('textarea');
                newSkor.className = 'form-control';
                newSkor.name = `rincianIndikator[${rincianIndex}][kriteria][${kriteriaIndex}][skor][]`;
                skorGroup.appendChild(newSkor);
            });
        });

        document.querySelector('.add-kriteria').addEventListener('click', function () {
            const rincianIndex = this.dataset.rincianIndex;
            const kriteriaWrapper = document.querySelector(`.rincian-indikator-item[data-rincian-index="${rincianIndex}"] .kriteria-wrapper`);
            const newKriteria = document.createElement('div');
            newKriteria.className = 'form-group';
            newKriteria.innerHTML = `
                <label>Kriteria/Parameter Penilaian:</label>
                <textarea class="form-control" name="rincianIndikator[${rincianIndex}][kriteria][new][kriteria]" required></textarea>
                <label>Proses/Hasil Kegiatan/Output:</label>
                <div class="proses-group">
                    <textarea class="form-control" name="rincianIndikator[${rincianIndex}][kriteria][new][proses][]" required></textarea>
                </div>
                <button type="button" class="btn btn-primary add-proses" data-rincian-index="${rincianIndex}" data-kriteria-index="new">Tambah Proses</button>
                <label>Skor:</label>
                <div class="skor-group">
                    <textarea class="form-control" name="rincianIndikator[${rincianIndex}][kriteria][new][skor][]" required></textarea>
                </div>
                <button type="button" class="btn btn-primary add-skor" data-rincian-index="${rincianIndex}" data-kriteria-index="new">Tambah Skor</button>
                <label>Bukti:</label>
                <input type="file" class="form-control" name="rincianIndikator[${rincianIndex}][kriteria][new][bukti][]">
                <label>Penanggung Jawab:</label>
                <textarea class="form-control" name="rincianIndikator[${rincianIndex}][kriteria][new][penanggung_jawab]" required></textarea>
            `;
            kriteriaWrapper.appendChild(newKriteria);
        });

        document.querySelector('.add-rincian-indikator').addEventListener('click', function () {
            const rincianIndikatorWrapper = document.getElementById('rincian-indikator-wrapper');
            const newRincian = document.createElement('div');
            newRincian.className = 'rincian-indikator-item grid-item';
            newRincian.innerHTML = `
                <div class="form-group">
                    <label>Rincian Indikator:</label>
                    <textarea class="form-control" name="rincianIndikator[new][rincian_indikator]" required></textarea>
                </div>
                <div class="form-group">
                    <label>Kriteria/Parameter Penilaian:</label>
                    <textarea class="form-control" name="rincianIndikator[new][kriteria][new][kriteria]" required></textarea>
                    <label>Proses/Hasil Kegiatan/Output:</label>
                    <textarea class="form-control" name="rincianIndikator[new][kriteria][new][proses][]" required></textarea>
                    <button type="button" class="btn btn-primary add-proses" data-rincian-index="new" data-kriteria-index="new">Tambah Proses</button>
                    <label>Skor:</label>
                    <textarea class="form-control" name="rincianIndikator[new][kriteria][new][skor][]" required></textarea>
                    <button type="button" class="btn btn-primary add-skor" data-rincian-index="new" data-kriteria-index="new">Tambah Skor</button>
                    <label>Bukti:</label>
                    <input type="file" class="form-control" name="rincianIndikator[new][kriteria][new][bukti][]">
                    <label>Penanggung Jawab:</label>
                    <textarea class="form-control" name="rincianIndikator[new][kriteria][new][penanggung_jawab]" required></textarea>
                </div>
            `;
            rincianIndikatorWrapper.appendChild(newRincian);
        });
    });
</script>

<!-- CSS -->
<style>
/* CSS untuk container-edit */
.container-edit {
    max-width: 1200px; /* Atur lebar maksimum container sesuai kebutuhan */
    padding: 20px; /* Tambahkan padding agar konten tidak terlalu rapat ke tepi */
    box-sizing: border-box; /* Pastikan padding termasuk dalam lebar total container */
}

/* CSS untuk rincian-indikator-body */
.rincian-indikator-body {
    max-height: 500px; /* Atur tinggi maksimum sesuai kebutuhan */
    overflow-y: auto; /* Menyediakan scroll jika diperlukan */
}

/* CSS untuk grid-container */
.grid-container {
    display: grid;
    grid-template-columns: 1fr 1fr; /* Membuat dua kolom */
    gap: 1rem; /* Jarak antar item dalam grid */
}

/* CSS untuk grid-item */
.grid-item {
    border: 1px solid #ddd;
    padding: 1rem;
    box-sizing: border-box; /* Pastikan padding termasuk dalam lebar total item */
}

/* CSS untuk form-group */
.form-group {
    margin-bottom: 1.5rem; /* Jarak bawah antar elemen form */
}

/* CSS untuk card-body yang dapat di-scroll */
.scrollable-card-body {
    max-height: 500px; /* Atur tinggi maksimum sesuai kebutuhan */
    overflow-y: auto; /* Menyediakan scroll jika diperlukan */
}


/* CSS untuk form-control */
.form-control {
    width: 100%; /* Lebar form-control memenuhi lebar container-nya */
    height: 40px; /* Tinggi form-control agar konsisten */
    padding: 0.75rem 1.25rem; /* Padding dalam form-control */
}

/* CSS untuk button */
.btn {
    margin-top: 1rem; /* Jarak atas pada button */
}

/* Responsif untuk perangkat besar */
@media (min-width: 992px) {
    .container-edit {
        margin-top: -110px; /* Mengatur margin top untuk perangkat besar jika diperlukan */
    }
}

</style>

@endsection
