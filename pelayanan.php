<?php
    require_once (__DIR__.'\proses\proses-pelayanan.php');
    require_once (__DIR__.'\proses\proses-relawan.php');
    require_once (__DIR__.'\proses\proses-armada.php');
    require_once (__DIR__.'\proses\proses-pasien.php');

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


    // Data tiga entitas(relawan, pasien, armada)



    if(isset($_POST['simpan'])){
        $pelayanan->tambah($_POST['tanggal'],$_POST['id_pasien'],$_POST['id_relawan'],$_POST['id_armada'], $_POST['dari_lokasi'], $_POST['ke_lokasi'], $_POST['jenis_pelayanan'],$_POST['keterangan']); 
        // $tanggal, $id_relawan, $id_armada, $id_pasien, $dari_lokasi, $ke_lokasi, $jenis_pelayanan, $keterangan

        // var_dump($result);
        header("location:pelayanan.php");
    }
    
    $editData = NULL;
    if(isset($_GET['edit'])){
        $id = $_GET['edit'];
        $editData = $pelayanan->cari($id);
        // var_dump($editData);
    } 
    if(isset($_POST['edit'])){
        // var_dump($_POST['jenis_kelamin']);
       $pelayanan->edit($_POST['tanggal'],$_POST['id_pelayanan'], $_POST['id_pasien'], $_POST['id_relawan'],$_POST['id_armada'], $_POST['dari_lokasi'], $_POST['ke_lokasi'], $_POST['jenis_pelayanan'],$_POST['keterangan']);
       header('location:pelayanan.php');
        // var_dump($editData);
    } 

    if(isset($_GET['hapus'])){
        $pelayanan->hapus($_GET['hapus']);
        header("location:pelayanan.php");
    }

?>

<!DOCTYPE html>
<html>
<head>
    <title>Data Pelayanan</title>
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
    <h2 style="text-align: center;">DATA PELAYANAN</h2>        <a href="index.php">Kembali</a>


    <!-- Form Input -->
    <div class="form-input">

        <!-- Edit -->
        <?php if($editData){ ?>
            <h2 style="text-align : center;">Edit Data</h2>
        <form method="post" action="pelayanan.php">
            <input type="hidden" name="Pelayanan" value="<?= $editData['id_pelayanan'];?>">
            <label>Tanggal</label>
            <input type="date" name="tanggal" required><br><br>

            <label>Pasien :</label>
            <select name="id_pasien" required><br><br>
                <?php foreach ($pelayanan->tampil() as $data) {?>
                    <option value="<?= $data['id_pasien'];?>"><?= $data['nama_pasien'] ?></option>
                <?php } ;?>
                <?php foreach ($pasien->tampil() as $data) {?>
                    <option value="<?= $data['id_pasien'];?>"><?= $data['nama_pasien'] ?></option>
                <?php } ;?>
            </select><br><br>

            <label>Relawan :</label>
            <select name="id_relawan" required><br><br>
                <?php foreach ($pelayanan->tampil() as $data) {?>
                    <option value="<?= $data['id_relawan'];?>"><?= $data['nama_relawan'] ?></option>
                <?php }  ?>
                <?php foreach ($relawan->tampil() as $data) {?>
                    <option value="<?= $data['id_relawan'];?>"><?= $data['nama_relawan'] ?></option>
                <?php }  ?>
            </select><br><br>

            <label>Armada :</label>
            <select name="id_armada" required><br><br>
                <?php foreach ($pelayanan->tampil() as $data) {?>
                    <option value=" <?= $data['id_armada'];?>"><?= $data['nama_armada'] ?></option>
                <?php }  ?>
                <?php foreach ($armada->tampil() as $data) {?>
                    <option value=" <?= $data['id_armada'];?>"><?= $data['nama_armada'] ?></option>
                <?php }  ?>
            </select><br><br>

            <label>Dari Lokasi :</label>
            <input type="text" name="dari_lokasi" value="<?= $editData['dari_lokasi'] ?>" ><br><br>

            <label>Ke Lokasi : </label>
            <input type="text" name="ke_lokasi" value="<?= $editData['ke_lokasi']  ?>"><br><br>
            
            <label>Jenis Pelayanan :</label>
            <input type="text" name="jenis_pelayanan" value="<?= $editData['ke_lokasi']?>"><br><br>
            
            <label>Keterangan :</label>
            <input type="text" name="keterangan" value="<?= $editData['ke_lokasi'] ?>"><br><br>

            <input type="submit" name="edit" value="Update data"> |
            <a href="pelayanan.php">Batal</a>
        </form>

        <?php }else{  ?>
        <!-- Input -->
        <form method="post">
        <h2 style="text-align : center;">Tambah Data</h2>
            <label>Tanggal</label>
            <input type="date" name="tanggal" required><br><br>

            <label>Pasien :</label>
            <select name="id_pasien" required><br><br>
                <option></option>
                <?php foreach ($pasien->tampil() as $data) {?>
                    <option value="<?= $data['id_pasien'];?>"><?= $data['nama_pasien'] ?></option>
                <?php } ;?>
            </select><br><br>

            <label>Relawan :</label>
            <select name="id_relawan" required><br><br>
                <option></option>
                <?php foreach ($relawan->tampil() as $data) {?>
                    <option value="<?= $data['id_relawan'];?>"><?= $data['nama_relawan'] ?></option>
                <?php }  ?>
            </select><br><br>

            <label>Armada :</label>
            <select name="id_armada" required><br><br>
                <option></option>
                <?php foreach ($armada->tampil() as $data) {?>
                    <option value=" <?= $data['id_armada'];?>"><?= $data['nama_armada'] ?></option>
                <?php }  ?>
            </select><br><br>

            <label>Dari Lokasi :</label>
            <input type="text" name="dari_lokasi" required><br><br>

            <label>Ke Lokasi : </label>
            <input type="text" name="ke_lokasi" required><br><br>
            
            <label>Jenis Pelayanan :</label>
            <input type="text" name="jenis_pelayanan" required><br><br>
            
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
        
        <?php
        $no = 1;
        ;
        foreach($pelayanan ->tampil() as $data) {
        ?>
        <tr>
            <td><?php echo $data['id_pelayanan']; ?></td>
            <td><?php echo $data['tanggal']; ?></td>
            <td><?php echo $data['nama_pasien']; ?></td>
            <td><?php echo $data['nama_relawan']; ?></td>
            <td><?php echo $data['nama_armada']; ?></td>
            <td><?php echo $data['dari_lokasi']; ?></td>
            <td><?php echo $data['ke_lokasi']; ?></td>
            <td><?php echo $data['jenis_pelayanan']; ?></td>
            <td><?php echo $data['keterangan']; ?></td>
            <td>
                <a href="?edit=<?php echo $data['id_pelayanan']; ?>">Edit</a> | 
                <a href="?hapus=<?php echo $data['id_pelayanan']; ?> "onclick="return confirm('Yakin hapus data?')">Hapus</a>
            </td>
        </tr>
        <?php } ?>
    </table>
</body>
</html>