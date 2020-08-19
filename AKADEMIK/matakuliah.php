<?php
// Include config file
require_once "koneksi.php";
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Academic | Mata Kuliah</title>    
    <link rel="stylesheet" href="style.css">
 
    <link href="IMAGES/favicon.png" rel="icon">
</head>
<body>
    <header>
    <div><a class="cta" href="index.php"><button class="button button7"></button></a></div>
        <img class="logo" src="IMAGES/logo.png" alt="logo">
      
        <a class="cta" href="#"><button class="button button1">Admin</button></a>
    </header>
 
    <div class="fcustomer"><img style='vertical-align:middle;' src='IMAGES/matakuliah.png'>
      <div style='vertical-align:middle; display:inline; padding: 10px;'>MATA KULIAH</div>
     
</div>
<?php
// --- koneksi ke database
$conn=mysqli_connect("localhost","root","","db_akademik")or die(mysqli_error());
// --- Fngsi tambah data (Create)
function tambah($conn){
    
    if (isset($_POST['simpan'])){
        $id_mk=$_POST['id_mk'];
        $nama_mk=$_POST['nama_mk'];
        $sks=$_POST['sks'];
        $jurusan=$_POST['jurusan'];
        $semester=$_POST['semester'];
        
        if(!empty($id_mk) || !empty($nama_mk)|| !empty($sks)|| !empty($jurusan)|| !empty($semester)){
            $sql = "insert into tbl_mata_kuliah ( id_mk, nama_mk,sks,jurusan,semester )" . 
              "values ( '$id_mk','$nama_mk' ,'$sks','$jurusan','$semester')";
            $simpan = mysqli_query($conn, $sql);
            if($simpan && isset($_GET['aksi'])){
                if($_GET['aksi'] == 'create'){
                    header('location: matakuliah.php');
                   
                }
            }
        } else {
            $pesan = "Tidak dapat menyimpan, data belum lengkap!";
        }
    }
    ?> 
       <form method="POST" action="matakuliah.php">
<table>
<tr><td>ID Mata Kuliah<td> <input type="text" name="id_mk" required autocomplete="off" size="15"></td>
<td>Jurusan<td><select name="jurusan" id="jurusan">
  <option disabled selected> Pilih </option>
  <option value="Teknik Informatika">Teknik Informatika</option>
  <option value="Sistem Informasi">Sistem Informasi</option>
  <option value="Manajemen">Manajemen</option>
  <option value="Sastra Inggris">Sastra Inggris</option>
  <option value="Akuntansi">Akuntansi</option>
  </td>
<tr><td>Nama Mata Kuliah<td colspan="3"><input type="text" name="nama_mk"  required autocomplete="off" size="30"></td>

  <td>SKS<td><select name="sks" id="sks">
  <option disabled selected> Pilih </option>
  <option value="1">1</option>
  <option value="2">2</option>
  <option value="3">3</option>
  <option value="4">4</option>
  <option value="5">5</option>
  <option value="6">6</option>
  </td>
  <td>Semester<td><select name="semester" id="semester" >
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
</table>
<footer>
    <button class="button button10" type="submit" name="simpan">Save</button><button class="button button10" type="reset">Reset</button><a href="matakuliah.php" class="button button10">Refresh</a>
</footer>      
        </form>
    <?php
}
// --- Tutup Fungsi tambah data
// --- Fungsi Baca Data (Read)
function tampil_data($conn){
    $sql = "SELECT * FROM tbl_mata_kuliah";
    $query = mysqli_query($conn, $sql);
       
    echo "<table id='tabelan'>";
    echo "<tr>
        <th>ID Mata Kuliah</th>
        <th>Nama Mata Kuliah</th>
        <th>SKS</th>
        <th>Jurusan</th>
        <th>Semester</th>
        <th>Aksi</th>
        </tr>";
    
    while($data = mysqli_fetch_array($query)){
        ?>
            <tr>
                <td><?php echo $data['id_mk']; ?></td>
                <td><?php echo $data['nama_mk']; ?></td>
                <td><?php echo $data['sks']; ?></td>
                <td><?php echo $data['jurusan']; ?> </td>
                <td><?php echo $data['semester']; ?></td>
                <td>
                  <a class ="edit" href="matakuliah.php?aksi=update&id_mk=<?php echo $data['id_mk']; ?>&nama_mk=<?php echo $data['nama_mk']; ?>&sks=<?php echo $data['sks']; ?>&jurusan=<?php echo $data['jurusan']; ?>&semester=<?php echo $data['semester']; ?>">Edit</a> |
                    <a class="edit" href="matakuliah.php?aksi=delete&id_mk=<?php echo $data['id_mk']; ?>"onclick="return confirm('Yakin ingin di Hapus?')">Hapus</a>
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
        $id_mk=$_POST['id_mk'];
        $nama_mk=$_POST['nama_mk'];
        $sks=$_POST['sks'];
        $jurusan=$_POST['jurusan'];
        $semester=$_POST['semester'];
        
      if(!empty($id_mk) || !empty($nama_mk)|| !empty($sks)|| !empty($jurusan)|| !empty($semester)){
        $sql_update = "UPDATE tbl_mata_kuliah SET nama_mk='$_POST[nama_mk]',sks='$_POST[sks]',jurusan='$_POST[jurusan]',semester='$_POST[semester]' WHERE id_mk='$id_mk';";
        $update = mysqli_query($conn, $sql_update);
            if($update && isset($_GET['aksi'])){
                if($_GET['aksi'] == 'update'){
                    header('location: matakuliah.php');
                }
            }
        } else {
            $pesan = "Data tidak lengkap!";
        }
    }
    
    // tampilkan form ubah
    if(isset($_GET['id_mk'])){
        ?>  
            <form action="" method="POST"  >
            <table>
<tr><td>ID Mata Kuliah<td> <input type="text" name="id_mk" required autocomplete="off" size="15"value="<?php echo $_GET['id_mk']?>"></td>
<td>Jurusan<td><select name="jurusan" id="jurusan">
<option value="<?php echo $_GET['jurusan'] ?>"><?php echo $_GET['jurusan'] ?></option>
  <option value="Teknik Informatika">Teknik Informatika</option>
  <option value="Sistem Informasi">Sistem Informasi</option>
  <option value="Manajemen">Manajemen</option>
  <option value="Sastra Inggris">Sastra Inggris</option>
  <option value="Akuntansi">Akuntansi</option>
  </td>
<tr><td>Nama Mata Kuliah<td colspan="3"><input type="text" name="nama_mk"  required autocomplete="off" size="30"value="<?php echo $_GET['nama_mk']?>"></td>

  <td>SKS<td><select name="sks" id="sks">
  <option value="<?php echo $_GET['sks'] ?>"><?php echo $_GET['sks'] ?></option>
  <option value="1">1</option>
  <option value="2">2</option>
  <option value="3">3</option>
  <option value="4">4</option>
  <option value="5">5</option>
  <option value="6">6</option>
  </td>
  <td>Semester<td><select name="semester" id="semester" >
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
</table>
<footer>
    <button class="button button10" type="submit" name="btn_ubah" id="btn_ubah">Update</button><a href="matakuliah.php" class="button button10">Refresh</a> <a href="matakuliah.php?aksi=delete&id_mk=<?php echo $_GET['id_mk'] ?>" class="button button10">Hapus data ini</a>
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
    if(isset($_GET['id_mk']) && isset($_GET['aksi'])){
        $id_mk = $_GET['id_mk'];
        $sql_hapus = "DELETE FROM tbl_mata_kuliah WHERE id_mk='$id_mk'";
        $hapus = mysqli_query($conn, $sql_hapus);
        
        if($hapus){
            if($_GET['aksi'] == 'delete'){
                 
                header('location: matakuliah.php');
                
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
            echo '<a href="matakuliah.php"> &laquo; Home</a>';
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