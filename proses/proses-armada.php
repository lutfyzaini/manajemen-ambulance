<?php 
    require_once('/../config/koneksi.php');

    class armada{
        private $db;
        public function __construct(){
            $database = new database();
            $this->db = $database->connect;
        } 
    
    public function tambah($nama, $plat, $status){
        $sql = "INSERT INTO relawan(nama_armada, plat, 'status') values ('$nama', '$plat', '$status')";

        error_log("SQL : ". $sql);
        return mysqli_query($this->db, $sql);
    }

    public function tampil(){
        $data = mysqli_query($this->db, "SELECT * FROM armada");
        return mysqli_fetch_all($data, MYSQLI_ASSOC); 
    } 

    public function ubah($id, $nama,  $plat, $status) {
        $sql = "UPDATE relawan SET 
                nama_armada = '$nama', 
                plat = '$plat', 
                'status' = '$status' 
                WHERE id_armada = $id";
        return mysqli_query($this->db, $sql);
    }

    public function cari($id){
        $data = mysqli_query($this->db, "SELECT * FROM armada where id_armada = '$id'");
        return mysqli_fetch_all($data);
    }

    public function hapus($id) {
        $sql = "DELETE FROM armada WHERE id_armada = $id";
        return mysqli_query($this->db, $sql);
    }
}

?>