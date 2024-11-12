@extends('layouts.app')

@section('content')
<style>
    /* Default styles for smaller screens */
    .col-custom {
        width: 100%; /* Kolom mengisi lebar penuh pada ukuran layar kecil */
    }

    /* Styles for larger screens */
    @media (min-width: 992px) {
        .col-custom {
            width: 900px; /* Lebar tetap untuk layar besar */
            margin-left: 210px; /* Margin kiri untuk layar besar */
            margin-right: auto; /* Untuk memastikan kolom berada di tengah jika margin kiri diterapkan */
        }
    }

    /* Custom table styles */
    #data-table thead tr {
        border-bottom: 0; /* Menghilangkan garis bawah di baris header */
    }

    #data-table tbody tr {
        border-bottom: 0; /* Menghilangkan garis bawah di semua baris tubuh tabel */
    }

    /* Center align action buttons */
    .actions-cell {
        display: flex;
        justify-content: center;
        gap: 0.5rem; /* Jarak antara tombol-tombol */
    }
</style>

<div class="container-fluid">
    <div class="row">
        <div class="col-custom">
            <div class="card">
                <div class="card-header d-block d-sm-flex border-0">
                    <div class="me-3">
                        <h4 class="card-title mb-2">Data Indikator RBO</h4>
                    </div>
                    @can('data.create') <!-- Menampilkan tombol Create hanya jika pengguna memiliki izin data.create -->
                    <div class="card-tabs mt-3 mt-sm-0">
                        <a href="{{ route('data.create') }}" class="btn btn-primary">Buat Data</a>
                    </div>
                    @endcan
                </div>
                <div class="card-body p-0">
                    <div class="table-responsive">
                        <table id="data-table" class="table table-bordered mt-4">
                            <tbody>
                            <tr>
                                    <th>No</th>
                                    <th>Bidang Kinerja Kritis</th>
                                    <th>Tujuan</th>
                                    <th>Penjelasan Tujuan</th>
                                    <th>Indikator</th>
                                    <th>Teks</th>
                                    <th>Aksi</th>
                                </tr>
                                @php $no = 1; @endphp <!-- Inisialisasi variabel penomoran -->
                                @foreach ($data as $index => $item)
                                <tr>
                                    <td>{{ $index + 1 }}</td>
                                    <td>{{ $item->bidang_kerja }}</td>
                                    <td>{{ $item->tujuan }}</td>
                                    <td>{{ $item->penjelasan }}</td>
                                    <td>{{ $item->indikator }}</td>
                                    <td>{{ $item->text }}</td>
                                    <td class="actions-cell">
                                        @can('data.show') <!-- Menampilkan View hanya jika pengguna memiliki izin data.show -->
                                        <a href="{{ route('data.show', [$item->id, 'nomor' => $index + 1]) }}" class="btn btn-info btn-sm">Lihat</a>
                                        @endcan

                                        @can('data.edit') <!-- Menampilkan Edit hanya jika pengguna memiliki izin data.edit -->
                                        <a href="{{ route('data.edit', $item->id) }}" class="btn btn-warning btn-sm">Edit</a>
                                        @endcan

                                        @can('data.delete') <!-- Menampilkan Delete hanya jika pengguna memiliki izin data.delete -->
                                        <form action="{{ route('data.destroy', $item->id) }}" method="POST" style="display:inline;">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="btn btn-danger btn-sm" onclick="return confirm('Are you sure?')">Delete</button>
                                        </form>
                                        @endcan
                                    </td>
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Modal -->
<div class="modal fade" id="userModal" tabindex="-1" role="dialog" aria-labelledby="userModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="userModalLabel">Detail Pengguna</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <!-- Tempat untuk detail pengguna yang akan di-load dengan AJAX -->
                <div id="userDetails">
                    <p>Loading...</p>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
            </div>
        </div>
    </div>
</div>


<script>
    $(document).ready(function() {
        // Event listener untuk tombol View
        $('.view-user').on('click', function() {
            var userId = $(this).data('id');

            // AJAX untuk mendapatkan data pengguna
            $.ajax({
                url: '/users/' + userId, // URL untuk mengambil detail pengguna
                type: 'GET',
                success: function(response) {
                    // Isi modal dengan detail pengguna
                    var userDetails = `
                        <div class="info-row">
                            <strong>Nama:</strong>
                            <p>${response.name}</p>
                        </div>
                        <div class="info-row">
                            <strong>Email:</strong>
                            <p>${response.email}</p>
                        </div>
                        <div class="info-row">
                            <strong>Peran:</strong>
                            <ul>`;
                    response.roles.forEach(function(role) {
                        userDetails += `<li>${role.name}</li>`;
                    });
                    userDetails += `
                            </ul>
                        </div>`;
                    $('#userDetails').html(userDetails);
                },
                error: function(xhr) {
                    // Jika terjadi error, tampilkan pesan
                    $('#userDetails').html('<p>Error loading data. Please try again.</p>');
                }
            });
        });
    });
</script>

@endsection
