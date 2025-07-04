<?php
require_once(__DIR__ . '/proses/proses-pasien.php');
$pasien = new Pasien();

if (isset($_POST['simpan'])) {
    $pasien->tambah($_POST['nama'], $_POST['jenis_kelamin'], $_POST['umur'], $_POST['alamat'], $_POST['no_hp'], $_POST['diagnosa']);
    header("location:pasien.php");
    exit;
}

$editData = NULL;
if (isset($_GET['edit'])) {
    $id = $_GET['edit'];
    $editData = $pasien->cari($id);
}

if (isset($_POST['edit'])) {
    $pasien->edit($_POST['id_pasien'], $_POST['nama'], $_POST['jenis_kelamin'], $_POST['umur'], $_POST['alamat'], $_POST['no_hp'], $_POST['diagnosa']);
    header('location:pasien.php');
    exit;
}

if (isset($_GET['hapus'])) {
    $pasien->hapus($_GET['hapus']);
    header("location:pasien.php");
    exit;
}
?>

<!DOCTYPE html>
<html>

<head>
    <title>Data Pasien</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/5.3.3/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdn.datatables.net/2.3.2/css/dataTables.bootstrap5.css">

<body>

    <!-- Navbar -->
    <nav class="navbar navbar-dark bg-dark">
        <div class="container">
            <h3 class="navbar-brand">AMBULANCE RJS - Pasien</h3>
            <a class="navbar-brand" href="index.php">Kembali</a>
        </div>
    </nav>

    <!-- body -->
    <div class="container my-4">
        <!-- AKSI -->
        <div class="card mb-4">
            <div class="card-header bg-primary text-white">Form Input / Edit</div>
            <div class="card-body">
                <div class="form-input">
                    <!-- Edit -->
                    <?php if ($editData) { ?>
                        <h4 style="text-align : center;">Edit Data</h4>
                        <form method="post" action="pasien.php">
                            <input type="hidden" name="id_pasien" value="<?= $editData['id_pasien']; ?>">

                            <div class="mb-3 row">
                                <label for="nama" class="col-sm-2 col-form-label">Nama Pasien</label>
                                <div class="col-sm-10">
                                    <input type="text" class="form-control" id="nama" name="nama" required value="<?= $editData['nama_pasien'] ?>">
                                </div>
                            </div>

                            <div class="mb-3 row">
                                <label for="jenis_kelamin" class="col-sm-2 col-form-label">Jenis Kelamin</label>
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
                                <label for="umur" class="col-sm-2 col-form-label">Umur</label>
                                <div class="col-sm-10">
                                    <input type="text" name="umur" id="umur" class="form-control" required value="<?= $editData['umur'] ?>">
                                </div>
                            </div>

                            <div class="mb-3 row">
                                <label for="alamat" class="col-sm-2 col-form-label">Alamat</label>
                                <div class="col-sm-10">
                                    <input type="text" name="alamat" id="alamat" class="form-control" required value="<?= $editData['alamat'] ?>">
                                </div>
                            </div>

                            <div class="mb-3 row">
                                <label for="no_hp" class="col-sm-2 col-form-label">No. HP</label>
                                <div class="col-sm-10">
                                    <input type="text" name="no_hp" id="no_hp" class="form-control" required value="<?= $editData['no_hp'] ?>">
                                </div>
                            </div>

                            <div class="mb-3 row">
                                <label for="diagnosa" class="col-sm-2 col-form-label">Diagnosa</label>
                                <div class="col-sm-10">
                                    <textarea name="diagnosa" class="form-control" id="diagnosa" required><?= $editData['diagnosa'] ?></textarea>
                                </div>
                            </div>

                            <button type="submit" name="edit" class="btn btn-primary">Update data</button>|
                            <a href="pasien.php" class="btn btn-secondary">Batal</a>
                        </form>

                    <?php } else {  ?>
                        <!-- Input -->
                        <h4 style="text-align : center;">Tambah Data</h4>
                        <form method="post">
                            <div class="mb-3 row">
                                <label for="nama" class="col-sm-2 col-form-label">Nama Pasien</label>
                                <div class="col-sm-10">
                                    <input type="text" class="form-control" id="nama" name="nama" required>
                                </div>
                            </div>

                            <div class="mb-3 row">
                                <label class="col-sm-2 col-form-label">Jenis Kelamin</label>
                                <div class="col-sm-10">
                                    <div class="form-check form-check-inline">
                                        <input class="form-check-input" type="radio" name="jenis_kelamin" id="jk1" value="Laki-laki">
                                        <label class="form-check-label" for="jk1">Laki-laki</label>
                                    </div>
                                    <div class="form-check form-check-inline">
                                        <input class="form-check-input" type="radio" name="jenis_kelamin" id="jk2" value="Perempuan">
                                        <label class="form-check-label" for="jk2">Perempuan</label>
                                    </div>
                                </div>
                            </div>

                            <div class="mb-3 row">
                                <label for="umur" class="col-sm-2 col-form-label">Umur</label>
                                <div class="col-sm-10">
                                    <input type="text" name="umur" id="umur" class="form-control" required>
                                </div>
                            </div>

                            <div class="mb-3 row">
                                <label for="alamat" class="col-sm-2 col-form-label">Alamat</label>
                                <div class="col-sm-10">
                                    <input type="text" name="alamat" id="alamat" class="form-control" required>
                                </div>
                            </div>

                            <div class="mb-3 row">
                                <label for="no_hp" class="col-sm-2 col-form-label">No. HP</label>
                                <div class="col-sm-10">
                                    <input type="text" name="no_hp" id="no_hp" class="form-control" required>
                                </div>
                            </div>

                            <div class="mb-3 row">
                                <label for="diagnosa" class="col-sm-2 col-form-label">Diagnosa</label>
                                <div class="col-sm-10">
                                    <textarea name="diagnosa" class="form-control" id="diagnosa" required></textarea>
                                </div>
                            </div>

                            <button type="submit" name="simpan" class="btn btn-success">Simpan</button>

                        </form>
                    <?php } ?>
                </div>
            </div>
        </div>
        <div class="card">
            <div class="card-header text-white bg-secondary">Data Pasien</div>
            <!-- Tampilkan Data -->
            <div class="card-body">

                <table class="table table-bordered table-striped" id="tablePasien">
                    <thead class="table-dark">
                        <tr>
                            <th>No</th>
                            <th>Nama pasien</th>
                            <th>Jenis Kelamin</th>
                            <th>Umur</th>
                            <th>Alamat</th>
                            <th>No. HP</th>
                            <th>Diagnosa</th>
                            <th>Aksi</th>
                        </tr>
                    </thead>
                    <?php
                    $no = 1;
                    foreach ($pasien->tampil() as $data) {
                    ?>
                        <tr>
                            <td><?php echo $no++; ?></td>
                            <td><?php echo $data['nama_pasien']; ?></td>
                            <td><?php echo $data['jenis_kelamin']; ?></td>
                            <td><?php echo $data['umur']; ?></td>
                            <td><?php echo $data['alamat']; ?></td>
                            <td><?php echo $data['no_hp']; ?></td>
                            <td><?php echo $data['diagnosa']; ?></td>
                            <td>
                                <a href="?edit=<?php echo $data['id_pasien']; ?>" class="btn btn-sm btn-warning">Edit</a> |
                                <a href="?hapus=<?php echo $data['id_pasien']; ?>" class="btn btn-sm btn-danger" onclick="return confirm('Yakin hapus data?')">Hapus</a>
                            </td>
                        </tr>
                    <?php
                    } ?>
                </table>
            </div>
        </div>
    </div>

    <?php
    include 'datatable/table.php';
    ?>

    <script>
        new DataTable('#tablePasien')
    </script>

</body>

</html>