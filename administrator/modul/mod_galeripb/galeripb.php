<?php
session_start();
 if (empty($_SESSION['username']) AND empty($_SESSION['passuser'])){
  echo "<link href='style.css' rel='stylesheet' type='text/css'>
 <center>Untuk mengakses modul, Anda harus login <br>";
  echo "<a href=../../index.php><b>LOGIN</b></a></center>";
}
else{
$aksi="modul/mod_galeripb/aksi_galeripb.php";
switch($_GET[act]){
  // Tampil Galeri Foto
  default:
    echo "<h2>Galeri Potret Banyumas</h2>
          <input type=button value='Tambah Galeri Potret Banyumas' onclick=\"window.location.href='?inyong=potretbanyumas&act=tambahgaleripotret';\">
          <table>
          <tr><th>no</th><th>judul Potret</th><th>album Potret Banyumas</th><th>Photografer</th><th>aksi</th></tr>";

    $p      = new Paging;
    $batas  = 15;
    $posisi = $p->cariPosisi($batas);

    $tampil = mysql_query("SELECT * FROM gallery_potretbanyumas,album_potretbanyumas WHERE gallery_potretbanyumas.id_album=album_potretbanyumas.id_album ORDER BY id_gallery DESC LIMIT $posisi,$batas");
  
    $no = $posisi+1;
    while($r=mysql_fetch_array($tampil)){
      echo "<tr><td>$no</td>
                <td>$r[jdl_gallery]</td>
                <td>$r[jdl_album]</td>
				<td>$r[photografer]</td>
		            <td><a href=?inyong=potretbanyumas&act=editgaleripotret&id=$r[id_gallery]><img src='icon/edit-kecil.png' border=0px width=15px height=16px title='edit'></a> | 
		                <a href='$aksi?inyong=potretbanyumas&act=hapus&id=$r[id_gallery]&namafile=$r[gbr_gallery]'><img src='icon/delete-kecil.png' border=0px width=15px height=16px title='delete'></a></td>
		        </tr>";
      $no++;
    }
    echo "</table>";

    $jmldata = mysql_num_rows(mysql_query("SELECT * FROM gallery_potretbanyumas"));
  
    $jmlhalaman  = $p->jumlahHalaman($jmldata, $batas);
    $linkHalaman = $p->navHalaman($_GET[halaman], $jmlhalaman);

    echo "<div id=paging>$linkHalaman</div><br>";
 
    break;
  
  case "tambahgaleripotret":
    echo "<h2>Tambah Galeri Potret Banyumas</h2>
          <form method=POST action='$aksi?inyong=potretbanyumas&act=input' enctype='multipart/form-data'>
          <table>
          <tr><td width=70>Judul Potret</td>     <td> : <input type=text name='jdl_gallery' size=60></td></tr>
          <tr><td>Album Potret Banyumas</td>  <td> : 
          <select name='album'>
            <option value=0 selected>- Pilih Album Potret Banyumas -</option>";
            $tampil=mysql_query("SELECT * FROM album_potretbanyumas ORDER BY jdl_album");
            while($r=mysql_fetch_array($tampil)){
              echo "<option value=$r[id_album]>$r[jdl_album]</option>";
            }
    echo "</select></td></tr>
	      <tr><td>Photografer</td><td> : <input type=text name='photografer' size=60></td></tr>
          <tr><td>Keterangan</td>  <td> <textarea name='keterangan' style='width: 600px; height: 150px;'></textarea></td></tr>
          <tr><td>Gambar</td>      <td> : <input type=file name='fupload' size=40> 
                                          <br>Tipe gambar harus JPG/JPEG</td></tr>
          </td></tr>
          <tr><td colspan=2><input type=submit value=Simpan>
                            <input type=button value=Batal onclick=self.history.back()></td></tr>
          </table></form>";
     break;
    
  case "editgaleripotret":
    $edit = mysql_query("SELECT * FROM gallery_potretbanyumas WHERE id_gallery='$_GET[id]'");
    $r    = mysql_fetch_array($edit);

    echo "<h2>Edit Galeri Potret Banyumas</h2>
          <form method=POST enctype='multipart/form-data' action=$aksi?inyong=potretbanyumas&act=update>
          <input type=hidden name=id value=$r[id_gallery]>
          <table>
          <tr><td width=70>Judul Potret</td>     <td> : <input type=text name='jdl_gallery' size=60 value='$r[jdl_gallery]'></td></tr>
          <tr><td>Album Potret Banyumas</td>  <td> : <select name='album'>";
 
          $tampil=mysql_query("SELECT * FROM album_potretbanyumas ORDER BY jdl_album");
          if ($r[id_album]==0){
            echo "<option value=0 selected>- Pilih Album Potret Banyumas -</option>";
          }   

          while($w=mysql_fetch_array($tampil)){
            if ($r[id_album]==$w[id_album]){
              echo "<option value=$w[id_album] selected>$w[jdl_album]</option>";
            }
            else{
              echo "<option value=$w[id_album]>$w[jdl_album]</option>";
            }
          }
    echo "</select></td></tr>
	      <tr><td>Photografer</td><td> : <input type=text name='photografer' size=60 value='$r[photografer]'></td></tr>
          <tr><td>Keterangan</td>   <td> <textarea name='keterangan' style='width: 600px; height: 150px;'>$r[keterangan]</textarea></td></tr>
          <tr><td>Gambar</td>       <td> :  ";
          if ($r[gbr_gallery]!=''){
              echo "<img src='../potret_banyumas/kecil_$r[gbr_gallery]'>";  
          }
    echo "</td></tr>
          <tr><td>Ganti Gbr</td>    <td> : <input type=file name='fupload' size=30> *)</td></tr>
          <tr><td colspan=2>*) Apabila gambar tidak diubah, dikosongkan saja.</td></tr>
          <tr><td colspan=2><input type=submit value=Update>
                            <input type=button value=Batal onclick=self.history.back()></td></tr>
         </table></form>";
    break;  
}
}
?>
