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
    }
</style>

<!-- Trigger button untuk membuka modal -->
<button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#detailRoleModal">
    Tampilkan Detail Role
</button>

<!-- Modal -->
<div class="modal fade" id="detailRoleModal" tabindex="-1" aria-labelledby="detailRoleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg"> <!-- Ukuran modal ditetapkan sebagai modal besar -->
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="detailRoleModalLabel">Detail Role</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <div class="card">
                    <div class="card-header d-block d-sm-flex border-0">
                        <div class="me-3">
                            <h4 class="card-title mb-2">Detail Role</h4>
                            <span class="fs-12">Informasi Role</span>
                        </div>
                    </div>
                    <div class="card-body p-0">
                        <div class="p-3">
                            <h5 class="card-title">Nama: {{ $role->name }}</h5>
                            <p class="card-text">ID: {{ $role->id }}</p>
                            <!-- Tambahkan informasi lainnya sesuai kebutuhan -->
                        </div>
                    </div>
                    <div class="card-footer">
                        <a href="{{ route('roles.index') }}" class="btn btn-primary">Kembali ke Peran</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

@endsection
