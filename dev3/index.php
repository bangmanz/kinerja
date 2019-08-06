<?php
	session_start();
	include "../function/db.php";
	include "../function/func.php";
	if(!isset($_SESSION['username'])){echo "<script> location.replace('../index2.php?page=login'); </script>";}
?>
<!DOCTYPE html>
<html lang="en">
  <head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <!-- Meta, title, CSS, favicons, etc. -->
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
	<link rel="icon" href="../images/bps.png" type="image/ico" />
    <title>CKP Online - BPS Provinsi Lampung</title>
	

    <!-- Bootstrap -->
    <link href="vendors/bootstrap/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- Font Awesome -->
    <link href="vendors/font-awesome/css/font-awesome.min.css" rel="stylesheet">
    <!-- NProgress -->
    <link href="vendors/nprogress/nprogress.css" rel="stylesheet">
    <!-- iCheck -->
    <link href="vendors/iCheck/skins/flat/green.css" rel="stylesheet">
	
    <!-- bootstrap-progressbar -->
    <link href="vendors/bootstrap-progressbar/css/bootstrap-progressbar-3.3.4.min.css" rel="stylesheet">
    <!-- JQVMap -->
    <link href="vendors/jqvmap/dist/jqvmap.min.css" rel="stylesheet"/>
    <!-- bootstrap-daterangepicker -->
    <link href="vendors/bootstrap-daterangepicker/daterangepicker.css" rel="stylesheet">

    <!-- Custom Theme Style -->
    <link href="build/css/custom.min.css" rel="stylesheet">

    <link href="../css/style.css" rel="stylesheet">
	<style type="text/css" media="all">
    /* fix rtl for demo */
    .chosen-rtl .chosen-drop { left: -9000px; }
	</style>
    <script src="../js/jquery.min.js"></script>
    <script src="../js/scripts.js"></script>
		<?php
		if(isset($_GET['alert'])){
			if($_GET['alert']=="1"){
				echo "<script> function myFunction() {alert('Password Sudah Diganti');};</script>";
			}else{
				echo "<script>function myFunction() {alert('Maaf, ada kesalahan password, silahkan diulangi');};</script>";					
			}
		}
	?>
  </head>
  <?php if(isset($_GET['page'])){if($_GET['page']=='pertanggal'){echo "<body class='nav-sm'>";}else{echo "<body class='nav-md'>";}}?>
    <div class="container body">
      <div class="main_container">
        <div class="col-md-3 left_col menu_fixed">
          <div class="left_col scroll-view">
            <div class="navbar nav_title" style="border: 0;">
              <a href="?page=home" class="site_title"><i class="fa fa-home"></i> <span>BPS <?php if(isset($_SESSION['wilker'])){echo $_SESSION['wilker'];}?></span></a>
            </div>

            <div class="clearfix"></div>

			
            <!-- menu profile quick info -->
            <div class="profile clearfix">
              <div class="profile_pic">
                <img src="<?php 
				$file="../images/avatar/".substr($_SESSION['id'],4,5).".JPG";				
				if(file_exists($file)){
					echo "../images/avatar/".substr($_SESSION['id'],4,5).".JPG";
				}else{					
					echo "../images/avatar/".substr($_SESSION['id'],4,5)."(1).jpg";					
				}
			?>" alt="..." class="img-circle profile_img">
              </div>
              <div class="profile_info">
                <span>Welcome,</span>
                <h2><?=$_SESSION['nama']; ?></h2>				
              </div>
            </div>
            <!-- /menu profile quick info -->

            <br />

            <!-- sidebar menu -->
            <div id="sidebar-menu" class="main_menu_side hidden-print main_menu">
              <div class="menu_section">
                <h3>CKP</h3>
                <ul class="nav side-menu">
                  <li><a href="?page=home"><i class="fa fa-home"></i> HOME </a>
                    
                  </li>
                  <li><a><i class="fa fa-edit"></i> MASTER <span class="fa fa-chevron-down"></span></a>
                    <ul class="nav child_menu">
						<li><a href="?page=masterpekerjaan">Master Pekerjaan</a></li>
						<li><a href="?page=usulanmasterpekerjaan">Master Pekerjaan - Usulan</a></li>
						<?php if($_SESSION['level_user']<=3){ ?>
							<li><a href="?page=masterpegawai">Master Pegawai</a></li>
							<li><a href="?page=masteruser">Master User</a></li>							
						<?php } ?>
                    </ul>
                  </li>
                  <li><a><i class="fa fa-desktop"></i> ENTRY <span class="fa fa-chevron-down"></span></a>
                    <ul class="nav child_menu">
						<li><a href="?page=daftarpenugasan">Entry Daftar Penugasan</a></li>
						<li><a href="?page=entrylaporanpekerjaan">Entry Laporan Pekerjaan</a></li>
					  <?php if($_SESSION['level_user']<6){ ?>
						<li><a href="?page=entrypenilaianckp">Entry Penilaian</a></li>
					  <?php } ?>
                    </ul>
                  </li>
				  <li><a><i class="fa fa-desktop"></i> REPORT & VIEW <span class="fa fa-chevron-down"></span></a>
                    <ul class="nav child_menu">
						<li><a href="?page=rekappenilaianckp">Report Rekap Entry Laporan Pekerjaan</a></li>
						<li><a href="?page=cetak">Cetak CKP Bulanan</a></li>
                    </ul>
                  </li>
                </ul>
              </div>
              <div class="menu_section">
                <h3>MATRIKS KEGIATAN PEGAWAI</h3>
                <ul class="nav side-menu">
                  <li><a><i class="fa fa-table"></i> MATRIKS DINAS LUAR <span class="fa fa-chevron-down"></span></a>
                    <ul class="nav child_menu">
						<li><a href="?page=pertanggal">Entry Matriks Dinas Luar</a></li>
						<li><a href="?page=masterkodedl">Master Kode Dinas Luar</a></li>
                    </ul>
                  </li>                
                </ul>
              </div>

            </div>
            <!-- /sidebar menu -->

            <!-- /menu footer buttons -->
            <div class="sidebar-footer hidden-small">
              <a data-toggle="tooltip" data-placement="top" title="Settings">
                <span class="glyphicon glyphicon-cog" aria-hidden="true"></span>
              </a>
              <a data-toggle="tooltip" data-placement="top" title="FullScreen">
                <span class="glyphicon glyphicon-fullscreen" aria-hidden="true"></span>
              </a>
              <a data-toggle="tooltip" data-placement="top" title="Lock">
                <span class="glyphicon glyphicon-eye-close" aria-hidden="true"></span>
              </a>
              <a data-toggle="tooltip" data-placement="top" title="Logout" href="../function/login/logout.php">
                <span class="glyphicon glyphicon-off" aria-hidden="true"></span>
              </a>
            </div>
            <!-- /menu footer buttons -->
          </div>
        </div>

        <!-- top navigation -->
        <div class="top_nav">
          <div class="nav_menu">
            <nav>
              <div class="nav toggle">
                <a id="menu_toggle"><i class="fa fa-bars"></i></a>
              </div>
              <ul class="nav navbar-nav navbar-right">
                <li class="">
                  <a href="javascript:;" class="user-profile dropdown-toggle" data-toggle="dropdown" aria-expanded="false">
                    <?=$_SESSION['nama'] ." (".$_SESSION['jabatan']." - ".level($_SESSION['level_user']).")";?>
					<?php
						$not=0;
						if($_SESSION['level_user']<=4 && $_SESSION['level_wilayah']==2){
							$ss="select * from masterkegiatan where approved=0 and kode_seksi='".$_SESSION['bidang']."'";
							if ($result = $mysqli->query($ss)){
								if($result->num_rows>0){
									echo " <img src='../images/new.gif'>";
									$not=1;
								}
							}
						}else{
							$ss="select * from notifikasi where id_pegawai='".$_SESSION['id']."' and baca=0";
							if ($result = $mysqli->query($ss)){
								if($result->num_rows>0){
									echo " <img src='../images/new.gif'>";
									$not=2;
								}
							}
						}
					 ?>
                    <span class=" fa fa-angle-down"></span>
                  </a>
                  <ul class="dropdown-menu dropdown-usermenu pull-right">
                    <li>
						<a href="../function/login/logout.php">Logout</a>
					</li>
					<?php
					    if(isset($_GET['page'])){
					        if($_GET['page']=='home'){
					            echo "	<li><a id='open_modal1' href='#'>Ganti Password</a></li>";
					        }
					    }
					
					
					?>
				
					<?php
						if($not==1 &&  $_SESSION['level_wilayah']==2 ){
							echo "<li><a href='?page=usulanmasterpekerjaan'>Usulan Master Pekerjaan Baru<img src='../images/new.gif'></a></li>";
						}else if($not==2){
							echo "<li><a href='?page=notif'>Pemberitahuan Baru<img src='../images/new.gif'></a></li>";
						}
					?>
                  </ul>
                </li>
				
               <!--area notif -->
			    <li role="presentation" class="dropdown">
				  <a href="javascript:;" class="dropdown-toggle info-number" data-toggle="dropdown" aria-expanded="false">
					<i class="fa fa-envelope-o"></i>
					<span class="badge bg-green"></span>
				  </a>
				</li>
              </ul>
            </nav>
          </div>
        </div>
        <!-- /top navigation -->

        <!-- page content -->
        <div class="right_col" role="main">
			<?php 
				if(isset($_SESSION['username'])){
					if(isset($_GET['page'])){
						if(file_exists("../page/".$_GET['page'].".php")){
							require "../page/".$_GET['page'].".php";
						}else{
							echo "<script> location.replace('?page=home'); </script>";
						}
					}else{
						echo "<script> location.replace('?page=home'); </script>";
					}
				}else{
					echo "<script> location.replace('../?page=login'); </script>";
				}
				//include "mod_top_tiles.php";
				//include "mod_network.php";    
				//include "mod_app.php"; 
				//include "mod_recent.php";
			?>    
			  
        </div>
        <!-- /page content -->

        <!-- footer content -->
        <footer>
          <div class="pull-right">
            Gentelella - Bootstrap Admin Template by <a href="https://colorlib.com">Colorlib</a>
          </div>
          <div class="clearfix"></div>
        </footer>
        <!-- /footer content -->
      </div>
    </div>

    <script src="vendors/bootstrap/dist/js/bootstrap.min.js"></script>
    <script src="build/js/custom.min.js"></script>
	
  </body>
</html>
<script	type="text/javascript">$(document).ready(function	()	{
		$(".open_modal1").click(function(e)	{
			var	id		=	$(this).attr("id");
			$.ajax({
				url:	"../ganti.php",
				type:	"GET",
				data	:	{id: id},
				success:	function	(ajaxData){
					$("#ModalEdit").html(ajaxData);
					$("#ModalEdit").modal('show',{backdrop:	'true'});
				}
			});
		});
	});	
</script>