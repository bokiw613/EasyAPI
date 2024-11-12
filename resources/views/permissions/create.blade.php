@extends('layouts.app')

@section('content')
<div class="container">
    <h1>Buat Izin</h1>
    <form action="{{ route('permissions.store') }}" method="POST">
        @csrf
        
        <div class="mb-3">
            <label for="name">Nama Izin</label>
            <input type="text" class="form-control" id="name" name="name" required>
        </div>

        <button type="submit" class="btn btn-primary">Kirim</button>
    </form>
</div>
@endsection