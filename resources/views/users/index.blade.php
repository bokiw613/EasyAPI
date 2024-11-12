@extends('layouts.app')

@section('content')

<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
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
    #users-table thead tr {
        border-bottom: 0; /* Menghilangkan garis bawah di baris header */
    }

    #users-table tbody tr {
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
                        <h4 class="card-title mb-2">Pengguna</h4>
                        <span class="fs-12">Kelola akun Pengguna</span>
                    </div>
                    <div class="card-tabs mt-3 mt-sm-0">
                        <a href="{{ route('users.create') }}" class="btn btn-primary">Buat Pengguna</a>
                    </div>
                </div>
                <div class="card-body p-0">
                    <div class="table-responsive">
                        <table id="users-table" class="table table-responsive-md card-table transactions-table">
                            <tbody>

                            <tr>
                                    <th>No</th>
                                    <th>Nama</th>
                                    <th>Email</th>
                                    <th>Peran</th>
                                    <th>Aksi</th>
                                </tr>
                                @foreach ($users as $user)
                                <tr>
                                    <td>{{ $loop->index + 1 }}</td>
                                    <td>{{ $user->name }}</td>
                                    <td>{{ $user->email }}</td>
                                    <td>{{ $user->role }}</td>
                                    <td class="actions-cell">
                                    <button class="btn btn-info btn-sm view-user" data-id="{{ $user->id }}" data-toggle="modal" data-target="#userModal">Lihat</button>
                                        <a href="{{ route('users.edit', $user->id) }}" class="btn btn-primary btn-sm">Edit</a>
                                        <form action="{{ route('users.destroy', $user->id) }}" method="POST" style="display:inline;">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="btn btn-danger btn-sm">Hapus</button>
                                        </form>
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
                <!-- Hapus tombol X di sini -->
            </div>
            <div class="modal-body">
                <!-- Tempat untuk detail pengguna yang akan di-load dengan AJAX -->
                <div id="userDetails">
                    <p>Loading...</p>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
            </div>
        </div>
    </div>
</div>

<!-- Tambahkan Bootstrap dan jQuery jika belum -->
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

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
                userDetails += `</ul></div>`;
                
                $('#userDetails').html(userDetails);
                $('#userModal').modal('show'); // Tampilkan modal
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
