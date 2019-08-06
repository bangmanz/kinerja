<?php 

	if(isset($_POST['bln'])){
			$_SESSION['viewlaporanbulanan'] = $_POST['bln'];
	}
	if(isset($_POST['id'])){
			$_SESSION['viewidlaporanbulanan'] = $_POST['id'];
	}
?>
<h2>
	Daftar Penugasan Pegawai<br>
</h2>
<br>
<form action="" method="post">		
<table class="table table-unbordered table-condensed">
	<thead>
	</thead>
	<tbody>
		<?php				
				if($_SESSION['level']=6){ ?>
		<tr>
			<td>Nama </td>
			<?php				
				//if($_SESSION['level']>2){		
					$_SESSION['id_new'] = $_SESSION['id'];
					$sql="SELECT * FROM `pegawai` where id='".$_SESSION['id']."'";
					if ($result = $mysqli->query($sql)) { 
						while($obj = $result->fetch_object()){			
						echo "<td><div class='col-md-4'>".$obj->nama."</div></td>";
			 			}
			 		} 
			 	/*}else{
			 		echo "<td><div class='col-md-4'>";
			 		echo "<select id='id' name='id' class='form-control' required>";
			 		echo "<option></option>";
			 		$sql="SELECT * FROM `pegawai` order by nama";
					if ($result = $mysqli->query($sql)) { 
						while($obj = $result->fetch_object()){			
							if($_SESSION['id_new']==$obj->id){
								echo "<option selected value='".$obj->id."'>".$obj->nama."</option>";
							}else{
								echo "<option value='".$obj->id."'>".$obj->nama."</option>";
			 				}
			 			}
			 		}
			 		echo "</select></div></td>";
			 	}*/
			 ?>
		</tr>
		<?php } else{?>
		
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
		<?php } ?>
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
<?php
	if(isset($_POST['submit']) || (isset($_SESSION['viewidlaporanbulanan']) && isset ($_SESSION['viewlaporanbulanan']))){
?>
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
		</tr>
	</thead>
	<tbody>
	<?php
		
		//$sql2="SELECT * FROM `penugasan` a, masterkegiatan m where a.id_keg=m.id_keg and id_pegawai='".$_SESSION['viewidlaporanbulanan']."' and bulan='".$_SESSION['viewlaporanbulanan']."' order by uraian";
		$sql2="SELECT * FROM `penugasan` a, masterkegiatan m where a.id_keg=m.id_keg and id_pegawai='".$_SESSION['id']."' and bulan='".$_SESSION['viewlaporanbulanan']."' order by uraian";
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

