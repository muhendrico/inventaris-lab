@extends('layouts.app')

@section('content')
<h1 class="h3 mb-4 text-gray-800">Tambah Inventaris</h1>

<form method="POST" action="{{ route('inventaris.store') }}">
    @csrf
    <div class="mb-3">
        <label for="nama" class="form-label">Nama Inventaris</label>
        <input type="text" name="nama" class="form-control" id="nama" value="{{ old('nama') }}">
        @error('nama') <div class="text-danger small">{{ $message }}</div> @enderror
    </div>

    <div class="mb-3">
        <label for="kategori_id" class="form-label">Kategori</label>
        <select name="kategori_id" class="form-select" id="kategori_id">
            <option value="">Pilih Kategori</option>
            @foreach($kategori as $k)
                <option value="{{ $k->id }}" {{ old('kategori_id') == $k->id ? 'selected' : '' }}>
                    {{ $k->nama }}
                </option>
            @endforeach
        </select>
        @error('kategori_id') <div class="text-danger small">{{ $message }}</div> @enderror
    </div>

    <div class="mb-3">
        <label for="jumlah" class="form-label">Jumlah</label>
        <input type="number" name="jumlah" class="form-control" id="jumlah" value="{{ old('jumlah') }}">
        @error('jumlah') <div class="text-danger small">{{ $message }}</div> @enderror
    </div>

    <a href="{{ route('inventaris.index') }}" class="btn btn-secondary">Kembali</a>
    <button type="submit" class="btn btn-primary">Simpan</button>
</form>
@endsection
