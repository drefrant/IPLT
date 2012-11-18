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

$inyong=$_GET[inyong];
$act=$_GET[act];

// Hapus sub menu
if ($inyong=='submenubawah' AND $act=='hapus'){
  mysql_query("DELETE FROM submenubawah WHERE id_sub='$_GET[id]'");
  header('location:../../media.php?inyong='.$inyong);
}

// Input sub menu
elseif ($inyong=='submenubawah' AND $act=='input'){
    mysql_query("INSERT INTO submenubawah(nama_sub,
                                    id_main,
                                    link_sub) 
                            VALUES('$_POST[nama_sub]',
                                   '$_POST[menu_utama]',
                                   '$_POST[link_sub]')");
  header('location:../../media.php?inyong='.$inyong);
}

// Update sub menu
elseif ($inyong=='submenubawah' AND $act=='update'){
    mysql_query("UPDATE submenubawah SET nama_sub  = '$_POST[nama_sub]',
                                   id_main = '$_POST[menu_utama]',
                                   link_sub  = '$_POST[link_sub]'  
                             WHERE id_sub   = '$_POST[id]'");
  header('location:../../media.php?inyong='.$inyong);
}
}
?>
