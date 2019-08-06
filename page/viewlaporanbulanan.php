<!--	Javascript	untuk	popup	modal	Edit-->	
<script	type="text/javascript">$(document).ready(function	()	{
		$(".open_modal").click(function(e)	{
			var	m	=	$(this).attr("id");
			$.ajax({
				url:	"page/add_laporanbulanan.php",
				type:	"GET",
				data	:	{modal_id:	m,},
				success:	function	(ajaxData){
					$("#ModalEdit").html(ajaxData);
					$("#ModalEdit").modal('show',{backdrop:	'true'});
				}
			});
		});
	});	
</script>		
<link rel="stylesheet" href="css/tstyle.css" />
<script type="text/javascript" src="js/tinybox.js"></script>
<h2>
	View Laporan Pekerjaan Bulanan<br>
</h2>

<?php

	if(isset($_POST['bln'])){
			$_SESSION['entrylaporanbulanan'] = $_POST['bln'];
	}
	if(isset($_POST['id'])){
			$_SESSION['idlaporanbulanan'] = $_POST['id'];
	}
	

	$sql="SELECT * FROM `pegawai` where id='".$_SESSION['id']."'";
	if ($result = $mysqli->query($sql)) { 
		while($obj = $result->fetch_object()){
?> 			
<form action="?page=viewlaporanbulanan" method="post">
<table class="table table-unbordered table-condensed">
	<thead>
	</thead>
	<tbody>
		<tr>
			<td>Nama </td>
			<?php				
				echo "<td><div class='col-md-4'>";
			 	echo "<select id='id' name='id' class='form-control' required>";
			 	echo "<option></option>";
			 	$sql="SELECT * FROM `pegawai` order by nama";
				if ($result = $mysqli->query($sql)) { 
					while($obj = $result->fetch_object()){			
						if($_SESSION['idlaporanbulanan']==$obj->id){
							echo "<option selected value='".$obj->id."'>".$obj->nama."</option>";
						}else{
							echo "<option value='".$obj->id."'>".$obj->nama."</option>";
			 			}
			 		}
			 	}
			 	echo "</select></div></td>";
			 	
			 ?>
		</tr>		
		<tr>
			<td>Bulan </td>
			<td>
				<div class="col-md-4">
					<select id="bln" name="bln" class="form-control" required>
						<option></option>
						<option value="01" <?php if(isset($_SESSION['entrylaporanbulanan'])){if($_SESSION['entrylaporanbulanan']=="01"){echo "selected";}}?>>Januari</option>
						<option value="02" <?php if(isset($_SESSION['entrylaporanbulanan'])){if($_SESSION['entrylaporanbulanan']=="02"){echo "selected";}}?>>Februari</option>
						<option value="03" <?php if(isset($_SESSION['entrylaporanbulanan'])){if($_SESSION['entrylaporanbulanan']=="03"){echo "selected";}}?>>Maret</option>
						<option value="04" <?php if(isset($_SESSION['entrylaporanbulanan'])){if($_SESSION['entrylaporanbulanan']=="04"){echo "selected";}}?>>April</option>
						<option value="05" <?php if(isset($_SESSION['entrylaporanbulanan'])){if($_SESSION['entrylaporanbulanan']=="05"){echo "selected";}}?>>Mei</option>
						<option value="06" <?php if(isset($_SESSION['entrylaporanbulanan'])){if($_SESSION['entrylaporanbulanan']=="06"){echo "selected";}}?>>Juni</option>
						<option value="07" <?php if(isset($_SESSION['entrylaporanbulanan'])){if($_SESSION['entrylaporanbulanan']=="07"){echo "selected";}}?>>Juli</option>
						<option value="08" <?php if(isset($_SESSION['entrylaporanbulanan'])){if($_SESSION['entrylaporanbulanan']=="08"){echo "selected";}}?>>Agustus</option>
						<option value="09" <?php if(isset($_SESSION['entrylaporanbulanan'])){if($_SESSION['entrylaporanbulanan']=="09"){echo "selected";}}?>>September</option>
						<option value="10" <?php if(isset($_SESSION['entrylaporanbulanan'])){if($_SESSION['entrylaporanbulanan']=="10"){echo "selected";}}?>>Oktober</option>
						<option value="11" <?php if(isset($_SESSION['entrylaporanbulanan'])){if($_SESSION['entrylaporanbulanan']=="11"){echo "selected";}}?>>November</option>
						<option value="12" <?php if(isset($_SESSION['entrylaporanbulanan'])){if($_SESSION['entrylaporanbulanan']=="12"){echo "selected";}}?>>Desember</option>
					</select>
				</div>
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
<?php }} ?>

<div	id="ModalEdit"	class="modal	fade"	tabindex="-1"	role="dialog"	aria-labelledby="myModalLabel"	aria-hidden="true"></div>

