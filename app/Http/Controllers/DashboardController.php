<?php

namespace App\Http\Controllers;

use App\Models\Kategori;
use App\Models\Produk;

class DashboardController extends Controller
{
    public function index()
    {
        // Hitung jumlah kategori dan produk
        $jumlahKategori = Kategori::count();
        $jumlahProduk = Produk::count();

        // Tampilkan view dashboard
        return view('dashboard', compact('jumlahKategori', 'jumlahProduk'));
    }
}
