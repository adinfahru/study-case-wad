#### 1. Buat model kategori dan produk

```bash 
php artisan make:model Kategori -m
php artisan make:model Produk -m
```

#### 2. Buat migrasi kategori dan produk
#### 3. Jalankan migrasi database

```bash 
php artisan migrate
```

#### 4. Buat Controller

```bash 
php artisan make:controller KategoriController --resource
php artisan make:controller ProdukController --resource
php artisan make:controller DashboardController
```

#### 5. Buat routing di routes/web.php
#### 6. Konfigurasi storage agar image terbaca

```bash 
php artisan storage:link
```

#### 7. Buat masing masing view

```
|-views
│ |--kategori
│   ├── create.blade.php
│   ├── edit.blade.php
│   ├── index.blade.php
| |--produk
│   ├── create.blade.php
│   ├── edit.blade.php
│   ├── index.blade.php
│ |--dashboard.blade.php
```