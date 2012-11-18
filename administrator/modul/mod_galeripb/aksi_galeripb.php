<?php
session_start();
 if (empty($_SESSION['username']) AND empty($_SESSION['passuser'])){
  echo "<link href='style.css' rel='stylesheet' type='text/css'>
 <center>Untuk mengakses modul, Anda harus login <br>";
  echo "<a href=../../index.php><b>LOGIN</b></a></center>";
}
else{
include "../../../config/koneksi.php";
include "../../../config/fungsi_thumb.php";
include "../../../config/fungsi_seo.php";

$inyong=$_GET['inyong'];
$act=$_GET['act'];

// Hapus gallery_potretbanyumas
if ($inyong=='potretbanyumas' AND $act=='hapus'){
  $data=mysql_fetch_array(mysql_query("SELECT gbr_gallery FROM gallery_potretbanyumas WHERE id_gallery='$_GET[id]'"));
  if ($data['gbr_gallery']!=''){
    mysql_query("DELETE FROM gallery_potretbanyumas WHERE id_gallery='$_GET[id]'");
    unlink("../../../potret_banyumas/$_GET[namafile]");   
    unlink("../../../potret_banyumas/kecil_$_GET[namafile]");
  }
  else{
    mysql_query("DELETE FROM gallery_potretbanyumas WHERE id_gallery='$_GET[id]'");  
  }   
  header('location:../../media.php?inyong='.$inyong);
}

// Input gallery_potretbanyumas
elseif ($inyong=='potretbanyumas' AND $act=='input'){
  $lokasi_file    = $_FILES['fupload']['tmp_name'];
  $tipe_file      = $_FILES['fupload']['type'];
  $nama_file      = $_FILES['fupload']['name'];
  $acak           = rand(000000,999999);
  $nama_file_unik = $acak.$nama_file; 
  
  $gallery_seo      = seo_title($_POST['jdl_gallery']);

  // Apabila ada gambar yang diupload
  if (!empty($lokasi_file)){
    if ($tipe_file != "image/jpeg" AND $tipe_file != "image/pjpeg"){
    echo "<script>window.alert('Upload Gagal, Pastikan File yang di Upload bertipe *.JPG');
        window.location=('../../media.php?inyong=potretbanyumas')</script>";
    }
    else{
    UploadGalleryPotret($nama_file_unik);
    mysql_query("INSERT INTO gallery_potretbanyumas(jdl_gallery,
									photografer,
                                    gallery_seo,
                                    id_album,
                                    keterangan,
                                    gbr_gallery) 
                            VALUES('$_POST[jdl_gallery]',
							       '$_POST[photografer]',
                                   '$gallery_seo',
                                   '$_POST[album]',
                                   '$_POST[keterangan]',
                                   '$nama_file_unik')");
  header('location:../../media.php?inyong='.$inyong);
  }
  }
  else{
    mysql_query("INSERT INTO gallery_potretbanyumas(jdl_gallery,
	                                photografer,
                                    gallery_seo,
                                    id_album,
                                    keterangan) 
                            VALUES('$_POST[jdl_gallery]',
							       '$_POST[photografer]',
                                   '$gallery_seo',
                                   '$_POST[album]',
                                   '$_POST[keterangan]')");
  header('location:../../media.php?inyong='.$inyong);
  }
}

// Update gallery_potretbanyumas
elseif ($inyong=='potretbanyumas' AND $act=='update'){
  $lokasi_file    = $_FILES['fupload']['tmp_name'];
  $tipe_file      = $_FILES['fupload']['type'];
  $nama_file      = $_FILES['fupload']['name'];
  $acak           = rand(000000,999999);
  $nama_file_unik = $acak.$nama_file; 

  $gallery_seo      = seo_title($_POST['jdl_gallery']);

  // Apabila gambar tidak diganti
  if (empty($lokasi_file)){
    mysql_query("UPDATE gallery_potretbanyumas SET jdl_gallery  = '$_POST[jdl_gallery]',
	                               photografer  = '$_POST[photografer]',
                                   gallery_seo   = '$gallery_seo', 
                                   id_album = '$_POST[album]',
                                   keterangan  = '$_POST[keterangan]'  
                             WHERE id_gallery   = '$_POST[id]'");
  header('location:../../media.php?inyong='.$inyong);
  }
  else{
    if ($tipe_file != "image/jpeg" AND $tipe_file != "image/pjpeg"){
    echo "<script>window.alert('Upload Gagal, Pastikan File yang di Upload bertipe *.JPG');
        window.location=('../../media.php?inyong=potretbanyumas')</script>";
    }
    else{
    UploadGalleryPotret($nama_file_unik);
    mysql_query("UPDATE gallery_potretbanyumas SET jdl_gallery  = '$_POST[jdl_gallery]',
	                               photografer  = '$_POST[photografer]',
                                   gallery_seo   = '$gallery_seo', 
                                   id_album = '$_POST[album]',
                                   keterangan  = '$_POST[keterangan]',  
                                   gbr_gallery      = '$nama_file_unik'   
                             WHERE id_gallery   = '$_POST[id]'");
  header('location:../../media.php?inyong='.$inyong);
  }
  }
}
}
?>
