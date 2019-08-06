<?php 

	if(isset($_POST['bln'])){
			$_SESSION['viewlaporanbulanan'] = $_POST['bln'];
	}
	if(isset($_POST['id'])){
			$_SESSION['viewidlaporanbulanan'] = $_POST['id'];
	}

	if(isset($_GET['action'])){
		if($_GET['action']=='hapus'){
			$sql = "delete from penugasan where id_penugasan=".$_GET['id'];
			//echo $sql;
			if($a = $mysqli->query($sql)){
				header("location:?page=daftarpenugasan");
			}
		}
	}


	if(isset($_POST['tambah'])){
		$que = "insert into penugasan values('',2017,'".$_SESSION['viewlaporanbulanan']."','".$_SESSION['viewidlaporanbulanan']."',".$_POST['seksi'].",".$_POST['tugas'].",".$_POST['target'].",".$_POST['satuan'].",".$_POST['waktu'].",".$_POST['satuanwaktu'].",'".$_SESSION['id']."')";
		//echo $que;
		if($insert = $mysqli->query($que)){
			header("location:".$_SERVER["REQUEST_URI"]);
		}else{
			echo "gagal entry";
		}
	}
?>
<!-- isi -->
<script>
	jQuery(document).ready(function() {
	var doc = $(document);
		doc.delegate('#tugas', 'change', function(e){
	        var source = $(this),
	            val = $.trim(source.val()),
	            target = source.attr('target');
			$(target).empty();
	        if(typeof(_stateData[val]) != "undefined"){
	            var options = (typeof(_stateData[val]) != "undefined") ? _stateData[val] : {};
	            $.each( options , function(value, index) {
	                    $('<option value="' + value + '">' + index + '</option>').appendTo(target);
	            });
	        }
	        var source = $(this),
	            val = $.trim(source.val()),
	            target = source.attr('target2');
			$(target).empty();
	        if(typeof(_stateData2[val]) != "undefined"){
	            var options = (typeof(_stateData2[val]) != "undefined") ? _stateData2[val] : {};
	            $.each( options , function(value, index) {
	                    $('<option value="' + value + '">' + index + '</option>').appendTo(target);
	            });
	        };
	    });
    });
</script>
<h2>
	Entry Daftar Penugasan<br>
</h2>
<br>
<form action="" method="post">		
<table class="table table-unbordered table-condensed">
	<thead>
	</thead>
	<tbody>
		<tr>
			<td>Nama </td>
			<td>
				<div class="col-md-4">
					<select id="id" name="id" class="form-control" required="required">
						<option></option>						
						<!--<option value="0">Semua Pegawai</option>		-->			
						<?php

							if($_SESSION['level_user']==5){
								$sql="select * from pegawai p, jabatan j, jabatan_pegawai jp where p.id=jp.id_pegawai and j.id_jabatan=jp.id_jabatan and jp.wilker=".$_SESSION['wilker']." and eselon>=".$_SESSION['eselon']." order by nama";
							}else if($_SESSION['level_user']==4){
								$sql="select * from pegawai p, jabatan j, jabatan_pegawai jp where p.id=jp.id_pegawai and j.id_jabatan=jp.id_jabatan and jp.wilker=".$_SESSION['wilker']." and eselon>=".$_SESSION['eselon']." order by wilker, nama";
							}
							
							if ($result = $mysqli->query($sql)) { 
								while($obj = $result->fetch_object()){
									if(isset($_SESSION['viewidlaporanbulanan'])){
										if($_SESSION['viewidlaporanbulanan']==$obj->id){
											echo "<option selected value=".$obj->id.">".$obj->wilker." - ".$obj->nama."</option>";
										}else{
											echo "<option value=".$obj->id.">".$obj->wilker." - ".$obj->nama."</option>";
										}
									}else{
										echo "<option value=".$obj->id.">".$obj->wilker." - ".$obj->nama."</option>";								
									}
								}
							}
						?> 	
					</select>
				</div>
			</td>
		</tr>		
		<tr>
			<td>Bulan </td>
			<td>
				<div class="col-md-4">
					<select id="bln" name="bln" class="form-control" required="required">
						<option></option>
						<option value="01" <?php if(isset($_SESSION['viewlaporanbulanan'])){if($_SESSION['viewlaporanbulanan']=="01"){echo "selected";}}?>>Januari</option>
						<option value="02" <?php if(isset($_SESSION['viewlaporanbulanan'])){if($_SESSION['viewlaporanbulanan']=="02"){echo "selected";}}?>>Februari</option>
						<option value="03" <?php if(isset($_SESSION['viewlaporanbulanan'])){if($_SESSION['viewlaporanbulanan']=="03"){echo "selected";}}?>>Maret</option>
						<option value="04" <?php if(isset($_SESSION['viewlaporanbulanan'])){if($_SESSION['viewlaporanbulanan']=="04"){echo "selected";}}?>>April</option>
						<option value="05" <?php if(isset($_SESSION['viewlaporanbulanan'])){if($_SESSION['viewlaporanbulanan']=="05"){echo "selected";}}?>>Mei</option>
						<option value="06" <?php if(isset($_SESSION['viewlaporanbulanan'])){if($_SESSION['viewlaporanbulanan']=="06"){echo "selected";}}?>>Juni</option>
						<option value="07" <?php if(isset($_SESSION['viewlaporanbulanan'])){if($_SESSION['viewlaporanbulanan']=="07"){echo "selected";}}?>>Juli</option>
						<option value="08" <?php if(isset($_SESSION['viewlaporanbulanan'])){if($_SESSION['viewlaporanbulanan']=="08"){echo "selected";}}?>>Agustus</option>
						<option value="09" <?php if(isset($_SESSION['viewlaporanbulanan'])){if($_SESSION['viewlaporanbulanan']=="09"){echo "selected";}}?>>September</option>
						<option value="10" <?php if(isset($_SESSION['viewlaporanbulanan'])){if($_SESSION['viewlaporanbulanan']=="10"){echo "selected";}}?>>Oktober</option>
						<option value="11" <?php if(isset($_SESSION['viewlaporanbulanan'])){if($_SESSION['viewlaporanbulanan']=="11"){echo "selected";}}?>>November</option>
						<option value="12" <?php if(isset($_SESSION['viewlaporanbulanan'])){if($_SESSION['viewlaporanbulanan']=="12"){echo "selected";}}?>>Desember</option>
					</select>
				</div>
				<input type="hidden" name="page" value="daftarpenugasan"></input>
				<div class="col-md-2">
					<button type="submit" name="submit">Submit</button>
				</div>
			
			</td>
		</tr>
		<tr>
			<td></td>
			<td></td>
		</tr>
	</tbody>
