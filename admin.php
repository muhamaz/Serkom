<?php 
    require __DIR__.'/connection.php';
    require __DIR__.'/config.php';

    include_once __DIR__.'/models/Wisata.php';
    include_once __DIR__.'/models/Pesanan.php';

    $wisata = new Wisata;
    $pesanan = new Pesanan;

    if(isset($_POST['tambah'])) {
        if($_FILES['gambar']['size'] == 0) {
            $gambar = 'noimage.jpg';
        } else {
            $gambar = $_FILES['gambar']['name'];
            $img_path = 'assets/img/'.basename($gambar);
            move_uploaded_file($_FILES['gambar']['tmp_name'],$img_path);
        }

        $wisata->tambahWisata($_POST['nama'], $_POST['deskripsi'], $_POST['harga'], $gambar, $_POST['youtube']);
    }
    if(isset($_POST['delete'])) {
        $wisata->delete($_POST['id']);
    }
    if(isset($_POST['hapus'])) {
        $pesanan->delete($_POST['id']);
    }
    
?>

<!DOCTYPE html>
<html>
<head>
    <title>Admin</title>

    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    
    <!-- Fontawesome -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.5.0/css/font-awesome.min.css" />

    <!-- Box Icon -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/boxicons@latest/css/boxicons.min.css">

    <!-- Bootstrap Icon -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.5.0/font/bootstrap-icons.css">

    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <link rel="stylesheet" type="text/css" href="assets/css/bootstrap.min.css">
    <script src="assets/js/bootstrap.min.js"></script>

    <!-- Chart -->
    <script src="assets/js/Chart.js"></script>
    
    <!-- CSS -->
    <link rel="stylesheet" href="assets/css/style.css">
</head>
<body>
    <div class="wrapper">

        <nav id="sidebar">
            <div class="sidebar-header text-center mt-3">
                <h3>Admin</h3>
            </div>
    
            <ul class="list-unstyled components">
                <li><a href="index.php"><i class="fa fa-home fa-sm"></i> Home</a></li>
            </ul>
        </nav>

        <div id="content">
            <nav class="navbar navbar-expand-lg navbar-light bg-light">
                <div class="container-fluid">
                    <button type="button" id="sidebarCollapse" class="btn btn-danger navbar-btn">
                        <span></span>
                        <span></span>
                        <span></span>
                    </button>

                    <div class="collapse navbar-collapse" id="navbarNavAltMarkup">
                            <div class="navbar-nav ms-3">
                                <h2><i class="fa fa-user fa-md"></i> Admin</h2>
                            </div>
                            <div class="navbar-nav ms-auto">
                                <button class="btn btn-primary mx-2" data-bs-toggle="modal" data-bs-target="#exampleModal"><i class="fa fa-plus"></i> Tambah Wisata</button>
                            </div>
                            
                    </div>

                </div>
            </nav>

            <div class="row">
                <div class="d-flex justify-content-between mb-3">
                    <h3>Daftar Wisata</h3>
                </div>
                <div class="card">
                    <div class="card-header">Wisata</div>
                    <div class="card-body">
                        <table class="table">
                            <tr>
                                <th>No.</th>
                                <th>Nama Wisata</th>
                                <th>Harga Tiket</th>
                                <th>Tindakan</th>
                            </tr>
                            <?php $i=1; foreach($wisata->showAll() as $item): ?>
                            <tr>
                                <td><?= $i++ ?></td>
                                <td><?= $item['nama_wisata'] ?></td>
                                <td><?= rupiah($item['harga']) ?></td>
                                <td>
                                    <div class="d-flex">
                                        <a href="editwisata.php?id=<?= $item['wisata_id'] ?>" class="btn btn-warning mx-2"> <i class="fa fa-pencil"></i> Edit</a>
                                        <form action="" method="POST">
                                            <input type="hidden" value="<?= $item['wisata_id'] ?>" name="id">
                                            <button class="btn btn-danger" onClick="javascript: return confirm('Anda yakin ingin menghapusnya?');" type="submit" name="delete"><i class="fa fa-trash"></i> Hapus</button>
                                        </form>
                                    </div>
                                </td>
                            </tr>
                            <?php endforeach; ?>
                        </table>
                    </div>
                </div>
            </div>
            <div class="row mt-4">
                <div class="d-flex justify-content-between mb-3">
                    <h3>Data Pemesan</h3>
                </div>
                <div class="card">
                    <div class="card-header">Pemesanan</div>
                    <div class="card-body">
                        <table class="table">
                            <tr>
                                <th>No.</th>
                                <th>Tanggal Berangkat</th>
                                <th>Nama Wisata</th>
                                <th>Nama Pemesan</th>
                                <th>NIK</th>
                                <th>No Telp</th>
                                <th>Jumlah Pengunjung</th>
                                <th>Total Bayar</th>
                                <th>Tindakan</th>
                            </tr>
                            <?php $i=1; foreach($pesanan->showAll() as $item): ?>
                            <tr>
                                <td><?= $i++ ?></td>
                                <td><?= date('D, d M Y', strtotime($item['tanggal'])) ?></td>
                                <td><?= $item['nama_wisata'] ?></td>
                                <td><?= $item['nama_lengkap'] ?></td>
                                <td><?= $item['nik'] ?></td>
                                <td><?= $item['nohp'] ?></td>
                                <td><?= $item['anak']+$item['dewasa'] ?> ( <?= $item['dewasa'] ?> Dewasa, <?= $item['anak'] ?> Anak )</td>
                                <td ><?= rupiah($item['total']) ?></td>
                                <td>
                                    <form action="" method="POST">
                                        <input type="hidden" value="<?= $item['pesanan_id'] ?>" name="id">
                                        <button class="btn btn-danger" onClick="javascript: return confirm('Anda yakin ingin menghapusnya?');" type="submit" name="hapus"><i class="fa fa-trash"></i> Hapus</button>
                                    </form>
                                </td>
                            </tr>
                            <?php endforeach; ?>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="container py-4">
        
    </div>

    <!-- Modal -->
    <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-scrollable">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Tambah Wisata</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form action="" method="POST" enctype="multipart/form-data">
                        <label class="mb-2">Nama Wisata</label>
                        <input class="form-control mb-4" type="text" name="nama" required>

                        <label class="mb-2">Harga</label>
                        <input class="form-control mb-4" type="number" name="harga" required>

                        <label class="mb-2">Gambar</label>
                        <input class="form-control mb-4" type="file" name="gambar" required>

                        <label class="mb-2">Youtube</label>
                        <input class="form-control mb-4" type="text" name="youtube">

                        <label class="mb-2">Deskripsi</label>
                        <textarea class="form-control mb-4" name="deskripsi" rows="3"></textarea>
                        <button type="submit" class="btn btn-primary" name='tambah'>Simpan</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
    

    <!-- jQuery CDN - Slim version (=without AJAX) -->
    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
    <!--Bootstrap Bundle with Popper -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>
        
    <script type="text/javascript" src="assets/js/script.js"></script>
</body>
</html>