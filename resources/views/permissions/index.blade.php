@extends('layouts.app')

@section('content')
<style>
    /* Default styles for smaller screens */
    .col-custom {
        width: 100%; /* Kolom mengisi lebar penuh pada ukuran layar kecil */
        margin: 0 auto; /* Pusatkan pada layar kecil */
    }

    .coin-card {
        height: auto;
        padding: 20px;
        margin-bottom: 20px;
    }

    .coin-card h3 {
        font-size: 18px; /* Ukuran teks lebih kecil untuk layar kecil */
    }

    .coin-card p {
        font-size: 14px;
    }

    /* Styles for medium screens (tablet) */
    @media (min-width: 768px) {
        .coin-card {
            height: 180px; /* Sedikit lebih tinggi untuk ukuran layar menengah */
            padding: 20px;
        }

        .coin-card h3 {
            font-size: 20px;
        }

        .coin-card p {
            font-size: 16px;
        }
    }

    /* Styles for larger screens */
    @media (min-width: 992px) {
        .col-custom {
            width: 950px; /* Lebar tetap untuk layar besar */
            margin-top: 130px;
            margin-left: 210px;
            margin-right: auto;
        }

        .coin-card {
            height: 220px; /* Tinggi tetap untuk layar besar */
            padding: 20px;
        }

        .coin-card h3 {
            font-size: 14px;
        }

        .coin-card p {
            font-size: 18px;
        }
    }

    /* Custom table styles for the Permissions page only */
    #permissions-table thead tr {
        border-bottom: 0;
    }

    #permissions-table tbody tr {
        border-bottom: 0;
    }

    .th-cell {
        display: flex;
        justify-content: center;
        gap: 0.5rem;
    }

    /* Center align action buttons */
    .actions-cell {
        display: flex;
        justify-content: center;
        gap: 0.5rem;
    }
</style>


<div class="container-fluid">
    <div class="row">
        
        <div class="col-custom">

            <div class="card">
                <div class="card-header d-block d-sm-flex border-0">
                    <div class="me-3">
                        <h4 class="card-title mb-2">Izin</h4>
                        <span class="fs-12">Mengelola Izin Pengguna</span>
                    </div>
                    <div class="card-tabs mt-3 mt-sm-0">
                        <a href="{{ route('permissions.create') }}" class="btn btn-primary">Buat Izin</a>
                    </div>
                </div>
                <div class="card-body p-0">
                    <div class="table-responsive">
                        <table id="permissions-table" class="table table-responsive-md card-table transactions-table">
                            <tbody>
                            <tr>
                                    <th>No</th>
                                    <th>Nama</th>
                                    <th class="th-cell">Aksi</th>
                                </tr>
                                @foreach ($permissions as $permission)
                                <tr>
                                    <td>{{ $loop->index + 1 }}</td>
                                    <td>{{ $permission->name }}</td>
                                    <td class="actions-cell">
                                        <a href="{{ route('permissions.edit', $permission->id) }}" class="btn btn-primary btn-sm">Edit</a>
                                        <form action="{{ route('permissions.destroy', $permission->id) }}" method="POST" style="display:inline;">
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
@endsection
