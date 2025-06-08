<?php

namespace App\Http\Controllers;

use App\Models\Inventaris;
use App\Models\Kategori;
use Illuminate\Http\Request;

class InventarisController extends Controller
{
    public function index(Request $request)
    {
        $query = Inventaris::with('kategori');

        if ($request->filled('search')) {
            $query->where('nama', 'like', '%' . $request->search . '%');
        }

        if ($request->filled('kategori_id')) {
            $query->where('kategori_id', $request->kategori_id);
        }

        $kategori = Kategori::all();
        $inventaris = $query->paginate(10);

        return view('inventaris.index', compact('inventaris', 'kategori'));
    }

    public function create()
    {
        $kategori = Kategori::all();
        return view('inventaris.create', compact('kategori'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'nama' => 'required|string|max:255',
            'deskripsi' => 'nullable|string',
            'kategori_id' => 'required|exists:kategori,id',
            'jumlah' => 'required|integer|min:0',
        ]);

        Inventaris::create($request->all());

        return redirect()->route('inventaris.index')->with('success', 'Inventaris berhasil ditambahkan.');
    }

    public function edit(Inventaris $inventari)
    {
        $kategori = Kategori::all();
        return view('inventaris.edit',[
            'inventaris' => $inventari,
            'kategori' => $kategori,
        ]);
    }

    public function update(Request $request, Inventaris $inventari)
    {
        $request->validate([
            'nama' => 'required|string|max:255',
            'deskripsi' => 'nullable|string',
            'kategori_id' => 'required|exists:kategori,id',
            'jumlah' => 'required|integer|min:0',
        ]);

        $inventari->update($request->all());

        return redirect()->route('inventaris.index')->with('success', 'Inventaris berhasil diperbarui.');
    }

    public function destroy(Inventaris $inventari)
    {
        $inventari->delete();
        return redirect()->route('inventaris.index')->with('success', 'Inventaris berhasil dihapus.');
    }

    public function bulkDelete(Request $request)
    {   
        $ids = $request->ids ?? [];
        if ($ids) {
            Inventaris::whereIn('id', $ids)->delete();
            return redirect()->route('inventaris.index')->with('success', 'Data berhasil dihapus.');
        }
        return redirect()->route('inventaris.index')->with('error','Tidak ada data yang dipilih.');
    }
}
