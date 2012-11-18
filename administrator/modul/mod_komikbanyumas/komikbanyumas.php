<?php
session_start();
 if (empty($_SESSION['username']) AND empty($_SESSION['passuser'])){
  echo "<link href='style.css' rel='stylesheet' type='text/css'>
 <center>Untuk mengakses modul, Anda harus login <br>";
  echo "<a href=../../index.php><b>LOGIN</b></a></center>";
}
else{
$aksi="modul/mod_komikbanyumas/aksi_komikbanyumas.php";
switch($_GET[act]){
  // Tampil Komik
  default:
    echo "<h2>Komik Banyumas</h2>
          <input type=button value='Tambah Komik Banyumas' onclick=location.href='?inyong=komikbanyumas&act=tambahkomikbanyumas'>
          <table>
          <tr><th>no</th><th>judul</th><th>url</th><th>tgl. posting</th><th>aksi</th></tr>";
    $tampil=mysql_query("SELECT * FROM komik ORDER BY id_komik DESC");
    $no=1;
    while ($r=mysql_fetch_array($tampil)){
      $tgl=tgl_indo($r[tgl_posting]);
      echo "<tr><td>$no</td>
                <td>$r[judul]</td>
                <td><a href=$r[url] target=_blank>$r[url]</a></td>
                <td>$tgl</td>
                <td><a href=?inyong=komikbanyumas&act=editkomikbanyumas&id=$r[id_komik]><img src='icon/edit-kecil.png' border=0px width=15px height=16px title='edit'></a> | 
	                  <a href='$aksi?inyong=komikbanyumas&act=hapus&id=$r[id_komik]&namafile=$r[gambar]'><img src='icon/delete-kecil.png' border=0px width=15px height=16px title='delete'></a>
		        </tr>";
    $no++;
    }
    echo "</table>";
    break;
  
  case "tambahkomikbanyumas":
    echo "<h2>Tambah Komik Banyumas</h2>
          <form method=POST action='$aksi?inyong=komikbanyumas&act=input' enctype='multipart/form-data'>
          <table>
          <tr><td>Judul</td><td>  : <input type=text name='judul' size=30></td></tr>
          <tr><td>Url</td><td>   : <input type=text name='url' size=50 value='http://'></td></tr>
          <tr><td>Gambar</td><td> : <input type=file name='fupload' size=40></td></tr>
          <tr><td colspan=2><input type=submit value=Simpan>
                            <input type=button value=Batal onclick=self.history.back()></td></tr>
          </table></form><br><br><br>";
     break;
    
  case "editkomikbanyumas":
    $edit = mysql_query("SELECT * FROM komik WHERE id_komik='$_GET[id]'");
    $r    = mysql_fetch_array($edit);

    echo "<h2>Edit Komik Banyumas</h2>
          <form method=POST enctype='multipart/form-data' action=$aksi?inyong=komikbanyumas&act=update>
          <input type=hidden name=id value=$r[id_komik]>
          <table>
          <tr><td>Judul</td><td>     : <input type=text name='judul' size=30 value='$r[judul]'></td></tr>
          <tr><td>Url</td><td>      : <input type=text name='url' size=50 value='$r[url]'></td></tr>
          <tr><td>Gambar</td><td>    : <img src='../foto_komik/$r[gambar]'></td></tr>
          <tr><td>Ganti Gbr</td><td> : <input type=file name='fupload' size=30> *)</td></tr>
          <tr><td colspan=2>*) Apabila gambar tidak diubah, dikosongkan saja.</td></tr>
          <tr><td colspan=2><input type=submit value=Update>
                            <input type=button value=Batal onclick=self.history.back()></td></tr>
          </table></form>";
    break;  
}
}
?>
