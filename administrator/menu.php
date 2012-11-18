<?php
include "../config/koneksi.php";

if ($_SESSION['leveluser']=='admin'){
  $sql=mysql_query("select * from modul where aktif='Y' order by urutan");
  while ($m=mysql_fetch_array($sql)){  
    echo "<li><a href='$m[link]'><img src='icon/globe.ico' border=0px width=12px height=13px > $m[nama_modul]</a></li>";
  }
}
elseif ($_SESSION['leveluser']=='user'){
  $sql=mysql_query("select * from modul where status='user' and aktif='Y' order by urutan"); 
  while ($m=mysql_fetch_array($sql)){  
    echo "<li><a href='$m[link]'><img src='icon/globe.ico' border=0px width=12px height=13px > $m[nama_modul]</a></li>";
  }
} 
elseif ($_SESSION['leveluser']=='citizen'){
  $sql=mysql_query("select * from modul where status='citizen' and aktif='Y' order by urutan"); 
  while ($m=mysql_fetch_array($sql)){  
    echo "<li><a href='$m[link]'><img src='icon/globe.ico' border=0px width=12px height=13px > $m[nama_modul]</a></li>";
  }
} 
?>
