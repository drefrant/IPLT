<?php
session_start();
 if (empty($_SESSION['username']) AND empty($_SESSION['passuser'])){
  echo "<link href='style.css' rel='stylesheet' type='text/css'>
 <center>Untuk mengakses modul, Anda harus login <br>";
  echo "<a href=../../index.php><b>LOGIN</b></a></center>";
}
else{
session_start();
include "../../../config/koneksi.php";

$inyong=$_GET[inyong];
$act=$_GET[act];

// Hapus modul Administrator Panel
if ($inyong=='modul' AND $act=='hapus'){
  mysql_query("DELETE FROM modul WHERE id_modul='$_GET[id]'");
  header('location:../../media.php?inyong='.$inyong);
}
// Input modul Administrator Panel
elseif ($inyong=='modul' AND $act=='input'){
  // Cari angka urutan terakhir
  $u=mysql_query("SELECT urutan FROM modul ORDER by urutan DESC");
  $d=mysql_fetch_array($u);
  $urutan=$d[urutan]+1;  
  // Input data modul
  mysql_query("INSERT INTO modul(nama_modul,
                                 link,
                                 publish,
                                 aktif,
                                 status,
                                 urutan) 
	                       VALUES('$_POST[nama_modul]',
                                '$_POST[link]',
                                '$_POST[publish]',
                                '$_POST[aktif]',
                                '$_POST[status]',
                                '$urutan')");
  header('location:../../media.php?inyong='.$inyong);
}
// Update modul Administrator Panel
elseif ($inyong=='modul' AND $act=='update'){
  mysql_query("UPDATE modul SET nama_modul = '$_POST[nama_modul]',
                                link       = '$_POST[link]',
                                publish    = '$_POST[publish]',
                                aktif      = '$_POST[aktif]',
                                status     = '$_POST[status]',
                                urutan     = '$_POST[urutan]'  
                          WHERE id_modul   = '$_POST[id]'");
  header('location:../../media.php?inyong='.$inyong);
}
}
?>
