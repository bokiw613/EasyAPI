@extends('layouts.app')

@section('content')
<style>
    html, body {
        height: 100%;
        margin: 0;
        overflow: hidden; /* Prevent scrollbars */
    }

    .centered-container {
        display: flex;
        justify-content: center; /* Center horizontally */
        align-items: center; /* Center vertically */
        height: 100vh; /* Ensure the container takes full viewport height */
        padding: 20px; /* Add padding to prevent content touching edges */
    }

    .form-card {
        width: 500px; /* Width of the card */
        max-width: 1200px; /* Maximum width of the card */
        padding: 30px; /* Padding inside the card */
        box-shadow: 0 6px 16px rgba(0,0,0,0.2); /* Shadow for better visibility */
        border-radius: 12px; /* Rounded corners */
        background-color: #ffffff; /* Background color */
        box-sizing: border-box; /* Include padding and border in the total width and height */
    }

    @media (min-width: 992px) {
        .form-card {
            margin-top: -220px;
        }
    }

    .form-card h1 {
        margin-top: 0; /* Remove default top margin */
        margin-bottom: 20px; /* Space below the heading */
        font-size: 28px; /* Larger font size for the heading */
    }

    .form-card .form-info {
        display: flex;
        flex-direction: column;
        gap: 15px; /* Space between rows */
    }

    .form-card .info-row {
        display: flex;
        justify-content: flex-start; /* Align items to the start of the container */
        align-items: center; /* Center items vertically */
        padding-bottom: 10px; /* Add space below the row */
        margin-bottom: 10px; /* Space between rows */
    }

    .form-card .info-row strong {
        min-width: 120px; /* Set a minimum width for labels to align properly */
        font-weight: 600; /* Make label text bold */
        text-align: left; /* Align label text to the left */
    }

    .form-card .info-row p,
    .form-card .info-row ul {
        margin: 0; /* Remove margin for consistent alignment */
        padding-left: 10px; /* Add padding to ensure spacing between label and value */
    }

    .form-card .info-row ul {
        margin-left: 0; /* Remove margin left for alignment */
        padding-left: 0; /* Remove padding left for alignment */
    }

    .form-card .btn {
        margin-top: 20px; /* Space above the button */
    }

    .form-card .alert {
        margin-bottom: 20px; /* Space below the alert */
    }
</style>

<div class="centered-container">
    <div class="form-card">
        <h1>Detail Pengguna</h1>

        @if (session('success'))
            <div class="alert alert-success">
                {{ session('success') }}
            </div>
        @endif

        <div class="form-info">
            <div class="info-row">
                <strong>Nama:</strong>
                <p>{{ $user->name }}</p>
            </div>

            <div class="info-row">
                <strong>Email:</strong>
                <p>{{ $user->email }}</p>
            </div>

            <div class="info-row">
                <strong>Peran:</strong>
                <ul>
                    @foreach ($user->roles as $role)
                        <li>{{ $role->name }}</li>
                    @endforeach
                </ul>
            </div>
        </div>

        <a href="{{ route('users.edit', $user->id) }}" class="btn btn-primary">Edit Pengguna</a>
        <a href="{{ route('users.index') }}" class="btn btn-secondary">Kembali</a>
    </div>
</div>
@endsection
