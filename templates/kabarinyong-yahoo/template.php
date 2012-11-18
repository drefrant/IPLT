<?php 
  error_reporting(0);
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<title><?php include "judultitle.php"; ?></title>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<meta name="robots" content="index, follow">
<meta name="description" content="<?php include "description.php"; ?>">
<meta name="keywords" content="<?php include "keywords.php"; ?>">
<meta http-equiv="Copyright" content="stikomyos">
<meta name="author" content="kabarinyong.com">
<meta http-equiv="imagetoolbar" content="no">
<meta name="language" content="Indonesia">
<meta name="revisit-after" content="7">
<meta name="webcrawlers" content="all">
<meta name="rating" content="general">
<meta name="spiders" content="all">
<link rel="shortcut icon" href="favicon.ico" /> 
<link rel="alternate" type="application/rss+xml" title="RSS 2.0" href="rss.xml" />
<link rel="stylesheet" href="<?php echo "$f[folder]/css/style.css" ?>" type="text/css" />
<link rel="stylesheet" href="<?php echo "$f[folder]/css/styles2.css" ?>" type="text/css" />
<link rel="stylesheet" href="<?php echo "$f[folder]/themes/base.css" ?>" type="text/css" /> <!-- Yahoo-->
<link rel="stylesheet" href="<?php echo "$f[folder]/themes/default/theme.css" ?>" type="text/css" /><!-- Yahoo-->
<script src="<?php echo "$f[folder]/js/jquery-1.4.js" ?>" type="text/javascript"></script><!-- Yahoo-->
<script src="<?php echo "$f[folder]/js/jquery.dropdownPlain.js" ?>" type="text/javascript"></script>
<script src="<?php echo "$f[folder]/js/jquery.tipsy.js" ?>" type="text/javascript"></script><!-- Yahoo-->
<script src="<?php echo "$f[folder]/js/menu.js" ?>" type="text/javascript"></script>


<script type='text/javascript'>
  $(function($) {        
	   $('.tips a').tipsy({fade: true, gravity: 'w'});
	   $('.tipsatas a').tipsy({fade: true, gravity: 's'});	
  });
</script>
<script src="<?php echo "$f[folder]/js/jquery.js" ?>" type="text/javascript"></script>
  <script src="<?php echo "$f[folder]/js/jquery.accessible-news-slider.js" ?>" type="text/javascript"></script><!-- Yahoo-->
  <script type="text/javascript">
  jQuery(document).ready(function() {
  jQuery('#newsslider').accessNews({
  });
  });
  </script>
<script src="<?php echo "$f[folder]/js/jquery.fancybox.js" ?>" type="text/javascript"></script>
<script src="<?php echo "$f[folder]/js/jquery.mousewhell.js" ?>" type="text/javascript"></script>
	<script type="text/javascript">
		$(document).ready(function() {
			$("a#galeri").fancybox({
				'titlePosition'	: 'inside'
			});
		});
  </script>	  
