<?php
require_once(__DIR__ . '/../config/koneksi.php');

class pelayanan
{
    private $db;
    function __construct()
    {
        $database = new database();
        $this->db = $database->connect;
    }

    function tampil()
    {
        $data = mysqli_query($this->db, "SELECT * from pelayanan,relawan,pasien,armada WHERE
        pelayanan.id_relawan = relawan.id_relawan and
        pelayanan.id_pasien=pasien.id_pasien and
        pelayanan.id_armada=armada.id_armada");
        return mysqli_fetch_all($data, MYSQLI_ASSOC);
    }

    function tambah($tanggal, $id_pasien, $id_relawan, $id_armada,  $dari_lokasi, $ke_lokasi, $jenis_pelayanan, $keterangan)
    {
        $sql = "INSERT INTO pelayanan(tanggal, id_relawan, id_armada, id_pasien, dari_lokasi, ke_lokasi, jenis_pelayanan, keterangan) value ('$tanggal', '$id_relawan', '$id_armada', '$id_pasien', '$dari_lokasi', '$ke_lokasi', '$jenis_pelayanan', '$keterangan')";
        return mysqli_query($this->db, $sql);
    }

    function edit($tanggal, $id_pasien, $id_pelayanan, $id_relawan, $id_armada,  $dari_lokasi, $ke_lokasi, $jenis_pelayanan, $keterangan)
    {
        $sql = "UPDATE pelayanan set 
                tanggal = '$tanggal', 
                id_pasien = '$id_pasien',
                id_relawan = '$id_relawan',
                id_armada = '$id_armada',
                dari_lokasi = '$dari_lokasi', 
                ke_lokasi = '$ke_lokasi', 
                jenis_pelayanan = '$jenis_pelayanan', 
                keterangan = '$keterangan' where id_pelayanan = '$id_pelayanan'";
        return mysqli_query($this->db, $sql);
    }

    function hapus($id_pelayanan)
    {
        $sql = "DELETE FROM pelayanan where id = '$id_pelayanan'";
        return mysqli_query($this->db, $sql);
    }

    function cari($id_pelayanan)
    {
        $sql = mysqli_query($this->db, "SELECT * from pelayanan WHERE id_pelayanan = '$id_pelayanan'");
        return mysqli_fetch_assoc($sql);
    }
}
