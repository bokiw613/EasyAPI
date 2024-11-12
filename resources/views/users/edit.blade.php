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
        width: 500px; /* Full width of its parent */
        max-width: 1200px; /* Increase the max-width for larger size */
        padding: 30px; /* Add more padding for inner spacing */
        box-shadow: 0 6px 16px rgba(0,0,0,0.2); /* Larger shadow for better visibility */
        border-radius: 12px; /* Increased border-radius for a more rounded look */
        background-color: #ffffff; /* Ensure background color matches */
        box-sizing: border-box; /* Include padding and border in the element's total width and height */
    }

    @media (min-width: 992px) {
        .form-card {
            margin-top:-320px;
    }
    }

    .form-card h1 {
        margin-top: 0; /* Remove default top margin */
        margin-bottom: 20px; /* Space below the heading */
        font-size: 28px; /* Larger font size for the heading */
    }

    .form-card .form-label {
        font-size: 16px;
        color: #495057;
    }

    .form-card .form-group {
        margin-bottom: 1.5rem; /* Spacing between form elements */
    }

    .form-card .btn {
        margin-top: 20px; /* Add space above the button */
    }

    .form-card .alert {
        margin-bottom: 20px; /* Space below the alert */
    }
</style>

<div class="centered-container">
    <div class="form-card">
        <h1>Edit Pengguna</h1>

        @if (session('success'))
            <div class="alert alert-success">
                {{ session('success') }}
            </div>
        @endif

        <form action="{{ route('users.update', $user->id) }}" method="POST">
            @csrf
            @method('PUT')

            <div class="form-group">
                <label for="name" class="form-label">Nama:</label>
                <input type="text" class="form-control" id="name" name="name" value="{{ old('name', $user->name) }}" required>
            </div>
            
            <div class="form-group">
                <label for="email" class="form-label">Email:</label>
                <input type="email" class="form-control" id="email" name="email" value="{{ old('email', $user->email) }}" required>
            </div>

            <div class="form-group">
                <label for="role" class="form-label">Role:</label>
                <select class="form-control" id="role" name="role" required>
                    @foreach ($roles as $role)
                        <option value="{{ $role->id }}" {{ $role->id == old('role', $user->role_id) ? 'selected' : '' }}>
                            {{ $role->name }}
                        </option>
                    @endforeach
                </select>
            </div>

            <!-- Tambahkan field lain jika diperlukan -->

            <button type="submit" class="btn btn-primary">Update</button>
            <a href="{{ route('users.index') }}" class="btn btn-secondary">Kembali</a>
        </form>
    </div>
</div>
@endsection
