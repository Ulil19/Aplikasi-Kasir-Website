<?php

namespace App\Http\Controllers\Pemilik;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Kategori;
use App\Models\Produk;
use Illuminate\Support\Str;
use Carbon\Carbon;
use Illuminate\Support\Facades\Storage;

class ProdukController extends Controller
{

    public function index()
    {
        $kategori = Kategori::with('produk')->get();
        $produkTerhapus = Produk::onlyTrashed()->get();
        return view('pemilik.produk.index', compact('kategori', 'produkTerhapus'));
    }

    // Tambah produk baru
    public function simpan(Request $request)
    {
        $data = $request->validate([
            'nama' => 'required|string|max:255',
            'kategori_id' => 'required|exists:kategori,id',
            'deskripsi' => 'nullable|string',
            'harga' => 'required|numeric|min:0',
            'gambar' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',

        ]);

        if ($request->hasFile('gambar')) {
            $file = $request->file('gambar');

            $kategori = Kategori::find($data['kategori_id']);
            $namakategori = Str::slug($kategori->nama);

            $namaProduk = Str::slug($data['nama']);
            $tanggal = Carbon::now()->format('YmdHis');
            $ekstensi = strtolower($file->getClientOriginalExtension());

            $namaGambar = $namakategori . '-' . $namaProduk . '-' . $tanggal . '.' . $ekstensi;
            $path = $file->storeAs('produk', $namaGambar, 'public');
            $data['gambar'] = $path;

        }
        Produk::create($data);

        return redirect()->back()->with('success', 'Produk berhasil ditambahkan.');
    }

    // Edit produk
    public function update($id)
    {
        $data = request()->validate([
            'nama' => 'required|string|max:255',
            'kategori_id' => 'required|exists:kategori,id',
            'deskripsi' => 'nullable|string',
            'harga' => 'required|numeric|min:0',
            'gambar' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',

        ]);

        $produk = Produk::findOrFail($id);

        if (request()->hasFile('gambar')) {
            $file = request()->file('gambar');

            $kategori = Kategori::find($data['kategori_id']);
            $namakategori = Str::slug($kategori->nama);

            $namaProduk = Str::slug($data['nama']);
            $tanggal = Carbon::now()->format('YmdHis');
            $ekstensi = strtolower($file->getClientOriginalExtension());

            $namaGambar = $namakategori . '-' . $namaProduk . '-' . $tanggal . '.' . $ekstensi;
            $path = $file->storeAs('produk', $namaGambar, 'public');
            $data['gambar'] = $path;

            // Hapus gambar lama jika ada
            if ($produk->gambar && \Storage::disk('public')->exists($produk->gambar)) {
                \Storage::disk('public')->delete($produk->gambar);
            }
        }

        $produk->update($data);

        return redirect()->back()->with('success', 'Produk berhasil diperbarui.');
    }

    // Hapus produk
    public function hapus($id)
    {
        $produk = Produk::findOrFail($id);
        $produk->delete();

        return redirect()->back()->with('success', 'Produk berhasil dipindahkan ke tempat sampah.');
    }

    
    public function hapusPermanen($id)
    {
        
        $produk = Produk::withTrashed()->findOrFail($id);

        if ($produk->gambar) {
            if (Storage::disk('public')->exists($produk->gambar)) {
                Storage::disk('public')->delete($produk->gambar);
            }
        }

        $produk->forceDelete();

        return redirect()->back()->with('success', 'Produk berhasil dihapus permanen.');
    }

    
    public function restore($id)
    {
        $produk = Produk::withTrashed()->findOrFail($id);
        $produk->restore();

        return redirect()->back()->with('success', 'Produk berhasil dipulihkan.');
    }

}
