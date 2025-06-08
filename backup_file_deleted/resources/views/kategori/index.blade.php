@extends('layouts.app')

@section('content')
<h1 class="h3 mb-4 text-gray-800">Daftar Kategori</h1>

{{-- Flash Message --}}
@if(session('success'))
    <div class="alert alert-success alert-dismissible fade show" role="alert">
        {{ session('success') }}
        <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
    </div>
@endif

{{-- Form Search --}}
<form method="GET" class="mb-3 row g-2">
    <div class="col-md-4">
        <input type="text" name="search" class="form-control" placeholder="Cari kategori..." value="{{ $search }}">
    </div>
    <div class="col-auto">
        <button type="submit" class="btn btn-primary"><i class="fas fa-search"></i> Cari</button>
        <a href="{{ route('kategori.index') }}" class="btn btn-secondary">Reset</a>
    </div>
</form>

<a href="{{ route('kategori.create') }}" class="btn btn-success mb-3">
    <i class="fas fa-plus"></i> Tambah Kategori
</a>


{{-- Tabel --}}
<div class="table-responsive">
    <table class="table table-bordered align-middle">
        <thead class="table-light">
            <tr>
                <th>No</th>
                <th>Nama Kategori</th>
                <th style="width: 150px">Aksi</th>
            </tr>
        </thead>
        <tbody>
            @forelse($kategori as $index => $item)
                <tr>
                    <td>{{ $kategori->firstItem() + $index }}</td>
                    <td>{{ $item->nama }}</td>
                    <td>
                        <a href="{{ route('kategori.edit', $item) }}" class="btn btn-warning btn-sm">
                            <i class="fas fa-edit"></i>
                        </a>
                        <form action="{{ route('kategori.destroy', $item) }}" method="POST" style="display:inline-block">
                            @csrf @method('DELETE')
                            <button class="btn btn-danger btn-sm" onclick="return confirm('Yakin hapus?')">
                                <i class="fas fa-trash"></i>
                            </button>
                        </form>
                    </td>
                </tr>
            @empty
                <tr><td colspan="4" class="text-center">Data tidak ditemukan</td></tr>
            @endforelse
        </tbody>
    </table>
</div>

{{-- Pagination --}}
<div class="d-flex justify-content-end">
    {{ $kategori->links() }}
</div>
@endsection
