<?php
session_start();
if (empty($_SESSION['username']) AND empty($_SESSION['passuser'])){
  echo "<link href='style.css' rel='stylesheet' type='text/css'>
 <center>Untuk mengakses modul, Anda harus login <br>";
  echo "<a href=../../index.php><b>LOGIN</b></a></center>";
}
else{
include "../../../config/koneksi.php";
include "../../../config/library.php";
include "../../../config/fungsi_thumb.php";

$inyong=$_GET['inyong'];
$act=$_GET['act'];

// Hapus Footer
if ($inyong=='footer' AND $act=='hapus'){
  $data=mysql_fetch_array(mysql_query("SELECT gambar FROM footer WHERE id_footer='$_GET[id]'"));
  if ($data['gambar']!=''){
     mysql_query("DELETE FROM footer WHERE id_footer='$_GET[id]'");
     unlink("../../../foto_banner/$_GET[namafile]");   
  }
  else{
    mysql_query("DELETE FROM footer WHERE id_footer='$_GET[id]'");
  }
  header('location:../../media.php?inyong='.$inyong);
}

// Input banner
elseif ($inyong=='footer' AND $act=='input'){
  $lokasi_file = $_FILES['fupload']['tmp_name'];
  $tipe_file      = $_FILES['fupload']['type'];
  $nama_file   = $_FILES['fupload']['name'];

  // Apabila ada gambar yang diupload
  if (!empty($lokasi_file)){
    if ($tipe_file != "image/jpeg" AND $tipe_file != "image/pjpeg"){
    echo "<script>window.alert('Upload Gagal, Pastikan File yang di Upload bertipe *.JPG');
        window.location=('../../media.php?inyong=footer')</script>";
    }
    else{
    UploadBanner($nama_file);
    mysql_query("INSERT INTO footer(judul,                                    
                                    tgl_posting,
                                    gambar) 
                            VALUES('$_POST[judul]',                                   
                                   '$tgl_sekarang',
                                   '$nama_file')");
   header('location:../../media.php?inyong='.$inyong);
  }
  }
  else{
    mysql_query("INSERT INTO footer(judul,
                                    tgl_posting
                                    ) 
                            VALUES('$_POST[judul]',
                                   '$tgl_sekarang')");
  header('location:../../media.php?inyong='.$inyong);
  }
}

// Update banner
elseif ($inyong=='footer' AND $act=='update'){
  $lokasi_file = $_FILES['fupload']['tmp_name'];
  $tipe_file      = $_FILES['fupload']['type'];
  $nama_file   = $_FILES['fupload']['name'];

  // Apabila gambar tidak diganti
  if (empty($lokasi_file)){
    mysql_query("UPDATE footer SET judul     = '$_POST[judul]'                                   
                             WHERE id_footer = '$_POST[id]'");
   header('location:../../media.php?inyong='.$inyong);
  }
  else{
    if ($tipe_file != "image/jpeg" AND $tipe_file != "image/pjpeg"){
    echo "<script>window.alert('Upload Gagal, Pastikan File yang di Upload bertipe *.JPG');
        window.location=('../../media.php?inyong=footer')</script>";
    }
    else{
    UploadBanner($nama_file);
    mysql_query("UPDATE footer SET judul     = '$_POST[judul]',                                 
                                   gambar    = '$nama_file'   
                             WHERE id_footer = '$_POST[id]'");
   header('location:../../media.php?inyong='.$inyong);
   }
  }
}
}
?>