</table>
</form>
<script type="text/javascript">
<?php
	echo "var _stateData = {};
        var _stateData ={";
    $querytugas = "select * from masterkegiatan m, satuan s, satwaktu w where m.id_satuan=s.id_satuan and m.id_satuan_waktu=w.id_satuan_waktu and approved=1 and level=4 and kode_seksi=".$_SESSION['bidang']." order by uraian";		

	if($hasil=$mysqli->query($querytugas)){
		while($hasil2 = $hasil->fetch_object()){
			echo '"'.$hasil2->id_keg.'":{"'.$hasil2->id_satuan.'":"'.$hasil2->satuan.'"},';
		}							
	}
	echo "};";	
	echo "var _stateData2 = {};
        var _stateData2 ={";
    $querytugas = "select * from masterkegiatan m, satuan s, satwaktu w where m.id_satuan=s.id_satuan and m.id_satuan_waktu=w.id_satuan_waktu and approved=1 and level=4 and kode_seksi=".$_SESSION['bidang']." order by uraian";		

	if($hasil=$mysqli->query($querytugas)){
		while($hasil2 = $hasil->fetch_object()){
			echo '"'.$hasil2->id_keg.'":{"'.$hasil2->id_satuan_waktu.'":"'.$hasil2->waktu.'"},';
		}							
	}
	echo "};";
?>
</script>
<?php
	if(isset($_POST['submit']) || (isset($_SESSION['viewidlaporanbulanan']) && isset ($_SESSION['viewlaporanbulanan']))){
		if($_SESSION['level_user']>=2 && $_SESSION['level_user']<=5){
?>
<table	id="mytable2"	class="table	table-unbordered">
	<tr  data-toggle="collapse" data-target=".demo1">
		<td colspan="6">
		<div align="right">
			<button class="btn btn-primary">Tambah Penugasan</button>
		</div>
		</td>
	</tr>
		<tr>
            <td class="hiddenRow" colspan="6">
                <div class="collapse demo1">
                	<table	id="mytable3" class="table table-bordered">
                		<tr>
                			<td>
                				<form class="form-horizontal" role="form" action="<?php echo $_SERVER["REQUEST_URI"]; ?>" method="post">
									<div class="form-group">
										<label for="inputEmail3" class="col-sm-2 control-label">
											Kode Seksi
										</label>
										<div class="col-sm-10">
											<select id='seksi' name='seksi' class='form-control' required>
												<?php
													if($_SESSION['level_user']==1){
													}else if($_SESSION['level_user']==4 || $_SESSION['level_user']==5){
														if($_SESSION['bidang']==1){
															echo "<option value='1'>Tata Usaha</option>";
														}else if($_SESSION['bidang']==2){
															echo "<option value='2'>Sosial</option>";
														}else if($_SESSION['bidang']==3){
															echo "<option value='3'>Produksi</option>";
														}else if($_SESSION['bidang']==4){
															echo "<option value='4'>Distribusi</option>";
														}else if($_SESSION['bidang']==5){
															echo "<option value='5'>Neraca</option>";
														}else if($_SESSION['bidang']==6){
															echo "<option value='6'>IPDS</option>";
														}
													}
												?>
											</select>
										</div>
									</div>

									<div class="form-group">
										<label for="inputEmail3" class="col-sm-2 control-label">
											Nama Pekerjaan
										</label>
										<div class="col-sm-10">
											<select id='tugas' name='tugas' target ='#satuan' target2='#satuanwaktu' class='form-control chosen-select' required>
												<option></option>
												<?php
													if($_SESSION['level_user']==4 || $_SESSION['level_user']==5){
														$querytugas = "select * from masterkegiatan where level=4 and approved=1 and kode_seksi=".$_SESSION['bidang']." order by uraian";			
														if($hasil=$mysqli->query($querytugas)){
															while($hasil2 = $hasil->fetch_object()){
																echo "<option value='".$hasil2->id_keg."'>".$hasil2->uraian."</option>";
															}							
														}			
													}
													
												?>
											</select>
										</div>
									</div>

									<div class="form-group">
										<label for="inputEmail3" class="col-sm-2 control-label">
											Target
										</label>
										<div class="col-sm-5">											
											<input id='target' required name='target' type='number' class='form-control input-md' placeholder="isi dengan angka....">
										</div>
										<div class="col-sm-5">											
											<select id='satuan' name='satuan' class='form-control' required>
												<option></option>												
											</select>
										</div>
									</div>

									<div class="form-group">
										<label for="inputEmail3" class="col-sm-2 control-label">
											Waktu
										</label>
										<div class="col-sm-5">											
											<input id='waktu' required name='waktu' type='number' class='form-control input-md' placeholder="isi dengan angka....">
										</div>
										<div class="col-sm-5">											
											<select id='satuanwaktu' name='satuanwaktu' class='form-control' required>
												<option></option>
											</select>
										</div>
									</div>


									<div class="form-group">
										<div class="col-sm-offset-2 col-sm-10">											 
											<button id="tambah" type="sumbit" name="tambah" class="btn btn-primary"><image src="images/icon-plus.png"> TAMBAH</button>
										</div>
									</div>

								</form>
                			</td>
                		</tr>
                	</table>
                </div>
            </td>
        </tr>
	</table>
<?php } ?>
<table class="table table-bordered table-condensed">
	<thead>
		<tr  style="background: #cccccc;">
			<th><div align='center'>
				No
			</div></th>
			<th><div align='center'>
				Bidang/Seksi
			</div></th>
			<th><div align='center'>
				Tugas
			</div></th>
			<th><div align='center'>
				Target
			</div></th>
			<th><div align='center'>
				Satuan
			</div></th>
			<th><div align='center'>
				Angka Kredit
			</div></th>
			<th><div align='center'>
				Insert By
			</div></th>
			<th><div align='center'>
				Edit
			</div></th>
			<th><div align='center'>
				Delete
			</div></th>
		</tr>
	</thead>
	<tbody>
	<?php

		$sql2="SELECT * FROM `penugasan` a, masterkegiatan m where a.id_keg=m.id_keg and id_pegawai='".$_SESSION['viewidlaporanbulanan']."' and bulan='".$_SESSION['viewlaporanbulanan']."' order by uraian";
		$no = 1;
		if ($result2 = $mysqli->query($sql2)) { 
			while($obj2 = $result2->fetch_object()){	
				echo "
					<tr>
						<td><div align='center'>".$no."</div></td>
						<td>".namaseksi($obj2->kode_seksi)."</td>
						<td>".$obj2->uraian."</td>
						<td align='left'>".$obj2->target." ".satuan($obj2->satuan)."</td>
						<td align='left'>".$obj2->targetwaktu." ".waktu($obj2->satuanwaktu)."</td>
						<td>".$obj2->target*$obj2->angkred."</td>
						<td>".$obj2->penugasan_by."</td>
						";
						
					if(($_SESSION['level_user']==4 || $_SESSION['level_user']==5) && $_SESSION['id']==$obj2->penugasan_by){
						if($obj2->kode_seksi==$_SESSION['bidang']){
							echo "
								<td><a href=''><div align='center'><img src='images/edit.png'></div></a></td>
								<td><a href='?page=daftarpenugasan&action=hapus&id=".$obj2->id_penugasan."' onclick='return confirm(\"Are you sure you want to delete this item?\");'><div align='center'><img src='images/del.png'></div></a></td>";
						}else{
							echo "<td></td><td></td>";
						}
					}else {
						echo "<td></td><td></td>";
					}
				
				echo "</tr>";
				
				$no++;
			}
		}
		
	?>
		
	</tbody>
</table>



<?php } ?>

<link rel="stylesheet" href="css/chosen.css">
<script src="js/jquery.min.js" type="text/javascript"></script>
<script src="js/chosen.jquery.js" type="text/javascript"></script>
<style type="text/css" media="all">
/* fix rtl for demo */
.chosen-rtl .chosen-drop { left: -9000px; }
</style>
<script type="text/javascript">
	 $(".chosen-select").chosen({width: "100%"}); 
	var config = {
	  '.chosen-select'           : {}
	}
	for (var selector in config) {
	  $(selector).chosen(config[selector]);
	}
</script>
