<?php
include 'config/koneksi.php';
session_start();
if (!isset($_SESSION['username'])) {
    header("Location: login.php");
    exit;
}

require_once(__DIR__ . '\proses\proses-pelayanan.php');
require_once(__DIR__ . '\proses\proses-relawan.php');
require_once(__DIR__ . '\proses\proses-armada.php');
require_once(__DIR__ . '\proses\proses-pasien.php');
require_once(__DIR__ . '\proses\proses-operasional.php');



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

$operasional = new operasional();
// Data tiga entitas(relawan, pasien, armada)


$db = new database();
// $pelayanan = new pelayanan();
?>

<?php
include 'template/header.php';
?>

<body>
    <!-- Navbar -->
    <nav class="navbar navbar-dark bg-dark">
        <div class="container">
            <h3 class="navbar-brand">AMBULANCE RJS - Dashboard</h3>
            <a href="logout.php" class="btn btn-danger">Logout</a>

            <!-- <a class="navbar-brand" href="index.php">Kembali</a> -->
        </div>
    </nav>

    <!-- Content -->
    <div class="container mt-5 text-center">
        <h2 class="text-center mb-4">Selamat Datang!</h2>

        <div class="row justify-content-center g-4">

            <!-- Card Pasien -->
            <div class="col-md-4">
                <div class="card bg-primary-subtle">
                    <div class="card-body text-center ">
                        <h5 class="card-title">Data Pasien</h5>
                        <a href="view/pasien.php" class="btn btn-info">Lihat</a>
                    </div>
                </div>
            </div>

            <!-- Card Relawan -->
            <div class="col-md-4">
                <div class="card bg-info-subtle">
                    <div class="card-body text-center">
                        <h5 class="card-title">Data Relawan</h5>
                        <a href="view/relawan.php" class="btn btn-info">Lihat</a>
                    </div>
                </div>
            </div>

            <!-- Card Armada -->
            <div class="col-md-4">
                <div class="card bg-secondary-subtle">
                    <div class="card-body text-center">
                        <h5 class="card-title">Data Armada</h5>
                        <a href="view/armada.php" class="btn btn-info ">Lihat</a>
                    </div>
                </div>
            </div>

            <!-- Card Pelayanan -->
            <div class="col-md-6">
                <div class="card bg-warning-subtle">
                    <div class="card-body text-center">
                        <h5 class="card-title">Data Pelayanan</h5>
                        <a href="view/pelayanan.php" class="btn btn-info ">Lihat</a>
                    </div>
                </div>
            </div>

            <!-- Card Operasional -->
            <div class="col-md-6">
                <div class="card bg-danger-subtle">
                    <div class="card-body text-center">
                        <h5 class="card-title">Data Operasional</h5>
                        <a href="view/operasional.php" class="btn btn-info">Lihat</a>
                    </div>
                </div>
            </div>



            <!-- Tabel pelayanan -->
            <div class="card mb-4">
                <div class="card-header bg-secondary text-white">
                    <h2 class="text-center">Histori Pelayanan Terakhir</h2>
                </div>
                <div class="card-body">
                    <table class="table table-bordered table-striped" id="tableHistory">
                        <thead class="table-primary">
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
                            $no = 1;

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
            <!-- Tabel operasional -->
            <div class="card mb-4">
                <div class="card-header bg-secondary text-white">
                    <h2 class="text-center ">Operasional</h2>
                </div>
                <div class="card-body">
                    <table class="table table-bordered table-striped" id="tableOperasional">
                        <thead class="table-primary">
                            <tr>
                                <th>No</th>
                                <th>Tanggal</th>
                                <th>Keterangan</th>
                                <th>Jenis</th>
                                <th>Nominal</th>
                            </tr>
                        </thead>
                        <?php
                        $no = 1;
                        foreach ($operasional->tampil() as $data) {
                        ?>
                            <tr>
                                <td><?php echo $no++; ?></td>
                                <td><?php echo $data['tanggal'] ?></td>
                                <td><?php echo $data['keterangan'] ?></td>
                                <td><?php echo $data['jenis'] ?></td>
                                <td>Rp. <?php echo number_format($data['nominal'], 0, ',', '.')  ?></td>
                            </tr>
                        <?php } ?>
                    </table>
                </div>
            </div>
        </div>
    </div>

    <?php
    include 'template/footer.php';
    ?>
    <script>
        new DataTable('#tableHistory');
        new DataTable('#tableOperasional');
    </script>
</body>

</html>