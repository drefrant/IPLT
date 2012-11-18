<?php
session_start();
 if (empty($_SESSION['username']) AND empty($_SESSION['passuser'])){
  echo "<link href='style.css' rel='stylesheet' type='text/css'>
 <center>Untuk mengakses modul, Anda harus login <br>";
  echo "<a href=../../index.php><b>LOGIN</b></a></center>";
}
else{
$aksi="modul/mod_dialek/aksi_dialek.php";
switch($_GET[act]){
  // Tampil Kamus Dialek
  default:
    echo "<h2>Kamus Dialek Banyumas</h2>
          <input type=button value='Tambah Kamus Dialek' 
         onclick=\"window.location.href='?inyong=kamusdialek&act=tambahkamusdialek';\">
         <table>
          <tr><th>no</th><th>Bahasa Indonesia</th><th>Bahasa Banyumas</th><th>Bahasa Inggris</th><th>Kalimat</th><th>aktif</th><th>aksi</th></tr>";

    $p      = new Paging;
    $batas  = 15;
    $posisi = $p->cariPosisi($batas);

    $tampil=mysql_query("SELECT * FROM kamus_dialek ORDER BY id_kamus DESC LIMIT $posisi,$batas");

    $no = $posisi+1;
    while ($r=mysql_fetch_array($tampil)){
      echo "<tr><td>$no</td>
                <td>$r[indonesia]</td>
                <td>$r[banyumas]</td>
                <td>$r[inggris]</td>
				<td>$r[kalimat]</td>
                <td width=5 align=center>$r[aktif]</td>
                <td><a href=?inyong=kamusdialek&act=editkamusdialek&id=$r[id_kamus]><img src='icon/edit-kecil.png' border=0px width=15px height=16px title='edit'></a> | 
	                  <a href=$aksi?inyong=kamusdialek&act=aktifkan&id=$r[id_kamus]><img src='icon/aktif-kecil.png' border=0px width=15px height=16px title='aktifkan'></a>
		        </tr>";
      $no++;
    }
    echo "</table>";
    $jmldata=mysql_num_rows(mysql_query("SELECT * FROM kamus_dialek"));
    $jmlhalaman  = $p->jumlahHalaman($jmldata, $batas);
    $linkHalaman = $p->navHalaman($_GET[halaman], $jmlhalaman);

    echo "<div id=paging>$linkHalaman</div><br>";
    break;
  
  
  // Form Tambah Cuaca
  case "tambahkamusdialek":
    echo "<h2>Tambah Kamus Dialek Banyumas</h2>
          <form method=POST action='$aksi?inyong=kamusdialek&act=input'>
          <table>
          <tr><td>Indonesia</td><td> : <input type=text name='indonesia'></td></tr>
          <tr><td>Banyumas</td><td> : <input type=text name='banyumas'></td></tr>
		   <tr><td>Inggris</td><td> : <input type=text name='inggris'></td></tr>
          <tr><td>Kalimat</td><td> : <input type=text name='kalimat'></td></tr>
          <tr><td colspan=2><input type=submit name=submit value=Simpan>
                            <input type=button value=Batal onclick=self.history.back()></td></tr>
          </table></form>";
     break;
  
  // Form Edit Cuaca 
  case "editkamusdialek":
    $edit=mysql_query("SELECT * FROM kamus_dialek WHERE id_kamus='$_GET[id]'");
    $r=mysql_fetch_array($edit);

    echo "<h2>Edit Kamus Dialek Banyumas</h2>
          <form method=POST action=$aksi?inyong=kamusdialek&act=update>
          <input type=hidden name=id value='$r[id_kamus]'>
          <table>
          <tr><td>Bahasa Indonesia</td><td> : <input type=text name='indonesia' value='$r[indonesia]'></td></tr>
		  <tr><td>Bahasa Banyumas</td><td> : <input type=text name='banyumas' value='$r[banyumas]'></td></tr>
		  <tr><td>Bahasa Inggris</td><td> : <input type=text name='inggris' value='$r[inggris]'></td></tr>
          <tr><td>Kalimat</td><td> : <input type=text name='kalimat' value='$r[kalimat]'></td></tr>
          <tr><td colspan=2><input type=submit value=Update>
          <input type=button value=Batal onclick=self.history.back()></td></tr>
          </table></form>";
    break;  
}
}
?>
