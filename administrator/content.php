<?php
include "../config/koneksi.php";
include "../config/timezone.php";
include "../config/tanggalan.php";
include "../config/fungsi_combobox.php";
include "../config/halaman.php";

// Bagian kabarinyong
if ($_GET['inyong']=='kabarinyong'){
  if ($_SESSION['leveluser']=='admin'){
  echo "<h2>Selamat Datang</h2>
  <p align=right>Login : $hari_ini, ";
  echo tgl_indo(date("Y m d")); 
  echo " | "; 
  echo date("H:i:s");
  echo " WIB</p>
          <p>Hai <b>$_SESSION[namalengkap]</b>, selamat datang di halaman Administrator CMS IPLT.<br> 
          Silahkan klik menu pilihan yang berada di sebelah kiri untuk mengelola website atau pilih ikon-ikon pada Administrator Panel. </p>		
 		<table>
		<th colspan=5><center>Administrator Panel</center></th>
		<tr>
		  <td width=120 align=center><a href=media.php?inyong=user><img src=images/user.jpg border=none></a></td>
		  <td width=120 align=center><a href=media.php?inyong=modul><img src=images/modul.png border=none></a></td>
		  <td width=120 align=center><a href=media.php?inyong=berita><img src=images/berita.png border=none></a></td>
		  <td width=120 align=center><a href=media.php?inyong=pendapatmasyarakat><img src=images/komentar.png border=none></a></td>
		  <td width=120 align=center><a href=media.php?inyong=download><img src=images/download.png border=none></a></td>
        </tr>
		<tr>
		  <th width=120><b>Manajemen User</b></th>
		  <th width=120><b>Manajemen Modul</b></center></th>
		  <th width=120><b>Berita</b></th>
		  <th width=120><b>Pendapat Masyarakat</b></th>
		  <th width=120><b>Download</b></th>
		</tr>
		<tr>
		  <td width=120 align=center><a href=media.php?inyong=agenda><img src=images/agenda.png border=none></a></td>
		  <td width=120 align=center><a href=media.php?inyong=komikbanyumas><img src=images/komik.png border=none></a></td>
		  <td width=120 align=center><a href=media.php?inyong=galerifoto><img src=images/galeri.png border=none></a></td>
		  <td width=120 align=center><a href=media.php?inyong=poling><img src=images/poling.png border=none></a></td>
		  <td width=120 align=center><a href=media.php?inyong=hubungi><img src=images/hubungi.png border=none></a></td>
        </tr>
		<tr>
		  <th width=120><center><b>Agenda</b></th>
		  <th width=120><center><b>Komik</b></th>
		  <th width=120><center><b>Galeri Foto</b></th>
		  <th width=120><b>Poling</b></th>
		  <th width=120><b>Hubungi Kami</b></th>
		</tr>		
		<tr>
		  <td width=120 align=center><a href=media.php?inyong=iplt><img src=images/kamus.png border=none></a></td>
		  <td width=120 align=center><a href=media.php?inyong=halamanstatis><img src=images/halstatis.png border=none></a></td>
		  <td width=120 align=center><a href=media.php?inyong=cuaca><img src=images/cuaca.png border=none></a></td>
		  <td width=120 align=center><a href=media.php?inyong=photografer><img src=images/photografer.png border=none></a></td>
		  <td width=120 align=center><a href=media.php?inyong=kategori><img src=images/kategori.png border=none></a></td>
        </tr>
		<tr>
		  <th width=120><b>IPLT</b></th>
		  <th width=120><b>Halaman Statis</b></center></th>
		  <th width=120><b>Cuaca</b></th>
		  <th width=120><b>Photografer</b></th>
		  <th width=120><b>Kategori</b></th>
		</tr>
		<tr>
		  <td width=120 align=center><a href=media.php?inyong=tag><img src=images/tag.png border=none></a></td>
		  <td width=120 align=center><a href=media.php?inyong=identitas website><img src=images/id.png border=none></a></td>
		  <td width=120 align=center><a href=media.php?inyong=menu utama><img src=images/menu-utama.png border=none></a></td>
		  <td width=120 align=center><a href=media.php?inyong=sub menu atas><img src=images/sub-menu-atas.png border=none></a></td>
		  <td width=120 align=center><a href=media.php?inyong=sub menu bawah><img src=images/sub-menu.png border=none></a></td>
        </tr>
		<tr>
		  <th width=120><center><b>Tag</b></th>
		  <th width=120><center><b>Identitas Website</b></th>
		  <th width=120><center><b>Menu Utama</b></th>
		  <th width=120><b>Sub Menu Atas</b></th>
		  <th width=120><b>Sub Menu Bawah</b></th>
		</tr>
        </table>
		<p>&nbsp;</p>
		<p>&nbsp;</p>
		<p>&nbsp;</p>";
  }
  elseif ($_SESSION['leveluser']=='user'){
  echo "<h2>Selamat Datang</h2>
          <p>Hai <b>$_SESSION[namalengkap]</b>, selamat datang di halaman Administrator IPLT <br> 
          Silahkan klik menu pilihan yang berada di sebelah kiri untuk mengelola website. </p>
		<p>&nbsp;</p>
		<p>&nbsp;</p>
		<p>&nbsp;</p>
		<p>&nbsp;</p>
        <p align=right>Login : $hari_ini, ";
  echo tgl_indo(date("Y m d")); 
  echo " | "; 
  echo date("H:i:s");
  echo " WIB</p>";
 	}	
	elseif ($_SESSION['leveluser']=='citizen'){
    echo "<h2>Selamat Datang</h2>
          <p>Hai <b>$_SESSION[namalengkap]</b>, selamat datang di halaman Administrator Citizen Journalisme IPLT <br> 
          Silahkan klik menu pilihan yang berada di sebelah kiri untuk mengelola website. </p>
		<p>&nbsp;</p>
		<p>&nbsp;</p>
		<p>&nbsp;</p>
		<p>&nbsp;</p>
        <p align=right>Login : $hari_ini, ";
    echo tgl_indo(date("Y m d")); 
    echo " | "; 
    echo date("H:i:s");
    echo " WIB</p>";
 	}
}

