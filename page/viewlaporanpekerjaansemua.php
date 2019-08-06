<link rel="stylesheet" href="css/tstyle.css" />
<script type="text/javascript" src="js/tinybox.js"></script>
<script	type="text/javascript">$(document).ready(function	()	{
		$(".open_modal").click(function(e)	{
			var	m	=	$(this).attr("id");
			$.ajax({
				url:	"page/add_laporanpekerjaan.php",
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
<h2>
	Entry Laporan Pekerjaan Bulanan Pegawai<br>
</h2>

<?php
	if(isset($_POST['bln'])){
			$_SESSION['bln_new'] = $_POST['bln'];
	}
	if(isset($_POST['id'])){
			$_SESSION['id_new'] = $_POST['id'];
	}
?> 			

<form action="?page=viewlaporanpekerjaansemua" method="post">
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
				Nama
			</strong></div></td>
			<td rowspan=2><div align='center'><strong>
				Seksi
			</strong></div></td>
			<td rowspan=2><div align='center'><strong>
				Tugas
			</strong></div></td>
			<td colspan=4><div align='center'><strong>
				Target
			</strong></div></td>
			<td colspan=6><div align='center'><strong>
				Realisasi
			</strong></div></td>
		</tr>
		<tr>
			<td><div align='center'><strong>
				Kuantitas
			</strong></div></td>			
			<td><div align='center'><strong>
				Kuantitas
			</strong></div></td>
			<td><div align='center'><strong>
				Waktu
			</strong></div></td>
			<td><div align='center'><strong>
				Waktu
			</strong></div></td>
			<td><div align='center'><strong>
				Kualitas
			</strong></div></td>
			<td><div align='center'><strong>
				Kuantitas
			</strong></div></td>
			<td><div align='center'><strong>
				Kuantitas
			</strong></div></td>
			<td><div align='center'><strong>
				Waktu
			</strong></div></td>
			<td><div align='center'><strong>
				Waktu
			</strong></div></td>
			<td><div align='center'><strong>
				Tanggal
			</strong></div></td>
		</tr>
	</thead>
	<tbody>
	<?php
	//	$querry = "select * from penugasan lp, masterkegiatan mk where lp.id_keg=mk.id_keg and lp.id_pegawai='".$_SESSION['id_new']."' and bulan='".$_SESSION['bln_new']."'";
		
	//	$querry = "select * from (select targetwaktu,lp.kode_seksi,uraian,target,satuan,satuanwaktu,mk.id_keg,id_penugasan as id_penugasanaa from penugasan lp, masterkegiatan mk where lp.id_keg=mk.id_keg and lp.id_pegawai='".$_SESSION['id_new']."' and bulan='".$_SESSION['bln_new']."') aa left join (SELECT id_penugasan,waktu as real_waktu, kualitas as real_kualitas, kuantitas as real_kuantitas, group_concat(tanggal SEPARATOR ',') as grup FROM laporanpekerjaan_new l group by id_penugasan) bb on aa.id_penugasanaa=bb.id_penugasan";
		
		$querry = "select * from (select nama, targetwaktu,lp.kode_seksi,uraian,target,satuan,satuanwaktu,mk.id_keg,lp.id_penugasan as id_penugasanaa from penugasan lp, pegawai pg, masterkegiatan mk where lp.id_pegawai=pg.id and lp.id_keg=mk.id_keg and bulan='".$_SESSION['bln_new']."') aa left join laporanpekerjaan_new on aa.id_penugasanaa=laporanpekerjaan_new.id_penugasan order by nama";
	
	  echo $querry;

		$no = 1;
		if ($result2 = $mysqli->query($querry)) { 
			while($obj2 = $result2->fetch_object()){	
				echo "
					<tr>
						<td><div align='center'>".$no."</div></td>
						<td>".$obj2->nama."</td>
						<td>".namaseksi($obj2->kode_seksi)."</td>
						<td>".$obj2->uraian."</td>
						<td>".$obj2->target."</td>
						<td>".satuan($obj2->satuan)."</td>
						<td>".$obj2->targetwaktu."</td>			
						<td>".waktu($obj2->satuanwaktu)."</td>			
";
				if($obj2->kuantitas==null){
					echo "<td></td><td></td><td></td><td></td><td></td><td></td>";
				}else{
					echo "	
						<td>".$obj2->kualitas."</td>
						<td>".$obj2->kuantitas."</td>
						<td>".satuan($obj2->satuan)."</td>
						<td>".$obj2->waktu."</td>
						<td>".waktu($obj2->satuanwaktu)."</td>
						<td>".$obj2->tanggal."</td>";
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
