<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Dashboard</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
</head>

<body>

    <section class="container mt-5">
        <div class="row">
            <!-- Card Jumlah Kategori -->
            <div class="col-md-6">
                <div class="card">
                    <div class="card-body text-center">
                        <h5 class="card-title">Jumlah Kategori</h5>
                        <p class="card-text display-4">{{ $jumlahKategori }}</p>
                        <a href="{{ route('kategori.index') }}" class="btn btn-primary">Lihat Kategori</a>
                    </div>
                </div>
            </div>

            <!-- Card Jumlah Produk -->
            <div class="col-md-6">
                <div class="card">
                    <div class="card-body text-center">
                        <h5 class="card-title">Jumlah Produk</h5>
                        <p class="card-text display-4">{{ $jumlahProduk }}</p>
                        <a href="{{ route('produk.index') }}" class="btn btn-primary">Lihat Produk</a>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
</body>

</html>