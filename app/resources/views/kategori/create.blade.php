@extends('layouts.app')

@section('content')
<h1 class="h3 mb-4 text-gray-800">Tambah Kategori</h1>

<form action="{{ route('kategori.store') }}" method="POST" class="col-md-6">
    @csrf

    <div class="mb-3">
        <label for="nama" class="form-label">Nama Kategori</label>
        <input type="text" name="nama" id="nama"
               class="form-control @error('nama') is-invalid @enderror"
               value="{{ old('nama') }}" required>

        @error('nama')
            <div class="invalid-feedback">{{ $message }}</div>
        @enderror
    </div>

    <a href="{{ route('kategori.index') }}" class="btn btn-secondary">Kembali</a>
    <button type="submit" class="btn btn-success">Simpan</button>
</form>
@endsection
