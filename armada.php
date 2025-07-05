<?php
require_once __DIR__ . '/proses/proses-armada.php';

session_start();
if (!isset($_SESSION['username'])) {
    header("Location: login.php");
    exit;
}


$armada = new Armada();

if (isset($_POST['simpan'])) {
    $armada->tambah($_POST['nama'], $_POST['plat'], $_POST['status']);
    header("location:armada.php");
    exit;
}

$editData = NULL;
if (isset($_GET['edit'])) {
    $id = $_GET['edit'];
    $editData = $armada->cari($id);
}

if (isset($_POST['edit'])) {
    $armada->edit($_POST['id_armada'], $_POST['nama'], $_POST['plat'], $_POST['status']);
    header('location:armada.php');
    exit;
}

if (isset($_GET['hapus'])) {
    $armada->hapus($_GET['hapus']);
    header("location:armada.php");
    exit;
}

?>

<!DOCTYPE html>
<html>

<head>
    <title>Data Armada</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/5.3.3/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdn.datatables.net/2.3.2/css/dataTables.bootstrap5.css">
</head>

<body>
    <!-- Navbar -->
    <nav class="navbar navbar-dark bg-dark">
        <div class="container">
            <h3 class="navbar-brand">AMBULANCE RJS - Data Armada</h3>
            <a class="navbar-brand" href="index.php">Kembali</a>
        </div>
    </nav>

    <!-- body -->
    <div class="container my-4">
        <div class="card mb-4">
            <div class="card-header bg-primary text-white">Form Input / Edit</div>
            <div class="card-body">
                <!-- Form Input -->
                <div class="form-input">
                    <!-- Edit -->
                    <?php if ($editData) { ?>
                        <h4 style="text-align : center;">Edit Data</h4>
                        <form method="post" action="armada.php">
                            <input type="hidden" name="id_armada" value="<?= $editData['id_armada']; ?>">

                            <div class="mb-3 row">
                                <label for="nama" class="col-sm-2 col-form-label">Nama Armada</label>
                                <div class="col-sm-10">
                                    <input type="text" class="form-control" id="nama" name="nama" required value="<?= $editData['nama_armada'] ?>">
                                </div>
                            </div>

                            <div class="mb-3 row">
                                <label for="plat" class="col-sm-2 col-form-label">Plat</label>
                                <div class="col-sm-10">
                                    <input type="text" class="form-control" id="plat" name="plat" required value="<?= $editData['plat'] ?>">
                                </div>
                            </div>

                            <div class="mb-3 row">
                                <label for="status" class="col-sm-2 col-form-label">Status</label>
                                <div class="col-sm-10">
                                    <input type="text" class="form-control" id="status" name="status" required value="<?= $editData['status'] ?>">
                                </div>
                            </div>

                            <button type="submit" name="edit" class="btn btn-primary"> Update data </button> |
                            <a href="armada.php" class="btn btn-secondary">Batal</a>
                        </form>

                    <?php } else {  ?>
                        <!-- Input -->
                        <form method="post">
                            <h4 style="text-align : center;">Tambah Data</h4>

                            <div class="mb-3 row">
                                <label for="nama" class="col-sm-2 col-form-label">Nama Armada</label>
                                <div class="col-sm-10">
                                    <input type="text" class="form-control" id="nama" name="nama" required>
                                </div>
                            </div>

                            <div class="mb-3 row">
                                <label for="plat" class="col-sm-2 col-form-label">Plat</label>
                                <div class="col-sm-10">
                                    <input type="text" class="form-control" id="plat" name="plat" required>
                                </div>
                            </div>

                            <div class="mb-3 row">
                                <label for="status" class="col-sm-2 col-form-label">Status</label>
                                <div class="col-sm-10">
                                    <input type="text" class="form-control" id="status" name="status" required>
                                </div>
                            </div>

                            <button type="submit" name="simpan" class="btn btn-sm btn-primary">Simpan</button>
                        </form>
                    <?php } ?>
                </div>
            </div>
        </div>
        <div class="card">
            <div class="card-header text-white bg-secondary">Data Armada</div>
            <!-- Tampilkan Data -->
            <div class="card-body">
                <table class="table table-bordered table-striped" id="tableArmada">
                    <thead class="table-dark">
                        <tr>
                            <th>No</th>
                            <th>Nama Armada</th>
                            <th>Plat</th>
                            <th>Status</th>
                            <th>Aksi</th>
                        </tr>
                    </thead>
                    <?php
                    $no = 1;
                    foreach ($armada->tampil() as $data) {
                    ?>
                        <tr>
                            <td><?php echo $no++; ?></td>
                            <td><?php echo $data['nama_armada']; ?></td>
                            <td><?php echo $data['plat']; ?></td>
                            <td><?php echo $data['status']; ?></td>
                            <td>
                                <a href="?edit=<?php echo $data['id_armada']; ?>" class="btn btn-sm btn-warning">Edit</a> |
                                <a href="?hapus=<?php echo $data['id_armada']; ?>" class="btn btn-sm btn-danger" onclick="return confirm('Yakin hapus data?')">Hapus</a>
                            </td>
                        </tr>
                    <?php } ?>
                </table>
            </div>
        </div>
    </div>

    <?php
    include 'datatable/table.php';
    ?>
    <script>
        new DataTable('#tableArmada')
    </script>
</body>

</html>