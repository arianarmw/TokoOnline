<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?= $title ?? "PPL" ?></title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-GLhlTQ8iRABdZLl6O3oVMWSktQOp6b7In1Zl3/Jr59b6EGGoI1aFkw7cmDA6j6gD" crossorigin="anonymous">
    <style>
        .card {
            margin: 10px;
        }
    </style>
</head>

<h1 class="text-center">Tambah Data</h1>
<section id="form-barang-store">
    <?php
    if (isset($errors)) {
        echo '<div style="width: 300px"; border-radius: 5px; >';
        echo '<ul style="background-color: red; color: white; padding: 10px;">';
        foreach ($errors as $error) {
            echo "<li>$error</li>";
        }
        echo '</ul>';
        echo '</div>';
    }
    ?>

    <?= form_open('/store'); ?>

    <form>
        <div class="form-group row mx-auto center">
            <label for="nama_barang" class="col-sm-1 col-form-label">Nama Barang</label>
            <div class="col-sm-10">
                <input type="text" name="nama_barang" id="nama_barang" value="<?= set_value('nama_barang') ?>">
            </div>
        </div>
        <div class="form-group row mx-auto">
            <label for="harga_barang" class="col-sm-1 col-form-label">Harga Barang</label>
            <div class="col-sm-10">
                <input type="text" name="harga_barang" id="harga_barang" value="<?= set_value('harga_barang') ?>">
            </div>
        </div>
        <div class="form-group row mx-auto">
            <label for="stok" class="col-sm-1 col-form-label">Stok</label>
            <div class="col-sm-10">
                <input type="text" name="stok" id="stok" value="<?= set_value('stok') ?>">
            </div>
        </div>
        <div class="form-group row mx-auto">
            <label for="nama_file" class="col-sm-1 col-form-label">Gambar</label>
            <div class="col-sm-10">
                <input type="text" name="nama_file" id="nama_file" value="<?= set_value('nama_file') ?>">
            </div>
        </div>
        <div class="form-group row mx-auto">
            <div class="col-sm-10">
                <button type="submit" class="btn btn-primary">Tambah</button>
            </div>
        </div>
    </form>

    <?= form_close(); ?>
</section>