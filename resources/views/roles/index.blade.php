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
            margin-left: 310px;
            margin-right: auto; /* Untuk memastikan kolom berada di tengah jika margin kiri diterapkan */
        }

        .col-custom-invoice {
            margin-top:120px;
            margin-left: 310px;
        }
    }

    /* Custom table styles */
    #roles-table thead tr {
        border-bottom: 0; /* Menghilangkan garis bawah di baris header */
    }

    #roles-table tbody tr {
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

<div class="container-fluid">
    <div class="row">
        <div class="col-custom">
            <div class="card">
                <div class="card-header d-block d-sm-flex border-0">
                    <div class="me-3">
                        <h4 class="card-title mb-2">Peran</h4>
                        <span class="fs-12">Mengelola peran dan izin pengguna</span>
                    </div>
                    <div class="card-tabs mt-3 mt-sm-0">
                        <a href="{{ route('roles.create') }}" class="btn btn-primary">Buat Peran</a>
                    </div>
                </div>
                <div class="card-body p-0">
                    <div class="table-responsive">
                        <table id="roles-table" class="table table-responsive-md card-table transactions-table">
                            <tbody>

                                <tr>
                                    <th>No</th>
                                    <th>Nama</th>
                                    <th>Izin</th>
                                    <th>Aksi</th>
                                </tr>
                                @foreach ($roles as $role)
                                <tr>
                                    <td>{{ $role->id }}</td>
                                    <td>{{ $role->name }}</td>
                                    <td>
                                        @foreach($role->permissions as $permission)
                                            {{ $permission->name }},
                                        @endforeach
                                    </td>
                                    <td class="actions-cell">
                                    <a href="javascript:void(0);" onclick="showRoleDetail({{ $role->id }})" class="btn btn-info">Lihat</a>
                                        <a href="{{ route('roles.edit', $role->id) }}" class="btn btn-primary btn-sm">Edit</a>
                                        <form action="{{ route('roles.destroy', $role->id) }}" method="POST" style="display:inline;">
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

<!-- Modal untuk menampilkan detail role -->
<div class="modal fade" id="detailRoleModal" tabindex="-1" aria-labelledby="detailRoleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="detailRoleModalLabel">Detail Peran</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <!-- Tempat untuk detail role -->
                <h5 id="roleName"></h5>
                <p id="roleId"></p>
                <p id="rolePermissions"></p>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Tutup</button>
            </div>
        </div>
    </div>
</div>

<script>
function showRoleDetail(roleId) {
    // Mengambil detail role menggunakan AJAX
    $.ajax({
        url: '/roles/' + roleId, // Route untuk mengambil data role berdasarkan ID
        method: 'GET',
        success: function(response) {
            // Cek jika response adalah objek JSON
            if (typeof response === 'object') {
                // Isi modal dengan data yang diterima dari server
                $('#roleName').text("Name: " + response.name);
                $('#roleId').text("ID: " + response.id);

                let permissions = response.permissions.map(function(permission) {
                    return permission.name;
                }).join(", ");

                $('#rolePermissions').text("Permissions: " + permissions);

                // Tampilkan modal
                $('#detailRoleModal').modal('show');
            } else {
                console.error("Unexpected response format");
            }
        },
        error: function(xhr) {
            alert('Error fetching role details: ' + xhr.responseText);
        }
    });
}

</script>



@endsection
