<?php
session_start();
 if (empty($_SESSION['username']) AND empty($_SESSION['passuser'])){
  echo "<link href='style.css' rel='stylesheet' type='text/css'>
 <center>Untuk mengakses modul, Anda harus login <br>";
  echo "<a href=../../index.php><b>LOGIN</b></a></center>";
}
else{
include "../../../config/koneksi.php";

$inyong=$_GET[inyong];
$act=$_GET[act];

// Hapus hubungi
if ($inyong=='hubungi' AND $act=='hapus'){
  mysql_query("DELETE FROM hubungi WHERE id_hubungi='$_GET[id]'");
  header('location:../../media.php?inyong='.$inyong);
}
}
?>
