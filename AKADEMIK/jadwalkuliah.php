<?php
// Include config file
require_once "koneksi.php";
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Academic | Jadwal Kuliah</title>    
    <link rel="stylesheet" href="style.css">
 
    <link href="IMAGES/favicon.png" rel="icon">
</head>
<body>
    <header>
    <div><a class="cta" href="index.php"><button class="button button7"></button></a></div>
        <img class="logo" src="IMAGES/logo.png" alt="logo">
      
        <a class="cta" href="#"><button class="button button1">Admin</button></a>
    </header>
 
    <div class="fcustomer"><img style='vertical-align:middle;' src='IMAGES/jadwal.png'>
      <div style='vertical-align:middle; display:inline; padding: 10px;'>JADWAL KULIAH</div>
     
</div>
<?php
// --- koneksi ke database
$conn=mysqli_connect("localhost","root","","db_akademik")or die(mysqli_error());
// --- Fngsi tambah data (Create)
function tambah($conn){
    
    if (isset($_POST['simpan'])){
        $id_jk=$_POST['id_jk'];
        $nim=$_POST['nim'];
        $semester=$_POST['semester'];
        $id_mk=$_POST['id_mk'];
        $waktu=$_POST['waktu'];
        $ruangan=$_POST['ruangan'];
        $kelas=$_POST['kelas'];
        $nip=$_POST['nip'];

        if(!empty($id_jk) || !empty($nim)|| !empty($semester)|| !empty($id_mk)|| !empty($waktu)|| !empty($ruangan)|| !empty($kelas)|| !empty($nip)){
            $sql = "insert into tbl_jadwal_kuliah ( id_jk,nim,semester,id_mk,waktu,ruangan,kelas,nip )" . 
              "values ( '$id_jk','$nim' ,'$semester','$id_mk','$waktu','$ruangan','$kelas','$nip')";
            $simpan = mysqli_query($conn, $sql);
            if($simpan && isset($_GET['aksi'])){
                if($_GET['aksi'] == 'create'){
                    header('location: jadwalkuliah.php');
                   
                }
            }
        } else {
            $pesan = "Tidak dapat menyimpan, data belum lengkap!";
        }
    }
    ?> 
       <?php 
  $sql5 = "SELECT * FROM tbl_mahasiswa";
  $query5 = mysqli_query($conn, $sql5);
  while($data5 = mysqli_fetch_array($query5)){
 ?>
       <form method="POST" action="jadwalkuliah.php">
<table>
<tr><td>ID Jadwal Kuliah<td> <input type="text" name="id_jk" required autocomplete="off" size="15"></td>
<td>NIM<td><select name="nim" id="nim">
  <option disabled selected> Pilih </option>
  <option value="<?php echo $data5['nim']?>"><?php echo $data5['nim']?></option> 
 <?php
  }
 ?>
  </td>
  <?php 
  $sql6 = "SELECT * FROM tbl_mata_kuliah";
  $query6 = mysqli_query($conn, $sql6);
  while($data6 = mysqli_fetch_array($query6)){
 ?>
  <td>ID Mata Kuliah<td><select name="id_mk" id="id_mk">
  <option disabled selected> Pilih </option>
  <option value="<?php echo $data6['id_mk']?>"><?php echo $data6['id_mk']?></option> 
 <?php
  }
 ?>
  </td>
  <?php 
  $sql7 = "SELECT * FROM tbl_dosen";
  $query7 = mysqli_query($conn, $sql7);
  while($data7 = mysqli_fetch_array($query7)){
 ?>
  <td>NIP<td><select name="nip" id="nip">
  <option disabled selected> Pilih </option>
  <option value="<?php echo $data7['nip']?>"><?php echo $data7['nip']?></option> 
 <?php
  }
 ?>
  </td>
<tr> <td>Semester<td><select name="semester" id="semester" >
  <option disabled selected> Pilih </option>
  <option value="1">1</option>
  <option value="2">2</option>
  <option value="3">3</option>
  <option value="4">4</option>
  <option value="5">5</option>
  <option value="6">6</option>
  <option value="7">7</option>
  <option value="8">8</option>
  <option value="9">9</option>
  <option value="10">10</option>
  <option value="11">11</option>
  <option value="12">12</option>
  <option value="13">13</option>
  <option value="14">14</option>
  </td>
  <td>Kelas<td><input type="text" name="kelas" required autocomplete="off" size="10"></td>
<td>Waktu<td><input type="text" name="waktu"  required autocomplete="off" size="20"></td>
<td>Ruangan<td><input type="text" name="ruangan"  required autocomplete="off" size="20"></td>
</table>
<footer>
    <button class="button button10" type="submit" name="simpan">Save</button><button class="button button10" type="reset">Reset</button><a href="jadwalkuliah.php" class="button button10">Refresh</a>
</footer>      
        </form>
    <?php
}
// --- Tutup Fungsi tambah data
// --- Fungsi Baca Data (Read)
function tampil_data($conn){
    $sql = "SELECT * FROM tbl_jadwal_kuliah";
    $query = mysqli_query($conn, $sql);
       
    echo "<table id='tabelan'>";
    echo "<tr>
        <th>ID Jadwal</th>
        <th>NIM</th>
        <th>Semester</th>
        <th>ID Matkul</th>
        <th>Waktu</th>
        <th>Ruangan</th>
        <th>Kelas</th>
        <th>NIP</th>
        <th>Aksi</th>
        </tr>";
    
    while($data = mysqli_fetch_array($query)){
        ?>
            <tr>
                <td><?php echo $data['id_jk']; ?></td>
                <td><?php echo $data['nim']; ?></td>
                <td><?php echo $data['semester']; ?></td>
                <td><?php echo $data['id_mk']; ?> </td>
                <td><?php echo $data['waktu']; ?></td>
                <td><?php echo $data['ruangan']; ?></td>
                <td><?php echo $data['kelas']; ?> </td>
                <td><?php echo $data['nip']; ?></td>
                <td>
                  <a class ="edit" href="jadwalkuliah.php?aksi=update&id_jk=<?php echo $data['id_jk']; ?>&nim=<?php echo $data['nim']; ?>&semester=<?php echo $data['semester']; ?>&id_mk=<?php echo $data['id_mk']; ?>&waktu=<?php echo $data['waktu']; ?>&ruangan=<?php echo $data['ruangan']; ?>&kelas=<?php echo $data['kelas']; ?>&nip=<?php echo $data['nip']; ?>">Edit</a> |
                    <a class="edit" href="jadwalkuliah.php?aksi=delete&id_jk=<?php echo $data['id_jk']; ?>"onclick="return confirm('Yakin ingin di Hapus?')">Hapus</a>
                </td>
            </tr>
        <?php
    }
    echo "</table>";
 
}
// --- Tutup Fungsi Baca Data (Read)
// --- Fungsi Ubah Data (Update)
function ubah($conn){
    // ubah data
    if(isset($_POST['btn_ubah'])){
        $id_jk=$_POST['id_jk'];
        $nim=$_POST['nim'];
        $semester=$_POST['semester'];
        $id_mk=$_POST['id_mk'];
        $waktu=$_POST['waktu'];
        $ruangan=$_POST['ruangan'];
        $kelas=$_POST['kelas'];
        $nip=$_POST['nip'];

        if(!empty($id_jk) || !empty($nim)|| !empty($semester)|| !empty($id_mk)|| !empty($waktu)|| !empty($ruangan)|| !empty($kelas)|| !empty($nip)){
        $sql_update = "UPDATE tbl_jadwal_kuliah SET nim='$_POST[nim]',semester='$_POST[semester]',id_mk='$_POST[id_mk]',waktu='$_POST[waktu]',ruangan='$_POST[ruangan]',kelas='$_POST[kelas]',nip='$_POST[nip]' WHERE id_jk='$id_jk';";
        $update = mysqli_query($conn, $sql_update);
            if($update && isset($_GET['aksi'])){
                if($_GET['aksi'] == 'update'){
                    header('location: jadwalkuliah.php');
                }
            }
        } else {
            $pesan = "Data tidak lengkap!";
        }
    }
    
    // tampilkan form ubah
    if(isset($_GET['id_jk'])){
        ?>  
           <?php 
  $sql5 = "SELECT * FROM tbl_mahasiswa";
  $query5 = mysqli_query($conn, $sql5);
  while($data5 = mysqli_fetch_array($query5)){
 ?>
            <form action="" method="POST"  >
            <table>
<tr><td>ID Jadwal Kuliah<td> <input type="text" name="id_jk" required autocomplete="off" size="15"value="<?php echo $_GET['id_jk']?>"></td>
<td>NIM<td><select name="nim" id="nim">
<option value="<?php echo $_GET['nim'] ?>"><?php echo $_GET['nim'] ?></option>
  <option value="<?php echo $data5['nim']?>"><?php echo $data5['nim']?></option> 
 <?php
  }
 ?>
  </td>
  <?php 
  $sql6 = "SELECT * FROM tbl_mata_kuliah";
  $query6 = mysqli_query($conn, $sql6);
  while($data6 = mysqli_fetch_array($query6)){
 ?>
  <td>ID Mata Kuliah<td><select name="id_mk" id="id_mk">
  <option value="<?php echo $_GET['id_mk'] ?>"><?php echo $_GET['id_mk'] ?></option>
  <option value="<?php echo $data6['id_mk']?>"><?php echo $data6['id_mk']?></option> 
 <?php
  }
 ?>
  </td>
  <?php 
  $sql7 = "SELECT * FROM tbl_dosen";
  $query7 = mysqli_query($conn, $sql7);
  while($data7 = mysqli_fetch_array($query7)){
 ?>
  <td>NIP<td><select name="nip" id="nip">
  <option value="<?php echo $_GET['nip'] ?>"><?php echo $_GET['nip'] ?></option>
  <option value="<?php echo $data7['nip']?>"><?php echo $data7['nip']?></option> 
 <?php
  }
 ?>
  </td>
<tr> <td>Semester<td><select name="semester" id="semester" >
<option value="<?php echo $_GET['semester'] ?>"><?php echo $_GET['semester'] ?></option>
  <option value="1">1</option>
  <option value="2">2</option>
  <option value="3">3</option>
  <option value="4">4</option>
  <option value="5">5</option>
  <option value="6">6</option>
  <option value="7">7</option>
  <option value="8">8</option>
  <option value="9">9</option>
  <option value="10">10</option>
  <option value="11">11</option>
  <option value="12">12</option>
  <option value="13">13</option>
  <option value="14">14</option>
  </td>
  <td>Kelas<td><input type="text" name="kelas" required autocomplete="off" size="10"value="<?php echo $_GET['kelas']?>"></td>
<td>Waktu<td><input type="text" name="waktu"  required autocomplete="off" size="20"value="<?php echo $_GET['waktu']?>"></td>
<td>Ruangan<td><input type="text" name="ruangan"  required autocomplete="off" size="20"value="<?php echo $_GET['ruangan']?>"></td>
</table>
<footer>
    <button class="button button10" type="submit" name="btn_ubah" id="btn_ubah">Update</button><a href="jadwalkuliah.php" class="button button10">Refresh</a> <a href="jadwalkuliah.php?aksi=delete&id_jk=<?php echo $_GET['id_jk'] ?>" class="button button10">Hapus data ini</a>
    </footer>           
    <br>
                <p><?php echo isset($pesan) ? $pesan : "" ?></p>
  
            </form>
        <?php
    }
    
}
// --- Tutup Fungsi Update
// --- Fungsi Delete
function hapus($conn){
    if(isset($_GET['id_jk']) && isset($_GET['aksi'])){
        $id_jk = $_GET['id_jk'];
        $sql_hapus = "DELETE FROM tbl_jadwal_kuliah WHERE id_jk='$id_jk'";
        $hapus = mysqli_query($conn, $sql_hapus);
        
        if($hapus){
            if($_GET['aksi'] == 'delete'){
                 
                header('location: jadwalkuliah.php');
                
            }
        }
    }
    
}
// --- Tutup Fungsi Hapus
// ===================================================================
// --- Program Utama
if (isset($_GET['aksi'])){
    switch($_GET['aksi']){
        case "create":
            echo '<a href="jadwalkuliah.php"> &laquo; Home</a>';
            tambah($conn); 
         
            break;
        case "read":
            tampil_data($conn);
            break;
        case "update":
            ubah($conn);
            tampil_data($conn);
            break;
        case "delete":
            hapus($conn);
            tambah($conn);
            tampil_data($conn); 
            break;
        default:
            echo "<h3>Aksi<i>".$_GET['aksi']."</i> tidak ada!</h3>";
            tambah($conn);
            tampil_data($conn);
    }
} else {
    tambah($conn);
    tampil_data($conn);
    
}
?>
</body>
</html>