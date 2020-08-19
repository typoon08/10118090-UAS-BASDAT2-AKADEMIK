<?php
// Include config file
require_once "koneksi.php";
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Academic | Mahasiswa</title>    
    <link rel="stylesheet" href="style.css">
 
    <link href="IMAGES/favicon.png" rel="icon">
</head>
<body>
    <header>
    <div><a class="cta" href="index.php"><button class="button button7"></button></a></div>
        <img class="logo" src="IMAGES/logo.png" alt="logo">
      
        <a class="cta" href="#"><button class="button button1">Admin</button></a>
    </header>
 
    <div class="fcustomer"><img style='vertical-align:middle;' src='IMAGES/mahasiswa.png'>
      <div style='vertical-align:middle; display:inline; padding: 10px;'>MAHASISWA</div>
     
</div>
<?php
// --- koneksi ke database
$conn=mysqli_connect("localhost","root","","db_akademik")or die(mysqli_error());
// --- Fngsi tambah data (Create)
function tambah($conn){
    
    if (isset($_POST['simpan'])){
        $nim=$_POST['nim'];
        $nama_mhs=$_POST['nama_mhs'];
        $jurusan=$_POST['jurusan'];
        $kelas=$_POST['kelas'];
        $angkatan=$_POST['angkatan'];
        $semester=$_POST['semester'];
        
        if(!empty($nim) || !empty($nama_mhs)|| !empty($jurusan)|| !empty($kelas)|| !empty($angkatan)|| !empty($semester)){
            $sql = "insert into tbl_mahasiswa ( nim, nama_mhs,jurusan,kelas,angkatan,semester )" . 
              "values ( '$nim','$nama_mhs' ,'$jurusan','$kelas','$angkatan','$semester')";
            $simpan = mysqli_query($conn, $sql);
            if($simpan && isset($_GET['aksi'])){
                if($_GET['aksi'] == 'create'){
                    header('location: mahasiswa.php');
                   
                }
            }
        } else {
            $pesan = "Tidak dapat menyimpan, data belum lengkap!";
        }
    }
    ?> 
       <form method="POST" action="mahasiswa.php">
<table>
<tr><td>NIM<td> <input type="text" name="nim" required autocomplete="off" size="15"></td>
<td>Jurusan<td><select name="jurusan" id="jurusan">
  <option disabled selected> Pilih </option>
  <option value="Teknik Informatika">Teknik Informatika</option>
  <option value="Sistem Informasi">Sistem Informasi</option>
  <option value="Manajemen">Manajemen</option>
  <option value="Sastra Inggris">Sastra Inggris</option>
  <option value="Akuntansi">Akuntansi</option>
  </td>
<tr><td>Nama Mahasiswa<td colspan="3"><input type="text" name="nama_mhs"  required autocomplete="off" size="30"></td>

  <td>Kelas<td><input type="text" name="kelas" required autocomplete="off" size="10"></td>
  <td>Angkatan<td><select name="angkatan" id="angkatan">
  <option disabled selected> Pilih </option>
  <option value="2015">2015</option>
  <option value="2016">2016</option>
  <option value="2017">2017</option>
  <option value="2018">2018</option>
  <option value="2019">2019</option>
  <option value="2020">2020</option>
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
    <button class="button button10" type="submit" name="simpan">Save</button><button class="button button10" type="reset">Reset</button><a href="mahasiswa.php" class="button button10">Refresh</a>
</footer>      
        </form>
    <?php
}
// --- Tutup Fungsi tambah data
// --- Fungsi Baca Data (Read)
function tampil_data($conn){
    $sql = "SELECT * FROM tbl_mahasiswa";
    $query = mysqli_query($conn, $sql);
       
    echo "<table id='tabelan'>";
    echo "<tr>
        <th>NIM</th>
        <th>Nama Mahasiswa</th>
        <th>Jurusan</th>
        <th>Kelas</th>
        <th>Angkatan</th>
        <th>Semester</th>
        <th>Aksi</th>
        </tr>";
    
    while($data = mysqli_fetch_array($query)){
        ?>
            <tr>
                <td><?php echo $data['nim']; ?></td>
                <td><?php echo $data['nama_mhs']; ?></td>
                <td><?php echo $data['jurusan']; ?></td>
                <td><?php echo $data['kelas']; ?> </td>
                <td><?php echo $data['angkatan']; ?></td>
                <td><?php echo $data['semester']; ?></td>
                <td>
                  <a class ="edit" href="mahasiswa.php?aksi=update&nim=<?php echo $data['nim']; ?>&nama_mhs=<?php echo $data['nama_mhs']; ?>&jurusan=<?php echo $data['jurusan']; ?>&kelas=<?php echo $data['kelas']; ?>&angkatan=<?php echo $data['angkatan']; ?>&semester=<?php echo $data['semester']; ?>">Edit</a> |
                    <a class="edit" href="mahasiswa.php?aksi=delete&nim=<?php echo $data['nim']; ?>"onclick="return confirm('Yakin ingin di Hapus?')">Hapus</a>
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
        $nim=$_POST['nim'];
        $nama_mhs=$_POST['nama_mhs'];
        $jurusan=$_POST['jurusan'];
        $kelas=$_POST['kelas'];
        $angkatan=$_POST['angkatan'];
        $semester=$_POST['semester'];
        
      if(!empty($nim) || !empty($nama_mhs)|| !empty($jurusan)|| !empty($kelas)|| !empty($angkatan)|| !empty($semester)){
        $sql_update = "UPDATE tbl_mahasiswa SET nama_mhs='$_POST[nama_mhs]',jurusan='$_POST[jurusan]',kelas='$_POST[kelas]',angkatan='$_POST[angkatan]',semester='$_POST[semester]' WHERE nim='$nim';";
        $update = mysqli_query($conn, $sql_update);
            if($update && isset($_GET['aksi'])){
                if($_GET['aksi'] == 'update'){
                    header('location: mahasiswa.php');
                }
            }
        } else {
            $pesan = "Data tidak lengkap!";
        }
    }
    
    // tampilkan form ubah
    if(isset($_GET['nim'])){
        ?>  
            <form action="" method="POST"  >
            <table>
<tr><td>NIM<td> <input type="text" name="nim" required autocomplete="off" size="15"value="<?php echo $_GET['nim']?>"></td>
<td>Jurusan<td><select name="jurusan" id="jurusan">
<option value="<?php echo $_GET['jurusan'] ?>"><?php echo $_GET['jurusan'] ?></option>
  <option value="Teknik Informatika">Teknik Informatika</option>
  <option value="Sistem Informasi">Sistem Informasi</option>
  <option value="Manajemen">Manajemen</option>
  <option value="Sastra Inggris">Sastra Inggris</option>
  <option value="Akuntansi">Akuntansi</option>
  </td>
<tr><td>Nama Mahasiswa<td colspan="3"><input type="text" name="nama_mhs"  required autocomplete="off" size="30"value="<?php echo $_GET['nama_mhs']?>"></td>

  <td>Kelas<td><input type="text" name="kelas" required autocomplete="off" size="10"value="<?php echo $_GET['kelas']?>"></td>
  <td>Angkatan<td><select name="angkatan" id="angkatan">
  <option value="<?php echo $_GET['angkatan'] ?>"><?php echo $_GET['angkatan'] ?></option>
  <option value="2015">2015</option>
  <option value="2016">2016</option>
  <option value="2017">2017</option>
  <option value="2018">2018</option>
  <option value="2019">2019</option>
  <option value="2020">2020</option>
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
    <button class="button button10" type="submit" name="btn_ubah" id="btn_ubah">Update</button><a href="mahasiswa.php" class="button button10">Refresh</a> <a href="mahasiswa.php?aksi=delete&nim=<?php echo $_GET['nim'] ?>" class="button button10">Hapus data ini</a>
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
    if(isset($_GET['nim']) && isset($_GET['aksi'])){
        $nim = $_GET['nim'];
        $sql_hapus = "DELETE FROM tbl_mahasiswa WHERE nim='$nim'";
        $hapus = mysqli_query($conn, $sql_hapus);
        
        if($hapus){
            if($_GET['aksi'] == 'delete'){
                 
                header('location: mahasiswa.php');
                
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
            echo '<a href="mahasiswa.php"> &laquo; Home</a>';
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