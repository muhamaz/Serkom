<?php 
    require __DIR__.'/connection.php';
    require __DIR__.'/config.php';

    include_once __DIR__.'/models/Wisata.php';
    include_once __DIR__.'/models/Pesanan.php';

    $wisata = new Wisata;
    $pesanan = new Pesanan;

    if(isset($_POST['simpan'])) {
        $explodeValues = explode("|", $_POST['wisata']);
        $wisata_id = $explodeValues[1];
        
        $pesanan->createPesanan(
            $_POST['nama_lengkap'],
            $_POST['nik'],
            $_POST['nohp'],
            $wisata_id,
            $_POST['tanggal'],
            $_POST['dewasa'],
            $_POST['anak'],
            $_POST['total']
        );

        header('Location:hasil.php');
    }
?>
<!DOCTYPE html>
<html>
<head>
    <title>Pesan Tiket</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.5.0/css/font-awesome.min.css" />
    <link rel="stylesheet" type="text/css" href="assets/css/bootstrap.min.css">
    <link rel="stylesheet" type="text/css" href="assets/css/custom.css">
    <script src="assets/js/bootstrap.min.js"></script>
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
                            <a class="nav-link" href="index.php"><button type="button" class="btn btn-secondary"> <i class="fa fa-home" ></i> Home</button></a>
                        </div>
                    </div>
                </div>
            </nav>
        </header>
    </section>
    <div class="container py-4">
        <div class="row">
            <div class="card mx-auto py-4 shadow">
                <h4 class="mb-4 text-center"><b>Form Pemesanan Tiket</b></h4>
                <form action="" method="POST">
                    <div class="mb-3">
                        <label for="nama_lengkap" class="form-label">Nama Lengkap</label>
                        <input type="text" name="nama_lengkap" class="form-control" required>
                    </div>
                    <div class="mb-3">
                        <label for="nik" class="form-label">Nomor Identitas</label>
                        <input type="number" name="nik" class="form-control" required>
                    </div>
                    <div class="mb-3">
                        <label for="nohp" class="form-label">No. HP</label>
                        <input type="number" name="nohp" class="form-control" required>
                    </div>
                    
                    <div class="form-floating">
                        <select name="wisata" id="wisata" class="form-control" required>
                            <?php foreach($wisata->showAll() as $item): ?>
                            <option value="<?= $item['harga'] ?>|<?= $item['wisata_id'] ?>">
                                <?= $item['nama_wisata'] ?> --> <?= rupiah($item['harga']) ?>
                            </option>
                            <?php endforeach ?>
                        </select><br>
                        <label for="wisata" class="form-label">Nama Wisata</label>
                    </div>

                    <div class="mb-3">
                        <label for="tanggal" class="form-label">Tanggal</label>
                        <input type="date" name="tanggal" class="form-control" required>
                    </div>
                    <div class="mb-3">
                        <label for="dewasa" class="form-label">Dewasa</label>
                        <input type="number" name="dewasa" id="dewasa" class="form-control" required>
                    </div>
                    <div class="mb-3">
                        <label for="anak" class="form-label" aria-describedby="ket">Anak</label>
                        <div id="ket" class="form-text">Usia 12 Tahun Ke bawah</div>
                        <input type="number" name="anak" id="anak" class="form-control" required>
                    </div>
                    <div class="mb-3">
                        <label for="total" class="form-label">Total</label>
                        <input type="number" name="total" id="total" class="form-control"required>
                    </div>
                    <div class="form-check mb-3">
							<input class="form-check-input" type="checkbox" value="" id="ceklis">
							<label class="form-check-label" for="flexCheckDefault">
								Saya dan atau rombongan telah membaca, memahami, dan setuju bedasarkan syarat dan ketentuan yang telah ditetapkan
							</label>
					</div>
                    <div class="form-group">
                        <div class="col-sm-offset-3 col-sm-9">
                            <button class="btn btn-success" type="submit" id="cekpesan" disabled name="simpan"><i class="fa fa-shopping-cart"></i> Pesan Sekarang</button>
                            <button class="btn btn-warning" type="button" onclick="hitungTotal()"><i class="fa fa-money"></i> Hitung Total</button>
                            <a class="btn btn-secondary" href="index.php">Batal</a>
                        </div>
                    </div>
                </form>  
            </div>
        </div>
    </div>

    <footer class="bg-primary text-center text-white py-4 mt-5">
            <h5><i class="fa fa-copyright"></i> 2022 18102168, All Right Reserved</h5>            
    </footer>

    <script src="http://code.jquery.com/jquery.min.js" type="text/javascript"></script>

    <script type="text/javascript">
        function hitungTotal() {
            var value = document.getElementById('wisata').value;
            const split = value.split("|");
            let harga = parseInt(split[0]);

            var dewasa = document.getElementById('dewasa').value;
            var anak = document.getElementById('anak').value;

            var total = (harga*dewasa)+((harga/2)*anak);
            
            document.getElementById('total').value = total
        }
    </script>

    <script>
        const disableCheckBox = document.getElementById("ceklis");
        const submitButton = document.getElementById("cekpesan");
        disableCheckBox.addEventListener("change", (e) => {
            if (e.target.checked) {
                submitButton.disabled = false;
            } else {
                submitButton.disabled = true;
            }
        });
    </script>
</body>
</html>