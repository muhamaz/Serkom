<?php 
    require __DIR__.'/connection.php';
    require __DIR__.'/config.php';
    include_once __DIR__.'/models/Wisata.php';
    $wisata = new Wisata;
?>

<!DOCTYPE html>
<html>
<head>
    <title>Wisata Tegal</title>

    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <link rel="stylesheet" type="text/css" href="assets/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.5.0/css/font-awesome.min.css" />
    <link rel="stylesheet" type="text/css" href="assets/css/custom.css">
    <script src="assets/js/bootstrap.min.js"></script>
    <script src="assets/js/Chart.js"></script>
</head>
<body>
    <section id="home">
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
                            <a class="nav-link" href="#home">Home</a>
                            <a class="nav-link" href="#wisata">Wisata</a>
                            <a class="nav-link" href="#grafik"> Grafik</a>
                            <a class="nav-link" href="#alamat"> Tentang</a>
                        </div>
                    </div>
                </div>
            </nav>
        </header>
    </section>
    

    <div class="container-md">

        <section id="wisata">
            <div class="row">
                <div class="text-center mx-auto my-3">
                    <h3 class="mb-4">Wisata Tegal</h3>
                    <p class="text-center">Wisata Tegal merupakan Website yang berguna untuk mencari dan memesan tiket tempat wisata yang ada di Tegal sehingga dapat memudahkan mencari lokasi tujuan wisata terdekat.</p>
                </div>
            </div>
            <div class="row baris">
                <?php 
                foreach($wisata->showAll() as $value) {
                ?>
                <div class="col-md-4">
                    <div class="card" style="width: 20rem;">
                        <img src="assets/img/<?= $value['gambar'] ?>" class="card-img-top" alt="...">
                        <div class="card-body">
                            <h5 class="card-title"><a class="link-dark stretched-link" href="detail.php?id=<?= $value['wisata_id'] ?>"><?= $value['nama_wisata'] ?></a></h5>
                            <hr>
                            <small>Harga Tiket</small>
                            <h4 class="card-text"><b><?= rupiah($value['harga']) ?></b></h4>
                        </div>
                    </div>
                </div>
                <?php } ?>
            </div>
        </section>

        <section id="grafik">
            <div class="row mt-5 text-center">
                <h3 class="mb-3">Grafik Jumlah Pengunjung</h3>
                <canvas id="myChart" class="mb-4"></canvas>
            </div>
        </section>

        <section id="alamat">
            <div class="container">
                <div class="row text-center my-5">
                    <h3>Tentang Kami</h3>
                </div>
                <div class="row">
                    <div class="col-md-6">
                        <iframe width="420" height="240" src="https://www.youtube.com/embed/J18_8PL315I" title="YouTube video player" frameborder="0" allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture" allowfullscreen></iframe>
                    </div>
                    <div class="col-md-6">
                        <ul style="list-style-type: none;" class="mx-2">
                            <li>		
                                <i class="fa fa-map-marker fa-2x" aria-hidden="true"style="color:#00436b"></i>
                                <span> Jl. Ki Gede Sebayu No. 12 Tegal,Jawa Tengah</span>
                            </li>
                            <li>	
                                <i class="fa fa-phone fa-2x" aria-hidden="true"style="color:#00436b"></i>
                                <span> 0283 355137</span>
                            </li>
                            <li>	
                                <i class="fa fa-envelope fa-2x" aria-hidden="true"style="color:#00436b"></i>
                                <span> 18102168@ittelkom-pwt.ac.id</span>
                            </li>
                        </ul>
                    </div>
                </div>
            </div>
        </section>

    </div>
    <footer class="bg-primary text-center text-white py-4 mt-5">
            <h5><i class="fa fa-copyright"></i> 2022 18102168, All Right Reserved</h5>            
    </footer>


    <script>
        const ctx = document.getElementById('myChart').getContext('2d');
        const myChart = new Chart(ctx, {
            type: 'bar',
            data: {
                labels: [<?php foreach($wisata->showAll() as $item) { echo '"'. $item['nama_wisata'].'"'.','; } ?>],
                datasets: [{
                    label: 'Jumlah Pengunjung',
                    data: [<?php foreach($wisata->showAll() as $item) { echo '"'. $item['visitors'].'"'.','; } ?>],
                    backgroundColor: [
                        'rgba(255, 99, 132, 0.2)',
                        'rgba(54, 162, 235, 0.2)',
                        'rgba(255, 206, 86, 0.2)',
                        'rgba(75, 192, 192, 0.2)',
                        'rgba(153, 102, 255, 0.2)',
                        'rgba(255, 159, 64, 0.2)'
                    ],
                    borderColor: [
                        'rgba(255, 99, 132, 1)',
                        'rgba(54, 162, 235, 1)',
                        'rgba(255, 206, 86, 1)',
                        'rgba(75, 192, 192, 1)',
                        'rgba(153, 102, 255, 1)',
                        'rgba(255, 159, 64, 1)'
                    ],
                    borderWidth: 1
                }]
            },
            options: {
                scales: {
                    y: {
                        beginAtZero: true
                    }
                }
            }
        });
    </script>
</body>
</html>