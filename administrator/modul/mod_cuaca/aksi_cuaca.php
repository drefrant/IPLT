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

// Update cuaca
if ($inyong=='cuaca' AND $act=='update'){
  mysql_query("UPDATE cuacabanyumas SET gambar  = '$_POST[gambar]',
                                    cuaca= '$_POST[cuaca]',
                                    derajat = '$_POST[derajat]'
                              WHERE id_cuaca = '$_POST[id]'");
  header('location:../../media.php?inyong='.$inyong);
}

// Aktifkan cuaca
elseif ($inyong=='cuaca' AND $act=='aktifkan'){
  $query1=mysql_query("UPDATE cuacabanyumas SET aktif='Y' WHERE id_cuaca='$_GET[id]'");
  $query2=mysql_query("UPDATE cuacabanyumas SET aktif='N' WHERE id_cuaca!='$_GET[id]'");
  header('location:../../media.php?inyong='.$inyong);
}
}
?>
