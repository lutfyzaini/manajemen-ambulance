<?php
require_once(__DIR__ . '/../config/koneksi.php');

class operasional
{
    private $db;
    function __construct()
    {
        $database = new database();
        $this->db = $database->connect;
    }

    function tampil()
    {
        $sql = mysqli_query($this->db, "SELECT * FROM operasional");
        // $sql = "SELECT * FROM operasional";
        return mysqli_fetch_all($sql, MYSQLI_ASSOC);
    }

    function cari($id)
    {
        $sql = mysqli_query($this->db, "SELECT * FROM operasional WHERE id_operasional='$id'");
        return mysqli_fetch_assoc($sql);
    }

    function tambah($tanggal, $keterangan, $jenis, $nominal)
    {
        $sql = "INSERT INTO operasional(tanggal, keterangan, jenis, nominal) values ('$tanggal','$keterangan', '$jenis', '$nominal')";
        return mysqli_query($this->db, $sql);
    }

    function edit($id_operasional, $tanggal, $keterangan, $jenis, $nominal)
    {
        $sql = "UPDATE operasional set 
        tanggal = '$tanggal',
        keterangan = '$keterangan',
        jenis = '$jenis', 
        nominal = '$nominal' where id_operasional = '$id_operasional'";
        return mysqli_query($this->db, $sql);
    }

    function hapus($id_operasional)
    {
        $sql = "DELETE FROM operasional WHERE id_operasional = '$id_operasional'";
        return mysqli_query($this->db, $sql);
    }


    function laporan_pemasukan($pemasukan)
    {
        $sql = "SELECT * from operasional where jenis='$pemasukan'";
        return mysqli_query($this->db, $sql);
    }

    function laporan_pengeluaran($pengeluaran)
    {
        $sql = "SELECT * FROM operasional where jenis = '$pengeluaran'";
        return mysqli_query($this->db, $sql);
    }

    function laporan_bulanan() {}
}
