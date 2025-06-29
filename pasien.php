<?php

    require_once (__DIR__.'\proses\proses-pasien.php');
    $pasien = new pasien();

    if(isset($_POST['simpan'])){
        $pasien->tambah($_POST['nama'],$_POST['jenis_kelamin'],$_POST['umur'],$_POST['alamat'], $_POST['no_hp'],$_POST['keterangan'] );

        // var_dump($result);
        header("location:pasien.php");
    }
    
    $editData = NULL;
    if(isset($_GET['edit'])){
        $id = $_GET['edit'];
        $editData = $pasien->cari($id);
        // var_dump($editData);
    } 
    if(isset($_POST['edit'])){
        // var_dump($_POST['jenis_kelamin']);
       $pasien->edit($_POST['id_pasien'],$_POST['nama'],$_POST['jk'],$_POST['umur'],$_POST['alamat'], $_POST['no_hp'],$_POST['keterangan'] );
       header('location:pasien.php');
        // var_dump($editData);
    } 

    if(isset($_GET['hapus'])){
        $pasien->hapus($_GET['hapus']);
        header("location:pasien.php");
    }

?>

<!DOCTYPE html>
<html>
<head>
    <title>Data Pasien</title>
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
    <h2 style="text-align: center;">DATA pasien</h2>        <a href="index.php">Kembali</a>


    <!-- Form Input -->
    <div class="form-input">

        <!-- Edit -->
        <?php if($editData){ ?>
            <h2 style="text-align : center;">Edit Data</h2>
        <form method="post" action="pasien.php">
            <input type="hidden" name="id_pasien" value="<?= $editData['id_pasien'];?>">
 
            <label>Nama pasien:</label>
            <input type="text" name="nama" value="<?=$editData ['nama_pasien']?>" required><br><br>
            
            <label>Jenis Kelamin:</label>
            <input type="radio" name="jk"  value="Laki-laki"  <?= ($editData['jenis_kelamin'] == 'Laki-laki') ? 'checked' : ''; ?>> Laki-laki 
            <input type="radio" name="jk" value="Perempuan" <?= ($editData['jenis_kelamin'] == 'Perempuan') ? 'checked' : ''; ?>> Perempuan<br><br>
            
            <label>Umur:</label>
            <input type="text" name="umur" required value="<?= $editData['umur']?>"><br><br>
            
            <label>Alamat:</label>
            <input type="text" name="alamat" required value="<?= $editData['alamat'] ?>"><br><br>

            <label>No. HP:</label>
            <input type="text" name="no_hp" required value="<?= $editData['no_hp'] ?>"><br><br>
            
            <label>Keterangan:</label>
            <input type="text" name="keterangan" required value="<?= $editData['keterangan'] ?>"><br><br>
            
            <input type="submit" name="edit" value="Update data"> |
            <a href="pasien.php">Batal</a>
        </form>

        <?php }else{  ?>
        <!-- Input -->
        <form method="post">
        <h2 style="text-align : center;">Tambah Data</h2>

            <label>Nama pasien:</label>
            <input type="text" name="nama" required><br><br>
            
            <label>Jenis Kelamin:</label>
            <input type="radio" name="jenis_kelamin" value="Laki-laki"> Laki-laki
            <input type="radio" name="jenis_kelamin" value="Perempuan"> Perempuan<br><br>
            
            <label>Umur :</label>
            <input type="text" name="umur" required><br><br>
            
            <label>Alamat :</label>
            <input type="text" name="alamat" required><br><br>            
            
            <label>No. HP:</label>
            <input type="text" name="no_hp" required><br><br>
            
            <label>Keterangan :</label>
            <input type="text" name="keterangan" required><br><br>
            
            <input type="submit" name="simpan" value="Simpan">
            
        </form>
        <?php } ?>
    </div>

    <!-- Tampilkan Data -->
    <table>
        <tr>
            <th>No</th>
            <th>Nama pasien</th>
            <th>Jenis Kelamin</th>
            <th>No. HP</th>
            <th>Alamat</th>
            <th>No. HP</th>
            <th>Keterangan</th>
            <th>Aksi</th>
        </tr>
        
        <?php
        $no = 1;
        ;
        foreach($pasien ->tampil() as $data) {
        ?>
        <tr>
            <td><?php echo $data['id_pasien']; ?></td>
            <td><?php echo $data['nama_pasien']; ?></td>
            <td><?php echo $data['jenis_kelamin']; ?></td>
            <td><?php echo $data['umur']; ?></td>
            <td><?php echo $data['alamat']; ?></td>
            <td><?php echo $data['no_hp']; ?></td>
            <td><?php echo $data['keterangan']; ?></td>
            <td>
                <a href="?edit=<?php echo $data['id_pasien']; ?>">Edit</a> | 
                <a href="?hapus=<?php echo $data['id_pasien']; ?> "onclick="return confirm('Yakin hapus data?')">Hapus</a>
            </td>
        </tr>
        <?php } ?>
    </table>
</body>
</html>