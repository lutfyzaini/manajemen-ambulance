<?php

    require_once (__DIR__.'\proses\proses-relawan.php');
    $relawan = new relawan();

    if(isset($_POST['simpan'])){
        $relawan->tambah($_POST['nama'],$_POST['jenis_kelamin'],$_POST['no_hp'],$_POST['alamat'] );

        // var_dump($result);
        // var_dump($_POST['jenis_kelamin']);
        header("location:relawan.php");
    }

    $editData = NULL;
    if(isset($_GET['edit'])){
        $id = $_GET['edit'];
        $editData = $relawan->cari($id);
        // var_dump($editData);
    } 
    if(isset($_POST['edit'])){
       $relawan->edit($_POST['id_relawan'],$_POST['nama'],$_POST['jk'],$_POST['no_hp'],$_POST['alamat']);
       header('location:relawan.php');
        // var_dump($editData);
    } 

    if(isset($_GET['hapus'])){
        $relawan->hapus($_GET['hapus']);
        header("location:relawan.php");
    }

?>

<!DOCTYPE html>
<html>
<head>
    <title>Data Relawan</title>
    <style>
        table {
            border-collapse: collapse;
            width: 80%;
            margin: 20px auto;
        }
        th, td {
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
    <h2 style="text-align: center;">DATA RELAWAN</h2>        <a href="index.php">Kembali</a>


    <!-- Form Input -->
    <div class="form-input">

        <!-- Edit -->
        <?php if($editData){ ?>
            <h2 style="text-align : center;">Edit Data</h2>
        <form method="post" action="relawan.php">
            <input type="hidden" name="id_relawan" value="<?= $editData['id_relawan'];?>">
 
            <label>Nama Relawan:</label>
            <input type="text" name="nama" value="<?=$editData ['nama_relawan']?>" required><br><br>
            
            <label>Jenis Kelamin:</label>
            <input type="radio" name="jk"  value="Laki-laki"  <?= ($editData['jenis_kelamin'] == 'Laki-laki') ? 'checked' : ''; ?>> Laki-laki 
            <input type="radio" name="jk" value="Perempuan" <?= ($editData['jenis_kelamin'] == 'Perempuan') ? 'checked' : ''; ?>> Perempuan<br><br>
            
            <label>No. HP:</label>
            <input type="text" name="no_hp" required value="<?= $editData['no_hp']?>"><br><br>
            
            <label>Alamat:</label>
            <input type="text" name="alamat" required value="<?= $editData['alamat'] ?>"><br><br>
            
            <input type="submit" name="edit" value="Update data"> |
            <a href="relawan.php">Batal</a>
        </form>

        <?php }else{  ?>
        <!-- Input -->
        <form method="post">
        <h2 style="text-align : center;">Tambah Data</h2>

            <label>Nama Relawan:</label>
            <input type="text" name="nama" required><br><br>
            
            <label>Jenis Kelamin:</label>
            <input type="radio" name="jenis_kelamin" value="Laki-laki" required> Laki-laki
            <input type="radio" name="jenis_kelamin" value="Perempuan"> Perempuan<br><br>
            
            <label>No. HP:</label>
            <input type="text" name="no_hp" required><br><br>
            
            <label>Alamat:</label>
            <input type="text" name="alamat" required><br><br>
            
            <input type="submit" name="simpan" value="Simpan">
            
        </form>
        <?php } ?>
    </div>

    <!-- Tampilkan Data -->
    <table>
        <tr>
            <th>No</th>
            <th>Nama Relawan</th>
            <th>Jenis Kelamin</th>
            <th>No. HP</th>
            <th>Alamat</th>
            <th>Aksi</th>
        </tr>
        
        <?php
        $no = 1;
        ;
        foreach($relawan ->tampil() as $data) {
        ?>
        <tr>
            <td><?php echo $data['id_relawan']; ?></td>
            <td><?php echo $data['nama_relawan']; ?></td>
            <td><?php echo $data['jenis_kelamin']; ?></td>
            <td><?php echo $data['no_hp']; ?></td>
            <td><?php echo $data['alamat']; ?></td>
            <td>
                <a href="?edit=<?php echo $data['id_relawan']; ?>">Edit</a> | 
                <a href="?hapus=<?php echo $data['id_relawan']; ?> "onclick="return confirm('Yakin hapus data?')">Hapus</a>
            </td>
        </tr>
        <?php } ?>
    </table>
</body>
</html>