<script src="<?php echo "$f[folder]/js/clock.js" ?>" type="text/javascript"></script>
<script src="<?php echo "$f[folder]/js/tabs.js" ?>" type="text/javascript"></script>
<script src="<?php echo "$f[folder]/js/newsticker.js" ?>" type="text/javascript"></script>
<!-- <script src="http://localhost/project/templates/kabarinyong-yahoo/js/clock.js"></script> -->
</head>
<body onload="startclock()">
	<div id="induk">
		<div id="wrapper">
        	<!-- HEADER -->
			<div id="header">
				<!--<div class="tgl">
				 jam 	
				<p><span id="date"></span>, <span id="clock"></span></p>  			
				</div> /tgl -->			
			</div> 
			<!-- /HEADER -->
          <!-- MENU -->
          <div id="page-wrap">
			     <ul class="dropdown">
            <?php               
              $main=mysql_query("SELECT * FROM mainmenu WHERE aktif='Y' Order By id_main");
              while($r=mysql_fetch_array($main)){
	             echo "<li><a href='$r[link]'><span>$r[nama_menu]</span></a>";
	             $sub=mysql_query("SELECT * FROM submenu, mainmenu  
                                 WHERE submenu.id_main=mainmenu.id_main 
                                 AND submenu.id_main=$r[id_main]");
               $jml=mysql_num_rows($sub);
                // apabila sub menu ditemukan
                if ($jml > 0){
                  echo "<div><ul>";
	                while($w=mysql_fetch_array($sub)){
                    echo "<li><a href='$w[link_sub]'><span>&#187; $w[nama_sub]</span></a></li>";
	                }           
	                echo "</ul></div>
                        </li>";
                }
                else{
                  echo "</li>";
                }
              }        
            ?>
		      </ul>
			  
	       </div>	<!-- /menu -->		
<!--  end top -->
			<!-- CONTENT -->
      <?php
          include "$f[folder]/kiri.php";      
      ?>
<div id="atasgariscoklat"></div> 
 <div id="gariscoklat"></div>
 	<!--<div class="marquee">
		<p><a href="http://www.hongkiat.com/blog/wordpress-related-posts-without-plugins/">How to add WordPress Related Posts Without Plugins</a></p>
		<p><a href="http://www.hongkiat.com/blog/automate-dropbox-files-with-actions/">Automate Your Dropbox Files With Actions</a></p>
	</div> -->
			<!-- SIDEBAR KANAN -->
			<div id="sidebarkanan">			
			<!-- untuk searching -->
			<div id="headers">
			<br /><br /><br /><br /><br />
			<div class="tgl">
			<form method="POST" id="searchform" action="hasil-pencarian.html"> <!-- form pencarian -->
					<div id="searching">
					   <div id="searching-border">
					   <input class="searchField" type="text" name="kata" maxlength="50" value="Pencarian..." onblur="if(this.value=='') this.value='Pencarian...';" onfocus="if(this.value=='Pencarian...') this.value='';" />
					   <input class="searchSubmit" type="submit" value="" />
					   </div>
					</div>
				</form>			
			</div>
			<!-- Social Network-->
					
					
					<div class="tips">
						<ul id="listsidebar-socialnetwork">
						<?php
						     //Tampilkan icon social network
								// Tentukan kolom
								$col = 4;
								$scnetwork = mysql_query("SELECT * FROM socialnetwork ORDER BY id_socialnetwork ASC LIMIT 4");
								//  echo "<img src='$f[folder]/images/potretbanyumas.png' />";
								echo "<div><div id='socialnetwork'><table cellpadding=5px cellspacing=10px;>";              
								$cnt = 0;
								while ($s = mysql_fetch_array($scnetwork)) {
								if ($cnt >= $col) {
								echo "<tr>";
								$cnt = 0;
								}
								$cnt++;
							echo "<td align=center valign=top>
									<a href=$s[url] title='$s[nama]' target='_blank'><img src='img_socialnetwork/$s[gambar]' border='0px' width='34' height='34'/></a>
								  </td> ";
								}
							echo "</tr></table></div></div>"; 
						?>
						</ul>
					</div> <!-- end social Network-->	
					
					<!-- <h2>Yahoo Messanger</h2>	-->
					<div>
						<ul id="listsidebar-socialnetwork">					
					<?php						
						echo "<table><div id='statusyahoo'><center>";
						$daftar_idyahoo="sk8terdinz,dumber.ndumber"; 
						$proses=explode(",",$daftar_idyahoo);
						reset($proses);
						foreach ($proses as $tujuan) {
						echo ("
							$tujuan<br>
								<a href=\"http://messenger.yahoo.com/edit/send/?.target=$tujuan\">
								<img border=0 src=\"http://opi.yahoo.com/online?u=$tujuan&m=g&t=2&l=us\"></a><br />");
								}
								echo"</center></div></table>";
					?>
					</ul>
					</div>
			</div>
			<!-- end searching-->
			<div id="space"></div>
					<?php echo"<div><h2><img src='$f[folder]/images/photoalbum.png' /></h2></div>"; ?>					
                    <div class="tips">                  
                    <?php
						// Galeri Foto (tampilkan 8 foto secara horizontal dan random)
              // Tentukan kolom
              $col = 2;
              $g = mysql_query("SELECT * FROM gallery ORDER BY rand() DESC LIMIT 8");              
              echo "<div class='tipsatas'><table><tr>";              
              $cnt = 0;
              while ($w = mysql_fetch_array($g)) {
                if ($cnt >= $col) {
                echo "</tr><tr>";
                $cnt = 0;
                }
                $cnt++;
                echo "<td align=center valign=top>
                      <a id='galeri' href='img_galeri/$w[gbr_gallery]' title='$w[keterangan]'>
                      <img alt='$w[keterangan]' src='img_galeri/kecil_$w[gbr_gallery]' width='90px' height='80px' /></a><br />
                      <a id='galeri' href='img_galeri/$w[gbr_gallery]' title='$w[keterangan]'><b>$w[jdl_gallery]</b></a></td>";
              }
              echo "</tr></table></div>";
                    ?>
                   
                    </div>	
					

					<!--<?php echo"<div><h2><img src='$f[folder]/images/cuacabanyumas.png' /></h2></div>"; ?>	
                    <div class="tips">
                    <ul id="listsidebar-cuaca">
                    <?php
						$cuaca=mysql_query("SELECT * FROM cuacabanyumas WHERE aktif='Y' ORDER BY id_cuaca DESC LIMIT 1");
						while($c=mysql_fetch_array($cuaca)){
						echo "<div id='cuaca'><li><center>
						<span class='text-cuaca'><strong>$c[cuaca]</strong></span><br/>						
						<img src='img_cuaca/$c[gambar]' width='100'  /><br/>						
						<span class='text-cuaca'>$c[derajat]</span>
						</center></li></div>";
						}
									
				    //  $banner=mysql_query("SELECT * FROM smartphone ORDER BY id_smartphone asc LIMIT 2");
					//	while($d=mysql_fetch_array($banner)){
					//	echo "<li class='news-text2'><a href='downlot.php?file=$d[nama_file]' title='Sudah didownload $d[hits] kali'>
					//	<img src='foto_banner/$b[icon]' border='0'>$d[judul]</a></li>";
					//	} 
                    ?>
                    </ul>
                    </div>	-->		
											  
					<!--<?php echo"<div><h2><img src='$f[folder]/images/agenda.png' /></h2></div>"; ?>
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
                  </ul>-->
				<!--	<?php echo"<div><h2><img src='$f[folder]/images/pendidikan.png' /></h2></div>"; ?>
                <div class="tips">
                  <ul id="listsidebar">
                  <?php
				  echo "<ul>";
   $main=mysql_query("SELECT * FROM kategori WHERE aktif='Y' order by id_kategori limit 4,1"); // Kategori Pendidikan
   while($r=mysql_fetch_array($main)){
     echo "<li><div>                
              </div>
              <div>                
                <tbody><div class='tips'>
             <ul>";
          $sub=mysql_query("SELECT * FROM kategori, berita  
                            WHERE kategori.id_kategori=berita.id_kategori 
                            AND berita.id_kategori=$r[id_kategori] order by id_berita desc limit 0,7"); //menentukan jumlah yg ditampilkan sebanyak 7
          $sub2=mysql_query("SELECT * FROM kategori, berita  
                            WHERE kategori.id_kategori=berita.id_kategori 
                            AND berita.id_kategori=$r[id_kategori] order by id_berita desc limit 1");
          $t=mysql_fetch_array($sub2);
                if ($t['gambar']!=''){
			    //echo "<span class=image><img src='foto_berita/small_$t[gambar]' width=110 border=0></span>";
		            }
                //Tampilkan hanya sebagian isi berita
                $isi_berita = htmlentities(strip_tags($t['isi_berita'])); // membuat paragraf pada isi berita dan mengabaikan tag html
                $isi = substr($isi_berita,0,120); // ambil sebanyak 120 karakter
                $isi = substr($isi_berita,0,strrpos($isi," ")); // potong per spasi kalimat
                $judul = substr($t['judul'],0,30); // ambil sebanyak 35 karakter
                $judul = substr($t['judul'],0,strrpos($judul," ")); // potong per spasi kalimat
              // echo "<li class='garisbawah'><span class=judulnya><a href='berita-$t[id_berita]-$t[judul_seo].html' title=\"$t[judul]\">$judul ...</a></span><br />
              // <span class=tanggal>$t[hari], $tgl</span><br /><br /> 
              // $isi ... <a href='berita-$t[id_berita]-$t[judul_seo].html' title=\"Klik untuk melihat detail beritanya\">Selengkapnya</a> 
              // </li>";                       	        
          while($w=mysql_fetch_array($sub)){
                $judul = substr($w['judul'],0,30); // ambil sebanyak 45 karakter
                $judul = substr($w['judul'],0,strrpos($judul," ")); // potong per spasi kalimat
              echo "<li class='news-text2'><a href='berita-$w[id_berita]-$w[judul_seo].html' title=\"$w[judul]\">$judul ...</a></li>";
	         }
	       echo "</ul></div>
                </tbody>                
              </div>
            </li>";
  }        
echo "</ul> "; 
				 
                  ?>
                  </ul>
                </div>				
					<?php echo"<div><h2><img src='$f[folder]/images/bankdata.png' /></h2></div>"; ?>
                <div class="tips">
                  <ul id="listsidebar">
                  <?php
                    $download=mysql_query("SELECT * FROM download ORDER BY id_download DESC LIMIT 5");                  
                    while($d=mysql_fetch_array($download)){
                      echo "<li class='news-text2'><a href='downlot.php?file=$d[nama_file]' title='Sudah didownload $d[hits] kali'>$d[judul]</a></li>";
                    }
                  ?>
                  </ul>
                </div>-->
			<!--<?php echo"<div><h2><img src='$f[folder]/images/polling.png' /></h2></div>"; ?> -->
            <!--<ul id="poling">
              <?php
                $tanya=mysql_query("SELECT * FROM poling WHERE aktif='Y' and status='Pertanyaan'");
                $t=mysql_fetch_array($tanya);

                echo "<br /><span class='news-title'> $t[pilihan]</span><br /><br />";
                echo "<form method=POST action='hasil-poling.html'>";

                $poling=mysql_query("SELECT * FROM poling WHERE aktif='Y' and status='Jawaban'");
                while ($p=mysql_fetch_array($poling)){
                  echo "<span class='news-text'> &nbsp;&nbsp;<input type=radio name=pilihan value='$p[id_poling]' />&nbsp; $p[pilihan]</span><br />";
                }
                echo "<p align=center><input type=submit value=vote /></p>
                      </form>
                      <a href=lihat-poling.html><span><center>Lihat Hasil Poling</center></span></a>";
              ?>
			   
            </ul> -->
                      
                    
			</div> <!-- / end sidebar -->
			<div> 
				<?php
					// Tampilkan Footer
					$footer=mysql_query("SELECT * FROM footer ORDER BY id_footer DESC LIMIT 3");
					while($b=mysql_fetch_array($footer)){
					echo "<span><center>
                    <img src='foto_banner/$b[gambar]' border='0' border='0' width='300px' ></center></span>";
					}
				?>
			</div>
					<center>Copyright &copy; 2012 by IPLT - PPLP. All rights reserved.</center> 
			
			<!-- FOOTER -->			
			<div id="footer">
				<div class="foot_l"></div>
				<div class="foot_content">
					
				</div>
				<div class="foot_r"></div>
			</div><!-- / end footer -->
		</div><!-- / end wrapper -->
	</div><!-- / end container -->
</body>
</html>
