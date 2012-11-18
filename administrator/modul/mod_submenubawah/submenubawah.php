<?php
session_start();
 if (empty($_SESSION['username']) AND empty($_SESSION['passuser'])){
  echo "<link href='style.css' rel='stylesheet' type='text/css'>
 <center>Untuk mengakses modul, Anda harus login <br>";
  echo "<a href=../../index.php><b>LOGIN</b></a></center>";
}
else{
$aksi="modul/mod_submenubawah/aksi_submenubawah.php";
switch($_GET[act]){
  // Tampil Sub Menu Bawah
  default:
    echo "<h2>Sub Menu Bawah</h2>
          <input type=button value='Tambah Sub Menu' onclick=\"window.location.href='?inyong=submenubawah&act=tambahsubmenubawah';\">
          <table>
          <tr><th>no</th><th>sub menu bawah</th><th>menu utama</th><th>link submenubawah</th><th>aksi</th></tr>";

    $tampil = mysql_query("SELECT * FROM submenubawah,mainmenu WHERE submenubawah.id_main=mainmenu.id_main");
  
    $no = 1;
    while($r=mysql_fetch_array($tampil)){
      echo "<tr><td>$no</td>
                <td>$r[nama_sub]</td>
                <td>$r[nama_menu]</td>
                <td>$r[link_sub]</td>
		            <td><a href=?inyong=submenubawah&act=editsubmenubawah&id=$r[id_sub]><img src='icon/edit-kecil.png' border=0px width=15px height=16px title='edit'></a> | 
		                <a href=$aksi?inyong=submenubawah&act=hapus&id=$r[id_sub]><img src='icon/delete-kecil.png' border=0px width=15px height=16px title='delete'></a></td>
		        </tr>";
      $no++;
    }
    echo "</table>";
    break;
  
  case "tambahsubmenubawah":
    echo "<h2>Tambah Sub Menu Bawah</h2>
          <form method=POST action='$aksi?inyong=submenubawah&act=input'>
          <table>
          <tr><td>Sub Menu Bawah</td>     <td> : <input type=text name='nama_sub'></td></tr>
          <tr><td>Menu Utama</td>  <td> : 
          <select name='menu_utama'>
            <option value=0 selected>- Pilih Menu Utama -</option>";
            $tampil=mysql_query("SELECT * FROM mainmenu ORDER BY nama_menu");
            while($r=mysql_fetch_array($tampil)){
              echo "<option value=$r[id_main]>$r[nama_menu]</option>";
            }
    echo "</select></td></tr>
          <tr><td>Link Sub Menu Bawah</td><td> : <input type=text name='link_sub'></td></tr>
          <tr><td colspan=2><input type=submit value=Simpan>
                            <input type=button value=Batal onclick=self.history.back()></td></tr>
          </table></form>";
     break;
    
  case "editsubmenubawah":
    $edit = mysql_query("SELECT * FROM submenubawah WHERE id_sub='$_GET[id]'");
    $r    = mysql_fetch_array($edit);

    echo "<h2>Edit Sub Menu Bawah</h2>
          <form method=POST action=$aksi?inyong=submenubawah&act=update>
          <input type=hidden name=id value=$r[id_sub]>
          <table>
          <tr><td width=70>Sub Menu Bawah</td>     <td> : <input type=text name='nama_sub' value='$r[nama_sub]'></td></tr>
          <tr><td>Menu Utama</td>  <td> : <select name='menu_utama'>";
 
          $tampil=mysql_query("SELECT * FROM mainmenu ORDER BY nama_menu");
          if ($r[id_main]==0){
            echo "<option value=0 selected>- Pilih Menu Utama -</option>";
          }   

          while($w=mysql_fetch_array($tampil)){
            if ($r[id_main]==$w[id_main]){
              echo "<option value=$w[id_main] selected>$w[nama_menu]</option>";
            }
            else{
              echo "<option value=$w[id_main]>$w[nama_menu]</option>";
            }
          }
    echo "</select></td></tr>
          <tr><td>Link Sub Menu Bawah</td><td> : <input type=text name='link_sub' value='$r[link_sub]'></td></tr>
          <tr><td colspan=2><input type=submit value=Update>
                            <input type=button value=Batal onclick=self.history.back()></td></tr>
         </table></form>";
    break;  
}
}
?>
