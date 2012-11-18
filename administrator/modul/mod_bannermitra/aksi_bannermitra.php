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

// Hapus banner
if ($inyong=='bannermitra' AND $act=='hapus'){
  $data=mysql_fetch_array(mysql_query("SELECT gambar FROM banner_mitra WHERE id_mitra='$_GET[id]'"));
  if ($data['gambar']!=''){
     mysql_query("DELETE FROM banner_mitra WHERE id_mitra='$_GET[id]'");
     unlink("../../../foto_banner/$_GET[namafile]");   
  }
  else{
    mysql_query("DELETE FROM banner_mitra WHERE id_mitra='$_GET[id]'");
  }
  header('location:../../media.php?inyong='.$inyong);
}

// Input banner
elseif ($inyong=='bannermitra' AND $act=='input'){
  $lokasi_file = $_FILES['fupload']['tmp_name'];
  $tipe_file      = $_FILES['fupload']['type'];
  $nama_file   = $_FILES['fupload']['name'];

  // Apabila ada gambar yang diupload
  if (!empty($lokasi_file)){
    if ($tipe_file != "image/jpeg" AND $tipe_file != "image/pjpeg"){
    echo "<script>window.alert('Upload Gagal, Pastikan File yang di Upload bertipe *.JPG');
        window.location=('../../media.php?inyong=bannermitra')</script>";
    }
    else{
    UploadBannerMitra($nama_file);
    mysql_query("INSERT INTO banner_mitra(judul,
                                    url,
                                    tgl_posting,
                                    gambar) 
                            VALUES('$_POST[judul]',
                                   '$_POST[url]',
                                   '$tgl_sekarang',
                                   '$nama_file')");
   header('location:../../media.php?inyong='.$inyong);
  }
  }
  else{
    mysql_query("INSERT INTO banner_mitra(judul,
                                    tgl_posting,
                                    url) 
                            VALUES('$_POST[judul]',
                                   '$tgl_sekarang',
                                   '$_POST[url]')");
  header('location:../../media.php?inyong='.$inyong);
  }
}

// Update banner
elseif ($inyong=='bannermitra' AND $act=='update'){
  $lokasi_file = $_FILES['fupload']['tmp_name'];
  $tipe_file      = $_FILES['fupload']['type'];
  $nama_file   = $_FILES['fupload']['name'];

  // Apabila gambar tidak diganti
  if (empty($lokasi_file)){
    mysql_query("UPDATE banner_mitra SET judul     = '$_POST[judul]',
                                   url       = '$_POST[url]'
                             WHERE id_mitra = '$_POST[id]'");
   header('location:../../media.php?inyong='.$inyong);
  }
  else{
    if ($tipe_file != "image/jpeg" AND $tipe_file != "image/pjpeg"){
    echo "<script>window.alert('Upload Gagal, Pastikan File yang di Upload bertipe *.JPG');
        window.location=('../../media.php?inyong=bannermitra')</script>";
    }
    else{
    UploadBannerMitra($nama_file);
    mysql_query("UPDATE banner_mitra SET judul     = '$_POST[judul]',
                                   url       = '$_POST[url]',
                                   gambar    = '$nama_file'   
                             WHERE id_mitra = '$_POST[id]'");
   header('location:../../media.php?inyong='.$inyong);
   }
  }
}
}
?>
