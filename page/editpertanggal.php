<?php
	if(isset($_POST['tambah_btn']) && ($_POST['id_keg']<>'')){
		//echo $_POST['dl'];
		if(isset($_POST['dl'])){
		$q = "insert into kegiatanharian values('','".$_GET['tahun']."','".$_GET['bln']."','".$_GET['tanggal']."','".$_GET['id']."','".$_POST['seksi']."','".$_POST['id_keg']."','".$_SESSION['eselon']."','".$_POST['uraian']."','".$_POST['dl']."','".$_SESSION['id']."')";
		}else{
			$q = "insert into kegiatanharian values('','".$_GET['tahun']."','".$_GET['bln']."','".$_GET['tanggal']."','".$_GET['id']."','".$_POST['seksi']."','".$_POST['id_keg']."','".$_SESSION['eselon']."','".$_POST['uraian']."','0','".$_SESSION['id']."')";
		}
		if($re = $mysqli->query($q)){
			//$qq="select * from kegiatanharian where tahun='".$_GET['tahun']."' and bln='".$_GET['bln']."' and tanggal='".$_GET['tanggal']."' and id='".$_GET['id']."' and dinasluar=1";
			if($_POST['seksi']==1){
				$hurufseksi="T";
			}else if($_POST['seksi']==2){
				$hurufseksi="S";
			}else if($_POST['seksi']==3){
				$hurufseksi="P";
			}else if($_POST['seksi']==4){
				$hurufseksi="D";
			}else if($_POST['seksi']==5){
				$hurufseksi="N";
			}else if($_POST['seksi']==6){
				$hurufseksi="I";
			}

			$qqq = "select * from harian where id='".$_GET['id']."' and tahun='".$_GET['tahun']."' and bulan='".$_GET['bln']."'";
			if($rqqq = $mysqli->query($qqq)){
				while($objqqq = $rqqq->fetch_object()){
					$as="t".$_GET['tanggal'];
					if(strpos($objqqq->$as, $hurufseksi) !== false){
						if($_POST['dl']==1){
							$updt="update `harian` set `".$as."`='+".($objqqq->$as)."' where id='".$_GET['id']."' and tahun='".$_GET['tahun']."' and bulan='".$_GET['bln']."'";
							$mysqli->query($updt);
							echo "kode 1";
						}
					}else{
						if($objqqq->$as==''){
							if(isset($_POST['dl']) && $_POST['dl']==1){
								$updt="update `harian` set `".$as."`='+".$hurufseksi."' where id='".$_GET['id']."' and tahun='".$_GET['tahun']."' and bulan='".$_GET['bln']."'";
								$mysqli->query($updt);	
								echo "kode 2";
							}else{
								$updt="update `harian` set `".$as."`='".$hurufseksi."' where id='".$_GET['id']."' and tahun='".$_GET['tahun']."' and bulan='".$_GET['bln']."'";
								$mysqli->query($updt);	
								echo "kode 3";
							}
						}else{
							if($_POST['dl']==1){
								$updt="update `harian` set `".$as."`='+".($objqqq->$as).$hurufseksi."' where id='".$_GET['id']."' and tahun='".$_GET['tahun']."' and bulan='".$_GET['bln']."'";
								$mysqli->query($updt);
								echo "kode 4";
							}else{
								$updt="update `harian` set `".$as."`='".($objqqq->$as).$hurufseksi."' where id='".$_GET['id']."' and tahun='".$_GET['tahun']."' and bulan='".$_GET['bln']."'";
								$mysqli->query($updt);
								echo "kode 5";
							}
						}
					}
					//echo "dfdfdf". $objqqq->$_GET['tanggal'];
				}
			}
			echo $updt;
			header("Location:".$_SERVER['REQUEST_URI']);
		}else{
			echo "ggl";
		}
	}
?>
<h3>
	Edit Kegiatan Harian Pegawai<br>
