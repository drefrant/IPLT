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

// Input photografer
if ($inyong=='photografer' AND $act=='input'){
  mysql_query("INSERT INTO photografer(nama,                               
                                 email, 
                                 no_hp) 
	                       VALUES('$_POST[nama]',                                
                                '$_POST[email]',
                                '$_POST[no_hp]')");
  header('location:../../media.php?inyong='.$inyong);
}

// Update photografer
elseif ($inyong=='photografer' AND $act=='update'){  
    mysql_query("UPDATE photografer SET nama   = '$_POST[nama]',
										email  = '$_POST[email]',
										no_hp  = '$_POST[no_hp]',
										aktif = '$_POST[aktif]'
                                 WHERE  id_pg  = '$_POST[id]'");  
  header('location:../../media.php?inyong='.$inyong);
}
}
?>
