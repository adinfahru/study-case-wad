# Buat model kategori dan produk

```bash 
php artisan make:model Kategori -m
php artisan make:model Produk -m
```

```bash 
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
```

```bash
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
```


# Buat migrasi kategori dan produk

```bash 
public function up()
{
    Schema::create('kategoris', function (Blueprint $table) {
        $table->id();
        $table->string('nama_kategori');
        $table->timestamps();
    });
}
```

```bash
public function up()
{
    Schema::create('produks', function (Blueprint $table) {
        $table->id();
        $table->string('nama_produk');
        $table->text('deskripsi')->nullable();
        $table->string('gambar')->nullable();
        $table->foreignId('kategori_id')->constrained('kategoris')->onDelete('cascade');
        $table->timestamps();
    });
}
```

# Jalankan migrasi database

```bash 
php artisan migrate
```

# Buat Controller dan Resource Route

```bash 
php artisan make:controller KategoriController --resource
php artisan make:controller ProdukController --resource
```

# KategoriController

```bash 
<?php

namespace App\Http\Controllers;

use App\Models\Kategori;
use Illuminate\Http\Request;

class KategoriController extends Controller
{
    public function index()
    {
        $kategoris = Kategori::all();
        return view('kategori.index', compact('kategoris'));
    }

    public function create()
    {
        return view('kategori.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'nama_kategori' => 'required',
        ]);

        Kategori::create($request->all());
        return redirect()->route('kategori.index')->with('success', 'Kategori berhasil ditambahkan.');
    }

    public function edit(Kategori $kategori)
    {
        return view('kategori.edit', compact('kategori'));
    }

    public function update(Request $request, Kategori $kategori)
    {
        $request->validate([
            'nama_kategori' => 'required',
        ]);

        $kategori->update($request->all());
        return redirect()->route('kategori.index')->with('success', 'Kategori berhasil diperbarui.');
    }

    public function destroy(Kategori $kategori)
    {
        $kategori->delete();
        return redirect()->route('kategori.index')->with('success', 'Kategori berhasil dihapus.');
    }
}
```

# ProdukController

```bash 
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
```

# View Kategori Index 

```bash 

```

# View Kategori Create 

```bash 

```

# View Kategori Edit 

```bash 

```

# View Produk Index 

```bash 

```

# View Produk Create 

```bash 

```

# View Produk Edit 

```bash 

```