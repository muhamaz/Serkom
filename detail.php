<?php 
    require __DIR__.'/connection.php';
    require __DIR__.'/config.php';
    include_once __DIR__.'/models/Wisata.php';
    $wisata = new Wisata;
    $detail = $wisata->detail($_GET['id']);
?>
<!DOCTYPE html>
<html>
<head>
    <title>Wisata</title>

    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <link rel="stylesheet" type="text/css" href="assets/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.5.0/css/font-awesome.min.css" />
    <link rel="stylesheet" type="text/css" href="assets/css/custom.css">
    <script src="assets/js/bootstrap.min.js"></script>
    <script src="assets/js/Chart.js"></script>
</head>
<body>
    <section id="navbar">
        <header>
            <nav class="navbar navbar-expand-lg navbar-dark bg-primary shadow-sm mb-3">
                <div class="container-md">
                    <a class="navbar-brand" href="index.php">
                        <img src="assets/img/logo.png" alt="" width="40" height="40" class="d-inline-block align-text-top">
                            <span style="font-size: 16px;">Wisata Tegal</span>
                    </a>
                        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNavAltMarkup" aria-controls="navbarNavAltMarkup" aria-expanded="false" aria-label="Toggle navigation">
                            <span class="navbar-toggler-icon"></span>
                        </button>
                    <div class="collapse navbar-collapse" id="navbarNavAltMarkup">
                        <div class="navbar-nav ms-auto mx-3">
                            <a href="index.php"><button type="button" class="btn btn-secondary">Kembali</button></a>
                        </div>
                    </div>
                </div>
            </nav>
        </header>
    </section>
        
    <div class="container">
        <div class="row">
            <div class="col-md-6">
                <iframe width="600" height="400" src="<?= $detail['youtube'] ?>" title="YouTube video player" frameborder="0" allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture" allowfullscreen></iframe>
            </div>
            <div class="col-md-6">
                <div class="ms-5 d-flex justify-content-between">
                    <h4><b><?= $detail['nama_wisata'] ?></b></h4>
                    <h6>HTM : <b><?= rupiah($detail['harga']) ?></b></h6>
                </div>
                <div class="d-flex justifiy-content-center mt-5 ms-5">
                    <h5 style="text-align: justify;"><?= $detail['deskripsi']?></h5>
                </div>
                <div class="d-flex justify-content-end ms-5 mt-3">
                    <a href="pesan.php" class="p-2"><button type="button" class="btn btn-success">Pesan Tiket</button></a>
                </div>
            </div>
        </div>
    </div>
    
    <footer class="bg-primary text-center text-white py-4 mt-5">
            <h5><i class="fa fa-copyright"></i> 2022 18102168, All Right Reserved</h5>            
    </footer>

</body>
</html>