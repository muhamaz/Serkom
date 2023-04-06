<?php 
    require __DIR__.'/connection.php';
    require __DIR__.'/config.php';

    include_once __DIR__.'/models/Pesanan.php';

    $pesanan = new Pesanan;
    $result = $pesanan->showResult();
?>
<!DOCTYPE html>
<html>
    <head>
        <title>Rincian Pesanan</title>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <link rel="stylesheet" type="text/css" href="assets/css/bootstrap.min.css">
        <link rel="stylesheet" type="text/css" href="assets/css/custom.css">
        <script src="assets/js/bootstrap.min.js"></script>
    </head>
    <body>
        <div class="container">
            <div class="row py-4">
                <div class="alert alert-success">Pesanan Anda berhasil dikirim.</div>
                <div class="card shadow">
                    <div class="card-header">Detail Pesanan</div>
                    <div class="card-body">
                        <table class="table mb-4">
                            <tr>
                                <td><b>Nama Pemesan</b></td>
                                <td><?= $result['nama_lengkap'] ?></td>
                            </tr>
                            <tr>
                                <td><b>No. Identitas</b></td>
                                <td><?= $result['nik'] ?></td>
                            </tr>
                            <tr>
                                <td><b>No. HP</b></td>
                                <td><?= $result['nohp'] ?></td>
                            </tr>
                        </table>
                        <table class="table">
                            <tr>
                                <td class="text-center bg-success text-white" colspan="3"><h5><b><?= $result['nama_wisata'] ?> | <?= rupiah($result['harga']) ?></b></h5></td>
                            </tr>
                            <tr>
                                <td class="text-center" colspan="3"><b>Tanggal Kunjungan <?= date('D, d M Y', strtotime($result['tanggal'])) ?></b></td>
                            </tr>
                            <tr>
                                <td><b>Dewasa</b></td>
                                <td><b>Anak</b></td>
                                <td><b>Total</b></td>
                            </tr>
                            <tr>
                                <td><?= $result['dewasa'] ?> Orang x <?= rupiah($result['harga']) ?></td>
                                <td><?= $result['anak'] ?> Orang x <?= rupiah($result['harga'] - $result['harga']/2) ?></td>
                                <td><b><?= rupiah($result['total']) ?></b></td>
                            </tr>
                        </table>
                    </div>
                    <div class="card-footer">
                        <a class="btn btn-danger" href="index.php" style="float: right;">Kembali ke Halaman Utama</a>
                    </div>
                </div>
            </div>
        </div>
    </body>
</html>

