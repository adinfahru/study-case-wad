<?php

namespace App\Http\Controllers;

use App\Models\Produk;
use App\Models\Kategori;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class ProdukController extends Controller
{
    // Tampilkan daftar produk
    public function index()
    {
        $produks = Produk::with('kategori')->get(); // Mengambil produk beserta kategori
        return view('produk.index', compact('produks'));
    }

    // Tampilkan form tambah produk
    public function create()
    {
        $kategoris = Kategori::all(); // Ambil semua kategori untuk dropdown
        return view('produk.create', compact('kategoris'));
    }

    // Simpan data produk baru
    public function store(Request $request)
    {
        $request->validate([
            'nama_produk' => 'required|string|max:255',
            'kategori_id' => 'required|exists:kategoris,id', // Validasi relasi
            'deskripsi' => 'nullable|string',
            'gambar' => 'nullable|image|mimes:jpeg,png,jpg|max:2048', // Validasi gambar
        ]);

        $input = $request->all();

        // Jika ada gambar yang diunggah
        if ($file = $request->file('gambar')) {
            $path = $file->store('images', 'public'); // Simpan gambar di storage/public/images
            $input['gambar'] = $path;
        }

        Produk::create($input);

        return redirect()->route('produk.index')->with('success', 'Produk berhasil ditambahkan.');
    }

    // Tampilkan form edit produk
    public function edit(Produk $produk)
    {
        $kategoris = Kategori::all(); // Ambil semua kategori untuk dropdown
        return view('produk.edit', compact('produk', 'kategoris'));
    }

    // Perbarui data produk
    public function update(Request $request, Produk $produk)
    {
        $request->validate([
            'nama_produk' => 'required|string|max:255',
            'kategori_id' => 'required|exists:kategoris,id',
            'deskripsi' => 'nullable|string',
            'gambar' => 'nullable|image|mimes:jpeg,png,jpg|max:2048',
        ]);

        $input = $request->all();

        // Jika ada gambar baru yang diunggah
        if ($file = $request->file('gambar')) {
            $path = $file->store('images', 'public');
            $input['gambar'] = $path;

            // Hapus gambar lama jika ada
            if ($produk->gambar && Storage::exists('public/' . $produk->gambar)) {
                Storage::delete('public/' . $produk->gambar);
            }
        }

        $produk->update($input);

        return redirect()->route('produk.index')->with('success', 'Produk berhasil diperbarui.');
    }

    // Hapus produk
    public function destroy(Produk $produk)
    {
        // Hapus gambar lama jika ada
        if ($produk->gambar && Storage::exists('public/' . $produk->gambar)) {
            Storage::delete('public/' . $produk->gambar);
        }

        $produk->delete();

        return redirect()->route('produk.index')->with('success', 'Produk berhasil dihapus.');
    }
}
