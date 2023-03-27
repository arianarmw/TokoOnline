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

<h1 class="text-center">KERANJANG</h1>
<br>

<form method="POST" action="<?= site_url('cart/update') ?>">
    <table class="table table-striped">
        <thead>
            <tr>
                <th>Gambar</th>
                <th>Nama</th>
                <th>Harga</th>
                <th>Kuantitas <input type="submit" value="Update"></th>
                <th>Sub Total</th>
                <th>Action</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($items as $i => $item) : ?>
                <tr>
                    <td>
                        <img src="<?= $item['nama_file'] ?>" class="img-thumbnail" width="300px">
                    </td>
                    <td><?= $item['nama_barang'] ?></td>
                    <td>Rp <?= $item['harga_barang'] ?></td>
                    <td>
                        <input type="number" min="1" value="<?= $item['kuantitas'] ?>" style="width=50px" name="kuantitas[<?= $i ?>]">
                    </td>
                    <td>Rp <?= $item['harga_barang'] * $item['kuantitas'] ?></td>
                    <td align="left">
                        <a href="<?= site_url('cart/remove/' . $item['id_barang']) ?>">
                            <button type="button" class="btn btn-danger">Remove</button>
                        </a>
                    </td>
                </tr>
            <?php endforeach ?>
            <tr>
                <td colspan="5" align="right">Total</td>
                <td>Rp <?= $total ?></td>
            </tr>
        </tbody>
    </table>
</form>

<a href="<?= site_url('barang') ?>">Continue Shopping</a>