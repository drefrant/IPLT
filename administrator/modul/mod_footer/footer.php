<?php
session_start();
 if (empty($_SESSION['username']) AND empty($_SESSION['passuser'])){
  echo "<link href='style.css' rel='stylesheet' type='text/css'>
 <center>Untuk mengakses modul, Anda harus login <br>";
  echo "<a href=../../index.php><b>LOGIN</b></a></center>";
}
else{
$aksi="modul/mod_footer/aksi_footer.php";
switch($_GET[act]){
  // Tampil Banner
  default:
    echo "<h2>Footer</h2>
         <!-- <input type=button value='Tambah Footer' onclick=location.href='?inyong=footer&act=tambahbanner'> -->
          <table>
          <tr><th>no</th><th>judul</th><th>tgl. posting</th><th>aksi</th></tr>";
    $tampil=mysql_query("SELECT * FROM footer ORDER BY id_footer DESC");
    $no=1;
    while ($r=mysql_fetch_array($tampil)){
      $tgl=tgl_indo($r[tgl_posting]);
      echo "<tr><td>$no</td>
                <td>$r[judul]</td>
                
                <td>$tgl</td>
                <td><a href=?inyong=footer&act=editbanner&id=$r[id_footer]>Edit</a>
	                  <!-- |<a href='$aksi?inyong=footer&act=hapus&id=$r[id_footer]&namafile=$r[gambar]'>Hapus</a> -->
		        </tr>";
    $no++;
    }
    echo "</table>";
    break;
  
  case "tambahbanner":
    echo "<h2>Tambah Footer</h2>
          <form method=POST action='$aksi?inyong=footer&act=input' enctype='multipart/form-data'>
          <table>
          <tr><td>Judul</td><td>  : <input type=text name='judul' size=30></td></tr>
          
          <tr><td>Gambar</td><td> : <input type=file name='fupload' size=40></td></tr>
          <tr><td colspan=2><input type=submit value=Simpan>
                            <input type=button value=Batal onclick=self.history.back()></td></tr>
          </table></form><br><br><br>";
     break;
    
  case "editbanner":
    $edit = mysql_query("SELECT * FROM footer WHERE id_footer='$_GET[id]'");
    $r    = mysql_fetch_array($edit);

    echo "<h2>Edit Footer</h2>
          <form method=POST enctype='multipart/form-data' action=$aksi?inyong=footer&act=update>
          <input type=hidden name=id value=$r[id_footer]>
          <table>
          <tr><td>Judul</td><td>     : <input type=text name='judul' size=30 value='$r[judul]'></td></tr>
          
          <tr><td>Gambar</td><td>    : <img src='../foto_banner/$r[gambar]' width='80%'></td></tr>
          <tr><td>Ganti Gbr</td><td> : <input type=file name='fupload' size=30> *)</td></tr>
          <tr><td colspan=2>*) Apabila gambar tidak diubah, dikosongkan saja.</td></tr>
          <tr><td colspan=2><input type=submit value=Update>
                            <input type=button value=Batal onclick=self.history.back()></td></tr>
          </table></form>";
    break;  
}
}
?>
