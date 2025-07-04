<?php
require_once(__DIR__ . '/proses/proses-operasional.php');

$operasional = new Operasional();

if (isset($_POST['simpan'])) {
    $operasional->tambah($_POST['tanggal'], $_POST['keterangan'], $_POST['jenis'], $_POST['nominal']);
    header('location:operasional.php');
    exit;
}

$editData = NULL;
if (isset($_GET['edit'])) {
    $id = $_GET['edit'];
    $editData = $operasional->cari($id);
}

if (isset($_POST['edit'])) {
    $operasional->edit($_POST['id_operasional'], $_POST['tanggal'], $_POST['keterangan'], $_POST['jenis'], $_POST['nominal']);
    header('location:operasional.php');
    exit;
}

// if (isset($_POST['cari'])) {
//     $operasional->cari_pemasukan($_POST['jenis_pemasukan']);
// }

if (isset($_GET['hapus'])) {
    $operasional->hapus($_GET['hapus']);
    header('location:operasional.php');
    exit;
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Data Operasional</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/5.3.3/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdn.datatables.net/2.3.2/css/dataTables.bootstrap5.css">
</head>

<body>
    <!-- Navbar -->
    <nav class="navbar navbar-dark bg-dark">
        <div class="container">
            <h3 class="navbar-brand">AMBULANCE RJS - Data Operasional</h3>
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
                    <?php if ($editData) { ?>
                        <h4 style="text-align: center;">Edit Data</h4>
                        <form action="operasional.php" method="POST">
                            <input type="hidden" name="id_operasional" value="<?= $editData['id_operasional']; ?>">

                            <div class="mb-3 row">
                                <label for="tanggal" class="col-sm-2 col-form-label">Tanggal:</label>
                                <div class="col-sm-10">
                                    <input type="date" class="form-control" name="tanggal" id="tanggal" value="<?= $editData['tanggal'] ?>">
                                </div>
                            </div>

                            <div class="mb-3 row">
                                <label for="keterangan" class="col-sm-2 col-form-label">Keterangan:</label>
                                <div class="col-sm-10">
                                    <input type="text" class="form-control" name="keterangan" id="keterangan" value="<?= $editData['keterangan'] ?>">
                                </div>
                            </div>

                            <div class="mb-3 row">
                                <label class="col-sm-2 col-form-label">Jenis:</label>
                                <div class="col-sm-10">
                                    <div class="form-check form-check-inline">
                                        <input class="form-check-input" type="radio" name="jenis" id="jenis1" value="pemasukan" <?= ($editData['jenis'] == 'Pemasukan') ? 'checked' : ''; ?>>
                                        <label class="form-check-label" for="jenis1">Pemasukan</label>
                                    </div>
                                    <div class="form-check form-check-inline">
                                        <input class="form-check-input" type="radio" name="jenis" id="jenis2" value="pengeluaran" <?= ($editData['jenis'] == 'Pengeluaran') ? 'checked' : ''; ?>>
                                        <label class="form-check-label" for="jenis2">Pengeluaran</label>
                                    </div>
                                </div>
                            </div>

                            <div class="mb-3 row">
                                <label for="nominal" class="col-sm-2 col-form-label">Nominal:</label>
                                <div class="col-sm-10">
                                    <input type="number" class="form-control" name="nominal" id="nominal" value="<?= $editData['nominal'] ?>">
                                </div>
                            </div>

                            <button type="submit" name="edit" class="btn btn-primary">Update data</button>|
                            <a href="operasional.php" class="btn btn-secondary">Batal</a>
                        </form>

                    <?php } else { ?>
                        <form method="post">
                            <h4 style="text-align: center;">Tambah Data</h4>

                            <div class="mb-3 row">
                                <label for="tanggal" class="col-sm-2 col-form-label">Tanggal:</label>
                                <div class="col-sm-10">
                                    <input type="date" class="form-control" name="tanggal" id="tanggal" required>
                                </div>
                            </div>

                            <div class="mb-3 row">
                                <label for="keterangan" class="col-sm-2 col-form-label">Keterangan:</label>
                                <div class="col-sm-10">
                                    <input type="text" class="form-control" name="keterangan" id="keterangan" required>
                                </div>
                            </div>

                            <div class="mb-3 row">
                                <label class="col-sm-2 col-form-label">Jenis:</label>
                                <div class="col-sm-10">
                                    <div class="form-check form-check-inline">
                                        <input class="form-check-input" type="radio" name="jenis" id="jenis1" value="pemasukan" required>
                                        <label class="form-check-label" for="jenis1">Pemasukan</label>
                                    </div>
                                    <div class="form-check form-check-inline">
                                        <input class="form-check-input" type="radio" name="jenis" id="jenis2" value="pengeluaran">
                                        <label class="form-check-label" for="jenis2">Pengeluaran</label>
                                    </div>
                                </div>
                            </div>

                            <div class="mb-3 row">
                                <label for="nominal" class="col-sm-2 col-form-label">Nominal:</label>
                                <div class="col-sm-10">
                                    <input type="number" class="form-control" name="nominal" id="nominal" required>
                                </div>
                            </div>

                            <button type="submit" name="simpan" class="btn btn-success">Simpan</button>
                        </form>
                    <?php } ?>
                </div>
            </div>
        </div>
        <div class="card">
            <div class="card-header text-white bg-secondary">Data Operasional</div><br>

            <!-- Tampilkan Data -->
            <div class="card-body">
                <table class="table table-bordered table-striped" id="tableOperasional">
                    <thead class="table-dark">
                        <tr>
                            <th>No</th>
                            <th>Tanggal</th>
                            <th>Keterangan</th>
                            <th>Jenis</th>
                            <th>Nominal</th>
                            <th>Aksi</th>
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
                            <td>Rp. <?php echo number_format($data['nominal'], 0, ',', '.') ?></td>
                            <td>
                                <a href="?edit=<?php echo $data['id_operasional'] ?>" class="btn btn-sm btn-warning">Edit</a> |
                                <a href="?hapus=<?php echo $data['id_operasional'] ?>" class="btn btn-sm btn-danger" onclick="return confirm('Yakin hapus data?')">Hapus</a>
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
        new DataTable('#tableOperasional');
    </script>

</body>

</html>