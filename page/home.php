<div	id="ModalEditganti"	class="modal	fade"	tabindex="-1"	role="dialog"	aria-labelledby="myModalLabel"	aria-hidden="true"></div>
<script	type="text/javascript">
	$(document).ready(function	()	{
		$("#open_modal1").click(function(e)	{
			$.ajax({
				url:	"../ganti.php",
				type:	"GET",
				success:	function	(ajaxData){
					$("#ModalEditganti").html(ajaxData);
					$("#ModalEditganti").modal('show',{backdrop:	'true'});
				}
			});
		});
	});	
</script>
	<?php
		if(isset($_GET['alert'])){
			if($_GET['alert']=="1"){
				echo "<script> alert('Password Sudah Diganti');</script>";
			}else{
				echo "<script> alert('Maaf, ada kesalahan password, silahkan diulangi');</script>";					
			}
		}
	?>

<?php include "mod_top_tiles.php"; ?>

<div class="row">
	<div class="col-md-4 col-sm-6 col-xs-12">
	  <div class="x_panel">
		<div class="x_title">
		  <h2>Ulang Tahun Bulan Ini <small></small></h2>
		  <ul class="nav navbar-right panel_toolbox">
			<li><a class="collapse-link"><i class="fa fa-chevron-up"></i></a>
			</li>
			<li class="dropdown">
			  <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false"><i class="fa fa-wrench"></i></a>
			  <ul class="dropdown-menu" role="menu">
				<li><a href="#">Settings 1</a>
				</li>
				<li><a href="#">Settings 2</a>
				</li>
			  </ul>
			</li>
			<li><a class="close-link"><i class="fa fa-close"></i></a>
			</li>
		  </ul>
		  <div class="clearfix"></div>
		</div>
		<div class="x_content">

		  <div class="">
			<ul class="to_do">
			<?php
				$sql="select nama, nip, substring(nip,7,2) as tgl, substring(nip,5,2) as bln from pegawai where substring(nip,5,2)=".date('m')." order by bln,tgl";
				if ($result = $mysqli->query($sql)) { 
					while($obj = $result->fetch_object()){			
						if($obj->tgl==date('d')){
							echo "<li><p><i class='fa fa-user'></i> <small>(".$obj->tgl."-".date('m').")</small> ".$obj->nama." <i class='fa fa-birthday-cake'></i></p></li>";
						}else{
							echo "<li><p><i class='fa fa-user'></i> <small>(".$obj->tgl."-".date('m').")</small> ".$obj->nama."</p></li>";
						}
					}
				}
			?>
			</ul>
		  </div>
		</div>
	  </div>
	</div>

  <div class="col-md-8 col-sm-6 col-xs-6">
	<div class="x_panel">
	  <div class="x_title">
		<h2>Jumlah Pegawai BPS Lampung <small></small></h2>
		<ul class="nav navbar-right panel_toolbox">
		  <li><a class="collapse-link"><i class="fa fa-chevron-up"></i></a>
		  </li>
		  <li class="dropdown">
			<a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false"><i class="fa fa-wrench"></i></a>
			<ul class="dropdown-menu" role="menu">
			  <li><a href="#">Settings 1</a>
			  </li>
			  <li><a href="#">Settings 2</a>
			  </li>
			</ul>
		  </li>
		  <li><a class="close-link"><i class="fa fa-close"></i></a>
		  </li>
		</ul>
		<div class="clearfix"></div>
	  </div>
	  <div class="x_content">
		<iframe src="mod_chart.php" width="100%" frameborder="0" height="380"></iframe>
	  </div>
	</div>
 
	<div class="x_panel">
	  <div class="x_title">
		<h2>Pegawai BPS Lampung Menurut Usia<small></small></h2>
		<ul class="nav navbar-right panel_toolbox">
		  <li><a class="collapse-link"><i class="fa fa-chevron-up"></i></a>
		  </li>
		  <li class="dropdown">
			<a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false"><i class="fa fa-wrench"></i></a>
			<ul class="dropdown-menu" role="menu">
			  <li><a href="#">Settings 1</a>
			  </li>
			  <li><a href="#">Settings 2</a>
			  </li>
			</ul>
		  </li>
		  <li><a class="close-link"><i class="fa fa-close"></i></a>
		  </li>
		</ul>
		<div class="clearfix"></div>
	  </div>
	  <div class="x_content">
		<iframe src="mod_chart_umur.php" width="100%" frameborder="0" height="380"></iframe>
	  </div>
	</div>
  </div>
<!-- </div>
 
 <div class="row"> -->
 
  <!-- Start to do list -->

	<!-- End to do list -->
</div>

