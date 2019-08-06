<div class="row">
<h2>
	Rekap Laporan Pekerjaan Bulanan Pegawai<br>
</h2>

<?php
	if(isset($_POST['bln'])){
			$_SESSION['bln_new'] = $_POST['bln'];
	}
?> 			

<form action="?page=rekappenilaianckp" method="post">
<table class="table table-unbordered table-condensed">
	<thead>
	</thead>
	<tbody>		
		<tr>
			<td>Bulan </td>
			<td>
				<div class="col-md-4">
					<select id="bln" name="bln" class="form-control" required>
						<option></option>
						<option value="01" <?php if(isset($_SESSION['bln_new'])){if($_SESSION['bln_new']=="01"){echo "selected";}}?>>Januari</option>
						<option value="02" <?php if(isset($_SESSION['bln_new'])){if($_SESSION['bln_new']=="02"){echo "selected";}}?>>Februari</option>
						<option value="03" <?php if(isset($_SESSION['bln_new'])){if($_SESSION['bln_new']=="03"){echo "selected";}}?>>Maret</option>
						<option value="04" <?php if(isset($_SESSION['bln_new'])){if($_SESSION['bln_new']=="04"){echo "selected";}}?>>April</option>
						<option value="05" <?php if(isset($_SESSION['bln_new'])){if($_SESSION['bln_new']=="05"){echo "selected";}}?>>Mei</option>
						<option value="06" <?php if(isset($_SESSION['bln_new'])){if($_SESSION['bln_new']=="06"){echo "selected";}}?>>Juni</option>
						<option value="07" <?php if(isset($_SESSION['bln_new'])){if($_SESSION['bln_new']=="07"){echo "selected";}}?>>Juli</option>
						<option value="08" <?php if(isset($_SESSION['bln_new'])){if($_SESSION['bln_new']=="08"){echo "selected";}}?>>Agustus</option>
						<option value="09" <?php if(isset($_SESSION['bln_new'])){if($_SESSION['bln_new']=="09"){echo "selected";}}?>>September</option>
						<option value="10" <?php if(isset($_SESSION['bln_new'])){if($_SESSION['bln_new']=="10"){echo "selected";}}?>>Oktober</option>
						<option value="11" <?php if(isset($_SESSION['bln_new'])){if($_SESSION['bln_new']=="11"){echo "selected";}}?>>November</option>
						<option value="12" <?php if(isset($_SESSION['bln_new'])){if($_SESSION['bln_new']=="12"){echo "selected";}}?>>Desember</option>
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
	if(isset($_SESSION['bln_new'])){ 
?>

<div	id="ModalEdit"	class="modal	fade"	tabindex="-1"	role="dialog"	aria-labelledby="myModalLabel"	aria-hidden="true"></div>
<table class="table table-bordered table-condensed">
	<thead>
		<tr>
			<td rowspan="2" style="vertical-align:middle;"><div align='center'><strong>
				No
			</strong></div></td>
			<td rowspan="2" style="vertical-align:middle;"><div align='center'><strong>
				Nama
			</strong></div></td>
			<td rowspan="2" style="vertical-align:middle;"><div align='center'><strong>
				Bidang/Seksi
			</strong></div></td>
			<td colspan="3" style="vertical-align:middle;"><div align='center'><strong>
				Jumlah/Rekap
			</strong></div></td>
			<?php
				if($_SESSION['eselon']<=3 || $_SESSION['level_user']<=3){
					echo "<td colspan='2' style='vertical-align:middle;'><div align='center'><strong>Penilaian CKP</strong></div></td>";
				}
			?>
		</tr>
		<tr>
			<td style="vertical-align:middle;"><div align='center'><strong>
				Daftar<br>Penugasan
			</strong></div></td>
			<td style="vertical-align:middle;"><div align='center'><strong>
				Laporan<br>Pekerjaan
			</strong></div></td>
			<td><div align='center'><strong>
				Laporan Pekerjaan<br>Sudah Dinilai
			</strong></div></td>
			<?php
				if($_SESSION['eselon']<=3 || $_SESSION['level_user']<=3){
					echo "<td style='vertical-align:middle;'><div align='center'><strong>Jumlah <br>Nilai CKP</strong></div></td>";
					echo "<td style='vertical-align:middle;'><div align='center'><strong>Rata-rata<br>(kol7/kol6)</strong></div></td>";
				}
			?>
		</tr>
		<tr>
			<td><div align='center'><small>(1)</small></div></td>
			<td><div align='center'><small>(2)</small></div></td>
			<td><div align='center'><small>(3)</small></div></td>
			<td><div align='center'><small>(4)</small></div></td>
			<td><div align='center'><small>(5)</small></div></td>
			<td><div align='center'><small>(6)</small></div></td>
			<?php
				if($_SESSION['eselon']<=3 || $_SESSION['level_user']<=3){
						echo "<td><div align='center'><small>(7)</small></div></td>
					<td><div align='center'><small>(8)</small></div></td>";
				}
			?>
		</tr>
	</thead>
	<tbody>
	<?php
		if($_SESSION['eselon']<=3 || $_SESSION['level_user']<=3){
			$querry = "select * from (SELECT id,nama,eselon,bidang,jp.id_jabatan,wilker FROM jabatan j, pegawai p, jabatan_pegawai jp where eselon>3 and j.id_jabatan=jp.id_jabatan and p.id=jp.id_pegawai and wilker='".$_SESSION['wilker']."') a left join (select id_pegawai,count(id_pegawai) as jml_penugasan from penugasan where tahun='".TAHUN."' and bulan='".$_SESSION['bln_new']."' group by id_pegawai) b on a.id=b.id_pegawai left join (select lp.id_pegawai,count(lp.id_pegawai) as jml_lap from laporanpekerjaan_new lp, penugasan pn where tahun='".TAHUN."' and bulan='".$_SESSION['bln_new']."' and lp.id_penugasan=pn.id_penugasan and pn.id_pegawai=lp.id_pegawai group by lp.id_pegawai order by lp.id_pegawai) c on a.id=c.id_pegawai left join (select lp.id_pegawai,count(lp.id_pegawai) as jml_lap_nilai from laporanpekerjaan_new lp, penugasan pn where tahun='".TAHUN."' and bulan='".$_SESSION['bln_new']."' and lp.id_penugasan=pn.id_penugasan and pn.id_pegawai=lp.id_pegawai and nilai>0 group by lp.id_pegawai order by lp.id_pegawai) d on a.id=d.id_pegawai left JOIN (select id, sum(nilai_ckp) as total, count(nilai_ckp) as jml_item from(SELECT pg.id,target,kuantitas,nilai,round((((kuantitas/target)*80) + (nilai*0.2)),2) as nilai_ckp FROM laporanpekerjaan_new l, penugasan p, pegawai pg, masterkegiatan mk where l.id_penugasan=p.id_penugasan and l.id_pegawai=pg.id and p.bulan='".$_SESSION['bln_new']."' and p.tahun=".TAHUN." and p.id_keg=mk.id_keg and l.id_pegawai=p.id_pegawai and nilai>0)a group by id) e on a.id=e.id order by bidang, id_jabatan,eselon";
		}else{
			$querry = "select * from (SELECT id,nama,eselon,bidang,jp.id_jabatan,wilker FROM jabatan j, pegawai p, jabatan_pegawai jp where eselon>3 and j.id_jabatan=jp.id_jabatan and p.id=jp.id_pegawai and wilker='".$_SESSION['wilker']."') a left join (select id_pegawai,count(id_pegawai) as jml_penugasan from penugasan where tahun='".TAHUN."' and bulan='".$_SESSION['bln_new']."' group by id_pegawai) b on a.id=b.id_pegawai left join (select lp.id_pegawai,count(lp.id_pegawai) as jml_lap from laporanpekerjaan_new lp, penugasan pn where tahun='".TAHUN."' and bulan='".$_SESSION['bln_new']."' and lp.id_penugasan=pn.id_penugasan and pn.id_pegawai=lp.id_pegawai group by lp.id_pegawai order by lp.id_pegawai) c on a.id=c.id_pegawai left join (select lp.id_pegawai,count(lp.id_pegawai) as jml_lap_nilai from laporanpekerjaan_new lp, penugasan pn where tahun='".TAHUN."' and bulan='".$_SESSION['bln_new']."' and lp.id_penugasan=pn.id_penugasan and pn.id_pegawai=lp.id_pegawai and nilai>0 group by lp.id_pegawai order by lp.id_pegawai) d on a.id=d.id_pegawai order by bidang, id_jabatan,eselon";
		}
		 // echo $querry;

		$no = 1;
		if ($result2 = $mysqli->query($querry)) { 
			while($obj2 = $result2->fetch_object()){	
				echo "
					<tr>
						<td><div align='center'>".$no."</div></td>
						<td>".$obj2->nama."</td>
						<td><div align='center'>".namaseksi($obj2->bidang)."</div></td>
						<td><div align='center'>".$obj2->jml_penugasan."</div></td>
						<td><div align='center'>".$obj2->jml_lap."</div></td>
						<td><div align='center'>".$obj2->jml_lap_nilai."</div></td>";
				if($_SESSION['eselon']<=3 || $_SESSION['level_user']<=3){
					echo "<td><div align='center'>".$obj2->total."</div></td>";
					//echo "<td><div align='center'>".$obj2->jml_item."</div></td>";
					if($obj2->jml_item>0){
						echo "<td><div align='center'>".round(($obj2->total/$obj2->jml_item),2)."</div></td>";
					}else{
						echo "<td></td>";
					}
				}
						
				echo "</tr>";
				
				$no++;
			}
		}
	?>
	</tbody>
</table>
<?php 
} 		
?>
</div>