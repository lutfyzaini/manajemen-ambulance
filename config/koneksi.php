<?php
class database
{
    private $host = "localhost";
    private $username = "root";
    private $pass = "";
    private $db = "ambulance";
    public $connect;


    function __construct()
    {
        $this->connect = mysqli_connect($this->host, $this->username, $this->pass, $this->db);

        if (!$this->connect) {
            die("Koneksi gagal : " . mysqli_connect_error());
        }
    }
}
