<?php

session_start();
if (!isset($_SESSION['username'])) {
    header("Location: login.php");
    exit;
}


$pelayanan = new Pelayanan();
$pasien = new Pasien();
$relawan = new Relawan();
$armada = new Armada();

if (isset($_POST['simpan'])) {
    $pelayanan->tambah($_POST['tanggal'], $_POST['id_pasien'], $_POST['id_relawan'], $_POST['id_armada'], $_POST['dari_lokasi'], $_POST['ke_lokasi'], $_POST['jenis_pelayanan'], $_POST['keterangan']);
    header("location:pelayanan.php");
    exit;
}

$editData = NULL;
if (isset($_GET['edit'])) {
    $id = $_GET['edit'];
    $editData = $pelayanan->cari($id);
}

if (isset($_POST['edit'])) {
    $pelayanan->edit($_POST['tanggal'], $_POST['id_pasien'], $_POST['id_pelayanan'], $_POST['id_relawan'], $_POST['id_armada'], $_POST['dari_lokasi'], $_POST['ke_lokasi'], $_POST['jenis_pelayanan'], $_POST['keterangan']);
    header('location:pelayanan.php');
    exit;
}

if (isset($_GET['hapus'])) {
    $pelayanan->hapus($_GET['hapus']);
    header("location:pelayanan.php");
    exit;
}
?>

<!DOCTYPE html>
<html>

<head>
    <title>Data Pelayanan</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/5.3.3/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdn.datatables.net/2.3.2/css/dataTables.bootstrap5.css">
</head>

