<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?= $title ?? "PPL" ?></title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-GLhlTQ8iRABdZLl6O3oVMWSktQOp6b7In1Zl3/Jr59b6EGGoI1aFkw7cmDA6j6gD" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <style>
        .card {
            margin: 10px;
        }
    </style>
</head>

<h1 class="text-center">CHRISTIAN ROID</h1>
<br>

<body>
    <div class="container-fluid">
        <div class="row">
            <?php foreach ($barang as $brg) : ?>
                <div class="card mx-2" style="width: 22rem;">
                    <img class="card-img-top" src="<?= $brg['nama_file'] ?>">
                    <div class="card-body">
                        <h3><?= $brg['nama_barang'] ?></h3>
                        <p4>Rp <?= number_format($brg['harga_barang'], 0, ',', '.') ?></p4>
                        <br>
                        <p5>Stok : <?= $brg['stok'] ?></p5>
                        <br><br>
                        <a href="<?= site_url('cart/buy/' . $brg['id_barang']) ?>"><button type="button" class="btn btn-success"><i class="fa fa-shopping-cart"></i> Tambah Ke Keranjang</button></a>
                    </div>
                </div>
            <?php endforeach; ?>
        </div>
    </div>

    <a href="create">
        <button type="button" class="btn btn-primary">Tambah Data</button>
    </a>

</body>