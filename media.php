<?php 
  ob_start();	
  session_start();
  // Panggil semua fungsi yang dibutuhkan (semuanya ada di folder config)
    include "config/koneksi.php";
	include "config/tanggalan.php";
	include "config/halaman.php";
	include "config/fungsi_combobox.php";
	include "config/timezone.php";
    include "config/fungsi_autolink.php";
    //include "config/fungsi_badword.php";
    include "config/fungsi_kalender.php";

  // Memilih template yang aktif saat ini
  $pilih_template=mysql_query("SELECT folder FROM templates WHERE aktif='Y'");
  $f=mysql_fetch_array($pilih_template);
  include "$f[folder]/template.php"; 
?>