// Bagian User
elseif ($_GET['inyong']=='user'){
  if ($_SESSION['leveluser']=='admin' OR $_SESSION[leveluser]=='user'){
    include "modul/mod_users/users.php";
  }
}
// Bagian Modul
elseif ($_GET['inyong']=='modul'){
  if ($_SESSION['leveluser']=='admin'){
    include "modul/mod_modul/modul.php";
  }
}
// Bagian Kategori
elseif ($_GET['inyong']=='kategori'){
  if ($_SESSION['leveluser']=='admin'){
    include "modul/mod_kategori/kategori.php";
  }
}
// Bagian Berita
elseif ($_GET['inyong']=='berita'){
  if ($_SESSION['leveluser']=='admin' OR $_SESSION['leveluser']=='user'){
    include "modul/mod_berita/berita.php";                            
  }
}
// Bagian Tag
elseif ($_GET['inyong']=='tag'){
  if ($_SESSION['leveluser']=='admin'){
    include "modul/mod_tag/tag.php";
  }
}
// Bagian Agenda
elseif ($_GET['inyong']=='agenda'){
  if ($_SESSION['leveluser']=='admin' OR $_SESSION['leveluser']=='user'){
    include "modul/mod_agenda/agenda.php";
  }
}
// Bagian Komik Banyumas
elseif ($_GET['inyong']=='komikbanyumas'){
  if ($_SESSION['leveluser']=='admin'){
    include "modul/mod_komikbanyumas/komikbanyumas.php";
  }
}
// Bagian Poling
elseif ($_GET['inyong']=='poling'){
  if ($_SESSION['leveluser']=='admin'){
    include "modul/mod_poling/poling.php";
  }
}
// Bagian Download
elseif ($_GET['inyong']=='download'){
  if ($_SESSION['leveluser']=='admin'){
    include "modul/mod_download/download.php";
  }
}
// Bagian Hubungi Kami
elseif ($_GET['inyong']=='hubungi'){
  if ($_SESSION['leveluser']=='admin'){
    include "modul/mod_hubungi/hubungi.php";
  }
}
// Bagian Templates
elseif ($_GET['inyong']=='templates'){
  if ($_SESSION['leveluser']=='admin'){
    include "modul/mod_templates/templates.php";
  }
}
// Bagian Cuaca Banyumas
elseif ($_GET['inyong']=='cuaca'){
  if ($_SESSION['leveluser']=='admin'){
    include "modul/mod_cuaca/cuaca.php";
  }
}
// Bagian Kamus Dialek
elseif ($_GET['inyong']=='kamusdialek'){
  if ($_SESSION['leveluser']=='admin'){
    include "modul/mod_dialek/dialek.php";
  }
}
// Bagian Album
elseif ($_GET['inyong']=='album'){
  if ($_SESSION['leveluser']=='admin'){
    include "modul/mod_album/album.php";
  }
}
// Bagian Galeri Foto
elseif ($_GET['inyong']=='galerifoto'){
  if ($_SESSION['leveluser']=='admin'){
    include "modul/mod_galerifoto/galerifoto.php";
  }
}
// Bagian Kata Jelek
elseif ($_GET['inyong']=='katajelek'){
  if ($_SESSION['leveluser']=='admin'){
    include "modul/mod_katajelek/katajelek.php";
  }
}
// Bagian Menu Utama
elseif ($_GET['inyong']=='menuutama'){
  if ($_SESSION['leveluser']=='admin'){
    include "modul/mod_menuutama/menuutama.php";
  }
}
// Bagian Sub Menu
elseif ($_GET['inyong']=='submenu'){
  if ($_SESSION['leveluser']=='admin'){
    include "modul/mod_submenu/submenu.php";
  }
}
// Bagian Sub Menu Bawah
elseif ($_GET['inyong']=='submenubawah'){
  if ($_SESSION['leveluser']=='admin'){
    include "modul/mod_submenubawah/submenubawah.php";
  }
}
// Bagian Halaman Statis
elseif ($_GET['inyong']=='halamanstatis'){
  if ($_SESSION['leveluser']=='admin'){
    include "modul/mod_halamanstatis/halamanstatis.php";
  }
}
// Bagian Pendapat Masyarakat
elseif ($_GET['inyong']=='pendapatmasyarakat'){
  if ($_SESSION['leveluser']=='admin'){
    include "modul/mod_pendapatmasyarakat/pendapatmasyarakat.php";
  }
}
// Bagian Identitas Website
elseif ($_GET['inyong']=='identitas'){
  if ($_SESSION['leveluser']=='admin'){
    include "modul/mod_identitas/identitas.php";
  }
}
// Bagian Album Potret Banyumas
elseif ($_GET['inyong']=='albumpb'){
  if ($_SESSION['leveluser']=='admin'){
    include "modul/mod_albumpb/albumpb.php";
  }
}
// Bagian Gallery Potret Banyumas
elseif ($_GET['inyong']=='potretbanyumas'){
  if ($_SESSION['leveluser']=='admin')  {
    include "modul/mod_galeripb/galeripb.php";
  }
}
// Bagian Photografer
elseif ($_GET['inyong']=='photografer'){
  if ($_SESSION['leveluser']=='admin')  {
    include "modul/mod_photografer/photografer.php";
  }
}
// Bagian Footer
elseif ($_GET['inyong']=='footer'){
  if ($_SESSION['leveluser']=='admin')  {
    include "modul/mod_footer/footer.php";
  }
}
// Bagian Banner Mitra
elseif ($_GET['inyong']=='bannermitra'){
  if ($_SESSION['leveluser']=='admin')  {
    include "modul/mod_bannermitra/bannermitra.php";
  }
}
// Bagian IPLT
elseif ($_GET['inyong']=='iplt'){
  if ($_SESSION['leveluser']=='admin')  {
    include "modul/mod_iplt/iplt.php";
  }
}
// Apabila administrator panel tidak ditemukan
else{
  echo "<p><b>MAAF HALAMAN ADMINISTRATOR PANEL ANDA TIDAK TERSEDIA</b></p>";
}
?>
