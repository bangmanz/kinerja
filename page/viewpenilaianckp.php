<h2>
	View Penilaian CKP Pegawai<br>
</h2>

<?php
	if(isset($_POST['bln'])){
			$_SESSION['bln_new'] = $_POST['bln'];
	}

?> 			

<form action="" method="post">
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
			<td rowspan=2><div align='center'><strong>
				No
			</strong></div></td>
			<td rowspan=2><div align='center'><strong>
				Seksi
			</strong></div></td>
			<td rowspan=2><div align='center'><strong>
				Nama
			</strong></div></td>
			<td rowspan=2><div align='center'><strong>
				Tugas
			</strong></div></td>
			<td colspan=3><div align='center'><strong>
				Target
			</strong></div></td>
			<td colspan=3><div align='center'><strong>
				Realisasi
			</strong></div></td>
			<td rowspan=2><div align='center'><strong>
				Penghitungan
			</strong></div></td>
			<td rowspan=2><div align='center'><strong>
				Nilai Capaian
			</strong></div></td>
		</tr>
		<tr>
			<td><div align='center'><strong>
				Kuantitas
			</strong></div></td>
			<td><div align='center'><strong>
				Kualitas
			</strong></div></td>
			<td><div align='center'><strong>
				Waktu
			</strong></div></td>
			<td><div align='center'><strong>
				Kuantitas
			</strong></div></td>
			<td><div align='center'><strong>
				Kualitas
			</strong></div></td>
			<td><div align='center'><strong>
				Waktu
			</strong></div></td>
		</tr>
	</thead>
	<tbody>
	<?php
		$querry = "SELECT * FROM laporanpekerjaan_new l, penugasan p, pegawai pg, masterkegiatan mk where l.id_penugasan=p.id_penugasan and l.id_pegawai=pg.id and p.bulan='".$_SESSION['bln_new']."' and p.tahun=2017 and p.id_keg=mk.id_keg order by pg.nama, p.kode_seksi" ;
	// $querry;
		$no = 1;
		if ($result2 = $mysqli->query($querry)) { 
			while($obj2 = $result2->fetch_object()){	
				echo "
					<tr>
						<td><div align='center'>".$no."</div></td>
						<td>".namaseksi($obj2->kode_seksi)."</td>
						<td>".$obj2->nama."</td>
						<td>".$obj2->uraian."</td>
						<td>".$obj2->target." ".satuan($obj2->satuan)."</td>
						<td align='center'>100</td>
						<td>".$obj2->targetwaktu." ".waktu($obj2->satuanwaktu)."</td>			
";
				
				echo "	
						<td>".$obj2->kuantitas." ".satuan($obj2->satuan)."</td>
						<td align='center'>".$obj2->nilai."</td>
						<td>".$obj2->waktu." ".waktu($obj2->satuanwaktu)."</td>";
				
				echo "					
						<td align='center'>".round((($obj2->kuantitas/$obj2->target)*(100))+(($obj2->nilai/(100))*(100))+(((((1.95)*$obj2->targetwaktu)-$obj2->waktu)/$obj2->targetwaktu)*(100)))."</td>
						<td align='center'>".round(((($obj2->kuantitas/$obj2->target)*(100))+(($obj2->nilai/(100))*(100))+(((((1.95)*$obj2->targetwaktu)-$obj2->waktu)/$obj2->targetwaktu)*(100)))/3)."</td>";

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
