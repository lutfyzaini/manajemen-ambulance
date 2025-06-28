<?php 
    require_once('/../config/koneksi.php'); 

    class pelayanan{
        private $db;
        function __construct(){
           $database = new database();
           $this-> db = $database->connect;
        }

    function tampil(){
        $data = mysqli_query($this->db ,"SELECT * pelayanan");
        return mysqli_fetch_all($data, MYSQLI_ASSOC);
    }

    function tambah($tanggal, $id_relawan, $id_armada, $id_pasien, $dari_lokasi, $ke_lokasi, $jenis_pelayanan, $keterangan){
        $sql = "INSERT INTO pelayanan(tanggal, id_relawan, id_armada, id_pasien, dari_lokasi, ke_lokasi, jenis_pelayanan, keterangan) value ('$tanggal', '$id_relawan', '$id_armada', '$id_pasien', '$dari_lokasi', '$ke_lokasi', '$jenis_pelayanan', '$keterangan')";
        return mysqli_query($this->db, $sql);
    } 

    function edit($id_pelayanan){
        $sql = "UPDATE pelayanan set"
    }
    }
?>