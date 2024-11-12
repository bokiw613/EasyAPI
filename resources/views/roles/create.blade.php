@extends('layouts.app')

@section('content')
<div class="container">
    <h1>Buat Peran</h1>
    <form action="{{ route('roles.store')}}" method="POST">
        @csrf

        <div class="mb-3">
            <label for="name" >Nama Peran</label>
            <input type="text" class="form-control" id="name" name="name" required>
        </div>

        <div class="form-group">
            <label for="permissions">Izin</label>
            @foreach ($permissions as $permission)
                <div class="form-check">
                    <input type="checkbox" class="form-check-input" id="permission_{{ $permission->id }}" name="permission[]" value="{{ $permission->name }}">
                    <label class="form-check-label" for="permission_{{ $permission->id }}">{{ $permission->name }}</label>
                </div>
            @endforeach
        </div>
        <button type="submit" class="btn btn-primary">Kirim</button>
    </form>
</div>
    
@endsection