<?php 
	if(isset($_POST['submit'])){ 
?>

<table class="table table-bordered table-condensed">
	<thead>
		<tr>
			<th><div align='center'>
				Tanggal
			</div></th>
			<th><div align='center'>
				Seksi
			</div></th>
			<th><div align='center'>
				Kegiatan
			</div></th>
			<th><div align='center'>
				Keterangan
			</div></th>
			<th><div align='center'>
				Kuantitas
			</div></th>
			<th><div align='center'>
				Kualitas (%)
			</div></th>
			<th><div align='center'>
				Waktu
			</div></th>
		</tr>
	</thead>
	<tbody>
	<?php
		
		//echo $querry;
		$aa=0;
		$namabulan=bulan($_SESSION['entrylaporanbulanan']);
		for($i=1;$i<=jmlhari($_SESSION['entrylaporanbulanan']);$i++){

			$querry = "select lp.id_laporan, lp.keterangan as ket, mk.uraian, lp.kode_seksi, lp.kuantitas, lp.sat_kuantitas, lp.kualitas, lp.waktu, lp.sat_waktu from laporanpekerjaan lp, pegawai p, masterkegiatan mk where lp.id_pegawai=p.id and lp.id_keg=mk.id_keg and lp.id_pegawai='".$_POST['id']."' and bulan='".$_SESSION['entrylaporanbulanan']."' and lp.tanggal='".substr("0".$i,-2)."'";
			//echo $querry;

			$index = 0;
			$seksi=array();
			$dinasluar=array();
			$ket=array();
			$uraian=array();
			if($result=$mysqli->query($querry)){
				$rowsp = mysqli_num_rows($result);
				while($obj=$result->fetch_object()){
					$id_laporan[$index]=$obj->id_laporan;
					$seksi[$index]=$obj->kode_seksi;
					$uraian[$index]=$obj->uraian;
					$ket[$index]=$obj->ket;
					$kualitas[$index]=$obj->kualitas;
					$sat_kuantitas[$index]=$obj->sat_kuantitas;
					$kuantitas[$index]=$obj->kuantitas;
					$waktu[$index]=$obj->waktu;
					$sat_waktu[$index]=$obj->sat_waktu;
					$index++;
				}
			}

			$timestamp = strtotime("2017-".$_SESSION['entrylaporanbulanan']."-".$i);
			$day = date('w', $timestamp);
			$check="";

			if(sizeof($seksi)==0){
				if($day==0 || $day==6){
					echo "<tr bgcolor='ffb3b3'>";
				}else{
					echo "<tr>";
				}
				echo "<td >".substr("0".$i,-2)."_".$namabulan."</td> ";
				echo "<td></td><td></td><td></td><td></td><td></td><td></td>	";				



				echo "</tr>";
			}else if(sizeof($seksi)==1){
				if($day==0 || $day==6){
					echo "<tr bgcolor='ffb3b3'>";
				}else{
					echo "<tr>";
				}
				echo "<td >".substr("0".$i,-2)."_".$namabulan."</td> ";
				echo "<td>".namaseksi($seksi[0])."</td><td>".$uraian[0]."</td><td>".$ket[0]."</td><td>".$kuantitas[0]."_".satuan($sat_kuantitas[0])."</td><td><div align='center'>".$kualitas[0]."</div></td><td>".$waktu[0]." ".waktu($sat_waktu[0])."</td>	";				

				echo "</tr>";
			}else{
				if($day==0 || $day==6){
					echo "<tr bgcolor='ffb3b3'>";
				}else{
					echo "<tr>";
				}
				echo "<td rowspan='".sizeof($seksi)."' >".substr("0".$i,-2)."_".$namabulan."</td> ";
				echo "<td>".namaseksi($seksi[0])."</td><td>".$uraian[0]."</td><td>".$ket[0]."</td><td>".$kuantitas[0]."_".satuan($sat_kuantitas[0])."</td><td><div align='center'>".$kualitas[0]."</div></td><td>".$waktu[0]." ".waktu($sat_waktu[0])."</td>	";				

				echo "</tr>";
				for($aa=1;$aa<sizeof($seksi);$aa++){
					if($day==0 || $day==6){
						echo "<tr bgcolor='ffb3b3'>";
					}else{
						echo "<tr>";
					}
					echo "<td>".namaseksi($seksi[$aa])."</td><td>".$uraian[$aa]."</td><td>".$ket[$aa]."</td><td>".$kuantitas[$aa]."_".satuan($sat_kuantitas[$aa])."</td><td><div align='center'>".$kualitas[$aa]."</div></td><td>".$waktu[$aa]." ".waktu($sat_waktu[$aa])."</td>	";				

					echo "</tr>";
				}
			}

		}
	?>
	</tbody>
</table>
<?php 
} 		
?>
