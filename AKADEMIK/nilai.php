<?php
// Include config file
require_once "koneksi.php";
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Academic | Nilai</title>    
    <link rel="stylesheet" href="style.css">
 
    <link href="IMAGES/favicon.png" rel="icon">
</head>
<body>
    <header>
    <div><a class="cta" href="index.php"><button class="button button7"></button></a></div>
        <img class="logo" src="IMAGES/logo.png" alt="logo">
      
        <a class="cta" href="#"><button class="button button1">Admin</button></a>
    </header>
 
    <div class="fcustomer"><img style='vertical-align:middle;' src='IMAGES/nilai.png'>
      <div style='vertical-align:middle; display:inline; padding: 10px;'>NILAI</div>
     
</div>
<?php
// --- koneksi ke database
$conn=mysqli_connect("localhost","root","","db_akademik")or die(mysqli_error());
// --- Fngsi tambah data (Create)
function tambah($conn){
    
    if (isset($_POST['simpan'])){
        $id_nilai=$_POST['id_nilai'];
        $nim=$_POST['nim'];
        $semester=$_POST['semester'];
        $id_mk=$_POST['id_mk'];
        $sks=$_POST['sks'];
        $nilai=$_POST['nilai'];

        if(!empty($id_nilai) || !empty($nim)|| !empty($semester)|| !empty($id_mk)|| !empty($sks)|| !empty($nilai)){
            $sql = "insert into tbl_nilai ( id_nilai, nim,semester,id_mk,sks,nilai )" . 
              "values ( '$id_nilai','$nim' ,'$semester','$id_mk','$sks','$nilai')";
            $simpan = mysqli_query($conn, $sql);
            if($simpan && isset($_GET['aksi'])){
                if($_GET['aksi'] == 'create'){
                    header('location: nilai.php');
                   
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
       <form method="POST" action="nilai.php">
<table>
<tr><td>ID Nilai<td> <input type="text" name="id_nilai" required autocomplete="off" size="15"></td>
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
<tr><td>Semester<td><select name="semester" id="semester" >
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
  <td>SKS<td><select name="sks" id="sks">
  <option disabled selected> Pilih </option>
  <option value="1">1</option>
  <option value="2">2</option>
  <option value="3">3</option>
  <option value="4">4</option>
  <option value="5">5</option>
  <option value="6">6</option>
  </td>
<td>Nilai<td><input type="text" name="nilai"  required autocomplete="off" size="10"></td>
</table>
<footer>
    <button class="button button10" type="submit" name="simpan">Save</button><button class="button button10" type="reset">Reset</button><a href="nilai.php" class="button button10">Refresh</a>
</footer>      
        </form>
    <?php
}
// --- Tutup Fungsi tambah data
// --- Fungsi Baca Data (Read)
function tampil_data($conn){
    $sql = "SELECT * FROM tbl_nilai";
    $query = mysqli_query($conn, $sql);
       
    echo "<table id='tabelan'>";
    echo "<tr>
        <th>ID Nilai</th>
        <th>NIM</th>
        <th>Semester</th>
        <th>ID Matkul</th>
        <th>SKS</th>
        <th>Nilai</th>
        <th>Aksi</th>
        </tr>";
    
    while($data = mysqli_fetch_array($query)){
        ?>
            <tr>
                <td><?php echo $data['id_nilai']; ?></td>
                <td><?php echo $data['nim']; ?></td>
                <td><?php echo $data['semester']; ?></td>
                <td><?php echo $data['id_mk']; ?> </td>
                <td><?php echo $data['sks']; ?></td>
                <td><?php echo $data['nilai']; ?></td>
                <td>
                  <a class ="edit" href="nilai.php?aksi=update&id_nilai=<?php echo $data['id_nilai']; ?>&nim=<?php echo $data['nim']; ?>&semester=<?php echo $data['semester']; ?>&id_mk=<?php echo $data['id_mk']; ?>&sks=<?php echo $data['sks']; ?>&nilai=<?php echo $data['nilai']; ?>">Edit</a> |
                    <a class="edit" href="nilai.php?aksi=delete&id_nilai=<?php echo $data['id_nilai']; ?>"onclick="return confirm('Yakin ingin di Hapus?')">Hapus</a>
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
        $id_nilai=$_POST['id_nilai'];
        $nim=$_POST['nim'];
        $semester=$_POST['semester'];
        $id_mk=$_POST['id_mk'];
        $sks=$_POST['sks'];
        $nilai=$_POST['nilai'];

        if(!empty($id_nilai) || !empty($nim)|| !empty($semester)|| !empty($id_mk)|| !empty($sks)|| !empty($nilai)){
        $sql_update = "UPDATE tbl_nilai SET nim='$_POST[nim]',semester='$_POST[semester]',id_mk='$_POST[id_mk]',sks='$_POST[sks]',nilai='$_POST[nilai]' WHERE id_nilai='$id_nilai';";
        $update = mysqli_query($conn, $sql_update);
            if($update && isset($_GET['aksi'])){
                if($_GET['aksi'] == 'update'){
                    header('location: nilai.php');
                }
            }
        } else {
            $pesan = "Data tidak lengkap!";
        }
    }
    
    // tampilkan form ubah
    if(isset($_GET['id_nilai'])){
        ?>  
           <?php 
  $sql5 = "SELECT * FROM tbl_mahasiswa";
  $query5 = mysqli_query($conn, $sql5);
  while($data5 = mysqli_fetch_array($query5)){
 ?>
            <form action="" method="POST"  >
            <table>
<tr><td>ID Nilai<td> <input type="text" name="id_nilai" required autocomplete="off" size="15"value="<?php echo $_GET['id_nilai']?>"></td>
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
<tr><td>Semester<td><select name="semester" id="semester" >
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
  <td>SKS<td><select name="sks" id="sks">
  <option value="<?php echo $_GET['sks'] ?>"><?php echo $_GET['sks'] ?></option>
  <option value="1">1</option>
  <option value="2">2</option>
  <option value="3">3</option>
  <option value="4">4</option>
  <option value="5">5</option>
  <option value="6">6</option>
  </td>
<td>Nilai<td><input type="text" name="nilai"  required autocomplete="off" size="10"value="<?php echo $_GET['nilai']?>"></td>
</table>
<footer>
    <button class="button button10" type="submit" name="btn_ubah" id="btn_ubah">Update</button><a href="nilai.php" class="button button10">Refresh</a> <a href="nilai.php?aksi=delete&id_nilai=<?php echo $_GET['id_nilai'] ?>" class="button button10">Hapus data ini</a>
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
    if(isset($_GET['id_nilai']) && isset($_GET['aksi'])){
        $id_nilai = $_GET['id_nilai'];
        $sql_hapus = "DELETE FROM tbl_nilai WHERE id_nilai='$id_nilai'";
        $hapus = mysqli_query($conn, $sql_hapus);
        
        if($hapus){
            if($_GET['aksi'] == 'delete'){
                 
                header('location: nilai.php');
                
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
            echo '<a href="nilai.php"> &laquo; Home</a>';
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