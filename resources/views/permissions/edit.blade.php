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
        height: 100px; /* Ensure the container takes full viewport height */
        padding: 20px; /* Add padding to prevent content touching edges */
    }

    .form-wrapper {
        width: 500px; /* Full width of its parent */
        max-width: 1200px; /* Increase the max-width for larger size */
        padding: 30px; /* Add more padding for inner spacing */
        box-shadow: 0 6px 16px rgba(0,0,0,0.2); /* Larger shadow for better visibility */
        border-radius: 12px; /* Increased border-radius for a more rounded look */
        background-color: #ffffff; /* Ensure background color matches */
        box-sizing: border-box; /* Include padding and border in the element's total width and height */
    }

    .form-wrapper h1 {
        margin-top: 0; /* Remove default top margin */
        margin-bottom: 20px; /* Space below the heading */
        font-size: 28px; /* Larger font size for the heading */
    }

    .form-wrapper .form-label {
        font-size: 16px;
        color: #495057;
    }

    .form-wrapper .btn {
        margin-top: 20px; /* Add space above the button */
    }


    @media (min-width: 992px) {
        .form-wrapper {
            margin-top:-120px;
    }
    }
</style>

<div class="centered-container">
    <div class="form-wrapper">
        <h1>Edit Izin</h1>

        <form action="{{ route('permissions.edit', $permission->id) }}" method="POST">
            @csrf
            @method('PUT')

            <div class="mb-3">
                <label for="name" class="form-label">Nama</label>
                <input type="text" class="form-control" id="name" name="name" value="{{ $permission->name }}" required>
            </div>

            <button type="submit" class="btn btn-primary">Perbarui Izin</button>
        </form>
    </div>
</div>
@endsection
