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

// Input Kamus Dialek Banyumas
if ($inyong=='kamusdialek' AND $act=='input'){
  mysql_query("INSERT INTO kamus_dialek(indonesia,banyumas,inggris,kalimat) VALUES('$_POST[indonesia]','$_POST[banyumas]','$_POST[inggris]','$_POST[kalimat]')");
  header('location:../../media.php?inyong='.$inyong);
}

// Update Kamus Dialek Banyumas
elseif ($inyong=='kamusdialek' AND $act=='update'){
  mysql_query("UPDATE kamus_dialek SET indonesia  = '$_POST[indonesia]',
                                    banyumas= '$_POST[banyumas]',
                                    inggris = '$_POST[inggris]',
									kalimat = '$_POST[kalimat]'
                              WHERE id_kamus = '$_POST[id]'");
  header('location:../../media.php?inyong='.$inyong);
}

// Aktifkan Kamus Dialek Banyumas
elseif ($inyong=='kamusdialek' AND $act=='aktifkan'){
  $query1=mysql_query("UPDATE kamus_dialek SET aktif='Y' WHERE id_kamus='$_GET[id]'");
  $query2=mysql_query("UPDATE kamus_dialek SET aktif='N' WHERE id_kamus!='$_GET[id]'");
  header('location:../../media.php?inyong='.$inyong);
}
}
?>
