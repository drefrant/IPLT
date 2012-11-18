<?php
session_start();
 if (empty($_SESSION['username']) AND empty($_SESSION['passuser'])){
  echo "<link href='style.css' rel='stylesheet' type='text/css'>
 <center>Untuk mengakses modul, Anda harus login <br>";
  echo "<a href=../../index.php><b>LOGIN</b></a></center>";
}
else{
$aksi="modul/mod_photografer/aksi_photografer.php";
switch($_GET[act]){
  // Tampil photografer
  default:
    echo "<h2>photografer</h2>
          <input type=button value='Tambah photografer' 
          onclick=\"window.location.href='?inyong=photografer&act=tambahphotografer';\">
          <table>
          <tr><th>no</th><th>nama photografer</th><th>Email</th><th>no telp/HP</th><th>status</th><th>aksi</th></tr>"; 
    $tampil=mysql_query("SELECT * FROM photografer ORDER BY id_pg DESC");
    $no=1;
    while ($r=mysql_fetch_array($tampil)){
       echo "<tr><td>$no</td>
             <td>$r[nama]</td>
			 <td><a href=mailto:$r[email]>$r[email]</a></td>
		     <td>$r[no_hp]</td>
             <td align=center>$r[aktif]</td>
             <td><a href=?inyong=photografer&act=editphotografer&id=$r[id_pg]><img src='icon/edit-kecil.png' border=0px width=15px height=16px title='edit'></a>
             </td></tr>";
      $no++;
    }
    echo "</table>";
    echo "<div id=paging>*) Data pada photografer tidak bisa dihapus, tapi bisa di non-aktifkan melalui Edit photografer.</div><br>";
    break;
  
  // Form Tambah photografer
  case "tambahphotografer":
    echo "<h2>Tambah photografer</h2>
          <form method=POST action='$aksi?inyong=photografer&act=input'>
          <table>
          <tr><td>Nama Photografer</td><td> : <input type=text name='nama'></td></tr>
		  <tr><td>E-mail</td><td> : <input type=text name='email'></td></tr>
		  <tr><td>No Telp/HP</td><td> : <input type=text name='no_hp'></td></tr>
          <tr><td colspan=2><input type=submit name=submit value=Simpan>
                            <input type=button value=Batal onclick=self.history.back()></td></tr>
          </table></form>";
     break;
  
  // Form Edit photografer  
  case "editphotografer":
    $edit=mysql_query("SELECT * FROM photografer WHERE id_pg='$_GET[id]'");
    $r=mysql_fetch_array($edit);

    echo "<h2>Edit photografer</h2>
          <form method=POST action=$aksi?inyong=photografer&act=update>
          <input type=hidden name=id value='$r[id_pg]'>
          <table>
          <tr><td>Nama photografer</td> <td> : <input type=text name='nama' value='$r[nama]'></td></tr>
		  <tr><td>E-mail</td>           <td> : <input type=text name='email' size=30 value='$r[email]'></td></tr>
          <tr><td>No.Telp/HP</td>       <td> : <input type=text name='no_hp' size=30 value='$r[no_hp]'></td></tr>";		  
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