<body>
    <!-- Navbar -->
    <nav class="navbar navbar-dark bg-dark">
        <div class="container">
            <h3 class="navbar-brand">AMBULANCE RJS - Data Pelayanan</h3>
            <a class="navbar-brand" href="index.php">Kembali</a>
        </div>
    </nav>

    <!-- body -->
    <div class="container my-4">
        <div class="card mb-4">
            <div class="card-header bg-primary text-white">Form Input/Edit Pelayanan</div>
            <div class="card-body">
                <!-- Form Input -->
                <div class="form-input">
                    <!-- Edit -->
                    <?php if ($editData) { ?>
                        <h4 style="text-align : center;">Edit Data</h4>
                        <form method="post" action="pelayanan.php">
                            <input type="hidden" name="id_pelayanan" value="<?= $editData['id_pelayanan']; ?>">

                            <div class="mb-3 row">
                                <label for="tanggal" class="col-sm-2 col-form-label">Tanggal:</label>
                                <div class="col-sm-10">
                                    <input type="date" class="form-control" name="tanggal" id="tanggal" value="<?= $editData['tanggal'] ?>">
                                </div>
                            </div>

                            <div class="mb-3 row">
                                <label for="pasien" class="col-sm-2 col-form-label">Pasien:</label>
                                <div class="col-sm-10">
                                    <select class="form-control" name="id_pasien" id="pasien" required>
                                        <?php foreach ($pasien->tampil() as $data) { ?>
                                            <option value="<?= $data['id_pasien']; ?>" <?= ($editData['id_pasien'] == $data['id_pasien']) ? 'selected' : ''; ?>>
                                                <?= $data['nama_pasien'] ?>
                                            </option>
                                        <?php }; ?>
                                    </select>
                                </div>
                            </div>

                            <div class="mb-3 row">
                                <label for="relawan" class="col-sm-2 col-form-label">Relawan:</label>
                                <div class="col-sm-10">
                                    <select class="form-control" name="id_relawan" id="relawan" required>
                                        <?php foreach ($relawan->tampil() as $data) { ?>
                                            <option value="<?= $data['id_relawan']; ?>" <?= ($editData['id_relawan'] == $data['id_relawan']) ? 'selected' : ''; ?>>
                                                <?= $data['nama_relawan'] ?>
                                            </option>
                                        <?php } ?>
                                    </select>
                                </div>
                            </div>

                            <div class="mb-3 row">
                                <label for="armada" class="col-sm-2 col-form-label">Armada:</label>
                                <div class="col-sm-10">
                                    <select class="form-control" name="id_armada" id="armada" required>
                                        <?php foreach ($armada->tampil() as $data) { ?>
                                            <option value="<?= $data['id_armada']; ?>" <?= ($editData['id_armada'] == $data['id_armada']) ? 'selected' : '' ?>>
                                                <?= $data['nama_armada'] ?>
                                            </option>
                                        <?php } ?>
                                    </select>
                                </div>
                            </div>

                            <div class="mb-3 row">
                                <label for="dari_lokasi" class="col-sm-2 col-form-label">Dari Lokasi:</label>
                                <div class="col-sm-10">
                                    <input type="text" class="form-control" name="dari_lokasi" id="dari_lokasi" value="<?= $editData['dari_lokasi'] ?>">
                                </div>
                            </div>

                            <div class="mb-3 row">
                                <label for="ke_lokasi" class="col-sm-2 col-form-label">Ke Lokasi:</label>
                                <div class="col-sm-10">
                                    <input type="text" class="form-control" name="ke_lokasi" id="ke_lokasi" value="<?= $editData['ke_lokasi'] ?>">
                                </div>
                            </div>

                            <div class="mb-3 row">
                                <label for="jenis_pelayanan" class="col-sm-2 col-form-label">Jenis Pelayanan:</label>
                                <div class="col-sm-10">
                                    <input type="text" class="form-control" name="jenis_pelayanan" id="jenis_pelayanan" value="<?= $editData['jenis_pelayanan'] ?>">
                                </div>
                            </div>

                            <div class="mb-3 row">
                                <label for="keterangan" class="col-sm-2 col-form-label">Keterangan:</label>
                                <div class="col-sm-10">
                                    <textarea class="form-control" name="keterangan" id="keterangan"><?= $editData['keterangan'] ?></textarea>
                                </div>
                            </div>

                            <button type="submit" name="edit" class="btn btn-primary">Update data</button>|
                            <a href="pelayanan.php" class="btn btn-secondary">Batal</a>
                        </form>

                    <?php } else { ?>
                        <!-- Input -->
                        <form method="post">
                            <h4 style="text-align : center;">Tambah Data</h4>

                            <div class="mb-3 row">
                                <label for="tanggal" class="col-sm-2 col-form-label">Tanggal:</label>
                                <div class="col-sm-10">
                                    <input type="date" class="form-control" name="tanggal" id="tanggal" required>
                                </div>
                            </div>

                            <div class="mb-3 row">
                                <label for="pasien" class="col-sm-2 col-form-label">Pasien:</label>
                                <div class="col-sm-10">
                                    <select class="form-control" name="id_pasien" id="pasien" required>
                                        <option value="">-- Pilih Pasien --</option>
                                        <?php foreach ($pasien->tampil() as $data) { ?>
                                            <option value="<?= $data['id_pasien']; ?>"><?= $data['nama_pasien'] ?></option>
                                        <?php }; ?>
                                    </select>
                                </div>
                            </div>

                            <div class="mb-3 row">
                                <label for="relawan" class="col-sm-2 col-form-label">Relawan:</label>
                                <div class="col-sm-10">
                                    <select class="form-control" name="id_relawan" id="relawan" required>
                                        <option value="">-- Pilih Relawan --</option>
                                        <?php foreach ($relawan->tampil() as $data) { ?>
                                            <option value="<?= $data['id_relawan']; ?>"><?= $data['nama_relawan'] ?></option>
                                        <?php } ?>
                                    </select>
                                </div>
                            </div>

                            <div class="mb-3 row">
                                <label for="armada" class="col-sm-2 col-form-label">Armada:</label>
                                <div class="col-sm-10">
                                    <select class="form-control" name="id_armada" id="armada" required>
                                        <option value="">-- Pilih Armada --</option>
                                        <?php foreach ($armada->tampil() as $data) { ?>
                                            <option value="<?= $data['id_armada']; ?>"><?= $data['nama_armada'] ?></option>
                                        <?php } ?>
                                    </select>
                                </div>
                            </div>

                            <div class="mb-3 row">
                                <label for="dari_lokasi" class="col-sm-2 col-form-label">Dari Lokasi:</label>
                                <div class="col-sm-10">
                                    <input type="text" class="form-control" name="dari_lokasi" id="dari_lokasi" required>
                                </div>
                            </div>

                            <div class="mb-3 row">
                                <label for="ke_lokasi" class="col-sm-2 col-form-label">Ke Lokasi:</label>
                                <div class="col-sm-10">
                                    <input type="text" class="form-control" name="ke_lokasi" id="ke_lokasi" required>
                                </div>
                            </div>

                            <div class="mb-3 row">
                                <label for="jenis_pelayanan" class="col-sm-2 col-form-label">Jenis Pelayanan:</label>
                                <div class="col-sm-10">
                                    <input type="text" class="form-control" name="jenis_pelayanan" id="jenis_pelayanan" required>
                                </div>
                            </div>

                            <div class="mb-3 row">
                                <label for="keterangan" class="col-sm-2 col-form-label">Keterangan:</label>
                                <div class="col-sm-10">
                                    <textarea class="form-control" name="keterangan" id="keterangan" required></textarea>
                                </div>
                            </div>

                            <button type="submit" name="simpan" class="btn btn-success">Simpan</button>
                        </form>
                    <?php } ?>
                </div>
            </div>
        </div>
        <div class="card">
            <div class="card-header text-white bg-secondary">Data Pelayanan</div>
            <!-- Tampilkan Data -->
            <div class="card-body">
                <table class="table table-bordered table-striped" id="tablePelayanan">
                    <thead class="table-dark">
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
                            <th>Aksi</th>
                        </tr>
                    </thead>
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
                            <td>
                                <a href="?edit=<?php echo $data['id_pelayanan']; ?>" class="btn btn-sm btn-warning">Edit</a> |
                                <a href="?hapus=<?php echo $data['id_pelayanan']; ?>" class="btn btn-sm btn-danger" onclick="return confirm('Yakin hapus data?')">Hapus</a>
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
        new DataTable('#tablePelayanan');
    </script>


</html>