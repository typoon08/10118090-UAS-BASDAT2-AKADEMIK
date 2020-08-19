<?php
// Include config file
require_once "koneksi.php";
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Academic | Dosen</title>    
    <link rel="stylesheet" href="style.css">
 
    <link href="IMAGES/favicon.png" rel="icon">
</head>
<body>
    <header>
    <div><a class="cta" href="index.php"><button class="button button7"></button></a></div>
        <img class="logo" src="IMAGES/logo.png" alt="logo">
      
        <a class="cta" href="#"><button class="button button1">Admin</button></a>
    </header>
 
    <div class="fcustomer"><img style='vertical-align:middle;' src='IMAGES/dosen.png'>
      <div style='vertical-align:middle; display:inline; padding: 10px;'>DOSEN</div>
     
</div>
<?php
// --- koneksi ke database
$conn=mysqli_connect("localhost","root","","db_akademik")or die(mysqli_error());
// --- Fngsi tambah data (Create)
function tambah($conn){
    
    if (isset($_POST['simpan'])){
        $nip=$_POST['nip'];
        $nama_dosen=$_POST['nama_dosen'];
        $id_mk=$_POST['id_mk'];
        $no_hp=$_POST['no_hp'];
        $email=$_POST['email'];

        if(!empty($nip) || !empty($nama_dosen)|| !empty($id_mk)|| !empty($no_hp)|| !empty($email)){
            $sql = "insert into tbl_dosen ( nip, nama_dosen,id_mk,no_hp,email )" . 
              "values ( '$nip','$nama_dosen' ,'$id_mk','$no_hp','$email')";
            $simpan = mysqli_query($conn, $sql);
            if($simpan && isset($_GET['aksi'])){
                if($_GET['aksi'] == 'create'){
                    header('location: dosen.php');
                   
                }
            }
        } else {
            $pesan = "Tidak dapat menyimpan, data belum lengkap!";
        }
    }
    ?> 
      <?php 
  $sql5 = "SELECT * FROM tbl_mata_kuliah";
  $query5 = mysqli_query($conn, $sql5);
  while($data5 = mysqli_fetch_array($query5)){
 ?>
       <form method="POST" action="dosen.php">
<table>
<tr><td>NIP<td> <input type="text" name="nip" required autocomplete="off" size="15"></td>
<td>ID Mata Kuliah<td><select name="id_mk" id="id_mk">
  <option disabled selected> Pilih </option>
   <option value="<?php echo $data5['id_mk']?>"><?php echo $data5['id_mk']?></option> 
 <?php
  }
 ?>
  </td>
<tr><td>Nama Dosen<td colspan="3"><input type="text" name="nama_dosen"  required autocomplete="off" size="30"></td>
<td>No.Telpon/HP<td><input type="text" name="no_hp"  required autocomplete="off" size="20"></td>
<td>Email<td><input type="text" name="email"  required autocomplete="off" size="25"></td>
</table>
<footer>
    <button class="button button10" type="submit" name="simpan">Save</button><button class="button button10" type="reset">Reset</button><a href="dosen.php" class="button button10">Refresh</a>
</footer>      
        </form>
    <?php
}
// --- Tutup Fungsi tambah data
// --- Fungsi Baca Data (Read)
function tampil_data($conn){
    $sql = "SELECT * FROM tbl_dosen";
    $query = mysqli_query($conn, $sql);
       
    echo "<table id='tabelan'>";
    echo "<tr>
        <th>NIP</th>
        <th>Nama Dosen</th>
        <th>ID Mata Kuliah</th>
        <th>No.Telpon/HP</th>
        <th>Email</th>
        <th>Aksi</th>
        </tr>";
    
    while($data = mysqli_fetch_array($query)){
        ?>
            <tr>
                <td><?php echo $data['nip']; ?></td>
                <td><?php echo $data['nama_dosen']; ?></td>
                <td><?php echo $data['id_mk']; ?></td>
                <td><?php echo $data['no_hp']; ?> </td>
                <td><?php echo $data['email']; ?></td>
                <td>
                  <a class ="edit" href="dosen.php?aksi=update&nip=<?php echo $data['nip']; ?>&nama_dosen=<?php echo $data['nama_dosen']; ?>&id_mk=<?php echo $data['id_mk']; ?>&no_hp=<?php echo $data['no_hp']; ?>&email=<?php echo $data['email']; ?>">Edit</a> |
                    <a class="edit" href="dosen.php?aksi=delete&nip=<?php echo $data['nip']; ?>"onclick="return confirm('Yakin ingin di Hapus?')">Hapus</a>
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
        $nip=$_POST['nip'];
        $nama_dosen=$_POST['nama_dosen'];
        $id_mk=$_POST['id_mk'];
        $no_hp=$_POST['no_hp'];
        $email=$_POST['email'];
        
      if(!empty($nip) || !empty($nama_dosen)|| !empty($id_mk)|| !empty($no_hp)|| !empty($email)){
        $sql_update = "UPDATE tbl_dosen SET nama_dosen='$_POST[nama_dosen]',id_mk='$_POST[id_mk]',no_hp='$_POST[no_hp]',email='$_POST[email]' WHERE nip='$nip';";
        $update = mysqli_query($conn, $sql_update);
            if($update && isset($_GET['aksi'])){
                if($_GET['aksi'] == 'update'){
                    header('location: dosen.php');
                }
            }
        } else {
            $pesan = "Data tidak lengkap!";
        }
    }
    
    // tampilkan form ubah
    if(isset($_GET['nip'])){
        ?>  
           <?php 
  $sql5 = "SELECT * FROM tbl_mata_kuliah";
  $query5 = mysqli_query($conn, $sql5);
  while($data5 = mysqli_fetch_array($query5)){
 ?>
            <form action="" method="POST"  >
            <table>
<tr><td>NIP<td> <input type="text" name="nip" required autocomplete="off" size="15"value="<?php echo $_GET['nip']?>"></td>
<td>ID Mata Kuliah<td><select name="id_mk" id="id_mk">
<option value="<?php echo $_GET['id_mk'] ?>"><?php echo $_GET['id_mk'] ?></option>
   <option value="<?php echo $data5['id_mk']?>"><?php echo $data5['id_mk']?></option> 
 <?php
  }
 ?>
  </td>
<tr><td>Nama Dosen<td colspan="3"><input type="text" name="nama_dosen"  required autocomplete="off" size="30"value="<?php echo $_GET['nama_dosen']?>"></td>
<td>No.Telpon/HP<td><input type="text" name="no_hp"  required autocomplete="off" size="20"value="<?php echo $_GET['no_hp']?>"></td>
<td>Email<td><input type="text" name="email"  required autocomplete="off" size="25"value="<?php echo $_GET['email']?>"></td>
</table>
<footer>
    <button class="button button10" type="submit" name="btn_ubah" id="btn_ubah">Update</button><a href="dosen.php" class="button button10">Refresh</a> <a href="dosen.php?aksi=delete&nip=<?php echo $_GET['nip'] ?>" class="button button10">Hapus data ini</a>
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
    if(isset($_GET['nip']) && isset($_GET['aksi'])){
        $nip = $_GET['nip'];
        $sql_hapus = "DELETE FROM tbl_dosen WHERE nip='$nip'";
        $hapus = mysqli_query($conn, $sql_hapus);
        
        if($hapus){
            if($_GET['aksi'] == 'delete'){
                 
                header('location: dosen.php');
                
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
            echo '<a href="dosen.php"> &laquo; Home</a>';
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