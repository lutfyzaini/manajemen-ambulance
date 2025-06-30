<?php
require_once __DIR__ . '\proses\proses-armada.php';
$armada = new armada();


if (isset($_POST['simpan'])) {
    $armada->tambah($_POST['nama'], $_POST['plat'], $_POST['status']);

    // var_dump($result);
    // var_dump($_POST['jenis_kelamin']);
    header("location:armada.php");
}

$editData = NULL;
if (isset($_GET['edit'])) {
    $id = $_GET['edit'];
    $editData = $armada->cari($id);
    // var_dump($editData);
}
if (isset($_POST['edit'])) {
    $armada->edit($_POST['id_armada'], $_POST['nama'], $_POST['plat'], $_POST['status']);
    header('location:armada.php');
    // var_dump($editData);
}

if (isset($_GET['hapus'])) {
    $armada->hapus($_GET['hapus']);
    header("location:armada.php");
}

?>

<!DOCTYPE html>
<html>

<head>
    <title>Data Armada</title>
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
    <h2 style="text-align: center;">DATA ARMADA</h2> <a href="index.php">Kembali</a>


    <!-- Form Input -->
    <div class="form-input">

        <!-- Edit -->
        <?php if ($editData) { ?>
            <h2 style="text-align : center;">Edit Data</h2>
            <form method="post" action="armada.php">
                <input type="hidden" name="id_armada" value="<?= $editData['id_armada']; ?>">

                <label for="nama">Nama Armada :</label>
                <input type="text" name="nama" id="nama" value="<?= $editData['nama_armada'] ?>" required><br><br>

                <label for="plat">Plat :</label>
                <input type="text" name="plat" id="plat" required value="<?= $editData['plat'] ?>"><br><br>

                <label for="status">Status :</label>
                <input type="text" name="status" id="status" required value="<?= $editData['status'] ?>"><br><br>

                <input type="submit" name="edit" value="Update data"> |
                <a href="armada.php">Batal</a>
            </form>

        <?php } else {  ?>
            <!-- Input -->
            <form method="post">
                <h2 style="text-align : center;">Tambah Data</h2>

                <label for="nama">Nama Armada :</label>
                <input type="text" name="nama" id="nama" required><br><br>

                <label for="plat">Plat :</label>
                <input type="text" name="plat" id="plat" required><br><br>

                <label for="status">Status :</label>
                <input type="text" name="status" id="status" required><br><br>

                <input type="submit" name="simpan" value="Simpan">

            </form>
        <?php } ?>
    </div>

    <!-- Tampilkan Data -->
    <table>
        <tr>
            <th>No</th>
            <th>Nama Armada</th>
            <th>Plat</th>
            <th>Status</th>
            <th>Aksi</th>
        </tr>

        <?php
        $no = 1;;
        foreach ($armada->tampil() as $data) {
        ?>
            <tr>
                <td><?php echo $no++; ?></td>
                <td><?php echo $data['nama_armada']; ?></td>
                <td><?php echo $data['plat']; ?></td>
                <td><?php echo $data['status']; ?></td>
                <td>
                    <a href="?edit=<?php echo $data['id_armada']; ?>">Edit</a> |
                    <a href="?hapus=<?php echo $data['id_armada']; ?> " onclick="return confirm('Yakin hapus data?')">Hapus</a>
                </td>
            </tr>
        <?php } ?>
    </table>
</body>

</html>