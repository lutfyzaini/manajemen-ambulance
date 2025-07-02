<?php
require_once(__DIR__ . '/proses/proses-operasional.php');

$operasional = new operasional();

if (isset($_POST['simpan'])) {
    $operasional->tambah($_POST['tanggal'], $_POST['keterangan'], $_POST['jenis'], $_POST['nominal']);
    header('location:operasional.php');
}

$editData = NULL;
if (isset($_GET['edit'])) {
    $id = $_GET['edit'];
    $editData = $operasional->cari($id);
}

if (isset($_POST['edit'])) {
    $operasional->edit($_POST['id_operasional'], $_POST['tanggal'], $_POST['keterangan'], $_POST['jenis'], $_POST['nominal']);
    header('location:operasional.php');
}

if (isset($_POST['hapus'])) {
    $operasional->hapus($_GET['id_operasional']);
    header('location:operasional.php');
}

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Data Operasional</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.7/dist/css/bootstrap.min.css" rel="stylesheet">

    <style>
        table {
            border-collapse: collapse;
            width: 80%;
            margin: 20px auto;
        }

        th,
        td {
            border: 1px solid #ddd;
            padding: 8px;
            text-align: left;
        }

        th {
            background-color: #f2f2f2;
        }

        .form-input {
            width: 80%;
            margin: 20px auto;
            padding: 20px;
            border: 1px solid #ddd;
        }
    </style>
</head>

<body>
    <!-- Navbar -->
    <nav class="navbar navbar-dark bg-dark">
        <div class="container">
            <a class="navbar-brand" href="#">AMBULANCE RJS - Data Operasional</a>
        </div>
    </nav>

    <h2 style="text-align: center;">DATA OPERASIONAL</h2> <a href="index.php">Kembali</a>
    <div class="form-input">
        <?php if ($editData) { ?>
            <h2 style="text-align: center;">Edit Data</h2>
            <form action="operasional.php" method="POST">
                <input type="hidden" name="id_operasional" value="<?= $editData['id_operasional']; ?>">

                <label for="tanggal">Tanggal</label>
                <input type="date" name="tanggal" id="tanggal" value="<?= $editData['tanggal'] ?>"><br><br>

                <label for="keterangan">Keterangan</label>
                <input type="text" name="keterangan" id="keterangan" value="<?= $editData['keterangan'] ?>"><br><br>

                <label for="jenis">Jenis</label>
                <input type="radio" name="jenis" id="jenis" value="pemasukan" <?= ($editData['jenis'] == 'Pemasukan') ? 'checked' : ''; ?>>Pemasukan
                <input type="radio" name="jenis" id="jenis" value="pengeluaran" <?= ($editData['jenis'] == 'Pengeluaran') ? 'checked' : ''; ?>>Pengeluaran
                <br><br>

                <label for="nominal">Nominal</label>
                <input type="number" name="nominal" id="nominal" value="<?= $editData['nominal'] ?>"><br><br>

                <input type="submit" name="edit" value="Update Data"> | <a href="operasional.php">Batal</a>

            </form>


        <?php } else { ?>
            <form method="post">
                <h2 style="text-align: center;">Tambah Data</h2>

                <label for="tanggal">Tanggal</label>
                <input type="date" name="tanggal" id="tanggal"><br><br>

                <label for="keterangan">Keterangan</label>
                <input type="text" name="keterangan" id="keterangan"><br><br>

                <label for="jenis">Jenis</label>
                <input type="radio" name="jenis" id="jenis" value="pemasukan">Pemasukan
                <input type="radio" name="jenis" id="jenis" value="pengeluaran">Pengeluaran
                <br><br>

                <label for="nominal">Nominal</label>
                <input type="number" name="nominal" id="nominal"><br><br>
                <input type="submit" name="simpan" value="Simpan">
            </form>
        <?php } ?>
    </div>
    <!-- tampil data -->
    <table>
        <tr>
            <th>No</th>
            <th>Tanggal</th>
            <th>Keterangan</th>
            <th>Jenis</th>
            <th>Nominal</th>
            <th>Aksi</th>
        </tr>
        <?php
        $no = 1;
        foreach ($operasional->tampil() as $data) {
        ?>
            <tr>
                <td><?php echo $no++; ?></td>
                <td><?php echo $data['tanggal'] ?></td>
                <td><?php echo $data['keterangan'] ?></td>
                <td><?php echo $data['jenis'] ?></td>
                <td><?php echo $data['nominal'] ?></td>
                <td>
                    <a href="?edit=<?php echo $data['id_operasional'] ?>">Edit</a> |
                    <a href="?hapus=<?php echo $data['id_operasional'] ?>" onclick="return confirm('Yakin hapus data?')">Hapus</a>
                </td>
            </tr>
        <?php } ?>
    </table>
</body>

</html>