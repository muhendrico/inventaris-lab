@extends('layouts.app')

@section('content')
<h1 class="h3 mb-4 text-gray-800">Daftar Inventaris</h1>

{{-- Flash message --}}
@if(session('success'))
    <div class="alert alert-success alert-dismissible fade show" role="alert">
        {{ session('success') }}
        <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
    </div>
@endif
@if(session('error'))
    <div class="alert alert-danger alert-dismissible fade show" role="alert">
        {{ session('error') }}
        <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
    </div>
@endif

{{-- Filter --}}
<form method="GET" class="row g-2 mb-4">
    <div class="col-md-4">
        <input type="text" name="search" class="form-control"
               placeholder="Cari nama…" value="{{ request('search') }}">
    </div>
    <div class="col-md-3">
        <select name="kategori_id" class="form-select">
            <option value="">Semua Kategori</option>
            @foreach($kategori as $k)
                <option value="{{ $k->id }}" {{ request('kategori_id') == $k->id ? 'selected' : '' }}>
                    {{ $k->nama }}
                </option>
            @endforeach
        </select>
    </div>
    <div class="col-auto">
        <button class="btn btn-primary"><i class="fas fa-filter"></i> Filter</button>
        <a href="{{ route('inventaris.index') }}" class="btn btn-secondary">Reset</a>
    </div>
</form>

{{-- Form gabungan tombol hapus dan tabel --}}
<form method="POST" action="{{ route('inventaris.bulk-delete') }}">
    @csrf
    @method('DELETE')

    <div class="d-flex justify-content-between mb-3">
        <a href="{{ route('inventaris.create') }}" class="btn btn-success">
            <i class="fas fa-plus"></i> Tambah Inventaris
        </a>
        <button type="submit" class="btn btn-danger" onclick="return confirm('Yakin ingin menghapus data terpilih?')">
            <i class="fas fa-trash"></i> Hapus yang Dipilih
        </button>
    </div>

    <div class="table-responsive">
        <table class="table table-bordered align-middle">
            <thead class="table-light">
                <tr>
                    <th style="width:45px">
                        <input type="checkbox" id="selectAll">
                    </th>
                    <th>Nama</th>
                    <th>Kategori</th>
                    <th class="text-center" style="width:110px">Jumlah</th>
                    <th class="text-center" style="width:150px">Aksi</th>
                </tr>
            </thead>
            <tbody>
                @forelse($inventaris as $item)
                    <tr>
                        <td>
                            <input type="checkbox" name="ids[]" value="{{ $item->id }}">
                        </td>
                        <td>{{ $item->nama }}</td>
                        <td>{{ $item->kategori->nama }}</td>
                        <td class="text-center">{{ $item->jumlah }}</td>
                        <td class="text-center">
                            <a href="{{ route('inventaris.edit', $item) }}" class="btn btn-warning btn-sm">
                                <i class="fas fa-edit"></i>
                            </a>
                            <form method="POST" action="{{ route('inventaris.destroy', $item) }}"
                                  style="display:inline-block">
                                @csrf @method('DELETE')
                                <button class="btn btn-danger btn-sm"
                                        onclick="return confirm('Yakin hapus?')">
                                    <i class="fas fa-trash"></i>
                                </button>
                            </form>
                        </td>
                    </tr>
                @empty
                    <tr><td colspan="5" class="text-center">Tidak ada data</td></tr>
                @endforelse
            </tbody>
        </table>
    </div>
</form>

{{-- Pagination --}}
<div class="d-flex justify-content-end">
    {{ $inventaris->withQueryString()->links() }}
</div>

{{-- Script centang semua --}}
@push('scripts')
<script>
    document.getElementById('selectAll').addEventListener('click', e => {
        document.querySelectorAll('input[name="ids[]"]').forEach(cb => cb.checked = e.target.checked);
    });
</script>
@endpush
@endsection
