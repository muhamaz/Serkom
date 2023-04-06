<?php 
require_once __DIR__.'/../connection.php';

/**
 * class untuk mengelola data Wisata
 * 
 * Nama Tabel : wisata
 * Column : wisata_id, nama_wisata, harga, visitors, gambar, youtube, deskripsi
 * 
 * @author MHZ
 */
class Wisata {
    
    protected $table = 'wisata';

    /**
     * Memasukkan data ke database
     * 
     * @param string $nama,$gambar,$youtube, $deskripsi
     * @param integer $harga
     * 
     * @return void
     */
    public function tambahWisata($nama, $deskripsi, $harga, $gambar, $youtube,) {
        global $conn;

        $initVisitor = 0;
        $query = "INSERT INTO $this->table VALUES (
            '',
            '$nama',
            '$deskripsi',
            '$harga',
            $initVisitor,
            '$gambar',
            '$youtube'
        )";

        $conn->query($query);
    } 

    /**
     * Menampilkan semua data dalam tabel database
     * 
     * @return iterable
     */
    public function showAll() {
        global $conn;

        $query = "SELECT * FROM $this->table";
        return $conn->query($query);
    }

    /**
     * Mengambil satu baris data pada wisata berdasarkan id
     * 
     * @param integer $id
     * 
     * @return array|null
     */
    public function detail($id) {
        global $conn;

        $query = "SELECT * FROM $this->table WHERE wisata_id = $id";

        return $conn->query($query)->fetch_assoc();
    }

    /**
     * Memperbarui data yang ketika melakukan pengeditan
     * 
     * @param integer $id,$harga
     * @param string $nama,$gambar,$youtube, $deskripsi
     * 
     * @return void
     */
    public function update($id, $nama, $deskripsi, $harga, $gambar, $youtube) {
        global $conn;

        $query = "UPDATE $this->table 
        SET nama_wisata = '$nama', deskripsi = '$deskripsi', harga = $harga, gambar = '$gambar', youtube = '$youtube'
        WHERE wisata_id = $id";

        $conn->query($query);
    }

    /**
     * Menghapus data wisata
     * 
     * Menghapus data dan gambar yang berkaitan dengan fungsi unlick(), jika isi field merupakan gambar default 'noimage.jpg'
     * maka unlink() tidak dijalankan
     * 
     * @param integer $id
     * @return void
     */
    public function delete($id) {
        global $conn;
        
        $wisata = $this->detail($id);
        if($wisata['gambar'] != 'noimage.jpg') {
            unlink("assets/img/".$wisata['gambar']);
        }

        $query = "DELETE FROM $this->table WHERE wisata_id = $id";

        $conn->query($query);
    }
}