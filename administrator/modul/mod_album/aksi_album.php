<?php
session_start();
 if (empty($_SESSION['username']) AND empty($_SESSION['passuser'])){
  echo "<link href='style.css' rel='stylesheet' type='text/css'>
 <center>Untuk mengakses modul, Anda harus login <br>";
  echo "<a href=../../index.php><b>LOGIN</b></a></center>";
}
else{
include "../../../config/koneksi.php";
include "../../../config/fungsi_seo.php";
include "../../../config/fungsi_thumb.php";

$inyong=$_GET['inyong'];
$act=$_GET['act'];

// Input album
if ($inyong=='album' AND $act=='input'){
  $lokasi_file = $_FILES['fupload']['tmp_name'];
  $nama_file   = $_FILES['fupload']['name'];
  $acak           = rand(000000,999999);
  $nama_file_unik = $acak.$nama_file; 
  $album_seo = seo_title($_POST['jdl_album']);
  $tipe_file = $_FILES['fupload']['type'];
  
  // Apabila ada gambar yang diupload
  if (!empty($lokasi_file)){
    if ($tipe_file != "image/jpeg" AND $tipe_file != "image/pjpeg"){
    echo "<script>window.alert('Upload Gagal, Pastikan File yang di Upload bertipe *.JPG');
        window.location=('../../media.php?inyong=album')</script>";
    }
    else{
    UploadAlbum($nama_file_unik);
    mysql_query("INSERT INTO album(jdl_album,
                                    album_seo,
                                    gbr_album) 
                            VALUES('$_POST[jdl_album]',
                                   '$album_seo',
                                   '$nama_file_unik')");
  header('location:../../media.php?inyong='.$inyong);
  }
  }
  else{
    mysql_query("INSERT INTO album(jdl_album,
                                    album_seo) 
                            VALUES('$_POST[jdl_album]',
                                   '$album_seo')");
  header('location:../../media.php?inyong='.$inyong);
  }
}

// Update album
elseif ($inyong=='album' AND $act=='update'){
  $lokasi_file = $_FILES['fupload']['tmp_name'];
  $nama_file   = $_FILES['fupload']['name'];
  $acak           = rand(000000,999999);
  $nama_file_unik = $acak.$nama_file; 
 $tipe_file = $_FILES['fupload']['type'];
  $album_seo = seo_title($_POST['jdl_album']);

  // Apabila gambar tidak diganti
  if (empty($lokasi_file)){
    mysql_query("UPDATE album SET jdl_album     = '$_POST[jdl_album]',
                                  album_seo     = '$album_seo', 
                                  aktif='$_POST[aktif]' 
                             WHERE id_album = '$_POST[id]'");
  header('location:../../media.php?inyong='.$inyong);
  }
  else{
    if ($tipe_file != "image/jpeg" AND $tipe_file != "image/pjpeg"){
    echo "<script>window.alert('Upload Gagal, Pastikan File yang di Upload bertipe *.JPG');
        window.location=('../../media.php?inyong=album')</script>";
    }
    else{
    UploadAlbum($nama_file_unik);
    mysql_query("UPDATE album SET jdl_album  = '$_POST[jdl_album]',
                                   album_seo = '$album_seo',
                                   gbr_album    = '$nama_file_unik', 
                                   aktif='$_POST[aktif]'    
                             WHERE id_album = '$_POST[id]'");
  header('location:../../media.php?inyong='.$inyong);
  }
  }
}
}
?>
