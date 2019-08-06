<?php
	session_start();
	include "function/db.php";
	include "function/func.php";
?>
<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <link rel="shortcut icon" type="image/x-icon" href="images/bps.png" />
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>CKP Online - BPS Provinsi Lampung</title>
    <meta name="description" content="Source code generated using layoutit.com">
    <meta name="author" content="LayoutIt!">
    <link href="css/bootstrap.min.css" rel="stylesheet">
    <link href="css/style.css" rel="stylesheet">
	<style type="text/css" media="all">
    /* fix rtl for demo */
    .chosen-rtl .chosen-drop { left: -9000px; }
	</style>
    <script src="js/jquery.min.js"></script>
    <script src="js/bootstrap.min.js"></script>
    <script src="js/scripts.js"></script>
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
  <body onload='myFunction()'>
    <div class="container-fluid">
		<div class="row">
			<div class="col-md-12">
				<nav class="navbar navbar-default" role="navigation">
					<div class="navbar-header">						 
						<button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1">
							<span class="sr-only">Toggle navigation</span><span class="icon-bar"></span>
							<span class="icon-bar"></span><span class="icon-bar"></span>
						</button> <a class="navbar-brand" href="?">BPS <?php if(isset($_SESSION['wilker'])){echo $_SESSION['wilker'];}?></a>
					</div>					
					<?php if(isset($_SESSION['nama'])){?>
					<div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
						<ul class="nav navbar-nav">
							<?php if($_SESSION['level_user']<6){ ?>
							<li class="dropdown">
								<a href="#" class="dropdown-toggle" data-toggle="dropdown">Master<strong class="caret"></strong></a>
								<ul class="dropdown-menu">
									<li>
										<a href="?page=masterpekerjaan">Master Pekerjaan</a>
									</li>
									<li>
										<a href="?page=usulanmasterpekerjaan">Master Pekerjaan - Usulan</a>
									</li>
									<?php if($_SESSION['level_user']<=3){ ?>
									<li>
										<a href="?page=masterpegawai">Master Pegawai</a>
									</li>
									<li>
										<a href="?page=masteruser">Master User</a>
									</li>
									<li>
										<a href="?page=masterkodedl">Master Kode Dinas Luar</a>
									</li>
									<?php } ?>
								</ul>
							</li>							
							<?php }else if($_SESSION['level_user']==6){?>
							<li class="dropdown">
								<a href="#" class="dropdown-toggle" data-toggle="dropdown">Master<strong class="caret"></strong></a>
								<ul class="dropdown-menu">
									<li>
										<a href="?page=masterpekerjaan">Master Pekerjaan</a>
									</li>
									<li>
										<a href="?page=masterkodedl">Master Kode Dinas Luar</a>
									</li>
								</ul>
							</li>							
							<?php } ?>
							
							<li class="dropdown">
								<a href="#" class="dropdown-toggle" data-toggle="dropdown">Entry<strong class="caret"></strong></a>
								<ul class="dropdown-menu">									
									<?php if($_SESSION['level_user']<=6){ ?>
									<li>
										<a href="?page=daftarpenugasan">Daftar Penugasan</a>
									</li>
									<li>
										<a href="?page=pertanggal">Matriks Dinas Luar</a>
									</li>
									<?php } ?>
									<li>
										<a href="?page=entrylaporanpekerjaan">Laporan Pekerjaan</a>
									</li>
									<?php if($_SESSION['level_user']==4 || $_SESSION['level_user']==5){ ?>
									<li>
										<a href="?page=entrypenilaianckp">Entry Penilaian CKP</a>
									</li>
									<?php } ?>						
								</ul>
							</li>		

							<li class="dropdown">
								 <a href="#" class="dropdown-toggle" data-toggle="dropdown">View<strong class="caret"></strong></a>
								<ul class="dropdown-menu">
									<li>
										<a href="?page=viewdaftarpenugasan">Daftar Penugasan</a>
									</li>
									<li>
										<a href="?page=pertanggal">Matriks Dinas Luar</a>
									</li>
									<li>
										<a href="?page=viewlaporanpekerjaan">Laporan Pekerjaan</a>
									</li>
									<li>
										<a href="?page=detaildlpk">Detail Dinas Luar - Laporan Pekerjaan</a>
									</li>
									<?php if($_SESSION['level_user']<6){ ?>
									<li>
										<a href="?page=viewpenilaianckp">Penilaian CKP</a>
									</li>
									<?php } ?>
								</ul>
							</li>
						</ul>
						<ul class="nav navbar-nav navbar-right">
							<li class="dropdown">
								 <a href="#" class="dropdown-toggle" data-toggle="dropdown"><?php echo $_SESSION['nama']." (".$_SESSION['jabatan']." - ".level($_SESSION['level_user']).")"; ?><strong class="caret">
								 <?php
								 	$not=0;
								 	if($_SESSION['level_user']<=4 && $_SESSION['level_wilayah']==2){
								 		$ss="select * from masterkegiatan where approved=0 and kode_seksi='".$_SESSION['bidang']."'";
								 		if ($result = $mysqli->query($ss)){
								 			if($result->num_rows>0){
								 				echo " <img src='images/new.gif'>";
								 				$not=1;
								 			}
								 		}
								 	}else{
								 		$ss="select * from notifikasi where id_pegawai='".$_SESSION['id']."' and baca=0";
								 		if ($result = $mysqli->query($ss)){
								 			if($result->num_rows>0){
								 				echo " <img src='images/new.gif'>";
								 				$not=2;
								 			}
								 		}
								 	}
								 ?>
								 </strong></a>
								<ul class="dropdown-menu">
									<li>
										<a href="function/login/logout.php">Logout</a>
									</li>
									<li>
										<a class='open_modal1' href='#'>Ganti Password</a>
									</li>
									<?php
										if($not==1 &&  $_SESSION['level_wilayah']==2 ){
											echo "<li><a href='?page=usulanmasterpekerjaan'>Usulan Master Pekerjaan Baru<img src='images/new.gif'></a></li>";
										}else if($not==2){
											echo "<li><a href='?page=notif'>Pemberitahuan Baru<img src='images/new.gif'></a></li>";
										}
									?>
								</ul>
							</li>
						</ul>
						<?php }?>
					</div>
					
				</nav>
				<div class="row">
					<div class="col-md-12">
						<?php
							if(isset($_SESSION['username'])){
								if(isset($_GET['page'])){
									if(file_exists("page/".$_GET['page'].".php")){
										require "page/".$_GET['page'].".php";
									}else{
										echo "<script> location.replace('?page=pertanggal'); </script>";
									}
								}else{
									echo "<script> location.replace('?page=pertanggal'); </script>";
								}
							}else{
								include "page/login.php";
							}
						?>
					</div>
				</div>
			</div>
		</div>
	</div>
  </body>
</html>
<script	type="text/javascript">$(document).ready(function	()	{
		$(".open_modal1").click(function(e)	{
			var	id		=	$(this).attr("id");
			$.ajax({
				url:	"ganti.php",
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