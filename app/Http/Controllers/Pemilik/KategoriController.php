<?php

namespace App\Http\Controllers\Pemilik;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Kategori;

class KategoriController extends Controller
{

    public function index()
    {
        $kategori = Kategori::all();
        return view('pemilik.kategori.index', compact('kategori'));
    }

    //
    public function simpan()
    {
        $data = request()->validate([
            'nama' => 'required|string|max:255',
            'deskripsi' => 'nullable|string|max:255',
        ]);

        Kategori::create($data);
        return redirect()->route('pemilik.kategori')->with('success', 'Kategori berhasil ditambahkan.');
    }

    // Edit produk
    public function update($id)
    {
        $kategori = Kategori::findOrFail($id);

        $data = request()->validate([
            'nama' => 'required|string|max:255',
            'deskripsi' => 'nullable|string|max:255',
        ]);

        $kategori->update($data);
        return redirect()->route('pemilik.kategori')->with('success', 'Kategori berhasil diperbarui.');
    }

    // Hapus produk
    public function hapus($id)
    {
        $kategori = Kategori::findOrFail($id);
        $kategori->delete();
        return redirect()->route('pemilik.kategori')->with('success', 'Kategori berhasil dihapus.');
    }

}
