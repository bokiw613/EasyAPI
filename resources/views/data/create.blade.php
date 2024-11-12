@extends('layouts.app')

@section('content')
<div class="container">
    <h1>Create Data</h1>

        @if ($errors->any())
        <div class="alert alert-danger">
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    @if (session('error'))
        <div class="alert alert-danger">
          {{ session('error') }}
        </div>
    @endif


    <form action="{{ route('data.store') }}" method="POST" enctype="multipart/form-data">
        @csrf 
        <div class="form-group">
             <label for="bidang_kerja">Bidang Kinerja Kritis:</label>
             <input type="text" class="form-control" id="bidang_kerja" name="bidang_kerja" required>
        </div>
        <div class="form-group">
            <label for="tujuan">Tujuan:</label>
            <input type="text" class="form-control" id="tujuan" name="tujuan" required>
        </div>
        <div class="form-group">
            <label for="penjelasan">Penjelasan Tujuan:</label>
            <input type="text" class="form-control" id="penjelasan" name="penjelasan" required>
        </div>
        <div class="form-group">
            <label for="indikator">Indikator:</label>
            <input type="text" class="form-control" id="indikator" name="indikator" required>
        </div>
        <div class="form-group">
            <label for="text">Text:</label>
            <textarea class="form-control" id="text" name="text" rows="4" required></textarea>
        </div>

        <div class="container">
            <h4>Rincian Indikator</h4>
            <div id="rincian-indikator-wrapper" class="grid-container">
                <div class="rincian-indikator-item grid-item" id="rincian-indikator-0">
                    <div class="form-group">
                        <label for="rincian_indikator">Rincian Indikator:</label>
                        <textarea class="form-control" name="rincianIndikator[0][rincian_indikator]" required></textarea>
                    </div>
                    <div class="form-group">
                        <label for="kriteria">Kriteria/Parameter Penilaian:</label>
                        <textarea class="form-control" name="rincianIndikator[0][kriteria][0]" required></textarea>
                    </div>
                    <div class="form-group">
                        <label for="proses">Proses/Hasil Kegiatan/Output:</label>
                        <div id="proses-group-0-0">
                            <textarea class="form-control" name="rincianIndikator[0][proses][0][]" required></textarea>
                        </div>
                        <button type="button" class="btn btn-primary addProsesBtn" data-rincian-index="0" data-kriteria-index="0">Tambah Proses</button>
                    </div>
                    <div class="form-group">
                        <label for="skor">Skor:</label>
                        <div id="skor-group-0-0">
                            <textarea class="form-control" name="rincianIndikator[0][skor][0][]" required></textarea>
                        </div>
                        <button type="button" class="btn btn-primary addSkorBtn" data-rincian-index="0" data-kriteria-index="0">Tambah Skor</button>
                    </div>
                    <div class="form-group">
                        <label for="bukti">Bukti:</label>
                        <div id="bukti-group-0-0">
                            <div class="bukti-item">
                                <input type="file" class="form-control" name="rincianIndikator[0][bukti][0][]" accept=".pdf,.doc,.docx">
                                <input type="text" class="form-control mt-2" name="rincianIndikator[0][nama_file][0][]" placeholder="Nama File" required>
                            </div>
                        </div>
                        <button type="button" class="btn btn-primary addBuktiBtn" data-rincian-index="0" data-kriteria-index="0">Tambah Bukti</button>
                    </div>

                    <div class="form-group">
                        <label for="penanggung_jawab">Penanggung Jawab:</label>
                        <textarea class="form-control" name="rincianIndikator[0][penanggung_jawab][0]" required></textarea>
                    </div>
                    <div class="kriteria-wrapper">
                    <!-- Tempat untuk kriteria tambahan -->
                    </div>
                    <button type="button" class="btn btn-secondary mt-3 add-kriteria" data-rincian-index="0" >Add Kriteria</button> 
                    <button type="button" class="btn btn-danger mt-3 remove-rincian-indikator">Delete Rincian Indikator</button>
                </div>
            </div>
            <button type="button" class="btn btn-secondary mt-3 add-rincian-indikator">Add Rincian Indikator</button>
            <button type="submit" class="btn btn-primary mt-3">Submit</button>
        </div>   
    </form>
</div>


