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

// Hapus komik banyumas
if ($inyong=='komikbanyumas' AND $act=='hapus'){
  $data=mysql_fetch_array(mysql_query("SELECT gambar FROM komik WHERE id_komik='$_GET[id]'"));
  if ($data['gambar']!=''){
     mysql_query("DELETE FROM komik WHERE id_komik='$_GET[id]'");
     unlink("../../../foto_komik/$_GET[namafile]");   
  }
  else{
    mysql_query("DELETE FROM komik WHERE id_komik='$_GET[id]'");
  }
  header('location:../../media.php?inyong='.$inyong);
}

// Input komik banyumas
elseif ($inyong=='komikbanyumas' AND $act=='input'){
  $lokasi_file = $_FILES['fupload']['tmp_name'];
  $tipe_file      = $_FILES['fupload']['type'];
  $nama_file   = $_FILES['fupload']['name'];

  // Apabila ada gambar yang diupload
  if (!empty($lokasi_file)){
    if ($tipe_file != "image/jpeg" AND $tipe_file != "image/pjpeg"){
    echo "<script>window.alert('Upload Gagal, Pastikan File yang di Upload bertipe *.JPG');
        window.location=('../../media.php?inyong=komikbanyumas')</script>";
    }
    else{
    UploadKomik($nama_file);
    mysql_query("INSERT INTO komik(judul,
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
    mysql_query("INSERT INTO komik(judul,
                                    tgl_posting,
                                    url) 
                            VALUES('$_POST[judul]',
                                   '$tgl_sekarang',
                                   '$_POST[url]')");
  header('location:../../media.php?inyong='.$inyong);
  }
}

// Update komik banyumas
elseif ($inyong=='komikbanyumas' AND $act=='update'){
  $lokasi_file = $_FILES['fupload']['tmp_name'];
  $tipe_file      = $_FILES['fupload']['type'];
  $nama_file   = $_FILES['fupload']['name'];

  // Apabila gambar tidak diganti
  if (empty($lokasi_file)){
    mysql_query("UPDATE komik SET judul     = '$_POST[judul]',
                                   url       = '$_POST[url]'
                             WHERE id_komik = '$_POST[id]'");
   header('location:../../media.php?inyong='.$inyong);
  }
  else{
    if ($tipe_file != "image/jpeg" AND $tipe_file != "image/pjpeg"){
    echo "<script>window.alert('Upload Gagal, Pastikan File yang di Upload bertipe *.JPG');
        window.location=('../../media.php?inyong=komikbanyumas')</script>";
    }
    else{
    UploadKomik($nama_file);
    mysql_query("UPDATE komik SET judul     = '$_POST[judul]',
                                   url       = '$_POST[url]',
                                   gambar    = '$nama_file'   
                             WHERE id_komik = '$_POST[id]'");
   header('location:../../media.php?inyong='.$inyong);
   }
  }
}
}
?>
