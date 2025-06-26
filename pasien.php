<?php 
    include 'config/koneksi.php'; 
    $db = new database();
?> 

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Data Pasien</title>
</head>
<body>
    <h2>Data Pasien</h2>
    <a href="tambah.php">Tambah pasien</a>

    <table>
        <thead>
            <tr>
                <th>No</th>
                <th>Nama Pasien</th>
                <th>Jenis Kelamin</th>
                <th>Umur</th>
                <th>Alamat</th>
                <th>Keterangan</th>
            </tr>
        </thead>
        <tbody>
            <?php 
                $no = 1;
                $hasil = 3;
            ?>
        </tbody>
    </table>
</body>
</html>