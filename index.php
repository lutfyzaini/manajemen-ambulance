<?php
include 'config/koneksi.php';
require_once(__DIR__ . '\proses\proses-pelayanan.php');
require_once(__DIR__ . '\proses\proses-relawan.php');
require_once(__DIR__ . '\proses\proses-armada.php');
require_once(__DIR__ . '\proses\proses-pasien.php');


// session_start();
// if (isset(['login'])) {

// }

$pelayanan = new pelayanan();
$pasien = new pasien();
// $dataPasien = [];
// $tampilPasien = $pasien->tampil();
// while ($p = $pasien->tampil()) {
//     $dataPasien[] = $p;
// }
$relawan = new relawan();
// $dataRelawan = $relawan->tampil();

$armada = new armada();
// $dataArmada = $armada->tampil();


// Data tiga entitas(relawan, pasien, armada)


$db = new database();
// $pelayanan = new pelayanan();
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <title>Dashboard Ambulance RJS</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.7/dist/css/bootstrap.min.css" rel="stylesheet">
</head>

<body>
    <!-- Navbar -->
    <nav class="navbar navbar-dark bg-dark">
        <div class="container">
            <a class="navbar-brand" href="#">AMBULANCE RJS - Dashboard</a>
        </div>
    </nav>

    <!-- Content -->
    <div class="container mt-5">
        <h2 class="text-center mb-4">Selamat Datang!</h2>

        <div class="row justify-content-center g-4">

            <!-- Card Pasien -->
            <div class="col-md-4">
                <div class="card border-primary">
                    <div class="card-body text-center">
                        <h5 class="card-title">Data Pasien</h5>
                        <a href="pasien.php" class="btn btn-primary">Lihat</a>
                    </div>
                </div>
            </div>

            <!-- Card Relawan -->
            <div class="col-md-4">
                <div class="card border-success">
                    <div class="card-body text-center">
                        <h5 class="card-title">Data Relawan</h5>
                        <a href="relawan.php" class="btn btn-success">Lihat</a>
                    </div>
                </div>
            </div>

            <!-- Card Armada -->
            <div class="col-md-4">
                <div class="card border-warning">
                    <div class="card-body text-center">
                        <h5 class="card-title">Data Armada</h5>
                        <a href="armada.php" class="btn btn-warning text-white">Lihat</a>
                    </div>
                </div>
            </div>

            <!-- Card Pelayanan -->
            <div class="col-md-4">
                <div class="card border-info">
                    <div class="card-body text-center">
                        <h5 class="card-title">Data Pelayanan</h5>
                        <a href="pelayanan.php" class="btn btn-info text-white">Lihat</a>
                    </div>
                </div>
            </div>

            <!-- Card Operasional -->
            <div class="col-md-4">
                <div class="card border-danger">
                    <div class="card-body text-center">
                        <h5 class="card-title">Data Operasional</h5>
                        <a href="operasional.php" class="btn btn-danger">Lihat</a>
                    </div>
                </div>
            </div>


            <!-- Tabel pelayanan -->
            <div class="mt-4">
                <h2 class="m-5 text-center">Histori Pelayanan</h2>

                <table class="table">
                    <thead>
                        <tr>
                            <th>No</th>
                            <th>Tanggal</th>
                            <th>Nama pasien</th>
                            <th>Relawan</th>
                            <th>Armada</th>
                            <th>Dari lokasi</th>
                            <th>Ke lokasi</th>
                            <th>Jenis pelayanan</th>
                            <th>Keterangan</th>
                            <!-- <th>Aksi</th> -->
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        $no = 1;;
                        foreach ($pelayanan->tampil() as $data) {
                        ?>
                            <tr>
                                <td><?php echo $no++; ?></td>
                                <td><?php echo $data['tanggal']; ?></td>
                                <td><?php echo $data['nama_pasien']; ?></td>
                                <td><?php echo $data['nama_relawan']; ?></td>
                                <td><?php echo $data['nama_armada']; ?></td>
                                <td><?php echo $data['dari_lokasi']; ?></td>
                                <td><?php echo $data['ke_lokasi']; ?></td>
                                <td><?php echo $data['jenis_pelayanan']; ?></td>
                                <td><?php echo $data['keterangan']; ?></td>

                            </tr>
                        <?php } ?>
                    </tbody>
                </table>
            </div>

        </div>
    </div>

    <!-- Bootstrap JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.7/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>