<?php
session_start();
 if (empty($_SESSION['username']) AND empty($_SESSION['passuser'])){
  echo "<link href='style.css' rel='stylesheet' type='text/css'>
 <center>Untuk mengakses modul, Anda harus login <br>";
  echo "<a href=../../index.php><b>LOGIN</b></a></center>";
}
else{
$aksi="modul/mod_cuaca/aksi_cuaca.php";
switch($_GET[act]){
  // Tampil Cuaca Banyumas
  default:
    echo "<h2>Cuaca Banyumas</h2>";     
    echo "      <table>
          <tr><th>no</th><th>cuaca</th><th>derajat</th><th>aktif</th><th>aksi</th></tr>";

    $p      = new Paging;
    $batas  = 15;
    $posisi = $p->cariPosisi($batas);

    $tampil=mysql_query("SELECT * FROM cuacabanyumas ORDER BY id_cuaca DESC LIMIT $posisi,$batas");

    $no = $posisi+1;
    while ($r=mysql_fetch_array($tampil)){
      echo "<tr><td>$no</td>
                
                <td>$r[cuaca]</td>
                <td>$r[derajat]</td>
                <td width=5 align=center>$r[aktif]</td>
                <td><a href=?inyong=cuaca&act=editcuaca&id=$r[id_cuaca]><img src='icon/edit-kecil.png' border=0px width=15px height=16px title='edit'></a> | 
	                  <a href=$aksi?inyong=cuaca&act=aktifkan&id=$r[id_cuaca]><img src='icon/aktif-kecil.png' border=0px width=15px height=16px title='aktifkan'></a>
		        </tr>";
      $no++;
    }
    echo "</table>";
    $jmldata=mysql_num_rows(mysql_query("SELECT * FROM cuacabanyumas"));
    $jmlhalaman  = $p->jumlahHalaman($jmldata, $batas);
    $linkHalaman = $p->navHalaman($_GET[halaman], $jmlhalaman);

    echo "<div id=paging>$linkHalaman</div><br>";
    break;
  
  
   
  // Form Edit Cuaca 
  case "editcuaca":
    $edit=mysql_query("SELECT * FROM cuacabanyumas WHERE id_cuaca='$_GET[id]'");
    $r=mysql_fetch_array($edit);

    echo "<h2>Edit Cuaca Banyumas</h2>
          <form method=POST action=$aksi?inyong=cuaca&act=update>
          <input type=hidden name=id value='$r[id_cuaca]'>
          <table>
          
          <tr><td>cuaca</td><td> : <input type=text name='cuaca' value='$r[cuaca]'></td></tr>
          <tr><td>derajat</td><td> : <input type=text name='derajat' value='$r[derajat]'></td></tr>
          <tr><td colspan=2><input type=submit value=Update>
                            <input type=button value=Batal onclick=self.history.back()></td></tr>
          </table></form>";
    break;  
}
}
?>
