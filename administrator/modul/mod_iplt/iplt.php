<?php    
session_start();
 if (empty($_SESSION['username']) AND empty($_SESSION['passuser'])){
  echo "<link href='style.css' rel='stylesheet' type='text/css'>
 <center>Untuk mengakses modul, Anda harus login <br>";
  echo "<a href=../../index.php><b>LOGIN</b></a></center>";
}
else{

$aksi="modul/mod_iplt/aksi_iplt.php";
switch($_GET[act]){
  // Tampil Berita
  default:
    echo "<h2>IPLT</h2>
          <form method=get action='$_SERVER[PHP_SELF]'>
          <input type=hidden name=inyong value=iplt>
          <div id=paging>Masukkan Nama IPLT : <input type=text name='kata'> <input type=submit value=Cari></div>
          </form>
          <input type=button value='Tambah IPLT' onclick=\"window.location.href='?inyong=iplt&act=tambahiplt';\">";

    if (empty($_GET['kata'])){
    echo "<table>  
          <tr><th>no</th><th>kode iplt</th><th>nama iplt</th><th>aksi</th></tr>";

    $p      = new Paging11;
    $batas  = 10;
    $posisi = $p->cariPosisi($batas);

    if ($_SESSION[leveluser]=='admin'){
      $tampil = mysql_query("SELECT * FROM DaftIPLT ORDER BY id DESC LIMIT $posisi,$batas");
    }
    else{
      $tampil=mysql_query("SELECT * FROM DaftIPLT 
                           WHERE username='$_SESSION[namauser]'       
                           ORDER BY id DESC LIMIT $posisi,$batas");
    }
  
    $no = $posisi+1;
    while($r=mysql_fetch_array($tampil)){
      echo "<tr><td>$no</td>
                <td>$r[KdIdIPLT]</td>
                <td>$r[NmIPLT]</td>
                <td><a href=?inyong=iplt&act=editiplt&id=$r[id]><img src='icon/edit-kecil.png' border=0px width=15px height=16px title='edit'></a> | 
                    <a href=\"$aksi?inyong=iplt&act=hapus&id=$r[id]&namafile=$r[GaleriFoto]&namafile=$r[PetaLokasi]&namafile=$r[LapSurveyKons]\" onClick=\"return confirm('Apakah Anda benar-benar mau menghapusnya?')\"><img src='icon/delete-kecil.png' border=0px width=15px height=16px title='delete'></a></td>
            </tr>";
      $no++;
    }
    echo "</table>";

    if ($_SESSION[leveluser]=='admin'){
      $jmldata = mysql_num_rows(mysql_query("SELECT * FROM DaftIPLT"));
    }
    else{
      $jmldata = mysql_num_rows(mysql_query("SELECT * FROM DaftIPLT WHERE username='$_SESSION[namauser]'"));
    }  
    $jmlhalaman  = $p->jumlahHalaman($jmldata, $batas);
    $linkHalaman = $p->navHalaman($_GET[halaman], $jmlhalaman);

    echo "<div id=paging>$linkHalaman</div><br>";
 
    break;    
    }
    else{
    echo "<table>  
          <tr><th>no</th><th>kode iplt</th><th>nama iplt</th><th>aksi</th></tr>";

    $p      = new Paging91;
    $batas  = 1;
    $posisi = $p->cariPosisi($batas);

    if ($_SESSION[leveluser]=='admin'){
      $tampil = mysql_query("SELECT * FROM DaftIPLT WHERE NmIPLT LIKE '%$_GET[kata]%' ORDER BY id DESC LIMIT $posisi,$batas");
    }
    else{
      $tampil=mysql_query("SELECT * FROM DaftIPLT 
                           WHERE username='$_SESSION[namauser]'
                           AND NmIPLT LIKE '%$_GET[kata]%'       
                           ORDER BY id DESC LIMIT $posisi,$batas");
    }
  
    $no = $posisi+1;
    while($r=mysql_fetch_array($tampil)){
      $tgl_posting=tgl_indo($r[tanggal]);
      echo "<tr><td>$no</td>
                <td>$r[KdIdIPLT]</td>
                <td>$r[NmIPLT]</td>
                <td><a href=?inyong=iplt&act=editiplt&id=$r[id]><img src='icon/edit-kecil.png' border=0px width=15px height=16px title='edit'></a> | 
                    <a href=\"$aksi?inyong=iplt&act=hapus&id=$r[id]&namafile=$r[GaleriFoto]&namafile=$r[PetaLokasi]&namafile=$r[LapSurveyKons]\" onClick=\"return confirm('Apakah Anda benar-benar mau menghapusnya?')\"><img src='icon/delete-kecil.png' border=0px width=15px height=16px title='delete'></a></td>
            </tr>";
      $no++;
    }
    echo "</table>";

    if ($_SESSION[leveluser]=='admin'){
      $jmldata = mysql_num_rows(mysql_query("SELECT * FROM DaftIPLT WHERE NmIPLT LIKE '%$_GET[kata]%'"));
    }
    else{
      $jmldata = mysql_num_rows(mysql_query("SELECT * FROM DaftIPLT WHERE username='$_SESSION[namauser]' AND NmIPLT LIKE '%$_GET[kata]%'"));
    }  
    $jmlhalaman  = $p->jumlahHalaman($jmldata, $batas);
    $linkHalaman = $p->navHalaman($_GET[halaman], $jmlhalaman);

    echo "<div id=paging>$linkHalaman</div><br>";
 
    break;    
    }

  
  case "tambahiplt":
    echo "<h2>Tambah IPLT</h2>
          <form method=POST action='$aksi?inyong=iplt&act=input' enctype='multipart/form-data'>
          <table>
          <tr><td width=70>Judul</td>     <td> : <input type=text name='judul' size=60></td></tr>
          <tr><td>Kategori</td>  <td> : 
          <select name='kategori'>
            <option value=0 selected>- Pilih Kategori -</option>";
            $tampil=mysql_query("SELECT * FROM kategori ORDER BY nama_kategori");
            while($r=mysql_fetch_array($tampil)){
              echo "<option value=$r[id_kategori]>$r[nama_kategori]</option>";
            }
    echo "</select></td></tr>
           <tr><td>Headline</td>    <td> : <input type=radio name='headline' value='Y' checked>Y  
                                         <input type=radio name='headline' value='N'> N 
                                         <br>(Apabila berita ada gambarnya dan ingin dijadikan headline, pilih Headline = Y)</td></tr>
          <tr><td>Isi Berita</td>  <td> <textarea name='isi_berita'  style='width: 600px; height: 350px;'></textarea></td></tr>
          <tr><td>Gambar</td>      <td> : <input type=file name='fupload' size=40> 
                                          <br>Tipe gambar harus JPG/JPEG dan ukuran lebar maks: 400 px</td></tr>";

    $tag = mysql_query("SELECT * FROM tag ORDER BY tag_seo");
    echo "<tr><td>Tag (Label)</td><td> ";
    while ($t=mysql_fetch_array($tag)){
      echo "<input type=checkbox value='$t[tag_seo]' name=tag_seo[]>$t[nama_tag] ";
    }
    
    echo "</td></tr>
          <tr><td colspan=2><input type=submit value=Simpan>
                            <input type=button value=Batal onclick=self.history.back()></td></tr>
          </table></form>";
     break;
    
    
  case "editberita":
    $edit = mysql_query("SELECT * FROM berita WHERE id_berita='$_GET[id]' AND username='$_SESSION[namauser]'");
    $r    = mysql_fetch_array($edit);

    echo "<h2>Edit Berita</h2>
          <form method=POST enctype='multipart/form-data' action=$aksi?inyong=berita&act=update>
          <input type=hidden name=id value=$r[id_berita]>
          <table>
          <tr><td width=70>Judul</td>     <td> : <input type=text name='judul' size=60 value='$r[judul]'></td></tr>
          <tr><td>Kategori</td>  <td> : <select name='kategori'>";
 
          $tampil=mysql_query("SELECT * FROM kategori ORDER BY nama_kategori");
          if ($r[id_kategori]==0){
            echo "<option value=0 selected>- Pilih Kategori -</option>";
          }   

          while($w=mysql_fetch_array($tampil)){
            if ($r[id_kategori]==$w[id_kategori]){
              echo "<option value=$w[id_kategori] selected>$w[nama_kategori]</option>";
            }
            else{
              echo "<option value=$w[id_kategori]>$w[nama_kategori]</option>";
            }
          }

    echo "</select></td></tr>";

   if ($r[headline]=='Y'){
      echo "<tr><td>Headline</td> <td> : <input type=radio name='headline' value='Y' checked>Y  
                                        <input type=radio name='headline' value='N'> N</td></tr>";
    }
    else{
      echo "<tr><td>Headline</td> <td> : <input type=radio name='headline' value='Y'>Y  
                                        <input type=radio name='headline' value='N' checked>N</td></tr>";
    }
      echo "<tr><td>Isi Berita</td>   <td> <textarea name='isi_berita' style='width: 600px; height: 350px;'>$r[isi_berita]</textarea></td></tr>
          <tr><td>Gambar</td>       <td> :  ";
          if ($r[gambar]!=''){
              echo "<img src='../foto_berita/small_$r[gambar]'>";  
          }
    echo "</td></tr>
          <tr><td>Ganti Gbr</td>    <td> : <input type=file name='fupload' size=30> *)</td></tr>
          <tr><td colspan=2>*) Apabila gambar tidak diubah, dikosongkan saja.</td></tr>";

    $d = GetCheckboxes('tag', 'tag_seo', 'nama_tag', $r[tag]);


    echo "<tr><td>Tag (Label)</td><td> $d </td></tr>";
 
    echo  "<tr><td colspan=2><input type=submit value=Update>
                            <input type=button value=Batal onclick=self.history.back()></td></tr>
         </table></form>";
    break;  
}

}
?>
