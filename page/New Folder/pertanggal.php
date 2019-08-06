<link rel="stylesheet" href="css/tstyle.css" />
<script type="text/javascript" src="js/tinybox.js"></script>
<script	type="text/javascript">$(document).ready(function	()	{
		$(".open_modal").click(function(e)	{
			var	id		=	$(this).attr("id");
			var	nama	=	$(this).attr("nama");
			var	tgl		=	$(this).attr("tgl");
			var	bln		=	$(this).attr("bln");
			var	thn		=	$(this).attr("thn");
			var	kode	=	$(this).attr("kode");
			$.ajax({
				url:	"post2.php",
				type:	"GET",
				data	:	{id: id, nama: nama, tgl: tgl, bln: bln, thn: thn,kode: kode},
				success:	function	(ajaxData){
					$("#ModalEdit").html(ajaxData);
					$("#ModalEdit").modal('show',{backdrop:	'true'});
				}
			});
		});
	});	
</script>
<h2>
	Matriks Dinas Luar Pegawai Tahun 2018
</h2>
	<?php
		if(isset($_POST['bln'])){
			$_SESSION['bln'] = $_POST['bln'];
		}
		if(isset($_POST['kab'])){
			$_SESSION['kab'] = $_POST['kab'];
		}
	?>
<div	id="ModalEdit"	class="modal	fade"	tabindex="-1"	role="dialog"	aria-labelledby="myModalLabel"	aria-hidden="true"></div>
<div class="col-md-6">
  <form action="" method="post">
  <table class="table table-unbordered table-condensed">
	<thead>
	</thead>
	<tbody>
		<?php 
			if($_SESSION['level_wilayah']==2 && $_SESSION['eselon']<=4){
		?>
		<tr>
			<td>Kabupaten/Kota </td>
			<td>
				<div class="col-md-12">
					<select id="kab" name="kab" class="form-control">
						<?php
							$kab = "select * from m_wilayah order by kode_wilayah, sub_kode_wilayah";
							if($kab2 = $mysqli->query($kab)){
								while($kab3 = $kab2->fetch_object()){
									if(($kab3->kode_wilayah.$kab3->sub_kode_wilayah)==$_SESSION['kab']){
										echo "<option value='".$kab3->kode_wilayah.$kab3->sub_kode_wilayah."' selected>".$kab3->nama_wilayah."</option>";
									}else{
										echo "<option value='".$kab3->kode_wilayah.$kab3->sub_kode_wilayah."'>".$kab3->nama_wilayah."</option>";
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
				<div class="col-md-12">
					<select id="bln" name="bln" class="form-control">
						<option value="01" <?php if(isset($_SESSION['bln'])){if($_SESSION['bln']=="01"){echo "selected";}}?>>Januari</option>
						<option value="02" <?php if(isset($_SESSION['bln'])){if($_SESSION['bln']=="02"){echo "selected";}}?>>Februari</option>
						<option value="03" <?php if(isset($_SESSION['bln'])){if($_SESSION['bln']=="03"){echo "selected";}}?>>Maret</option>
						<option value="04" <?php if(isset($_SESSION['bln'])){if($_SESSION['bln']=="04"){echo "selected";}}?>>April</option>
						<option value="05" <?php if(isset($_SESSION['bln'])){if($_SESSION['bln']=="05"){echo "selected";}}?>>Mei</option>
						<option value="06" <?php if(isset($_SESSION['bln'])){if($_SESSION['bln']=="06"){echo "selected";}}?>>Juni</option>
						<option value="07" <?php if(isset($_SESSION['bln'])){if($_SESSION['bln']=="07"){echo "selected";}}?>>Juli</option>
						<option value="08" <?php if(isset($_SESSION['bln'])){if($_SESSION['bln']=="08"){echo "selected";}}?>>Agustus</option>
						<option value="09" <?php if(isset($_SESSION['bln'])){if($_SESSION['bln']=="09"){echo "selected";}}?>>September</option>
						<option value="10" <?php if(isset($_SESSION['bln'])){if($_SESSION['bln']=="10"){echo "selected";}}?>>Oktober</option>
						<option value="11" <?php if(isset($_SESSION['bln'])){if($_SESSION['bln']=="11"){echo "selected";}}?>>November</option>
						<option value="12" <?php if(isset($_SESSION['bln'])){if($_SESSION['bln']=="12"){echo "selected";}}?>>Desember</option>
					</select>
				</div>
			</td>
		</tr>
		<tr>
			<td></td>
			<td>
				<div align="right" class="col-md-12">
					<input type="submit" value="Submit">
				</div>
			</td>			
		</tr>
	</tbody>
  </table>
  </form>
</div>
<br>

<?php
	if(isset($_SESSION['bln'])){
?>

<table class="table table-bordered table-condensed">
	<thead>
		<tr>
			<th> 
				No <br>  -
			</th>
			<!--<th>
				ID <br>  -
			</th>-->
			<th>
				Nama<br><font size='1'>(Klik nama untuk detail)</font>
			</th>

			<?php
				echo "<th><font size='1'>Wilker</font></th>";
				echo "<th><font size='1'>Seksi/<br>Bidang</font></th>";
				for($a=1;$a<=jmlhari($_SESSION['bln']);$a++){
					echo "<th>".substr("0".$a,-2)."</th>";
				}				
			?>
		</tr>
	</thead>
	<tbody>
	<?php
		$timestamp = strtotime(TAHUN."-".$_SESSION['bln']."-1");
		$days = date('w', $timestamp);

		if(isset($_POST['kab'])){
			if($_SESSION['eselon']==4){
				if(substr($_POST['kab'],0,4)==1800){
					if(substr($_POST['kab'],4,1)==0){
						$sql="select * from pegawai p, jabatan j, jabatan_pegawai jp where p.id=jp.id_pegawai and eselon<=3 and j.id_jabatan=jp.id_jabatan  order by wilker, eselon, bidang";
					}else{
						$sql="select * from pegawai p, jabatan j, jabatan_pegawai jp where p.id=jp.id_pegawai and jp.wilker=".substr($_POST['kab'],0,4)." and j.id_jabatan=jp.id_jabatan and bidang='".substr($_POST['kab'],4,1)."' order by eselon, bidang, nama";
					}
				}else{
					$sql="select * from pegawai p, jabatan j, jabatan_pegawai jp where p.id=jp.id_pegawai and jp.wilker=".substr($_POST['kab'],0,4)." and j.id_jabatan=jp.id_jabatan  and bidang='".$_SESSION['bidang']."' order by eselon, bidang, nama";
				}
			}else{
				if(substr($_POST['kab'],0,4)==1800){
					if(substr($_POST['kab'],4,1)==0){
						$sql="select * from pegawai p, jabatan j, jabatan_pegawai jp where p.id=jp.id_pegawai and eselon<=3 and j.id_jabatan=jp.id_jabatan  order by wilker, eselon, bidang";
					}else{
						$sql="select * from pegawai p, jabatan j, jabatan_pegawai jp where p.id=jp.id_pegawai and jp.wilker=".substr($_POST['kab'],0,4)." and j.id_jabatan=jp.id_jabatan and bidang='".substr($_POST['kab'],4,1)."' order by eselon, bidang, nama";
					}
				}else{
					$sql="select * from pegawai p, jabatan j, jabatan_pegawai jp where p.id=jp.id_pegawai and jp.wilker=".substr($_POST['kab'],0,4)." and j.id_jabatan=jp.id_jabatan order by eselon, bidang, nama";
				}
			}			
		}else{
			if($_SESSION['level_user']>=5 && $_SESSION['level_wilayah']==3){
				$sql="select * from pegawai p, jabatan j, jabatan_pegawai jp where p.id=jp.id_pegawai and j.id_jabatan=jp.id_jabatan and jp.wilker=".$_SESSION['wilker']." order by eselon, bidang, nama";
			}else if($_SESSION['level_user']>=6 && $_SESSION['level_wilayah']==2){
				$sql="select * from pegawai p, jabatan j, jabatan_pegawai jp where p.id=jp.id_pegawai and j.id_jabatan=jp.id_jabatan and jp.wilker=".$_SESSION['wilker']." and bidang='".$_SESSION['bidang']."' order by eselon, bidang, nama";
			}
		}
		echo $sql;
		$i=1;
		if ($result = $mysqli->query($sql)) { 
			while($obj = $result->fetch_object()){ 							
				echo "
					<tr>
						<td>
							".$i."
						</td>
						
						<td>
							<a href='?page=detaildl&id=".$obj->id."' target='_blank'>".$obj->nama."</a>
						</td>

						";
				echo "<td><div align='center'>".$obj->wilker."</div></td>";			
				echo "<td><div align='center'>".$obj->bidang."</div></td>";				
				$sql2 = "select * from harian where tahun='".TAHUN."' and bulan='".$_SESSION['bln']."' and id='".$obj->id."'";
				if($result2=$mysqli->query($sql2)){
					while($obj2=$result2->fetch_object()){
						$day=$days;
						for($a=1;$a<=jmlhari($_SESSION['bln']);$a++){
							$b="t".substr("0".$a,-2);	
							$c=substr("0".$a,-2);	
							if($day==0 || $day==6){
								if($obj2->$b!='' || $obj2->$b!=NULL){
									if(substr($obj2->$b,0,1) == '1'){
										echo "<td bgcolor='#F6277F' ";
									} else if(substr($obj2->$b,0,1) == '2'){
										echo "<td bgcolor='#3366ff' ";
									} else if(substr($obj2->$b,0,1) == '3'){
										echo "<td bgcolor='#2eff00' ";
									} else if(substr($obj2->$b,0,1) == '4'){
										echo "<td bgcolor='#ff6e00' ";
									} else if(substr($obj2->$b,0,1) == '5'){
										echo "<td bgcolor='#ff0000' ";
									} else if(substr($obj2->$b,0,1) == '6'){
										echo "<td bgcolor='#ffff00' ";
									}
								}else{
									echo "<td bgcolor='#ffb3b3' ";
								}
							} else if(substr($obj2->$b,0,1) == '1'){
								echo "<td bgcolor='#F6277F' ";
							} else if(substr($obj2->$b,0,1) == '2'){
								echo "<td bgcolor='#3366ff' ";
							} else if(substr($obj2->$b,0,1) == '3'){
								echo "<td bgcolor='#2eff00' ";
							} else if(substr($obj2->$b,0,1) == '4'){
								echo "<td bgcolor='#ff6e00' ";
							} else if(substr($obj2->$b,0,1) == '5'){
								echo "<td bgcolor='#ff0000' ";
							} else if(substr($obj2->$b,0,1) == '6'){
								echo "<td bgcolor='#ffff00' ";
							} else{ 
								echo "<td ";
							}						
							echo " id='".$obj2->id."' thn='".TAHUN."' bln='".$_SESSION['bln']."' tgl='".substr("0".$a,-2)."' nama='".$obj->nama."' kode='".$obj2->$b."' class='open_modal' href='#'><div  style='font-size:8px'>";
							if($obj2->$b!=''){
								echo substr($obj2->$b,2);
							}
							echo "</div></td>";
							$day++;
							if($day==7){$day=0;}
						}
					}
				}
				echo "</tr>";
				$i++; 
			} 
		}?>
	</tbody>
</table>

<?php } ?>
<div class="row">
		<div class="col-md-12">
			<table>
			<!--	<tr><td>*) Keterangan </td><td style="background:#ff6e00;" width="50px"></td><td>Dinas Luar</td></tr>
				<tr><td></td><td align="center" style="background:#2eff00;" width="50px"></td><td>Bukan Dinas Luar</td></tr>-->
				<tr><td>Keterangan</td><td align="center" style="background:#F6277F;" width="50px">T</td><td>Tata Usaha</td></tr>
				<tr><td></td><td align="center" style="background:#3366ff;" width="50px">S</td><td>Sosial</td></tr>
				<tr><td></td><td align="center" style="background:#2eff00;" width="50px">P</td><td>Produksi</td></tr>
				<tr><td></td><td align="center" style="background:#ff6e00;" width="50px">D</td><td>Distribusi</td></tr>
				<tr><td></td><td align="center" style="background:#ff0000;" width="50px">N</td><td>Neraca Wilayah</td></tr>
				<tr><td></td><td align="center" style="background:#ffff00;" width="50px">I</td><td>IPDS</td></tr>
			</table>
		</div>
	</div>
<br><br>
