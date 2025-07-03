<?php

require_once(__DIR__ . '/../config/koneksi.php');

class pasien
{
    private $db;
    public function __construct()
    {
        $database = new database();
        $this->db = $database->connect;
    }

    public function tambah($nama, $jenis_kelamin, $umur, $alamat, $no_hp, $diagnosa)
    {
        $sql = "INSERT INTO pasien(nama_pasien, jenis_kelamin, umur, alamat, no_hp,diagnosa) values ('$nama', '$jenis_kelamin', '$umur','$alamat', $no_hp,'$diagnosa')";

        error_log("SQL : " . $sql);
        return mysqli_query($this->db, $sql);
    }

    public function tampil()
    {
        $data = mysqli_query($this->db, "SELECT * FROM pasien");
        return mysqli_fetch_all($data, MYSQLI_ASSOC);
    }

    public function edit($id, $nama, $jenis_kelamin, $umur, $alamat, $no_hp, $diagnosa)
    {
        $sql = "UPDATE pasien SET 
                nama_pasien = '$nama', 
                jenis_kelamin = '$jenis_kelamin', 
                umur = '$umur', 
                alamat = '$alamat',
                no_hp = '$no_hp',
                diagnosa = '$diagnosa'
                WHERE id_pasien = $id";
        return mysqli_query($this->db, $sql);
    }

    public function cari($id)
    {
        $data = mysqli_query($this->db, "SELECT * FROM pasien WHERE id_pasien = '$id'");
        return mysqli_fetch_assoc($data);
    }

    public function hapus($id)
    {
        $sql = "DELETE FROM pasien WHERE id_pasien = '$id'";
        return mysqli_query($this->db, $sql);
    }
}
