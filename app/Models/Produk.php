<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Produk extends Model
{
    use HasFactory;

    // Tentukan tabel jika nama tabel berbeda
    protected $table = 'produks';

    // Kolom yang boleh diisi (mass-assignable)
    protected $fillable = [
        'nama_produk',
        'kategori_id',
        'deskripsi',
        'gambar',
    ];

    /**
     * Relasi Many-to-One dengan Kategori
     * Satu Produk dimiliki oleh satu Kategori
     */
    public function kategori()
    {
        return $this->belongsTo(Kategori::class, 'kategori_id', 'id');
    }
}