<!-- Include jQuery library -->
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script>
    $(document).ready(function() {
    let rincianIndex = 1;
    let kriteriaIndex = {};

    // Add Rincian Indikator
    $(document).on('click', '.add-rincian-indikator', function() {
        let newRincian = `
            <div class="rincian-indikator-item grid-item" id="rincian-indikator-${rincianIndex}">
                <!-- Rincian Indikator Field -->
                <div class="form-group">
                    <label for="rincian_indikator">Rincian Indikator:</label>
                    <textarea class="form-control" name="rincianIndikator[${rincianIndex}][rincian_indikator]" required></textarea>
                </div>
                <!-- Kriteria Field -->
                <div class="form-group">
                    <label for="kriteria">Kriteria/Parameter Penilaian:</label>
                    <div id="kriteria-group-${rincianIndex}">
                        <textarea class="form-control" name="rincianIndikator[${rincianIndex}][kriteria][0]" required></textarea>
                    </div>
                </div>
                <!-- Proses Field -->
                <div class="form-group">
                    <label for="proses">Proses/Hasil Kegiatan/Output:</label>
                    <div id="proses-group-${rincianIndex}-0">
                        <textarea class="form-control" name="rincianIndikator[${rincianIndex}][proses][0][]" required></textarea>
                    </div>
                    <button type="button" class="btn btn-primary addProsesBtn" data-rincian-index="${rincianIndex}" data-kriteria-index="0">Tambah Proses</button>
                </div>
                <!-- Skor Field -->
                <div class="form-group">
                    <label for="skor">Skor:</label>
                    <div id="skor-group-${rincianIndex}-0">
                        <textarea class="form-control" name="rincianIndikator[${rincianIndex}][skor][0][]" required></textarea>
                    </div>
                    <button type="button" class="btn btn-primary addSkorBtn" data-rincian-index="${rincianIndex}" data-kriteria-index="0">Tambah Skor</button>
                </div>
                <!-- Bukti Field -->
                <div class="form-group">
                    <label for="bukti">Bukti:</label>
                    <div id="bukti-group-${rincianIndex}-0">
                        <div class="bukti-item">
                            <input type="file" class="form-control" name="rincianIndikator[${rincianIndex}][bukti][0][]" accept=".pdf,.doc,.docx">
                            <input type="text" class="form-control mt-2" name="rincianIndikator[${rincianIndex}][nama_file][0][]" placeholder="Nama File" required>
                        </div>
                    </div>
                    <button type="button" class="btn btn-primary addBuktiBtn" data-rincian-index="${rincianIndex}" data-kriteria-index="0">Tambah Bukti</button>
                </div>
                <!-- Penanggung Jawab Field -->
                <div class="form-group">
                    <label for="penanggung_jawab">Penanggung Jawab:</label>
                    <textarea class="form-control" name="rincianIndikator[${rincianIndex}][penanggung_jawab][0]" required></textarea>
                </div>
                <div class="kriteria-wrapper">
                    <!-- Tempat untuk kriteria tambahan -->
                </div>
                <button type="button" class="btn btn-secondary mt-3 add-kriteria" data-rincian-index="${rincianIndex}">Add Kriteria</button>
                <button type="button" class="btn btn-danger mt-3 remove-rincian-indikator">Delete Rincian Indikator</button>
            </div>
        `;
        $('#rincian-indikator-wrapper').append(newRincian);
        kriteriaIndex[rincianIndex] = 1;
        rincianIndex++;
    });

    // Remove Rincian Indikator
    $(document).on('click', '.remove-rincian-indikator', function() {
        $(this).closest('.rincian-indikator-item').remove();
    });

    // Add Proses
    $(document).on('click', '.addProsesBtn', function() {
        console.log('Tombol Tambah Proses diklik');
        let rincianIdx = $(this).data('rincian-index');
        let kriteriaIdx = $(this).data('kriteria-index');
        let prosesGroup = $(`#proses-group-${rincianIdx}-${kriteriaIdx}`);
        let newProses = `
            <textarea class="form-control mt-2" name="rincianIndikator[${rincianIdx}][proses][${kriteriaIdx}][]" required></textarea>
        `;
        prosesGroup.append(newProses);
    });


    // Add Skor
    $(document).on('click', '.addSkorBtn', function() {
        let rincianIdx = $(this).data('rincian-index');
        let kriteriaIdx = $(this).data('kriteria-index');
        let skorGroup = $(`#skor-group-${rincianIdx}-${kriteriaIdx}`);
        let newSkor = `
            <textarea class="form-control mt-2" name="rincianIndikator[${rincianIdx}][skor][${kriteriaIdx}][]" required></textarea>
        `;
        skorGroup.append(newSkor);
    });

    // Add Bukti
    $(document).on('click', '.addBuktiBtn', function() {
        let rincianIdx = $(this).data('rincian-index');
        let kriteriaIdx = $(this).data('kriteria-index');
        let buktiGroup = $(`#bukti-group-${rincianIdx}-${kriteriaIdx}`);
        let newBukti = `
            <div class="bukti-item mt-2">
                <input type="file" class="form-control" name="rincianIndikator[${rincianIdx}][bukti][${kriteriaIdx}][]" accept=".pdf,.doc,.docx">
                <input type="text" class="form-control mt-2" name="rincianIndikator[${rincianIdx}][nama_file][${kriteriaIdx}][]" placeholder="Nama File" required>
            </div>
        `;
        buktiGroup.append(newBukti);
    });


    // Add Kriteria
    $(document).on('click', '.add-kriteria', function() {
        let rincianIdx = $(this).data('rincian-index');
        let kriteriaWrapper = $(`#rincian-indikator-${rincianIdx} .kriteria-wrapper`);
        if (!(rincianIdx in kriteriaIndex)) {
            kriteriaIndex[rincianIdx] = 1;
        }
        let kriteriaCount = kriteriaIndex[rincianIdx]++;
     
        let newKriteria = `
            <div class="kriteria-item mt-2">
                    <div class="form-group">
                        <label for="kriteria">Kriteria/Parameter Penilaian:</label>
                        <textarea class="form-control" name="rincianIndikator[${rincianIdx}][kriteria][${kriteriaCount}]" required></textarea>
                    </div>
                    <div class="form-group">
                        <label for="proses">Proses/Hasil Kegiatan/Output:</label>
                        <div id="proses-group-${rincianIdx}-${kriteriaCount}">
                            <textarea class="form-control" name="rincianIndikator[${rincianIdx}][proses][${kriteriaCount}][]" required></textarea>
                        </div>
                        <button type="button" class="btn btn-primary addProsesBtn" data-rincian-index="${rincianIdx}" data-kriteria-index="${kriteriaCount}">Tambah Proses</button>
                    </div>
                    <div class="form-group">
                        <label for="skor">Skor:</label>
                        <div id="skor-group-${rincianIdx}-${kriteriaCount}">
                            <textarea class="form-control" name="rincianIndikator[${rincianIdx}][skor][${kriteriaCount}][]" required></textarea>
                        </div>
                        <button type="button" class="btn btn-primary addSkorBtn" data-rincian-index="${rincianIdx}" data-kriteria-index="${kriteriaCount}">Tambah Skor</button>
                    </div>
                    <div class="form-group">
                        <label for="bukti">Bukti:</label>
                        <div id="bukti-group-${rincianIdx}-${kriteriaCount}">
                            <div class="bukti-item">
                                <input type="file" class="form-control" name="rincianIndikator[${rincianIdx}][bukti][${kriteriaCount}][]" accept=".pdf,.doc,.docx">
                                <input type="text" class="form-control mt-2" name="rincianIndikator[${rincianIdx}][nama_file][${kriteriaCount}][]" placeholder="Nama File" required>
                            </div>
                        </div>
                        <button type="button" class="btn btn-primary addBuktiBtn" data-rincian-index="${rincianIdx}" data-kriteria-index="${kriteriaCount}">Tambah Bukti</button>
                    </div>
                    <div class="form-group">
                        <label for="penanggung_jawab">Penanggung Jawab:</label>
                        <textarea class="form-control" name="rincianIndikator[${rincianIdx}][penanggung_jawab][${kriteriaCount}]" required></textarea>
                    </div>
                    <button type="button" class="btn btn-danger mt-2 remove-kriteria">Delete Kriteria</button>
                </div>
            `;
            kriteriaWrapper.append(newKriteria);
        });

        // Remove Kriteria
        $(document).on('click', '.remove-kriteria', function() {
            $(this).closest('.kriteria-item').remove();
        });
    });

</script>


<style>
    .btn{
        z-index: 10;
    }
    .grid-container {
        display: grid;
        grid-template-columns: repeat(auto-fill, minmax(300px, 1fr));
        gap: 20px;
    }
    .grid-item {
        background: #f9f9f9;
        padding: 20px;
        border: 1px solid #ddd;
        border-radius: 5px;
    }
    .rincian-indikator-item {
        border: 1px solid #ddd;
        padding: 15px;
        margin-bottom: 15px;
    }
    .kriteria-item {
        border: 1px dashed #ddd;
        padding: 10px;
        margin-bottom: 10px;
    }
</style>    
@endsection