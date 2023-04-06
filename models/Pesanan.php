<?php 
require_once __DIR__.'/../connection.php';

/**
 * class untuk mengelola data pesanan
 * 
 * Nama Tabel : pesanan
 * Column : pesanan_id, nama_lengkap, nik, nohp, wisata_id, tanggal, dewasa, anak, total
 * 
 * @author MHZ
*/
class Pesanan {

    protected $table = 'pesanan';

    /**
     * Memasukkan data pesanan ke tabel
     * 
     * @param string $nama,$nik,$nohp,$tanggal
     * @param integer $wisata_id,$dewasa,$anak,$total
     * 
     * @return void
     */
    public function createPesanan($nama, $nik, $nohp, $wisata_id, $tanggal, $dewasa, $anak, $total) {
        global $conn;

        $query = "INSERT INTO $this->table VALUES (
            '',
            '$nama',
            '$nik',
            '$nohp',
            '$wisata_id',
            '$tanggal',
            '$dewasa',
            '$anak',
            $total
        )";

        $updateVisitors = "UPDATE wisata SET visitors = visitors"."+".($dewasa+$anak)." WHERE wisata_id = ".$wisata_id;
        $conn->query($query);
        $conn->query($updateVisitors);
    }

    /**
     * Menampilkan data terakhir dari tabel pesanan, digunakan untuk tampilan setelah melakukan pemesanan
     * 
     * @return array|null
     */
    public function showResult() {
        global $conn;

        $query = "SELECT * FROM $this->table
        LEFT JOIN wisata ON pesanan.wisata_id = wisata.wisata_id
        ORDER BY pesanan_id DESC
        LIMIT 1
        ";

        return $conn->query($query)->fetch_assoc();
    }

    /**
     * Menampilkan semua data dari pesanan dan nama dari wisata,
     * nama wisata dari pesanan diambil dengan cara JOIN dua tabel
     * 
     * @return iterable
     */
    public function showAll() {
        global $conn;

        $query = "SELECT * FROM $this->table
        LEFT JOIN wisata ON pesanan.wisata_id = wisata.wisata_id
        ";

        return $conn->query($query);
    }


    public function detail($id) {
        global $conn;

        $query = "SELECT * FROM $this->table WHERE pesanan_id = $id";

        return $conn->query($query)->fetch_assoc();
    }

    public function delete($id) {
        global $conn;

        $query = "DELETE FROM $this->table WHERE pesanan_id = $id";

        $conn->query($query);
    }
}