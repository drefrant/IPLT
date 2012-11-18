<?php
session_start();
 if (empty($_SESSION['username']) AND empty($_SESSION['passuser'])){
  echo "<link href='style.css' rel='stylesheet' type='text/css'>
 <center>Untuk mengakses modul, Anda harus login <br>";
  echo "<a href=../../index.php><b>LOGIN</b></a></center>";
}
else{
$aksi="modul/mod_bannermitra/aksi_bannermitra.php";
switch($_GET[act]){
  // Tampil Banner
  default:
    echo "<h2>Banner Mitra </h2>
          <input type=button value='Tambah Banner Mitra' onclick=location.href='?inyong=bannermitra&act=tambahmitra'>
          <table>
          <tr><th>no</th><th>judul</th><th>url</th><th>tgl. posting</th><th>aksi</th></tr>";
    $tampil=mysql_query("SELECT * FROM banner_mitra ORDER BY id_mitra DESC");
    $no=1;
    while ($r=mysql_fetch_array($tampil)){
      $tgl=tgl_indo($r[tgl_posting]);
      echo "<tr><td>$no</td>
                <td>$r[judul]</td>
                <td><a href=$r[url] target=_blank>$r[url]</a></td>
                <td>$tgl</td>
                <td><a href=?inyong=bannermitra&act=editbanner&id=$r[id_mitra]>Edit</a> | 
	                  <a href='$aksi?inyong=bannermitra&act=hapus&id=$r[id_mitra]&namafile=$r[gambar]'>Hapus</a>
		        </tr>";
    $no++;
    }
    echo "</table>";
    break;
  
  case "tambahmitra":
    echo "<h2>Tambah Banner Mitra</h2>
          <form method=POST action='$aksi?inyong=bannermitra&act=input' enctype='multipart/form-data'>
          <table>
          <tr><td>Judul</td><td>  : <input type=text name='judul' size=30></td></tr>
          <tr><td>Url</td><td>   : <input type=text name='url' size=50 value='http://'></td></tr>
          <tr><td>Gambar</td><td> : <input type=file name='fupload' size=40></td></tr>
          <tr><td colspan=2><input type=submit value=Simpan>
                            <input type=button value=Batal onclick=self.history.back()></td></tr>
          </table></form><br><br><br>";
     break;
    
  case "editbanner":
    $edit = mysql_query("SELECT * FROM banner_mitra WHERE id_mitra='$_GET[id]'");
    $r    = mysql_fetch_array($edit);

    echo "<h2>Edit Banner Mitra</h2>
          <form method=POST enctype='multipart/form-data' action=$aksi?inyong=bannermitra&act=update>
          <input type=hidden name=id value=$r[id_mitra]>
          <table>
          <tr><td>Judul</td><td>     : <input type=text name='judul' size=30 value='$r[judul]'></td></tr>
          <tr><td>Url</td><td>      : <input type=text name='url' size=50 value='$r[url]'></td></tr>
          <tr><td>Gambar</td><td>    : <img src='../foto_bannermitra/$r[gambar]'></td></tr>
          <tr><td>Ganti Gbr</td><td> : <input type=file name='fupload' size=30> *)</td></tr>
          <tr><td colspan=2>*) Apabila gambar tidak diubah, dikosongkan saja.</td></tr>
          <tr><td colspan=2><input type=submit value=Update>
                            <input type=button value=Batal onclick=self.history.back()></td></tr>
          </table></form>";
    break;  
}
}
?>