</h3>
<br><br>
<?php
		$sql="SELECT * FROM `pegawai` where id='".$_GET['id']."'";
		if ($result = $mysqli->query($sql)) { 
			while($obj = $result->fetch_object()){
?> 			
<table class="table table-unbordered table-condensed">
	<thead>
	</thead>
	<tbody> 
		<tr>
			<td>Nama </td>
			<td><?php echo $obj->nama;?></td>
		</tr>		
		<tr>
			<td>Tanggal </td>
			<td><?php echo $_GET['tanggal']." ".bulan($_GET['bln'])." ".$_GET['tahun']?></td>
		</tr>
		<tr>
			<td></td>
			<td></td>
		</tr>
	</tbody>
</table>
<?php }}?>
<table class="table table-bordered table-condensed">
	<thead>
		<tr>
			<th>No</th>
			<th>Seksi</th>
			<th>Nama Kegiatan</th>
			<th>Dinas<br>Luar</th>
			<th>Uraian</th>
			<th>Hapus</th>
			<th>Edit</th>
		</tr>
	</thead>
	<tbody>
	<?php		
		include_once "function/func.php";
		$w=1;
		//$sql1="SELECT k.id_keg_harian, k.tahun, k.bln, k.tanggal, k.id, k.kode_seksi, k.kode_keg, k.eselon, k.uraian, k.dinasluar, k.assigner ,m.id_keg,m.eselon,m.kode_kegiatan,m.uraian as uraian2 FROM kegiatanharian k, masterkegiatan m where id='".$_GET['id']."' and tahun='".$_GET['tahun']."' and bln='".$_GET['bln']."' and tanggal='".$_GET['tanggal']."' and k.kode_keg=m.id_keg";
		$sql1="SELECT k.id_keg_harian, k.tahun, k.bln, k.tanggal, k.id, k.kode_seksi, k.kode_keg, k.eselon, k.uraian, k.dinasluar, k.assigner ,m.id_keg,m.eselon,m.kode_kegiatan,m.uraian as uraian2 FROM kegiatanharian k, masterkegiatan m where id='".$_GET['id']."' and tahun='".$_GET['tahun']."' and bln='".$_GET['bln']."' and tanggal='".$_GET['tanggal']."' and k.kode_keg=m.id_keg";
		//echo $sql1;
		if ($result1 = $mysqli->query($sql1)) { 
			while($obj1 = $result1->fetch_object()){		 	
				echo "<tr>
						<td>".$w."</td>
						<td>".namaseksi($obj1->kode_seksi)."</td>
						<td>".$obj1->uraian2."</td>";
				if($obj1->dinasluar==1){
					echo "	<td><input type='checkbox' disabled checked></td>";
				}else{
					echo "	<td><input type='checkbox' disabled></td>";
				}
				echo "	<td>".$obj1->uraian."</td>";
				if($_SESSION['level']==2){
					if($obj1->kode_seksi==$_SESSION['kode_seksi']){
						echo "
							<td><a href='function/hapuseditpertanggal.php?idkeg=".$obj1->id_keg_harian."&id=".$_GET['id']."&tahun=".$_GET['tahun']."&bln=".$_GET['bln']."&tanggal=".$_GET['tanggal']."' onclick='return confirm(\"Are you sure you want to delete this item?\");'><img src='images/del.png'></a></td>
							<td><a href=''><img src='images/edit.png'></a></td>
						</tr>";
					}else{
						echo "<td></td><td></td>";
					}
				}else if($_SESSION['level']==1){
					echo "
							<td><a href='function/hapuseditpertanggal.php?idkeg=".$obj1->id_keg_harian."&id=".$_GET['id']."&tahun=".$_GET['tahun']."&bln=".$_GET['bln']."&tanggal=".$_GET['tanggal']."' onclick='return confirm(\"Are you sure you want to delete this item?\");'><img src='images/del.png'></a></td>
							<td><a href=''><img src='images/edit.png'></a></td>
						</tr>";
				}
				$w++;
			}
		} 
		?>
		<form action="" method="post">		
		<tr>		
			<td><?php echo $w; ?></td>
			<td>
				<select data-placeholder="Pilih Seksi..." tabindex="2" name="seksi" class="form-control" required>
				<?php
					if($_SESSION['level']==1){
				?>
					<option></option>
					<option value="1">Tata Usaha</option>
					<option value="2">Sosial</option>
					<option value="3">Produksi</option>
					<option value="4">Distribusi</option>
					<option value="5">Neraca</option>
					<option value="6">IPDS</option>
				<?php
					}else if($_SESSION['level']==2){
						if($_SESSION['kode_seksi']==1){
							echo "<option value='1'>Tata Usaha</option>";
						}else if($_SESSION['kode_seksi']==2){
							echo "<option value='2'>Sosial</option>";
						}else if($_SESSION['kode_seksi']==3){
							echo "<option value='3'>Produksi</option>";
						}else if($_SESSION['kode_seksi']==4){
							echo "<option value='4'>Distribusi</option>";
						}else if($_SESSION['kode_seksi']==5){
							echo "<option value='5'>Neraca</option>";
						}else if($_SESSION['kode_seksi']==6){
							echo "<option value='6'>IPDS</option>";
						}
					}
				?>						
				</select>
			</td>
			<td><div  align="left">
				<select data-placeholder="Pilih Kegiatan..." class="chosen-select form-control" name="id_keg" required>
					<option></option>
					<?php
						if($_SESSION['level']==1){
							$sqls="SELECT * FROM `masterkegiatan` m, penugasan p where m.id_keg=p.id_keg and p.id_pegawai='".$_GET['id']."' and bulan='".$_GET['bln']."'";
						}else{
							$sqls="SELECT * FROM `masterkegiatan` m, penugasan p where m.id_keg=p.id_keg and p.id_pegawai='".$_GET['id']."' and p.`kode_seksi`='".$_SESSION['kode_seksi']."' and bulan='".$_GET['bln']."'";							
						}

						if($res = $mysqli->query($sqls)){
							while($data = $res->fetch_object()){
								echo "<option value='".$data->id_keg."'>".$data->uraian."</option>";
							}
						}
					?>					
				</select></div>
			</td>
			<?php
				$s = "select * from kegiatanharian where id='".$_GET['id']."' and tahun='".$_GET['tahun']."' and bln='".$_GET['bln']."' and tanggal='".$_GET['tanggal']."' and dinasluar=1";
				//echo $s;
				if($rs=$mysqli->query($s)){
					if(mysqli_num_rows($rs)==1){
						echo "<td><input type='checkbox' disabled value='1' name='dl'></td>";		
					}else{
						echo "<td><input type='checkbox' value='1' name='dl'></td>";
					}
				}
			?>			
			<td colspan="3"><textarea name="uraian" cols="40" rows="5" class="form-control" required></textarea></td>
		</tr>
		<tr>
			<td colspan="4"></td>
			<td  colspan="3" align="right"><button type="submit" id="singlebutton" name="tambah_btn" class="btn btn-primary">+ Tambah</button></td>
		</tr>
		</form>
	</tbody>
</table>
<div class="col-md-12"><a href="?page=pertanggal"><button id="sebelum" type="button" class="btn btn-primary btn-default active btn-block"><< Ke Halaman Kegiatan Harian Pegawai</button></a></div>


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
