<?php
	if(isset($_POST['bln'])){
			$_SESSION['viewlaporanbulanan'] = $_POST['bln'];
	}
	if(isset($_POST['id'])){
			$_SESSION['viewidlaporanbulanan'] = $_POST['id'];
	}
?>
<link rel="stylesheet" href="css/tstyle.css" />
<script type="text/javascript" src="js/tinybox.js"></script>
<h2>
	Detail Dinas Luar Pegawai - Laporan Pekerjaan<br>
</h2>

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
						<?php

							if($_SESSION['level_user']==5){
								$sql="select * from pegawai p, jabatan j, jabatan_pegawai jp where p.id=jp.id_pegawai and j.id_jabatan=jp.id_jabatan and jp.wilker=".$_SESSION['wilker']." and eselon>=".$_SESSION['eselon']." order by nama";
							}else if($_SESSION['level_user']==4){
								$sql="select * from pegawai p, jabatan j, jabatan_pegawai jp where p.id=jp.id_pegawai and j.id_jabatan=jp.id_jabatan and jp.wilker=".$_SESSION['wilker']." and eselon>=".$_SESSION['eselon']." and bidang='".$_SESSION['bidang']."' order by wilker, nama";
							}

							//$sql="SELECT * FROM `pegawai` order by nama";
							if ($result = $mysqli->query($sql)) { 
								while($obj = $result->fetch_object()){
									if(isset($_SESSION['viewidlaporanbulanan'])){
										if($_SESSION['viewidlaporanbulanan']==$obj->id){
											echo "<option selected value=".$obj->id.">".$obj->nama."</option>";
										}else{
											echo "<option value=".$obj->id.">".$obj->nama."</option>";
										}
									}else{
										echo "<option value=".$obj->id.">".$obj->nama."</option>";								
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
<?php
	if(isset($_SESSION['viewlaporanbulanan']) && isset($_SESSION['viewidlaporanbulanan'])){
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
<!--			<th><div align='center'>
				Kode Kegiatan
			</div></th>-->
			<th><div align='center'>
				Dinas Luar
			</div></th>
			<th><div align='center'>
				Laporan Pekerjaan
			</div></th>
		</tr>
	</thead>
	<tbody>
	<?php	
		$query1 = "select uraian,tanggal from (select uraian ,mk.id_keg,lp.id_penugasan as id_penugasanaa from penugasan lp, masterkegiatan mk where lp.id_keg=mk.id_keg and lp.id_pegawai='".$_SESSION['viewidlaporanbulanan']."' and tahun=".TAHUN." and bulan='".$_SESSION['viewlaporanbulanan']."') aa left join laporanpekerjaan_new on aa.id_penugasanaa=laporanpekerjaan_new.id_penugasan";
		echo $query1."<br>";
		if($result=$mysqli->query($query1)){
			while($row=$result->fetch_row()){
				$rows[]=$row;
			}
		}
		
		$len = count($rows);
		
		$namabulan=bulan($_SESSION['viewlaporanbulanan']);
		$timestamp = strtotime("2017-".$_SESSION['viewlaporanbulanan']."-1");
		$days = date('w', $timestamp);
		$query="select tanggal.tgl, df.kode_seksi, df.kode_kegiatan, df.keterangan from tanggal left join (select m.id_m_kode as id_m_kode, m.kode_seksi as kode_seksi, m.kode_kegiatan as kode_kegiatan, m.keterangan as keterangan, d.tgl as tgl, d.bln as bln, d.thn as thn from dinas_luar d, m_kode_kegiatan m where m.id_m_kode=d.id_m_kode and d.id='".$_SESSION['viewidlaporanbulanan']."' and d.thn='".TAHUN."' and d.bln='".$_SESSION['viewlaporanbulanan']."') df on tanggal.tgl=df.tgl order by tanggal.tgl limit 0,".jmlhari($_SESSION['viewlaporanbulanan']);
		echo $query;
		if($result=$mysqli->query($query)){
			while($obj=$result->fetch_object()){
				if($days==0||$days==6){
					echo "<tr bgcolor='#ffb3b3'>";
				}else{
					echo "<tr>";
				}
				echo "<td align='center'>".$obj->tgl."-".$namabulan."-".TAHUN."</td>";
				echo "<td align='center'>".namaseksi($obj->kode_seksi)."</td>";
				//echo "<td align='center'>".$obj->kode_kegiatan."</td>";
				echo "<td>".$obj->keterangan."</td>";
				echo "<td>";
				for($i=1;$i<$len;$i++){
					if (strpos($rows[$i][1], $obj->tgl) !== false) {
						echo $rows[$i][0]."<br>";
					}
				}
				
				echo "</td>";
				echo "</tr>";
				$days++;
				if($days==7){$days=0;}
			}
		}
	?>
	</tbody>
</table>
<?php }?>