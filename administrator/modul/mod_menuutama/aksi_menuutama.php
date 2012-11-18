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

$inyong=$_GET[inyong];
$act=$_GET[act];

// Input menu utama
if ($inyong=='menuutama' AND $act=='input'){
  mysql_query("INSERT INTO mainmenu(nama_menu,link) VALUES('$_POST[nama_menu]','$_POST[link]')");
  header('location:../../media.php?inyong='.$inyong);
}

// Update menu utama
elseif ($inyong=='menuutama' AND $act=='update'){
  mysql_query("UPDATE mainmenu SET nama_menu='$_POST[nama_menu]', link='$_POST[link]', aktif='$_POST[aktif]' 
               WHERE id_main = '$_POST[id]'");
  header('location:../../media.php?inyong='.$inyong);
}
}
?>
