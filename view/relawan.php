<?php
require_once(__DIR__ . '/../proses/proses-relawan.php');
session_start();
if (!isset($_SESSION['username'])) {
    header("Location: login.php");
    exit;
}

$relawan = new Relawan();

if (isset($_POST['simpan'])) {
    $relawan->tambah($_POST['nama'], $_POST['jenis_kelamin'], $_POST['no_hp'], $_POST['alamat']);
    header("location:relawan.php");
    exit;
}

$editData = NULL;
if (isset($_GET['edit'])) {
    $id = $_GET['edit'];
    $editData = $relawan->cari($id);
}

if (isset($_POST['edit'])) {
    $relawan->edit($_POST['id_relawan'], $_POST['nama'], $_POST['jenis_kelamin'], $_POST['no_hp'], $_POST['alamat']);
    header('location:relawan.php');
    exit;
}

if (isset($_GET['hapus'])) {
    $relawan->hapus($_GET['hapus']);
    header("location:relawan.php");
    exit;
}

include '../template/header.php'

?>

<body>
    <!-- navbar -->
    <nav class="navbar navbar-dark bg-dark">
        <div class="container">
            <h3 class="navbar-brand">AMBULANCE RJS - Relawan</h3>
            <a class="navbar-brand" href="../index.php">Kembali</a>
        </div>
    </nav>
    <!-- body -->
    <div class="container my-4">
        <div class="card mb-4">
            <div class="card-header bg-primary text-white">Form Input / Edit Relawan</div>
            <div class="card-body">
                <div class="form-input">
                    <?php if ($editData) { ?>
                        <h4 style="text-align : center;">Edit Data</h4>

                        <form method="post" action="relawan.php">
                            <input type="hidden" name="id_relawan" value="<?= $editData['id_relawan']; ?>">

                            <div class="mb-3 row">
                                <label for="nama" class="col-sm-2 col-form-label">Nama Relawan</label>
                                <div class="col-sm-10">
                                    <input type="text" class="form-control" id="nama" name="nama" required value="<?= $editData['nama_relawan'] ?>">
                                </div>
                            </div>

                            <div class="mb-3 row">
                                <label class="col-sm-2 col-form-label">Jenis Kelamin</label>
                                <div class="col-sm-10">
                                    <div class="form-check form-check-inline">
                                        <input class="form-check-input" type="radio" name="jenis_kelamin" id="jk1" value="Laki-laki" <?= ($editData['jenis_kelamin'] == 'Laki-laki') ? 'checked' : ''; ?>>
                                        <label class="form-check-label" for="jk1">Laki-laki</label>
                                    </div>
                                    <div class="form-check form-check-inline">
                                        <input class="form-check-input" type="radio" name="jenis_kelamin" id="jk2" value="Perempuan" <?= ($editData['jenis_kelamin'] == 'Perempuan') ? 'checked' : ''; ?>>
                                        <label class="form-check-label" for="jk2">Perempuan</label>
                                    </div>
                                </div>
                            </div>

                            <div class="mb-3 row">
                                <label for="no_hp" class="col-sm-2 col-form-label">No. HP</label>
                                <div class="col-sm-10">
                                    <input type="text" class="form-control" name="no_hp" id="no_hp" required value="<?= $editData['no_hp'] ?>">
                                </div>
                            </div>

                            <div class="mb-3 row">
                                <label for="alamat" class="col-sm-2 col-form-label">Alamat</label>
                                <div class="col-sm-10">
                                    <input type="text" class="form-control" name="alamat" id="alamat" required value="<?= $editData['alamat'] ?>">
                                </div>
                            </div>

                            <button type="submit" name="edit" class="btn btn-primary">Update</button>
                            <a href="relawan.php" class="btn btn-secondary">Batal</a>
                        </form>

                    <?php } else { ?>
                        <h4 style="text-align : center;">Tambah Data</h4>

                        <form method="post">
                            <div class="mb-3 row">
                                <label for="nama" class="col-sm-2 col-form-label">Nama Relawan</label>
                                <div class="col-sm-10">
                                    <input type="text" class="form-control" id="nama" name="nama" required>
                                </div>
                            </div>

                            <div class="mb-3 row">
                                <label class="col-sm-2 col-form-label">Jenis Kelamin</label>
                                <div class="col-sm-10">
                                    <div class="form-check form-check-inline">
                                        <input class="form-check-input" type="radio" name="jenis_kelamin" value="Laki-laki" id="jk1" required>
                                        <label class="form-check-label" for="jk1">Laki-laki</label>
                                    </div>
                                    <div class="form-check form-check-inline">
                                        <input class="form-check-input" type="radio" name="jenis_kelamin" value="Perempuan" id="jk2">
                                        <label class="form-check-label" for="jk2">Perempuan</label>
                                    </div>
                                </div>
                            </div>
                            <div class="mb-3 row">
                                <label for="no_hp" class="col-sm-2 col-form-label">No. HP</label>
                                <div class="col-sm-10">
                                    <input type="text" class="form-control" name="no_hp" id="no_hp" required>
                                </div>
                            </div>
                            <div class="mb-3 row">
                                <label for="alamat" class="col-sm-2 col-form-label">Alamat</label>
                                <div class="col-sm-10">
                                    <input type="text" class="form-control" name="alamat" id="alamat" required>
                                </div>
                            </div>
                            <button type="submit" name="simpan" class="btn btn-success">Simpan</button>
                        </form>
                    <?php } ?>
                </div>
            </div>
        </div>

        <div class="card">
            <div class="card-header bg-secondary text-white">Data Relawan</div>
            <div class="card-body">
                <table class="table table-bordered table-striped" id="tableRelawan">
                    <thead class="table-dark">
                        <tr>
                            <th>No</th>
                            <th>Nama Relawan</th>
                            <th>Jenis Kelamin</th>
                            <th>No. HP</th>
                            <th>Alamat</th>
                            <th>Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php $no = 1;
                        foreach ($relawan->tampil() as $data) { ?>
                            <tr>
                                <td><?= $no++ ?></td>
                                <td><?= $data['nama_relawan'] ?></td>
                                <td><?= $data['jenis_kelamin'] ?></td>
                                <td><?= $data['no_hp'] ?></td>
                                <td><?= $data['alamat'] ?></td>
                                <td>
                                    <a href="?edit=<?= $data['id_relawan'] ?>" class="btn btn-sm btn-warning">Edit</a>
                                    <a href="?hapus=<?= $data['id_relawan'] ?>" class="btn btn-sm btn-danger" onclick="return confirm('Yakin hapus data?')">Hapus</a>
                                </td>
                            </tr>
                        <?php } ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>

    <?php
    include '../template/footer.php';
    ?>

    <script>
        new DataTable('#tableRelawan');
    </script>

</body>

</html>