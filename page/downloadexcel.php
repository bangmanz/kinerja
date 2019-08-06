<?php
	session_start();
	$filename="CKP_".$_GET['id']."_".$_GET['bln'].".xls";
	//header("Content-Type: application/vnd.ms-excel");
	//header("Content-Disposition: attachment; filename=$filename");
	//header("Pragma: no-cache");
	//header("Expires: 0");
	include "../function/func.php";
	include "../function/db.php";
?>

<?php
	if(!isset($_GET['id'])){
		$id=$_SESSION['id'];
		$sql = "SELECT * FROM jabatan j, pegawai p, jabatan_pegawai jp where p.id='".$_SESSION['id']."' and jp.id_jabatan=j.id_jabatan and jp.id_pegawai=p.id";
		if ($result = $mysqli->query($sql)) { 
			while($obj = $result->fetch_object()){
				$nip=$obj->nip;
				$nama=$obj->nama;
				$jabatan=$obj->jabatan;
				$id_jabatan=$obj->id_jabatan;
				$satuan_organisasi=$obj->wilker;
				$eselon=$obj->eselon;
				$wilker=$obj->wilker;
				$bidang=$obj->bidang;
				if($eselon==6){
					$sql1 = "SELECT * FROM jabatan j, pegawai p, jabatan_pegawai jp where jp.id_jabatan=j.id_jabatan and jp.id_pegawai=p.id and eselon=4 and wilker='".$wilker."' and bidang='".$bidang."' and jp.id_jabatan='".$id_jabatan."'";
				}else if($eselon==4){
					$sql1 = "SELECT * FROM jabatan j, pegawai p, jabatan_pegawai jp where jp.id_jabatan=j.id_jabatan and jp.id_pegawai=p.id and eselon=3 and wilker='".$wilker."' and bidang='".$bidang."'";
				}
			//	echo $sql1;
				if ($result1 = $mysqli->query($sql1)) { 
					while($obj2 = $result1->fetch_object()){
						$nama_atasan = $obj2->nama;
						$nip_atasan = $obj2->nip;
					}
				}
			}
		}
	}else{
		$id=$_GET['id'];
		$sql = "SELECT * FROM jabatan j, pegawai p, jabatan_pegawai jp where p.id='".$_GET['id']."' and jp.id_jabatan=j.id_jabatan and jp.id_pegawai=p.id";
		//echo $sql;
		if ($result = $mysqli->query($sql)) { 
			while($obj = $result->fetch_object()){
				$nip=$obj->nip;
				$nama=$obj->nama;
				$jabatan=$obj->jabatan;
				$id_jabatan=$obj->id_jabatan;
				$satuan_organisasi=$obj->wilker;
				$eselon=$obj->eselon;	
				$wilker=$obj->wilker;
				$bidang=$obj->bidang;
				if($eselon==6){
					$sql1 = "SELECT * FROM jabatan j, pegawai p, jabatan_pegawai jp where jp.id_jabatan=j.id_jabatan and jp.id_pegawai=p.id and eselon=4 and wilker='".$wilker."' and bidang='".$bidang."' and jp.id_jabatan='".$id_jabatan."'";
				}else if($eselon==4){
					$sql1 = "SELECT * FROM jabatan j, pegawai p, jabatan_pegawai jp where jp.id_jabatan=j.id_jabatan and jp.id_pegawai=p.id and eselon=3 and wilker='".$wilker."' and bidang='".$bidang."'";
				}
				//echo $sql1;
				if ($result1 = $mysqli->query($sql1)) { 
					while($obj2 = $result1->fetch_object()){
						$nama_atasan = $obj2->nama;
						$nip_atasan = $obj2->nip;
					}
				}				
			}
		}
	}

