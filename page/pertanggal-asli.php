<link rel="stylesheet" href="css/tstyle.css" />
<script type="text/javascript" src="js/tinybox.js"></script>

<h2>
	Matriks Dinas Luar Pegawai Tahun 2017
</h2>
<div class="col-md-4">
  <label class="col-md-4 control-label" for="selectbasic">Bulan</label>
  <form action="" method="post">
  <div class="col-md-4">
	<?php
		if(isset($_POST['bln'])){
			$_SESSION['bln'] = $_POST['bln'];
		}
	?>
	<select id="bln" name="bln" class="form-control">
		<!--<option value="01" <?php if(isset($_SESSION['bln'])){if($_SESSION['bln']=="01"){echo "selected";}}?>>Januari</option>
		<option value="02" <?php if(isset($_SESSION['bln'])){if($_SESSION['bln']=="02"){echo "selected";}}?>>Februari</option>
		<option value="03" <?php if(isset($_SESSION['bln'])){if($_SESSION['bln']=="03"){echo "selected";}}?>>Maret</option>
		<option value="04" <?php if(isset($_SESSION['bln'])){if($_SESSION['bln']=="04"){echo "selected";}}?>>April</option>
		<option value="05" <?php if(isset($_SESSION['bln'])){if($_SESSION['bln']=="05"){echo "selected";}}?>>Mei</option>
		<option value="06" <?php if(isset($_SESSION['bln'])){if($_SESSION['bln']=="06"){echo "selected";}}?>>Juni</option>
		<option value="07" <?php if(isset($_SESSION['bln'])){if($_SESSION['bln']=="07"){echo "selected";}}?>>Juli</option>-->
		<option value="08" <?php if(isset($_SESSION['bln'])){if($_SESSION['bln']=="08"){echo "selected";}}?>>Agustus</option>
		<option value="09" <?php if(isset($_SESSION['bln'])){if($_SESSION['bln']=="09"){echo "selected";}}?>>September</option>
		<option value="10" <?php if(isset($_SESSION['bln'])){if($_SESSION['bln']=="10"){echo "selected";}}?>>Oktober</option>
		<option value="11" <?php if(isset($_SESSION['bln'])){if($_SESSION['bln']=="11"){echo "selected";}}?>>November</option>
		<option value="12" <?php if(isset($_SESSION['bln'])){if($_SESSION['bln']=="12"){echo "selected";}}?>>Desember</option>
	</select>
	 </div>
	<div class="col-md-4">
	<input type="submit" value="Submit">
  </div>
  </form>
</div>
<br>
<br>
<?php
	if(isset($_SESSION['bln'])){
?>

<table class="table table-bordered table-condensed">
	<thead>
		<tr>
			<th>
				No
			</th>
			<th>
				ID
			</th>
			<th>
				Nama
			</th>
			<th>
				Kode<br>Seksi
			</th>
			<?php
				for($a=1;$a<=jmlhari($_SESSION['bln']);$a++){
					if(strlen($a)==1){
						echo "<th>0".$a."</th>";
					}else{
						echo "<th>".$a."</th>";
					}
				}
				
			?>
		</tr>
	</thead>
	<tbody>
	<?php
		$sql="SELECT * FROM `pegawai` order by eselon, kode_seksi, nama";
		$i=1;
		if ($result = $mysqli->query($sql)) { 
			while($obj = $result->fetch_object()){ 							
			echo "
				<tr>
					<td>
						".$i."
					</td>
					<td>
						".$obj->id."
					</td>
					<td>
						".$obj->nama."
					</td>
					<td><div align='center'>
						".$obj->kode_seksi."
					</div></td>";
			$sql2 = "select * from harian where tahun='2017' and bulan='".$_SESSION['bln']."' and id='".$obj->id."'";
			if($result2=$mysqli->query($sql2)){
				while($obj2=$result2->fetch_object()){
					for($a=1;$a<=jmlhari($_SESSION['bln']);$a++){
						$b="t".substr("0".$a,-2);	
						$c=substr("0".$a,-2);	
						$timestamp = strtotime("2017-".$_SESSION['bln']."-".$a);
						$day = date('w', $timestamp);
						if($day==0 || $day==6){
							if($obj2->$b!='' || $obj2->$b!=NULL){
								echo "<td bgcolor='#ff6e00' ";
							}else{
								echo "<td bgcolor='#ffb3b3' ";
							}
						} else if(strpos($obj2->$b, '+') !== false){
							echo "<td bgcolor='#ff6e00' ";
						} else if($obj2->$b!='' || $obj2->$b != NULL){
							echo "<td bgcolor='#2eff00' ";
						} else{ 
							echo "<td ";
						}
						echo 'onclick="TINY.box.show({';
						echo "url:'post2.php',post:'id=".$obj->id."&tahun=2017&bulan=".$_SESSION['bln']."&tanggal=".$c."&nama=".$obj->nama."',width:500,height:400,opacity:20,topsplit:3})";
						echo '">';
						//echo $obj2[$a+2];
						//echo date("l", mktime(0,0,0, $_SESSION['bln'], $b,"2017"));
						if($obj2->$b!=''){
							echo str_replace('+', '', $obj2->$b);
//							echo $obj2[$a+2];
						}
						echo "</td>";
					}
				}
			}
			echo "</tr>";
			$i++; 
		 } }?>
	</tbody>
</table>

<?php } ?>

<table>
<!--	<tr><td>*) Keterangan </td><td style="background:#ff6e00;" width="50px"></td><td>Dinas Luar</td></tr>
	<tr><td></td><td align="center" style="background:#2eff00;" width="50px"></td><td>Bukan Dinas Luar</td></tr>-->
	<tr><td>Keterangan</td><td align="center" style="background:#d5d5d5;" width="50px">T</td><td>Tata Usaha</td></tr>
	<tr><td></td><td align="center" style="background:#3366ff;" width="50px">S</td><td>Sosial</td></tr>
	<tr><td></td><td align="center" style="background:#2eff00;" width="50px">P</td><td>Produksi</td></tr>
	<tr><td></td><td align="center" style="background:#ff6e00;" width="50px">D</td><td>Distribusi</td></tr>
	<tr><td></td><td align="center" style="background:#b32400;" width="50px">N</td><td>Neraca Wilayah</td></tr>
	<tr><td></td><td align="center" style="background:#ffff00;" width="50px">I</td><td>IPDS</td></tr>
</table>
<br><br>
