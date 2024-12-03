<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\KategoriController;
use App\Http\Controllers\ProdukController;
use App\Http\Controllers\DashboardController;


Route::get('/', [DashboardController::class, 'index'])->name('dashboard');
// Route::resource('kategori', KategoriController::class);
// Route::resource('produk', ProdukController::class);

// Route untuk kategori
Route::get('/kategori', [KategoriController::class, 'index'])->name('kategori.index'); // Menampilkan daftar kategori
Route::get('/kategori/create', [KategoriController::class, 'create'])->name('kategori.create'); // Form tambah kategori
Route::post('/kategori', [KategoriController::class, 'store'])->name('kategori.store'); // Proses tambah kategori
Route::get('/kategori/{kategori}', [KategoriController::class, 'show'])->name('kategori.show'); // Menampilkan detail kategori
Route::get('/kategori/{kategori}/edit', [KategoriController::class, 'edit'])->name('kategori.edit'); // Form edit kategori
Route::put('/kategori/{kategori}', [KategoriController::class, 'update'])->name('kategori.update'); // Proses edit kategori
Route::delete('/kategori/{kategori}', [KategoriController::class, 'destroy'])->name('kategori.destroy'); // Menghapus kategori

// Route untuk produk
Route::get('/produk', [ProdukController::class, 'index'])->name('produk.index'); // Menampilkan daftar produk
Route::get('/produk/create', [ProdukController::class, 'create'])->name('produk.create'); // Form tambah produk
Route::post('/produk', [ProdukController::class, 'store'])->name('produk.store'); // Proses tambah produk
Route::get('/produk/{produk}', [ProdukController::class, 'show'])->name('produk.show'); // Menampilkan detail produk
Route::get('/produk/{produk}/edit', [ProdukController::class, 'edit'])->name('produk.edit'); // Form edit produk
Route::put('/produk/{produk}', [ProdukController::class, 'update'])->name('produk.update'); // Proses edit produk
Route::delete('/produk/{produk}', [ProdukController::class, 'destroy'])->name('produk.destroy'); // Menghapus produk
