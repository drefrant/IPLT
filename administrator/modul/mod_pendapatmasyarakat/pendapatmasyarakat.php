<?php
$aksi="modul/mod_pendapatmasyarakat/aksi_pendapatmasyarakat.php";
switch($_GET[act]){
  // Tampil Pendapat Masyarakat
  default:
    echo "<h2>Pendapat Masyarakat</h2>
          <input type=button value='Tambah Pendapat Masyarakat' onclick=location.href='?inyong=pendapatmasyarakat&act=tambahpendapat'>
          <table>
          <tr><th>no</th><th>pendapat</th><th>tgl. posting</th><th>aksi</th></tr>";
    $tampil=mysql_query("SELECT * FROM pendapatmasyarakat ORDER BY id_pendapat DESC");
    $no=1;
    while ($r=mysql_fetch_array($tampil)){
      $tgl=tgl_indo($r[tgl_posting]);
      echo "<tr><td>$no</td>
                <td>$r[pendapat_masyarakat]</td>
                <td>$tgl</td>
                <td><a href=?inyong=pendapatmasyarakat&act=editpendapat&id=$r[id_pendapat]><img src='icon/edit-kecil.png' border=0px width=15px height=16px title='edit'></a> | 
	                  <a href='$aksi?inyong=pendapatmasyarakat&act=hapus&id=$r[id_pendapat]&namafile=$r[gambar]'><img src='icon/delete-kecil.png' border=0px width=15px height=16px title='delete'></a>
		        </tr>";
    $no++;
    }
    echo "</table>";
    break;
  
  case "tambahpendapat":
    echo "<h2>Tambah Pendapat Masyarakat</h2>
          <form method=POST action='$aksi?inyong=pendapatmasyarakat&act=input' enctype='multipart/form-data'>
          <table>
          <tr><td>Pendapat</td><td>  : <input type=text name='pendapat_masyarakat' size=100></td></tr>
          <tr><td>Photo</td><td> : <input type=file name='fupload' size=40> &nbsp photo harus 54 x 54 pixel &nbsp </td></tr>
          <tr><td colspan=2><input type=submit value=Simpan>
                            <input type=button value=Batal onclick=self.history.back()> </td></tr>
          </table></form><br><br><br>";
     break;
    
  case "editpendapat":
    $edit = mysql_query("SELECT * FROM pendapatmasyarakat WHERE id_pendapat='$_GET[id]'");
    $r    = mysql_fetch_array($edit);

    echo "<h2>Edit Pendapat Masyarakat</h2>
          <form method=POST enctype='multipart/form-data' action=$aksi?inyong=pendapatmasyarakat&act=update>
          <input type=hidden name=id value=$r[id_pendapat]>
          <table>
          <tr><td>Pendapat</td><td>     : <input type=text name='pendapat_masyarakat' size=100 value='$r[pendapat_masyarakat]'></td></tr>
          <tr><td>Photo</td><td>    : <img src='../foto_pendapatmasyarakat/$r[gambar]'></td></tr>
          <tr><td>Ganti Gbr</td><td> : <input type=file name='fupload' size=30>&nbsp photo harus 54 x 54 pixel &nbsp *)</td></tr>
          <tr><td colspan=2>*) Apabila photo tidak diubah, dikosongkan saja.</td></tr>
          <tr><td colspan=2><input type=submit value=Update>
                            <input type=button value=Batal onclick=self.history.back()></td></tr>
          </table></form>";
    break;  
}
?>
