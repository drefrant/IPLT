<?php
session_start();
 if (empty($_SESSION['username']) AND empty($_SESSION['passuser'])){
  echo "<link href='style.css' rel='stylesheet' type='text/css'>
 <center>Untuk mengakses modul, Anda harus login <br>";
  echo "<a href=../../index.php><b>LOGIN</b></a></center>";
}
else{

$aksi="modul/mod_albumpb/aksi_albumpb.php";
switch($_GET[act]){
  // Tampil Album Potret Banyumas
  default:
    echo "<h2>Album Potret Banyumas</h2>
          <input type=button value='Tambah Album' 
          onclick=\"window.location.href='?inyong=albumpb&act=tambahalbum';\">
          <table>
          <tr><th>no</th><th>judul album</th><th>aksi</th></tr>"; 
    $tampil=mysql_query("SELECT * FROM album_potretbanyumas ORDER BY id_album DESC");
    $no=1;
    while ($r=mysql_fetch_array($tampil)){
       echo "<tr><td>$no</td>
             <td>$r[jdl_album]</td>
             <td><a href=?inyong=albumpb&act=editalbum&id=$r[id_album]><img src='icon/edit-kecil.png' border=0px width=15px height=16px title='edit'></a>
             </td></tr>";
      $no++;
    }
    echo "</table>";
    echo "<div id=paging>*) Data pada Album tidak bisa dihapus, tapi bisa di non-aktifkan melalui Edit Album.</div><br>";
    break;
  
  // Form Tambah Album
  case "tambahalbum":
    echo "<h2>Tambah Album</h2>
          <form method=POST action='$aksi?inyong=albumpb&act=input' enctype='multipart/form-data'>
          <table>
          <tr><td>Judul Album</td><td> : <input type=text name='jdl_album'></td></tr>
          <tr><td>Gambar</td><td> : <input type=file name='fupload' size=40></td></tr>
          <tr><td colspan=2><input type=submit name=submit value=Simpan>
                            <input type=button value=Batal onclick=self.history.back()></td></tr>
          </table></form>";
     break;
  
  // Form Edit Album  
  case "editalbum":
    $edit=mysql_query("SELECT * FROM album_potretbanyumas WHERE id_album='$_GET[id]'");
    $r=mysql_fetch_array($edit);

    echo "<h2>Edit Album</h2>
          <form method=POST enctype='multipart/form-data' action=$aksi?inyong=albumpb&act=update>
          <input type=hidden name=id value='$r[id_album]'>
          <table>
          <tr><td>Judul Album</td><td> : <input type=text name='jdl_album' value='$r[jdl_album]'></td></tr>
          <tr><td>Gambar</td><td>    : <img src='../img_potretbanyumas/kecil_$r[gbr_album]'></td></tr>
          <tr><td>Ganti Gbr</td><td> : <input type=file name='fupload' size=30></td></tr>";
    if ($r[aktif]=='Y'){
      echo "<tr><td>Aktif</td> <td> : <input type=radio name='aktif' value='Y' checked>Y  
                                      <input type=radio name='aktif' value='N'> N</td></tr>";
    }
    else{
      echo "<tr><td>Aktif</td> <td> : <input type=radio name='aktif' value='Y'>Y  
                                      <input type=radio name='aktif' value='N' checked>N</td></tr>";
    }         
    echo "<tr><td colspan=2><input type=submit value=Update>
                            <input type=button value=Batal onclick=self.history.back()></td></tr>
          </table></form>";
    break;  
}
}
?>
