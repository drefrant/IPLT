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

// Hapus poling
if ($inyong=='poling' AND $act=='hapus'){
  mysql_query("DELETE FROM poling WHERE id_poling='$_GET[id]'");
  header('location:../../media.php?inyong='.$inyong);
}

// Input poling
elseif ($inyong=='poling' AND $act=='input'){
  mysql_query("INSERT INTO poling(pilihan,
                                  status, 
                                  aktif) 
	                       VALUES('$_POST[pilihan]',
	                              '$_POST[status]',
                                '$_POST[aktif]')");
  header('location:../../media.php?inyong='.$inyong);
}

// Update poling
elseif ($inyong=='poling' AND $act=='update'){
  mysql_query("UPDATE poling SET pilihan = '$_POST[pilihan]',
                                 status  = '$_POST[status]',
                                 aktif   = '$_POST[aktif]'  
                          WHERE id_poling = '$_POST[id]'");
  header('location:../../media.php?inyong='.$inyong);
}
}
?>