?>
<table border="0" width="100%">
<tr><td colspan="11" align="center"><h2>CAPAIAN KINERJA PEGAWAI TAHUN 2019</h2></td></tr>
<tr><td colspan="11"></td></tr>
<tr><td colspan="2">Satuan Organisasi</td><td colspan="9">:  BPS Provinsi Lampung</td></tr>
<tr><td colspan="2">Nama</td><td colspan="9">: <?php echo $nama; ?></td></tr>
<tr><td colspan="2">Jabatan</td><td colspan="9">:  <?php if($eselon==4){echo "Kepala ".$jabatan; }else if($eselon==6){echo "Staff ".$jabatan; } ?></td></tr>
<tr><td colspan="2">Periode</td><td colspan="9">:  </td></tr>
</table>
<br>
<table border="1" width="100%" class="table table-bordered table-condensed">
	<thead>
		<tr>
			<td rowspan=2><div align='center'><strong>
				No
			</strong></div></td>
			<td rowspan=2 colspan=2><div align='center'><strong>
				Uraian Kegiatan
			</strong></div></td>
			<td rowspan=2><div align='center'><strong>
				Satuan
			</strong></div></td>
			<td colspan=3><div align='center'><strong>
				Kuantitas
			</strong></div></td>
			<td rowspan=2><div align='center'><strong>
				Tingkat <br>Kualitas <br> (%)
			</strong></div></td>
			<td rowspan=2><div align='center'><strong>
				Kode<br> Butir<br> Kegiatan
			</strong></div></td>
			<td rowspan=2><div align='center'><strong>
				Angka Kredit
			</strong></div></td>
			<td rowspan=2><div align='center'><strong>
				Keterangan
			</strong></div></td>
		</tr>
		<tr>
			<td><div align='center'><strong>
				Target
			</strong></div></td>
			<td><div align='center'><strong>
				Realisasi
			</strong></div></td>
			<td><div align='center'><strong>
				%
			</strong></div></td>
		</tr>
		<tr>
			<td><div align='center'><small> '(1)</small></div></td>
			<td colspan=2><div align='center'><small> '(2)</small></div></td>
			<td><div align='center'><small> '(3)</small></div></td>
			<td><div align='center'><small> '(4)</small></div></td>
			<td><div align='center'><small> '(5)</small></div></td>
			<td><div align='center'><small> '(6)</small></div></td>
			<td><div align='center'><small> '(7)</small></div></td>
			<td><div align='center'><small> '(8)</small></div></td>
			<td><div align='center'><small> '(9)</small></div></td>
			<td><div align='center'><small> '(10)</small></div></td>
		</tr>
	</thead>
	<tbody>
	<?php
		$querry = "SELECT * FROM laporanpekerjaan_new l, penugasan p, pegawai pg, masterkegiatan mk where l.id_penugasan=p.id_penugasan and l.id_pegawai=pg.id and p.bulan='".$_GET['bln']."' and p.tahun=".TAHUN." and p.id_keg=mk.id_keg and pg.id=".$id." order by pg.nama, uraian";
		//echo $querry;
		$no = 1;
		if ($result2 = $mysqli->query($querry)) { 
			while($obj2 = $result2->fetch_object()){	
				//$nilai = round((($obj2->kuantitas/$obj2->target)*(100))+(($obj2->nilai/(100))*(100))+(((((1.95)*$obj2->targetwaktu)-$obj2->waktu)/$obj2->targetwaktu)*(100)));
				$nilai = round((($obj2->kuantitas/$obj2->target)*(80))+(($obj2->nilai)*(0.20)));
				echo "
					<tr>
						<td><div align='center'>".$no."</div></td>
						<td colspan=2>".$obj2->uraian."</td>
						<td align='center'>".satuan($obj2->satuan)."</td>
						<td align='center'>".$obj2->target."</td>
						<td align='center'>".$obj2->kuantitas."</td>
						<td align='center'>".(round($obj2->kuantitas/$obj2->target)*100)."</td>
						<td align='center'>".$obj2->nilai."</td>";
				
				echo "	<td></td>";
				echo "	<td></td>";
				echo "	<td>".$obj2->notes."</td>";
				echo "</tr>";
				
				$no++;
			}
		}
	?>
	</tbody>
</table>
<br>
<br>
<table border="0" width="100%">
<tr><td></td><td colspan="10"><strong>Penilaian Kinerja :</strong></td></tr>
<tr><td></td><td colspan="10"><strong>Tanggal :</strong></td></tr>
</table>
<br>
<table border="0" width="100%">
<tr><td></td><td colspan="3" align='center'><strong>Pegawai Yang Dinilai</strong></td><td colspan="4"></td><td colspan="3" align='center'><strong>Pejabat Penilai</strong></td></tr>
<tr><td></td><td colspan="3"><strong></strong></td><td colspan="4"></td><td colspan="3"></td></tr>
<tr><td></td><td colspan="3"><strong></strong></td><td colspan="4"></td><td colspan="3"></td></tr>
<tr><td></td><td colspan="3"><strong></strong></td><td colspan="4"></td><td colspan="3"></td></tr>
<tr><td></td><td colspan="3" align='center'><strong><?php echo "( ".$nama." )";?></strong></td><td colspan="4"></td><td colspan="3" align='center'><strong><?php echo "( ".$nama_atasan." )";?></strong></td></tr>
<tr><td></td><td colspan="3" align='center'><strong><?php echo "NIP ".$nip;?></strong></td><td colspan="4"></td><td colspan="3" align='center'><strong><?php echo "NIP. ".$nip_atasan;?></strong></td></tr>
</table>