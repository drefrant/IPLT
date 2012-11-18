 <?php
 if ($_GET['module']=='IPLT'){
 ?>
			<!-- CONTENT -->
		  <div id="content">		  
          <!-- Slideshow Headline Berita -->
          <div id="content-kiri-headline">	  
          <div id="content-head">
		    <ul id="newsslider">
			  <?php
			  $terkini2=mysql_query("SELECT * FROM berita WHERE headline='Y' ORDER BY id_berita DESC LIMIT 8");
			  $no=1;
			  while($t=mysql_fetch_array($terkini2)){      
			  $tgl = tgl_indo($t[tanggal]);
			  $isi_berita = strip_tags($t['isi_berita']); 
			  $isi = substr($isi_berita,0,100); 
			  $isi = substr($isi_berita,0,strrpos($isi," ")); 
			  echo "
			  <li>
			  <a href='berita-$t[id_berita]-$t[judul_seo].html'>
			  <img class=imgheadline src=foto_berita/$t[gambar] width='82px' height='40px' alt='' /></a>
			  <h3><a href='berita-$t[id_berita]-$t[judul_seo].html'>&nbsp;$t[judul]</h3></a>
			  <p><span class=tanggal>$t[hari], $tgl - $t[jam] WIB</span><br />$isi ...
			  <a href='berita-$t[id_berita]-$t[judul_seo].html'> &raquo; selengkapnya...</a></p>
			  </li>"; 
			  $no++;} 
			  ?>
			  </ul>
          </div> 
 <!-- Untuk menu kiri-->         
        <div id="tips">
         <!--<?php               
              $main=mysql_query("SELECT * FROM mainmenukiri  
                                 WHERE  aktif='Y'");
              while($r=mysql_fetch_array($main)){
	             //echo "<li><a href='$r[link]'><span>$r[nama_menu]</span></a>";
	             $sub=mysql_query("SELECT * FROM submenu, mainmenukiri  
                                 WHERE submenu.id_main =mainmenukiri.id_main 
                                 AND submenu.id_main=$r[id_main]");
               $jml=mysql_num_rows($sub);
                // apabila sub menu ditemukan
                if ($jml > 0){
                  echo "<div id='iconmenu'><ul>";
	                while($w=mysql_fetch_array($sub)){
					echo "<li><a href='$w[link_sub]'><span><img src='$f[folder]/icon/$w[icon]' border=0px width=23px height=23px> <div id='menus'>&nbsp; $w[nama_sub] </div></span></a></li>";
	                }           
	                echo "</ul></div>
                        </li>";
                }
                else{
                  echo "</li>";
                }
              }        
            ?>-->
                    <?php echo"<div><h2><img src='$f[folder]/images/agenda.png' /></h2></div>"; ?>
                  <ul id="listsidebar">
                  <?php
                    $agenda=mysql_query("SELECT * FROM agenda ORDER BY id_agenda DESC LIMIT 4");
                    while($a=mysql_fetch_array($agenda)){
                        $tgl_agenda = tgl_indo($a[tgl_mulai]);
                        $isi_agenda = strip_tags($a['isi_agenda']); // membuat paragraf pada isi berita dan mengabaikan tag html
                        $isi = substr($isi_agenda,0,200); // ambil sebanyak 220 karakter
                        $isi = substr($isi_agenda,0,strrpos($isi," ")); // potong per spasi kalimat
   
                       echo "<li class='news-text2'><span class='tanggal'>$tgl_agenda</span>
                             <br /><a href='agenda-$a[id_agenda]-$a[tema_seo].html'>$a[tema]</a></li>";
                    }
                  ?>
                  </ul>
        </div><!-- / end untuk menu kiri-->  
        </div><!-- / end content-kiri untuk headline berita -->       
        <!-- SIDEBAR -->
			<div id="sidebarkiri">
				<!--<?php echo"<div><h2><img src='$f[folder]/images/komentar.png' /></h2></div>"; ?>
          <ul id="listticker">
            <?php
              $sekilas=mysql_query("SELECT * FROM pendapatmasyarakat ORDER BY id_pendapat DESC LIMIT 8");
              while($s=mysql_fetch_array($sekilas)){
                echo "<li><img src='foto_pendapatmasyarakat/kecil_$s[gambar]' width='54' height='54' />
                      <span class='news-text'>$s[pendapat_masyarakat]</span></li>";
              }
            ?>
          </ul>-->
		  <!--<br/>-->
		  <ul id="content-paling-kiri">
		  <!--<?php               
              $main=mysql_query("SELECT * FROM mainmenukiri 
                                 WHERE  aktif='Y'");
              while($r=mysql_fetch_array($main)){
	             //echo "<li><a href='$r[link]'><span>$r[nama_menu]</span></a>";
	             $sub=mysql_query("SELECT * FROM submenubawah, mainmenu  
                                 WHERE submenubawah.id_main =mainmenu.id_main 
                                 AND submenubawah.id_main=$r[id_main]");
               $jml=mysql_num_rows($sub);
                // apabila sub menu ditemukan
                if ($jml > 0){
                  echo "<div id='iconmenus'><ul>";
	                while($w=mysql_fetch_array($sub)){
					echo "<li><a href='$w[link_sub]'><span><img src='$f[folder]/icon/$w[icon]' border=0px width=23px height=23px> <div id='menus'>$w[nama_sub] </div></span></a></li>";
	                }           
	                echo "</ul></div>
                        </li>";
                }
                else{
                  echo "</li>";
                }
              }        
            ?> <br/>
		  </ul>
		  <?php echo"<div><h2><img src='$f[folder]/images/kamusdialekbanyumas.png' /></h2></div>"; ?>
          <ul id="listsidebar-kamus">
            <?php
              $kamus=mysql_query("SELECT * FROM kamus_dialek ORDER BY id_kamus DESC LIMIT 1");
              while($k=mysql_fetch_array($kamus)){
                echo "<div id='kamus'><li><span class='news-text'><strong>Indonesia:</strong> $k[indonesia]</span><br/>
				<span class='news-text'><strong>Banyumas:</strong> $k[banyumas]</span><br/>
				<span class='news-text'><strong>Inggris:</strong> $k[inggris]</span></li></div>
				<div id='bataskamus'>
					<div id='kamuskalimat'>
					<span class='news-text'>$k[kalimat]</span>				
					</div>
				</div>";
              }
            ?>
          </ul><br />-->
		 
          <ul id="listsidebar">
            <?php
              $ip      = $_SERVER['REMOTE_ADDR']; // Mendapatkan IP komputer user
              $tanggal = date("Ymd"); // Mendapatkan tanggal sekarang
              $waktu   = time(); // 

              // Mencek berdasarkan IPnya, apakah user sudah pernah mengakses hari ini 
              $s = mysql_query("SELECT * FROM statistik WHERE ip='$ip' AND tanggal='$tanggal'");
              // Kalau belum ada, simpan data user tersebut ke database
              if(mysql_num_rows($s) == 0){
                mysql_query("INSERT INTO statistik(ip, tanggal, hits, online) VALUES('$ip','$tanggal','1','$waktu')");
              } 
              else{
                mysql_query("UPDATE statistik SET hits=hits+1, online='$waktu' WHERE ip='$ip' AND tanggal='$tanggal'");
              }

              $pengunjung       = mysql_num_rows(mysql_query("SELECT * FROM statistik WHERE tanggal='$tanggal' GROUP BY ip"));
              $totalpengunjung  = mysql_result(mysql_query("SELECT COUNT(hits) FROM statistik"), 0); 
              $hits             = mysql_fetch_assoc(mysql_query("SELECT SUM(hits) as hitstoday FROM statistik WHERE tanggal='$tanggal' GROUP BY tanggal")); 
              $totalhits        = mysql_result(mysql_query("SELECT SUM(hits) FROM statistik"), 0); 
              $tothitsgbr       = mysql_result(mysql_query("SELECT SUM(hits) FROM statistik"), 0); 
              $bataswaktu       = time() - 300;
              $pengunjungonline = mysql_num_rows(mysql_query("SELECT * FROM statistik WHERE online > '$bataswaktu'"));

              $path = "counter/";
              $ext = ".jpg";
              $tothitsgbr = sprintf("%06d", $tothitsgbr);
              for ( $i = 0; $i <= 9; $i++ ){
	               $tothitsgbr = str_replace($i, "<img src='$path$i$ext' alt='$i'>", $tothitsgbr);
              }
              echo "
                    <table>
					<tr><td class='news-title'><img src=counter/hariini.png> Pengunjung hari ini </td><td class='news-title'> : $pengunjung </td></tr>
                    <tr><td class='news-title'><img src=counter/total.png> Total pengunjung </td><td class='news-title'> : $totalpengunjung </td></tr>
                    <tr><td class='news-title'><img src=counter/hariini.png> Hits hari ini </td><td class='news-title'> : $hits[hitstoday] </td></tr>
                    <tr><td class='news-title'><img src=counter/total.png> Total Hits </td><td class='news-title'> : $totalhits </td></tr>
                    <tr><td class='news-title'><img src=counter/online.png> Pengunjung Online </td><td class='news-title'> : $pengunjungonline </td></tr>
                    </table><br />
					<div id='statistik'>$tothitsgbr </div>
					";
            ?>
          </ul><br />
		  <ul id="banneriklan">
				<?php
              // Tampilkan banner mitra
              $banner=mysql_query("SELECT * FROM banner_mitra ORDER BY id_mitra DESC LIMIT 10");
              while($b=mysql_fetch_array($banner)){
                  echo "<span><center><a href=$b[url] target='_blank' title='$b[judul]'>
                        <img src='foto_bannermitra/$b[gambar]' border='0'></a></center></span>";
              }
            ?>
			 </ul> 
		  </div>		
		<!-- TAB untuk Berita banyumas & Direktori Banyumas -->         
        <div id="content-beritabanyumas">		
            <div id="tabsview">
		          <div id="tab1" class="tab_sel" onclick="javascript: displayPanel('1');" align="center">&nbsp; BERITA IPLT &nbsp;</div>
 		          <div id="tab2" class="tab" style="margin-left: 1px;" onclick="javascript: displayPanel('2');" align="center">&nbsp; DIREKTORI IPLT &nbsp;</div> 		          
            </div>   
	          <div class="tab_bdr"></div>	          
	          <!-- tab 1: Berita Banyumas -->
            <div class="panel" id="panel1" style="display: block;">
              <span>
              <div class="tips">
              <ul>            
                <?php
                  $beritabanyumas=mysql_query("SELECT * FROM berita ORDER BY dibaca DESC LIMIT 10");
                  while($p=mysql_fetch_array($beritabanyumas)){

                    $isi_berita = strip_tags($p['isi_berita']); // membuat paragraf pada isi berita dan mengabaikan tag html
                    $isi = substr($isi_berita,0,100); // ambil sebanyak 100 karakter
                    $isi = substr($isi_berita,0,strrpos($isi," ")); // potong per spasi kalimat

                    echo "<li class='garisbawah'><a href=berita-$p[id_berita]-$p[judul_seo].html title=\"$isi ...\">$p[judul]</a> ($p[dibaca])</li>";
                  }
                ?>          
              </ul>
              </div>
              </span>
            </div>

	          <!-- tab 2: Direktori Banyumas -->
            <div class="panel" id="panel2" style="display: none;">
              <span>
              <div class="tips">
              <ul>            
                <?php
                  $direktori=mysql_query("SELECT * FROM berita ORDER BY id_berita DESC LIMIT 11");
                  while($t=mysql_fetch_array($direktori)){
                  
                    $isi_berita = strip_tags($t['isi_berita']); // membuat paragraf pada isi berita dan mengabaikan tag html
                    $isi = substr($isi_berita,0,100); // ambil sebanyak 100 karakter
                    $isi = substr($isi_berita,0,strrpos($isi," ")); // potong per spasi kalimat

                    echo "<li class='garisbawah'><a href=berita-$t[id_berita]-$t[judul_seo].html title=\"$isi ...\">$t[judul]</a></li>";
                  }
                ?>                    
              </ul>
              </div>
              </span>
            </div>  
	          <br />
          </div><!-- / end content-kanan untuk tabs-->
				
          <div id="content-kiri">
         <!--<?php            
              // Tampilkan 2 kategori beserta 5 berita dalam kategori tersebut          
   echo "<ul>";
   $main=mysql_query("SELECT * FROM kategori WHERE aktif='Y' order by id_kategori limit 2"); // Kategori Pariwisata & Investasi
   while($r=mysql_fetch_array($main)){
     echo "<li><div id=kotakjudul>
                <span class=judulhead><a href='kategori-$r[id_kategori]-$r[kategori_seo].html'>$r[nama_kategori]</a></span>
              </div>
              <div id=kotakisi>
                <table cellpadding=2 width=100% border=0 cellspacing=4>
                <tbody><div class='tips'>
             <ul>";
          $sub=mysql_query("SELECT * FROM kategori, berita  
                            WHERE kategori.id_kategori=berita.id_kategori  
                            AND berita.id_kategori=$r[id_kategori] order by id_berita desc limit 1,4");
          $sub2=mysql_query("SELECT * FROM kategori, berita  
                            WHERE kategori.id_kategori=berita.id_kategori 
                            AND berita.id_kategori=$r[id_kategori] order by id_berita desc limit 1");
          $t=mysql_fetch_array($sub2);
                if ($t['gambar']!=''){
			             echo "<span class=image><img src='foto_berita/small_$t[gambar]' width=110 border=0></span>";
		            }
                // Tampilkan hanya sebagian isi berita
                $isi_berita = htmlentities(strip_tags($t['isi_berita'])); // membuat paragraf pada isi berita dan mengabaikan tag html
                $isi = substr($isi_berita,0,120); // ambil sebanyak 120 karakter
                $isi = substr($isi_berita,0,strrpos($isi," ")); // potong per spasi kalimat

                $judul = substr($t['judul'],0,30); // ambil sebanyak 35 karakter
                $judul = substr($t['judul'],0,strrpos($judul," ")); // potong per spasi kalimat
                echo "<li class='garisbawah'><span class=judulnya><a href='berita-$t[id_berita]-$t[judul_seo].html' title=\"$t[judul]\">$judul ...</a></span><br />
                      <span class=tanggal>$t[hari], $tgl</span><br /><br /> 
                      $isi ... <a href='berita-$t[id_berita]-$t[judul_seo].html' title=\"Klik untuk melihat detail beritanya\">Selengkapnya</a> 
                      </li>";
                      	        
          while($w=mysql_fetch_array($sub)){
                $judul = substr($w['judul'],0,45); // ambil sebanyak 45 karakter
                $judul = substr($w['judul'],0,strrpos($judul," ")); // potong per spasi kalimat
              echo "<li class='garisbawah'><a href='berita-$w[id_berita]-$w[judul_seo].html' title=\"$w[judul]\">&#187; $judul ...</a></li>";
	         }
	       echo "</ul></div>
                </tbody>
                </table>
              </div>
            </li><br/>";
  }      
echo "</ul>";       
			
			//Tampilkan Potret Banyumas
			// Tentukan kolom
       /*       $col = 5;
              $potret = mysql_query("SELECT * FROM gallery_potretbanyumas ORDER BY rand() DESC LIMIT 3");
              echo "<img src='$f[folder]/images/potretbanyumas.png' />";
              echo "<div id='potret-border'><div class='tipsatas'><table cellpadding='2px'><tr>";              
              $cnt = 0;
              while ($p = mysql_fetch_array($potret)) {
                if ($cnt >= $col) {
                echo "</tr><tr>";
                $cnt = 0;
                }
                $cnt++;
                echo "
						<td align=center valign=top>
						<a id='galeri' href='potret_banyumas/$p[gbr_gallery]' title='$p[keterangan]'>
						<img alt='$p[keterangan]' src='potret_banyumas/$p[gbr_gallery]' width='125px' height='100px'/></a><br />
						<a id='galeri' href='potret_banyumas/$p[gbr_gallery]' title='$p[keterangan]'><b>$p[jdl_gallery]</b></a>						
						</td>
					  ";
              }
             echo "</tr></table></div></div>";
			 echo "<br/>";*/
			 
              // Tampilkan Komik Banyumas
			   /*echo "<img src='$f[folder]/images/komikbanyumas.png' />";
               $komik=mysql_query("SELECT * FROM komik ORDER BY id_komik DESC LIMIT 1");
               while($b=mysql_fetch_array($komik)){			  
                  echo "<div id='komik'>
				        <table>
						   <tr>
						      <td>
								<a id='galeri' href='foto_komik/$b[gambar]'> <img src='foto_komik/$b[gambar]' width='412px' border='0'></a>
							   </td>
							</tr>
						</table>
						</div>";
              }	  */          
          ?>-->
          </div><!-- / end content-kiri untuk berita sebelumnya dan galeri foto -->
          
          <div id="content-kanan">          
<!--<?php
  // Tampilkan 2 kategori beserta 5 berita dalam kategori tersebut (bagian kanan)          
  echo "<ul>";
   $main=mysql_query("SELECT * FROM kategori WHERE aktif='N' order by id_kategori limit 2,2"); //iki kategori bagian Kesenian budaya & APBD
   while($r=mysql_fetch_array($main)){
     echo "<br /><li><div id=kotakjudul>
                <span class=judulhead><a href='kategori-$r[id_kategori]-$r[kategori_seo].html'>$r[nama_kategori]</a></span>
              </div>
              <div id=kotakisi>
                <table cellpadding=2 width=100% border=0 cellspacing=4>
                <tbody>
                <div class='tips'>
             <ul>";
          $sub=mysql_query("SELECT * FROM kategori, berita  
                            WHERE kategori.id_kategori=berita.id_kategori 
                            AND berita.id_kategori=$r[id_kategori] order by id_berita desc limit 1,4");
          $sub2=mysql_query("SELECT * FROM kategori, berita  
                            WHERE kategori.id_kategori=berita.id_kategori 
                            AND berita.id_kategori=$r[id_kategori] order by id_berita desc limit 1");
          $t=mysql_fetch_array($sub2);
                if ($t['gambar']!=''){
			             echo "<span class=image><img src='foto_berita/small_$t[gambar]' width=110 border=0></span>";
		            }
                // Tampilkan hanya sebagian isi berita
                $isi_berita = htmlentities(strip_tags($t['isi_berita'])); // membuat paragraf pada isi berita dan mengabaikan tag html
                $isi = substr($isi_berita,0,120); // ambil sebanyak 120 karakter
                $isi = substr($isi_berita,0,strrpos($isi," ")); // potong per spasi kalimat

                $judul = substr($t['judul'],0,30); // ambil sebanyak 35 karakter
                $judul = substr($t['judul'],0,strrpos($judul," ")); // potong per spasi kalimat
                echo "<li class='garisbawah'>
                      <span class=judulnya><a href='berita-$t[id_berita]-$t[judul_seo].html' title=\"$t[judul]\">$judul ...</a></span><br />
                      <span class=tanggal>$t[hari], $tgl</span><br /><br /> 
                      $isi ... <a href='berita-$t[id_berita]-$t[judul_seo].html' title=\"Klik untuk melihat detail beritanya\">Selengkapnya</a> 
                      </li>";	        
          while($w=mysql_fetch_array($sub)){
                $judul = substr($w['judul'],0,45); // ambil sebanyak 45 karakter
                $judul = substr($w['judul'],0,strrpos($judul," ")); // potong per spasi kalimat
              echo "<li class='garisbawah'><a href='berita-$w[id_berita]-$w[judul_seo].html' title=\"$w[judul]\">&#187; $judul ...</a></li>";
	         }
	       echo "</ul></div>
                </tbody>
                </table>
              </div>
            </li>";
  }        
echo "</ul>";
?> -->
          </div><!-- / end content-kanan untuk kategori berita, download, dan agenda -->
	    </div> <!-- / end content -->
<?php 
}
elseif ($_GET['module']=='detailberita'){
	echo "<div id='content'>          
           <div id='content-detail'>";            

	$detail=mysql_query("SELECT * FROM berita,users,kategori    
                      WHERE users.username=berita.username 
                      AND kategori.id_kategori=berita.id_kategori 
                      AND id_berita='$_GET[id]'");
	$d   = mysql_fetch_array($detail);
	$tgl = tgl_indo($d[tanggal]);
	$baca = $d[dibaca]+1;
	echo "<span class=tanggal><img src=$f[folder]/images/clock.gif> $d[hari], $tgl - $d[jam] WIB</span><br />";
	echo "<span class=judul>$d[judul]</span><br />";
	echo "<span class=posting>Diposting oleh : <b>$d[nama_lengkap]</b><br /> 
        Kategori: <a href=kategori-$d[id_kategori]-$d[kategori_seo].html><b>$d[nama_kategori]</b></a> 
        - Dibaca: <b>$baca</b> kali</span><br />";
  // Apabila ada gambar dalam berita, tampilkan   
 	if ($d[gambar]!=''){
		echo "<p><span class=image><img src='foto_berita/$d[gambar]' border=0></span></p>";
	}
 	//$isi_berita=nl2br($d[isi_berita]); // membuat paragraf pada isi berita
	echo "$d[isi_berita] <br />";	 		  
  
  // Tampilkan judul berita yang terkait (maks: 5) 
  echo "<img src=$f[folder]/images/berita_terkait.jpg><br /><ul>";
  // pisahkan kata per kalimat lalu hitung jumlah kata
  $pisah_kata  = explode(",",$d[tag]);
  $jml_katakan = (integer)count($pisah_kata);

  $jml_kata = $jml_katakan-1; 
  $ambil_id = substr($_GET[id],0,4);

  // Looping query sebanyak jml_kata
  $cari = "SELECT * FROM berita WHERE (id_berita<'$ambil_id') and (id_berita!='$ambil_id') and (" ;
    for ($i=0; $i<=$jml_kata; $i++){
      $cari .= "tag LIKE '%$pisah_kata[$i]%'";
      if ($i < $jml_kata ){
        $cari .= " OR ";
      }
    }
   $cari .= ") ORDER BY id_berita DESC LIMIT 5";
 
  $hasil  = mysql_query($cari);
  while($h=mysql_fetch_array($hasil)){
  		echo "<li><a href=berita-$h[id_berita]-$h[judul_seo].html>$h[judul]</a></li>";
  }      
	echo "</ul>";

  // Apabila detail berita dilihat, maka tambahkan berapa kali dibacanya
  mysql_query("UPDATE berita SET dibaca=$d[dibaca]+1 
              WHERE id_berita='$_GET[id]'"); 
         
    echo "</div>";
	        echo " <div id='fb-root'/></div>
				   <script src=' http://connect.facebook.net/en_US/all.js#appId=305465462871179&amp;xfbml=1'/></script>
			       <div class='fb-comments' data-href='http://www.kabarinyong.com' data-num-posts='2' data-width='650'></div>
				   </div>";            
}

// Modul berita per kategori
elseif ($_GET['module']=='detailkategori'){
	echo "<div id='content'>          
           <div id='content-detail'>";            
  // Tampilkan nama kategori
  $sq = mysql_query("SELECT nama_kategori from kategori where id_kategori='$_GET[id]'");
  $n = mysql_fetch_array($sq);
  echo "<span class=judul_head>&#187; Kategori : <b>$n[nama_kategori]</b></span><br /><br />";
  
  $p      = new Paging3;
  $batas  = 6;
  $posisi = $p->cariPosisi($batas);
  
  // Tampilkan daftar berita sesuai dengan kategori yang dipilih
 	$sql   = "SELECT * FROM berita WHERE id_kategori='$_GET[id]' 
            ORDER BY id_berita DESC LIMIT $posisi,$batas";		 

	$hasil = mysql_query($sql);
	$jumlah = mysql_num_rows($hasil);
	// Apabila ditemukan berita dalam kategori
	if ($jumlah > 0){
   while($r=mysql_fetch_array($hasil)){
		$tgl = tgl_indo($r[tanggal]);
		echo "<table><tr><td><span class=tanggal><img src=$f[folder]/images/clock.gif> $r[hari], $tgl - $r[jam] WIB</span><br />";
		echo "<span class=judul><a href=berita-$r[id_berita]-$r[judul_seo].html>$r[judul]</a></span><br />";
 		// Apabila ada gambar dalam berita, tampilkan
    if ($r[gambar]!=''){
			echo "<span class=image><img src='foto_berita/small_$r[gambar]' width=110 border=0></span>";
		}
    // Tampilkan hanya sebagian isi berita
    $isi_berita = htmlentities(strip_tags($r[isi_berita])); // membuat paragraf pada isi berita dan mengabaikan tag html
    $isi = substr($isi_berita,0,400); // ambil sebanyak 220 karakter
    $isi = substr($isi_berita,0,strrpos($isi," ")); // potong per spasi kalimat
    echo "$isi ... <a href=berita-$r[id_berita]-$r[judul_seo].html>Selengkapnya</a>
          <br /></td></tr></table><hr color=#CCC noshade=noshade />";
	 }
	
  $jmldata     = mysql_num_rows(mysql_query("SELECT * FROM berita WHERE id_kategori='$_GET[id]'"));
  $jmlhalaman  = $p->jumlahHalaman($jmldata, $batas);
  $linkHalaman = $p->navHalaman($_GET[halkategori], $jmlhalaman);

  echo "Hal: $linkHalaman";
  }
  else{
    echo "Belum ada berita pada kategori ini.";
  }
  echo "</div>
    </div>";            
}

// Modul detail agenda
elseif ($_GET['module']=='detailagenda'){
		  echo "<div id='content'>          
               <div id='content-detail'>";
               
	$detail=mysql_query("SELECT * FROM agenda 
                      WHERE id_agenda='$_GET[id]'");
	$d   = mysql_fetch_array($detail);
  $tgl_posting   = tgl_indo($d[tgl_posting]);
  $tgl_mulai   = tgl_indo($d[tgl_mulai]);
  $tgl_selesai = tgl_indo($d[tgl_selesai]);
  $isi_agenda=nl2br($d[isi_agenda]);
	
  echo "<span class=judul>$d[tema]</span><br />";
  echo "<span class=tanggal>Diposting tanggal: $tgl_posting</span><br /><br />";
	echo "<b>Topik</b>  : $isi_agenda <br />";
 	echo "<b>Tanggal</b> : $tgl_mulai s/d $tgl_selesai <br /><br />";
 	echo "<b>Tempat</b> : $d[tempat] <br /><br />";
 	echo "<b>Pukul</b> : $d[jam] <br /><br />";
 	echo "<b>Pengirim (Contact Person)</b> : $d[pengirim] <br />";
            
  echo "</div>
    </div>";            
}


// Modul hasil pencarian berita 
elseif ($_GET['module']=='hasilcari'){
		  echo "<div id='content'>          
               <div id='content-detail'>";
  echo "<span class=judul_head>&#187; <b>Hasil Pencarian</b></span><br />";
  // menghilangkan spasi di kiri dan kanannya
  $kata = trim($_POST['kata']);
  // mencegah XSS
  $kata = htmlentities(htmlspecialchars($kata), ENT_QUOTES);

  // pisahkan kata per kalimat lalu hitung jumlah kata
  $pisah_kata = explode(" ",$kata);
  $jml_katakan = (integer)count($pisah_kata);
  $jml_kata = $jml_katakan-1;

  $cari = "SELECT * FROM berita WHERE " ;
    for ($i=0; $i<=$jml_kata; $i++){
      $cari .= "judul OR isi_berita LIKE '%$pisah_kata[$i]%'";
      if ($i < $jml_kata ){
        $cari .= " OR ";
      }
    }
  $cari .= " ORDER BY id_berita DESC LIMIT 7";
  $hasil  = mysql_query($cari);
  $ketemu = mysql_num_rows($hasil);

  if ($ketemu > 0){
    echo "<p>Ditemukan <b>$ketemu</b> berita dengan kata <font style='background-color:#00FFFF'><b>$kata</b></font> : </p>"; 
    while($t=mysql_fetch_array($hasil)){
		echo "<table><tr><td><span class=judul><a href=berita-$t[id_berita]-$t[judul_seo].html>$t[judul]</a></span><br />";
      // Tampilkan hanya sebagian isi berita
      $isi_berita = htmlentities(strip_tags($t[isi_berita])); // membuat paragraf pada isi berita dan mengabaikan tag html
      $isi = substr($isi_berita,0,250); // ambil sebanyak 150 karakter
      $isi = substr($isi_berita,0,strrpos($isi," ")); // potong per spasi kalimat

      echo "$isi ... <a href=berita-$t[id_berita]-$t[judul_seo].html>Selengkapnya</a>
            <br /></td></tr>
            </table><hr color=#CCC noshade=noshade />";
    }                                                          
  }
  else{
    echo "<p></p><p align=center>Tidak ditemukan berita dengan kata <b>$kata</b></p>";
  }

  echo "</div>
    </div>";            
}


// Modul hasil poling
elseif ($_GET['module']=='hasilpoling'){
 echo "<div id='content'>          
          <div id='content-detail'>";
 if (isset($_COOKIE["poling"])) {
   echo "Sorry, anda sudah pernah melakukan voting terhadap poling ini.";
 }
 else{
  // membuat cookie dengan nama poling
  // cookie akan secara otomatis terhapus dalam waktu 24 jam
  setcookie("poling", "sudah poling", time() + 3600 * 24);

  echo "<span class=judul_head>&#187; <b>Hasil Poling</b></span><br /><br />";

  $u=mysql_query("UPDATE poling SET rating=rating+1 WHERE id_poling='$_POST[pilihan]'");

  echo "<p align=center>Terimakasih atas partisipasi Anda mengikuti poling kami<br /><br />
        Hasil poling saat ini: </p><br />";
  
  echo "<table width=100% style='border: 1pt dashed #0000CC;padding: 10px;'>";

  $jml=mysql_query("SELECT SUM(rating) as jml_vote FROM poling WHERE aktif='Y'");
  $j=mysql_fetch_array($jml);
  
  $jml_vote=$j[jml_vote];
  
  $sql=mysql_query("SELECT * FROM poling WHERE aktif='Y' and status='Jawaban'");
  
  while ($s=mysql_fetch_array($sql)){
  	
  	$prosentase = sprintf("%2.1f",(($s[rating]/$jml_vote)*100));
  	$gbr_vote   = $prosentase * 3;

    echo "<tr><td width=120>$s[pilihan] ($s[rating]) </td><td> 
          <img src=$f[folder]/images/blue.png width=$gbr_vote height=18 border=0> $prosentase % 
          </td></tr>";  
  }
  echo "</table>
        <p>Jumlah Voting: <b>$jml_vote</b></p>";
 }
  echo "</div>
    </div>";            
}


// Modul hasil poling
elseif ($_GET['module']=='lihatpoling'){
  echo "<div id='content'>          
          <div id='content-detail'>";
  echo "<span class=judul_head>&#187; <b>Hasil Poling</b></span><br /><br />";

  echo "<p align=center>Terimakasih atas partisipasi Anda mengikuti poling kami<br /><br />
        Hasil poling saat ini: </p><br />";
  
  echo "<table width=100% style='border: 1pt dashed #0000CC;padding: 10px;'>";

  $jml=mysql_query("SELECT SUM(rating) as jml_vote FROM poling WHERE aktif='Y'");
  $j=mysql_fetch_array($jml);
  
  $jml_vote=$j[jml_vote];
  
  $sql=mysql_query("SELECT * FROM poling WHERE aktif='Y' and status='Jawaban'");
  
  while ($s=mysql_fetch_array($sql)){
  	
  	$prosentase = sprintf("%2.1f",(($s[rating]/$jml_vote)*100));
  	$gbr_vote   = $prosentase * 3;

    echo "<tr><td width=120>$s[pilihan] ($s[rating]) </td><td> 
          <img src=$f[folder]/images/blue.png width=$gbr_vote height=18 border=0> $prosentase % 
          </td></tr>";  
  }
  echo "</table>
        <p>Jumlah Voting: <b>$jml_vote</b></p>";
  echo "</div>
    </div>";            
}

// Modul profil
elseif ($_GET['module']=='profilkami'){
  echo "<div id='content'>          
          <div id='content-detail'>";
  echo "<span class=judul_head>&#187; <b>Profil</b></span><br /><br />"; 

	$profil = mysql_query("SELECT * FROM modul WHERE id_modul='37'");
	$r      = mysql_fetch_array($profil);

  echo "<tr><td class=isi>";
  if ($r[gambar]!=''){
		echo "<span class=image><img src='foto_banner/$r[gambar]'></span>";
	}
  echo "$r[static_content]";  
  echo "</div>
    </div>";            
}

// Modul halaman statis
elseif ($_GET['module']=='halamanstatis'){
		  echo "<div id='content'>          
               <div id='content-detail'>";
               
	$detail=mysql_query("SELECT * FROM halamanstatis 
                      WHERE id_halaman='$_GET[id]'");
	$d   = mysql_fetch_array($detail);
  $tgl_posting   = tgl_indo($d[tgl_posting]);
	
  echo "<span class=judul>$d[judul]</span><br />";
  echo "<span class=tanggal>Diposting tanggal: $tgl_posting</span><br /><br />";
  if ($d[gambar]!=''){
		echo "<span class=image><img src='foto_banner/$d[gambar]'></span>";
	}
	echo "$d[isi_halaman] <br />";
            
  echo "</div>
    </div>";            
}

// Modul semua berita
elseif ($_GET['module']=='semuaberita'){
  echo "<div id='content'>          
          <div id='content-detail'>";
  echo "<span class=judul_head>&#187; <b>Berita</b></span><br /><br />"; 
  $p      = new Paging2;
  $batas  = 12;
  $posisi = $p->cariPosisi($batas);
  // Tampilkan semua berita
  $sql=mysql_query("select count(komentar.id_komentar) as jml, judul, judul_seo, jam, 
                       berita.id_berita, hari, tanggal, gambar, isi_berita    
                       from berita left join komentar 
                       on berita.id_berita=komentar.id_berita
                       and aktif='Y' 
                       group by berita.id_berita DESC LIMIT $posisi,$batas");
  while($r=mysql_fetch_array($sql)){
		$tgl = tgl_indo($r[tanggal]);
		echo "<table><tr><td>
          <span class=tanggal>$r[hari], $tgl - $r[jam] WIB</span><br />";
 		echo "<span class=judul><a href=berita-$r[id_berita]-$r[judul_seo].html>$r[judul]</a></span><br />";
      // Tampilkan hanya sebagian isi berita
      $isi_berita = htmlentities(strip_tags($r[isi_berita])); // membuat paragraf pada isi berita dan mengabaikan tag html
      $isi = substr($isi_berita,0,220); // ambil sebanyak 150 karakter
      $isi = substr($isi_berita,0,strrpos($isi," ")); // potong per spasi kalimat

      echo "$isi ... <a href=berita-$r[id_berita]-$r[judul_seo].html>Selengkapnya</a> (<b>$r[jml] komentar</b>)
            </td></tr></table>
            <hr color=#CCC noshade=noshade />";
	 }
	
  $jmldata     = mysql_num_rows(mysql_query("SELECT * FROM berita"));
  $jmlhalaman  = $p->jumlahHalaman($jmldata, $batas);
  $linkHalaman = $p->navHalaman($_GET[halberita], $jmlhalaman);

  echo "Hal: $linkHalaman <br /><br />";
  echo "</div>
    </div>";            
}

// Modul semua agenda
elseif ($_GET['module']=='semuaagenda'){
  echo "<div id='content'>          
          <div id='content-detail'>";
  echo "<span class=judul_head>&#187; <b>Agenda</b></span><br /><br />"; 
  $p      = new Paging4;
  $batas  = 6;
  $posisi = $p->cariPosisi($batas); 
  // Tampilkan semua agenda
 	$sql = mysql_query("SELECT * FROM agenda  
                      ORDER BY id_agenda DESC LIMIT $posisi,$batas");		 
  while($d=mysql_fetch_array($sql)){
    $tgl_posting = tgl_indo($d[tgl_posting]);
    $tgl_mulai   = tgl_indo($d[tgl_mulai]);
    $tgl_selesai = tgl_indo($d[tgl_selesai]);
    $isi_agenda  = nl2br($d[isi_agenda]);
	
    echo "<table>";
		echo "<tr><td colspan=2><span class=tanggal>$tgl_posting</span></td></tr>";
    echo "<tr><td colspan=2><span class=judul>$d[tema]</span></td></tr>";
	  echo "<tr><td valign=top><b>Topik</b>  </td><td> : $isi_agenda </td></tr>";
 	  echo "<tr><td><b>Tanggal</b> </td><td> : $tgl_mulai s/d $tgl_selesai </td></tr>";
 	  echo "<tr><td><b>Pukul</b> </td><td> : $d[jam] </td></tr>";
 	  echo "<tr><td><b>Tempat</b> </td><td> : $d[tempat] </td></tr>";
 	  echo "<tr><td><b>Pengirim</b> </td><td> : $d[pengirim] 
          </td></tr></table><hr color=#CCC noshade=noshade />";
	 }
	
  $jmldata     = mysql_num_rows(mysql_query("SELECT * FROM agenda"));
  $jmlhalaman  = $p->jumlahHalaman($jmldata, $batas);
  $linkHalaman = $p->navHalaman($_GET[halagenda], $jmlhalaman);

  echo "Hal: $linkHalaman <br /><br />";
  echo "</div>
    </div>";            
}

// Modul semua download
elseif ($_GET['module']=='semuadownload'){
  echo "<div id='content'>          
          <div id='content-detail'>";
  echo "<span class=judul_head>&#187; <b>Bank Data</b></span><br /><br />"; 
  $p      = new Paging5;
  $batas  = 20;
  $posisi = $p->cariPosisi($batas);
  // Tampilkan semua download
 	$sql = mysql_query("SELECT * FROM download  
                      ORDER BY id_download DESC LIMIT $posisi,$batas");		 

  echo "<ul>";   
   while($d=mysql_fetch_array($sql)){
      echo "<li><a href='downlot.php?file=$d[nama_file]'>$d[judul]</a> ($d[hits])</li>";
	 }
  echo "</ul><hr color=#CCC noshade=noshade />";
	
  $jmldata     = mysql_num_rows(mysql_query("SELECT * FROM download"));
  $jmlhalaman  = $p->jumlahHalaman($jmldata, $batas);
  $linkHalaman = $p->navHalaman($_GET[haldownload], $jmlhalaman);

  echo "Hal: $linkHalaman <br /><br />";
  echo "</div>
    </div>";            
}

// Modul semua album
elseif ($_GET['module']=='semuaalbum'){
  echo "<div id='content'>          
          <div id='content-detail'>";
  echo "<span class=judul_head>&#187; <b>Album Galeri Foto</b></span><br />"; 
  // Tentukan kolom
  $col = 5;

  $a = mysql_query("SELECT jdl_album, album.id_album, gbr_album, album_seo,  
                  COUNT(gallery.id_gallery) as jumlah 
                  FROM album LEFT JOIN gallery 
                  ON album.id_album=gallery.id_album 
                  WHERE album.aktif='Y'  
                  GROUP BY jdl_album");
  echo "<table><tr>";
  $cnt = 0;
  while ($w = mysql_fetch_array($a)) {
    if ($cnt >= $col) {
      echo "</tr><tr>";
      $cnt = 0;
  }
  $cnt++;

 echo "<td align=center valign=top><br />
    <a href=album-$w[id_album]-$w[album_seo].html>
    <img class='img2' src='img_album/kecil_$w[gbr_album]' border=0 width=120 height=90><br />
    $w[jdl_album]</a><br />($w[jumlah] Foto)<br /></td>";
}
echo "</tr></table>";
  echo "</div>
    </div>";            
}
// Modul galeri foto berdasarkan album
elseif ($_GET['module']=='detailalbum'){
  echo "<div id='content'>          
          <div id='content-detail'>";
  // Dapatkan judul album
  $j = mysql_fetch_array(mysql_query("SELECT jdl_album FROM album WHERE id_album='$_GET[id]'"));
  echo "<span class=judul_head>&#187; <a href=semua-album.html><b>Album Galeri Foto</b></a> &#187; <b>$j[jdl_album]</b></span><br />"; 
  $p      = new Paging6;
  $batas  = 10;
  $posisi = $p->cariPosisi($batas);

  // Tentukan kolom
  $col = 6;

  $g = mysql_query("SELECT * FROM gallery WHERE id_album='$_GET[id]' ORDER BY id_gallery DESC LIMIT $posisi,$batas");
  $ada = mysql_num_rows($g);
  
  if ($ada > 0) {
  echo "<table><tr>";
  $cnt = 0;
  while ($w = mysql_fetch_array($g)) {
    if ($cnt >= $col) {
      echo "</tr><tr>";
      $cnt = 0;
    }
    $cnt++;

    echo "<td align=center valign=top><br />
          <a id='galeri' href='img_galeri/$w[gbr_gallery]' title='$w[keterangan]'>
          <img alt='galeri' src='img_galeri/kecil_$w[gbr_gallery]' /></a><br />
          <a href=#><b>$w[jdl_gallery]</b></a></td>";
  }
  echo "</tr></table><br />";

  $jmldata     = mysql_num_rows(mysql_query("SELECT * FROM gallery WHERE id_album='$_GET[id]'"));
  $jmlhalaman  = $p->jumlahHalaman($jmldata, $batas);
  $linkHalaman = $p->navHalaman($_GET[halgaleri], $jmlhalaman);

  echo "Hal: $linkHalaman <br /><br />";
  }else{
    echo "<p>Belum ada foto.</p>";
  }
  echo "</div>
    </div>";            
}

// Album Potret Banyumas
elseif ($_GET['module']=='semuaalbumpotretbanyumas'){
  echo "<div id='content'>          
          <div id='content-detail'>";
  echo "<span class=judul_head>&#187; <b>Album Potret Banyumas</b></span><br />"; 
  // Tentukan kolom
  $col = 6;

  $a = mysql_query("SELECT jdl_album, album_potretbanyumas.id_album, gbr_album, album_seo,  
                  COUNT(gallery_potretbanyumas.id_gallery) as jumlah 
                  FROM album_potretbanyumas LEFT JOIN gallery_potretbanyumas 
                  ON album_potretbanyumas.id_album=gallery_potretbanyumas.id_album 
                  WHERE album_potretbanyumas.aktif='Y'  
                  GROUP BY jdl_album");
  echo "<table><tr>";
  $cnt = 0;
  while ($pb = mysql_fetch_array($a)) {
    if ($cnt >= $col) {
      echo "</tr><tr>";
      $cnt = 0;
  }
  $cnt++;
 echo "<td align=center valign=top><br />
    <a href=albumpotretbanyumas-$pb[id_album]-$pb[album_seo].html>
    <img class='img2' src='img_potretbanyumas/kecil_$pb[gbr_album]' border=0 width=120 height=90><br />
    $pb[jdl_album]</a><br />($pb[jumlah] Foto)<br /></td>";
}
echo "</tr></table>";
  echo "</div>
    </div>";            
}
// Modul galeri foto berdasarkan album potret banyumas
elseif ($_GET['module']=='detailalbumpotretbanyumas'){
  echo "<div id='content'>          
          <div id='content-detail'>";
  // Dapatkan judul album
  $j = mysql_fetch_array(mysql_query("SELECT jdl_album FROM album_potretbanyumas WHERE id_album='$_GET[id]'"));
  echo "<span class=judul_head>&#187; <a href=semua-album-potretbanyumas.html><b>Album Potret Banyumas</b></a> &#187; <b>$j[jdl_album]</b></span><br />"; 
  $p      = new Paging6;
  $batas  = 10;
  $posisi = $p->cariPosisi($batas);

  // Tentukan kolom
  $col = 6;

  $g = mysql_query("SELECT * FROM gallery_potretbanyumas WHERE id_album='$_GET[id]' ORDER BY id_gallery DESC LIMIT $posisi,$batas");
  $ada = mysql_num_rows($g);
  
  if ($ada > 0) {
  echo "<table><tr>";
  $cnt = 0;
  while ($pb = mysql_fetch_array($g)) {
    if ($cnt >= $col) {
      echo "</tr><tr>";
      $cnt = 0;
    }
    $cnt++;

    echo "<td align=center valign=top><br />
          <a id='galeri' href='potret_banyumas/$pb[gbr_gallery]' title='$pb[keterangan]'>
          <img alt='galeri' src='potret_banyumas/kecil_$pb[gbr_gallery]' /></a><br />
          <a href=#><b>$pb[jdl_gallery]</b></a></td>";
  }
  echo "</tr></table><br />";

  $jmldata     = mysql_num_rows(mysql_query("SELECT * FROM gallery_potretbanyumas WHERE id_album='$_GET[id]'"));
  $jmlhalaman  = $p->jumlahHalaman($jmldata, $batas);
  $linkHalaman = $p->navHalaman($_GET[halgaleri], $jmlhalaman);
  echo "Hal: $linkHalaman <br /><br />";
  }else{
    echo "<p>Belum ada foto.</p>";
  }
  echo "</div>
    </div>";            
}
//---End Semua Potret & Gallery Banyumas----
// Modul hubungi kami
elseif ($_GET['module']=='hubungikami'){
  echo "<div id='content'>          
          <div id='content-detail'>";
  echo "<span class=judul_head>&#187; <b>Hubungi Kami</b></span><br /><br />"; 
  echo "<b>Hubungi kami secara online dengan mengisi form dibawah ini:</b>
        <table width=100% style='border: 1pt dashed #0000CC;padding: 10px;'>
        <form action=hubungi-aksi.html method=POST>
        <tr><td>Nama</td><td> : <input type=text name=nama size=40></td></tr>
        <tr><td>Email</td><td> : <input type=text name=email size=40></td></tr>
        <tr><td>Subjek</td><td> : <input type=text name=subjek size=55></td></tr>
        <tr><td valign=top>Pesan</td><td> <textarea name=pesan  style='width: 315px; height: 100px;'></textarea></td></tr>
        <tr><td>&nbsp;</td><td><img src='captcha.php'></td></tr>
        <tr><td>&nbsp;</td><td>(Masukkan 6 kode diatas)<br /><input type=text name=kode size=6 maxlength=6><br /></td></tr>
        </td><td colspan=2><input type=submit name=submit value=Kirim></td></tr>
        </form></table><br />";
  echo "</div>
    </div>";            
}

// Modul hubungi aksi
elseif ($_GET['module']=='hubungiaksi'){
  echo "<div id='content'>          
          <div id='content-detail'>";
$nama=trim($_POST[nama]);
$email=trim($_POST[email]);
$subjek=trim($_POST[subjek]);
$pesan=trim($_POST[pesan]);

if (empty($nama)){
  echo "Anda belum mengisikan NAMA<br />
  	      <a href=javascript:history.go(-1)><b>Ulangi Lagi</b>";
}
elseif (empty($email)){
  echo "Anda belum mengisikan EMAIL<br />
  	      <a href=javascript:history.go(-1)><b>Ulangi Lagi</b>";
}
elseif (empty($subjek)){
  echo "Anda belum mengisikan SUBJEK<br />
  	      <a href=javascript:history.go(-1)><b>Ulangi Lagi</b>";
}
elseif (empty($pesan)){
  echo "Anda belum mengisikan PESAN<br />
  	      <a href=javascript:history.go(-1)><b>Ulangi Lagi</b>";
}
else{
	if(!empty($_POST['kode'])){
		if($_POST['kode']==$_SESSION['captcha_session']){

  mysql_query("INSERT INTO hubungi(nama,
                                   email,
                                   subjek,
                                   pesan,
                                   tanggal) 
                        VALUES('$_POST[nama]',
                               '$_POST[email]',
                               '$_POST[subjek]',
                               '$_POST[pesan]',
                               '$tgl_sekarang')");
  echo "<span class=posting>&#187; <b>Hubungi Kami</b></span><br /><br />"; 
  echo "<p align=center><b>Terimakasih telah menghubungi kami. <br /> Kami akan segera meresponnya.</b></p>";
		}else{
			echo "Kode yang Anda masukkan tidak cocok<br />
			      <a href=javascript:history.go(-1)><b>Ulangi Lagi</b></a>";
		}
	}else{
		echo "Anda belum memasukkan kode<br />
  	      <a href=javascript:history.go(-1)><b>Ulangi Lagi</b></a>";
	}
}
  echo "</div>
    </div>";            
}
?>      
