<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Kategori extends Model
{
    use HasFactory;

    // Tentukan tabel jika nama tabel berbeda
    protected $table = 'kategoris';

    // Kolom yang boleh diisi (mass-assignable)
    protected $fillable = ['nama_kategori'];

    /**
     * Relasi One-to-Many dengan Produk
     * Satu Kategori memiliki banyak Produk
     */
    public function produk()
    {
        return $this->hasMany(Produk::class, 'kategori_id', 'id');
    }
}
