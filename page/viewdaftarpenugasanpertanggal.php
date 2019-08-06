<link rel="stylesheet" href="css/tstyle.css" />
<script type="text/javascript" src="js/tinybox.js"></script>
<h2>
	View Daftar Kegiatan Harian Pegawai<br>
</h2>

<?php
	if(isset($_POST['bln'])){
			$_SESSION['viewpngsnpertgl'] = $_POST['bln'];
	}
	if(isset($_POST['id'])){
			$_SESSION['viewidlaporanbulanan'] = $_POST['id'];
	}

?> 			
<form action="?page=viewdaftarpenugasanpertanggal" method="post">
<table class="table table-unbordered table-condensed">
	<thead>
	</thead>
	<tbody>
		<tr>
			<td>Nama </td>
			<?php				
				if($_SESSION['level']>2){		
					$_SESSION['viewidlaporanbulanan'] = $_SESSION['id'];
					$sql="SELECT * FROM `pegawai` where id='".$_SESSION['id']."'";
					if ($result = $mysqli->query($sql)) { 
						while($obj = $result->fetch_object()){			
						echo "<td><div class='col-md-4'>".$obj->nama."</div></td>";
			 			}
			 		} 
			 	}else{
			 		echo "<td><div class='col-md-4'>";
			 		echo "<select id='id' name='id' class='form-control' required>";
			 		echo "<option></option>";
			 		$sql="SELECT * FROM `pegawai` order by nama";
					if ($result = $mysqli->query($sql)) { 
						while($obj = $result->fetch_object()){			
							if($_SESSION['viewidlaporanbulanan']==$obj->id){
								echo "<option selected value='".$obj->id."'>".$obj->nama."</option>";
							}else{
								echo "<option value='".$obj->id."'>".$obj->nama."</option>";
			 				}
			 			}
			 		}
			 		echo "</select></div></td>";
			 	}
			 ?>
		</tr>		
		<tr>
			<td>Bulan </td>
			<td>
				<div class="col-md-4">
					<select id="bln" name="bln" class="form-control" required>
						<option></option>
						<option value="01" <?php if(isset($_SESSION['viewpngsnpertgl'])){if($_SESSION['viewpngsnpertgl']=="01"){echo "selected";}}?>>Januari</option>
						<option value="02" <?php if(isset($_SESSION['viewpngsnpertgl'])){if($_SESSION['viewpngsnpertgl']=="02"){echo "selected";}}?>>Februari</option>
						<option value="03" <?php if(isset($_SESSION['viewpngsnpertgl'])){if($_SESSION['viewpngsnpertgl']=="03"){echo "selected";}}?>>Maret</option>
						<option value="04" <?php if(isset($_SESSION['viewpngsnpertgl'])){if($_SESSION['viewpngsnpertgl']=="04"){echo "selected";}}?>>April</option>
						<option value="05" <?php if(isset($_SESSION['viewpngsnpertgl'])){if($_SESSION['viewpngsnpertgl']=="05"){echo "selected";}}?>>Mei</option>
						<option value="06" <?php if(isset($_SESSION['viewpngsnpertgl'])){if($_SESSION['viewpngsnpertgl']=="06"){echo "selected";}}?>>Juni</option>
						<option value="07" <?php if(isset($_SESSION['viewpngsnpertgl'])){if($_SESSION['viewpngsnpertgl']=="07"){echo "selected";}}?>>Juli</option>
						<option value="08" <?php if(isset($_SESSION['viewpngsnpertgl'])){if($_SESSION['viewpngsnpertgl']=="08"){echo "selected";}}?>>Agustus</option>
						<option value="09" <?php if(isset($_SESSION['viewpngsnpertgl'])){if($_SESSION['viewpngsnpertgl']=="09"){echo "selected";}}?>>September</option>
						<option value="10" <?php if(isset($_SESSION['viewpngsnpertgl'])){if($_SESSION['viewpngsnpertgl']=="10"){echo "selected";}}?>>Oktober</option>
						<option value="11" <?php if(isset($_SESSION['viewpngsnpertgl'])){if($_SESSION['viewpngsnpertgl']=="11"){echo "selected";}}?>>November</option>
						<option value="12" <?php if(isset($_SESSION['viewpngsnpertgl'])){if($_SESSION['viewpngsnpertgl']=="12"){echo "selected";}}?>>Desember</option>
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
				Dinas Luar
			</div></th>
		</tr>
	</thead>
	<tbody>
	<?php	
		$namabulan=bulan($_SESSION['viewpngsnpertgl']);
		for($i=1;$i<=jmlhari($_SESSION['viewpngsnpertgl']);$i++){
			$querry = "select k.kode_seksi, k.uraian as ket, mk.uraian as uraian, k.dinasluar from kegiatanharian k, masterkegiatan mk where k.kode_keg=mk.id_keg and k.id='".$_SESSION['viewidlaporanbulanan']."' and bln='".$_SESSION['viewpngsnpertgl']."' and k.tanggal='".substr("0".$i,-2)."'";
			$index = 0;
			$seksi=array();
			$dinasluar=array();
			$ket=array();
			$uraian=array();
			if($result=$mysqli->query($querry)){
				$rowsp = mysqli_num_rows($result);
				while($obj=$result->fetch_object()){
					$seksi[$index]=$obj->kode_seksi;
					$uraian[$index]=$obj->uraian;
					$dinasluar[$index]=$obj->dinasluar;
					$ket[$index]=$obj->ket;
					$index++;
				}
			}


			$timestamp = strtotime("2017-".$_SESSION['viewpngsnpertgl']."-".$i);
			$day = date('w', $timestamp);
			$check="";
			if(sizeof($seksi)==0){
				if($day==0 || $day==6){
					echo "<tr bgcolor='ffb3b3'>";
				}else{
					echo "<tr>";
				}
				echo "<td >".substr("0".$i,-2)." ".$namabulan."</td> ";
				echo "<td></td><td></td><td></td><td></td>";
				echo "</tr>";
			}else if(sizeof($seksi)==1){
				if($day==0 || $day==6){
					echo "<tr bgcolor='ffb3b3'>";
				}else{
					echo "<tr>";
				}
				if($dinasluar[0]){$check="<img width='30' height='30' src='images/check.png'>";}
				echo "<td >".substr("0".$i,-2)." ".$namabulan."</td> ";
				echo "<td>".namaseksi($seksi[0])."</td><td>".$uraian[0]."</td><td>".$ket[0]."</td><td align='center'>$check</td>";
				echo "</tr>";
				$check="";
			}else{

				if($day==0 || $day==6){
					echo "<tr bgcolor='ffb3b3'>";
				}else{
					echo "<tr>";
				}
				if($dinasluar[0]){$check="<img width='30' height='30' src='images/check.png'>";}
				echo "<td rowspan='".sizeof($seksi)."' >".substr("0".$i,-2)." ".$namabulan."</td> ";
				echo "<td>".namaseksi($seksi[0])."</td><td>".$uraian[0]."</td><td>".$ket[0]."</td><td align='center'>$check</td>";
				echo "</tr>";
				$check="";
				for($a=1;$a<sizeof($seksi);$a++){
					if($day==0 || $day==6){
						echo "<tr bgcolor='ffb3b3'>";
					}else{
						echo "<tr>";
					}
					if($dinasluar[$a]){$check="<img width='30' height='30' src='images/check.png'>";}
					echo "<td>".namaseksi($seksi[$a])."</td><td>".$uraian[$a]."</td><td>".$ket[$a]."</td><td align='center'>$check</td>";
					echo "</tr>";
					$check="";
				}
			}
			unset($seksi);
			unset($uraian);
		}
	?>
	</tbody>
</table>
<?php 
} 		
?>