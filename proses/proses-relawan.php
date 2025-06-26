<?php 

require_once (__DIR__.'/../config/koneksi.php');

class relawan {
    private $db;
    public function __construct(){
        $database = new database();
        $this->db = $database->connect;
    } 

    public function tambah($nama, $jenis_kelamin, $no_hp, $alamat){
        $sql = "INSERT INTO relawan(nama_relawan, jenis_kelamin, no_hp, alamat) values ('$nama', '$jenis_kelamin', '$no_hp','$alamat')";

        error_log("SQL : ". $sql);
        return mysqli_query($this->db, $sql);
    }

    public function tampil(){
        $data = mysqli_query($this->db, "SELECT * FROM relawan");
        return mysqli_fetch_all($data, MYSQLI_ASSOC); 
    } 

    public function edit($id, $nama, $jk, $no_hp, $alamat) {
        $sql = "UPDATE relawan SET 
                nama_relawan = '$nama', 
                jenis_kelamin = '$jk', 
                no_hp = '$no_hp', 
                alamat = '$alamat' 
                WHERE id_relawan = $id";
        return mysqli_query($this->db, $sql);
    }
    
    public function cari($id){
        $data = mysqli_query($this->db,"SELECT * FROM relawan WHERE id_relawan = '$id'");
        return mysqli_fetch_assoc($data);
    }

    public function hapus($id) {
        $sql = "DELETE FROM relawan WHERE id_relawan = '$id'";
        return mysqli_query($this->db, $sql);
    }
}

?>