<?php
session_start();
if (empty($_SESSION['username']) AND empty($_SESSION['passuser'])){
  echo "<link href='style.css' rel='stylesheet' type='text/css'>
 <center>Untuk mengakses modul, Anda harus login <br>";
  echo "<a href=../../index.php><b>LOGIN</b></a></center>";
}
else{
include "../../../config/koneksi.php";
include "../../../config/timezone.php";
include "../../../config/fungsi_thumb.php";

$inyong=$_GET['inyong'];
$act=$_GET['act'];

// Hapus sekilas pendapat masyarakat
if ($inyong=='pendapatmasyarakat' AND $act=='hapus'){
  $data=mysql_fetch_array(mysql_query("SELECT gambar FROM pendapatmasyarakat WHERE id_pendapat='$_GET[id]'"));
  if ($data['gambar']!=''){
  mysql_query("DELETE FROM pendapatmasyarakat WHERE id_pendapat='$_GET[id]'");
     unlink("../../../foto_pendapatmasyarakat/$_GET[namafile]");   
     unlink("../../../foto_pendapatmasyarakat/kecil_$_GET[namafile]");   
  }
  else{
  mysql_query("DELETE FROM pendapatmasyarakat WHERE id_pendapat='$_GET[id]'");  
  }
  header('location:../../media.php?inyong='.$inyong);
}

// Input sekilas pendapat masyarakat
elseif ($inyong=='pendapatmasyarakat' AND $act=='input'){
  $lokasi_file = $_FILES['fupload']['tmp_name'];
  $tipe_file      = $_FILES['fupload']['type'];
  $nama_file   = $_FILES['fupload']['name'];   
  
  $mime = array(
   'image/png' => '.png',
   'image/x-png' => '.png',
   'image/gif' => '.gif',
   'image/jpeg' => '.jpg',
   'image/pjpeg' => '.jpg');
   
   $ekstensi = substr($nama_file, strrpos($nama_file, '.'));
  
  // Apabila ada gambar yang diupload
  if (!empty($lokasi_file)){
    if (!array_keys($mime, $ekstensi)){
      echo "<script>window.alert('Upload Gagal, Pastikan File yang di Upload bertipe JPG/GIF/PNG. Patch by eidelweiss');
      window.location=('../../media.php?inyong=pendapatmasyarakat')</script>";
    }
    else{
    UploadInfo($nama_file);
    mysql_query("INSERT INTO pendapatmasyarakat(pendapat_masyarakat,
                                    tgl_posting,
                                    gambar) 
                            VALUES('$_POST[pendapat_masyarakat]',
                                   '$tgl_sekarang',
                                   '$nama_file')");
  header('location:../../media.php?inyong='.$inyong);
  }
  }
  else{
    mysql_query("INSERT INTO pendapatmasyarakat(pendapat_masyarakat,
                                    tgl_posting) 
                            VALUES('$_POST[pendapat_masyarakat]',
                                   '$tgl_sekarang')");
  header('location:../../media.php?inyong='.$inyong);
  }
}

// Update sekilas pendapat masyarakat
elseif ($inyong=='pendapatmasyarakat' AND $act=='update'){
  $lokasi_file = $_FILES['fupload']['tmp_name'];
  $tipe_file      = $_FILES['fupload']['type'];
  $nama_file   = $_FILES['fupload']['name'];

  // Apabila gambar tidak diganti
  if (empty($lokasi_file)){
    mysql_query("UPDATE pendapatmasyarakat SET pendapat_masyarakat = '$_POST[pendapat_masyarakat]'
                             WHERE id_pendapat = '$_POST[id]'");
  header('location:../../media.php?inyong='.$inyong);
  }
  else{
   if ($tipe_file != "image/jpeg" AND $tipe_file != "image/pjpeg"){
    echo "<script>window.alert('Upload Gagal, Pastikan File yang di Upload bertipe *.JPG');
        window.location=('../../media.php?inyong=pendapatmasyarakat')</script>";
    }
    else{
    UploadInfo($nama_file);
    mysql_query("UPDATE pendapatmasyarakat SET pendapat_masyarakat = '$_POST[pendapat_masyarakat]',
                                   gambar    = '$nama_file'   
                             WHERE id_pendapat= '$_POST[id]'");
  header('location:../../media.php?inyong='.$inyong);
  }
  }
}
}
?>
