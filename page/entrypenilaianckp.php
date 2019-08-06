<?php
	if(isset($_POST['edit_pekerjaan'])){
		$qqq = "update laporanpekerjaan_new set nilai='".$_POST['kualitas']."' , kuantitas='".$_POST['kuantitas']."' , waktu='".$_POST['waktu']."' where id_lapnew='".$_POST['id_lapnew']."'";
		//echo $qqq;
		$editpenugasan = "update penugasan set target='".$_POST['kuantitastarget']."' , targetwaktu='".$_POST['waktutarget']."' where id_penugasan='".$_POST['id_penugasan']."'";
		//echo $editpenugasan;
		if($fff = $mysqli->query($editpenugasan)){}
		if($ff = $mysqli->query($qqq)){
			echo "<script> location.replace('?page=entrypenilaianckp'); </script>";
		}
	}

	if(isset($_GET['action'])){
		if($_GET['action']=='hapus'){
			$sql = "update laporanpekerjaan_new set nilai=0 where id_lapnew=".$_GET['id'];
			//echo $sql;
			if($a = $mysqli->query($sql)){
				echo "<script> location.replace('?page=entrypenilaianckp'); </script>";
			}
		}
	}
?>
<link rel="stylesheet" href="../css/tstyle.css" />
<script type="text/javascript" src="../js/tinybox.js"></script>
<script	type="text/javascript">
	$(document).ready(function	()	{
		$(".open_modal").click(function(e)	{
			var	m	=	$(this).attr("id");
			var	tipe	=	$(this).attr("tipe");
			$.ajax({
				url:	"../page/add_penilaian.php",
				type:	"GET",
				data	:	{modal_id:	m, tipe: tipe},
				success:	function	(ajaxData){
					$("#ModalEdit").html(ajaxData);
					$("#ModalEdit").modal('show',{backdrop:	'true'});
				}
			});
		});
	});	
</script>
<h2>
	Entry Penilaian CKP Pegawai<br>
</h2>

<?php
	if(isset($_POST['bln'])){
			$_SESSION['bln_new'] = $_POST['bln'];
	}
	if(isset($_POST['seksickp'])){
			$_SESSION['seksickp'] = $_POST['seksickp'];
	}
?> 			

<form action="" method="post">
<table class="table table-unbordered table-condensed">
	<thead>
	</thead>
	<tbody>
		<?php
			if(substr($_SESSION['wilker'],2,2)=='00'){
				echo "<tr>
					<td>Seksi </td>
					<td><div class='col-md-4'>
						<select id='seksickp' name='seksickp' class='form-control chosen-select' required>
							<option></option>";
				if($_SESSION['eselon']==4){
					$sql = "select * from pegawai p, jabatan j, jabatan_pegawai jp where p.id=jp.id_pegawai and j.id_jabatan=jp.id_jabatan and substring(wilker,3,2)='00' and jp.id_jabatan='".$_SESSION['id_jabatan']."' and eselon>4 order by nama";				
				}else if($_SESSION['eselon']<=3){
					$sql = "select * from pegawai p, jabatan j, jabatan_pegawai jp where p.id=jp.id_pegawai and j.id_jabatan=jp.id_jabatan and substring(wilker,3,2)='00' and bidang='".$_SESSION['bidang']."' order by nama";
				}
				if($result=$mysqli->query($sql)){
					while($ob=$result->fetch_object()){
						if(isset($_SESSION['seksickp'])){
							if($_SESSION['seksickp']==$ob->id){
								echo "<option value='".$ob->id."' selected>".$ob->nama."</option>";
							}else{
								echo "<option value='".$ob->id."'>".$ob->nama."</option>";
							}
						}else{
							echo "<option value='".$ob->id."'>".$ob->nama."</option>";
						}
					}
				}
				echo "</select></div></td></tr>";
			}else{
		?>
		<tr>
			<td>Seksi </td>
			<td><div class='col-md-4'>
				<select id="seksickp" name="seksickp" class="form-control" required>
					<option></option>
					<option value="1" <?php if(isset($_SESSION['seksickp'])){if($_SESSION['seksickp']=="1"){echo "selected";}}?>>Tata Usaha</option>
					<option value="2" <?php if(isset($_SESSION['seksickp'])){if($_SESSION['seksickp']=="2"){echo "selected";}}?>>Sosial</option>
					<option value="3" <?php if(isset($_SESSION['seksickp'])){if($_SESSION['seksickp']=="3"){echo "selected";}}?>>Produksi</option>
					<option value="4" <?php if(isset($_SESSION['seksickp'])){if($_SESSION['seksickp']=="4"){echo "selected";}}?>>Distribusi</option>
					<option value="5" <?php if(isset($_SESSION['seksickp'])){if($_SESSION['seksickp']=="5"){echo "selected";}}?>>Neraca</option>
					<option value="6" <?php if(isset($_SESSION['seksickp'])){if($_SESSION['seksickp']=="6"){echo "selected";}}?>>IPDS</option>
				</select>
			</div></td>
		</tr>		
		<?php } ?>
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
	if(isset($_SESSION['bln_new']) && isset($_SESSION['seksickp'])){ 
?>
<div class="row">
	<div class="col-md-12">
		<label>*) Rumus Penilaian = 80% Kuantitas + 20% Kualitas</label><br>
		<label>*) Komponen waktu akan digunakan dalam penyusunan SKP Tahunan</label>
	</div>
</div>
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
			<td colspan=4><div align='center'><strong>
				Realisasi
			</strong></div></td>
<!--			<td rowspan=2><div align='center'><strong>
				Penghitungan
			</strong></div></td> -->
			<td rowspan=2><div align='center'><strong>
				Nilai<br> Capaian
			</strong></div></td>
			<?php if($_SESSION['seksickp']==$_SESSION['bidang']){?>
			<td rowspan=2><div align='center'><strong>
				Entry/<br>Hapus/<br>Edit
			</strong></div></td>
			<?php }?>
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
			<td><div align='center'><strong>
				Note
			</strong></div></td>
		</tr>
	</thead>
	<tbody>
	<?php
		if(substr($_SESSION['wilker'],2,2)=='00'){
			$querry = "SELECT * FROM laporanpekerjaan_new l, penugasan p, pegawai pg, masterkegiatan mk where l.id_penugasan=p.id_penugasan and l.id_pegawai=pg.id and p.bulan='".$_SESSION['bln_new']."' and p.tahun=".TAHUN." and p.id_keg=mk.id_keg and pg.id=".$_SESSION['seksickp']." order by pg.nama, uraian";
		}else{
			$querry = "SELECT * FROM laporanpekerjaan_new l, penugasan p, pegawai pg, masterkegiatan mk , jabatan_pegawai jp where l.id_penugasan=p.id_penugasan and l.id_pegawai=pg.id and pg.id=jp.id_pegawai and p.id_keg=mk.id_keg and p.bulan='".$_SESSION['bln_new']."' and p.tahun=".TAHUN." and wilker='".$_SESSION['wilker']."' and p.kode_seksi=".$_SESSION['seksickp']." order by pg.nama, uraian" ;
		}
		//echo $querry;
		$no = 1;
		$total = 0;
		if ($result2 = $mysqli->query($querry)) { 
			while($obj2 = $result2->fetch_object()){	
				//$nilai = round((($obj2->kuantitas/$obj2->target)*(100))+(($obj2->nilai/(100))*(100))+(((((1.95)*$obj2->targetwaktu)-$obj2->waktu)/$obj2->targetwaktu)*(100)));
				$nilai = round((($obj2->kuantitas/$obj2->target)*(80))+(($obj2->nilai)*(0.20)),2);
				echo "
					<tr>
						<td><div align='center'>".$no."</div></td>
						<td>".namaseksi($obj2->kode_seksi)."</td>
						<td>".$obj2->nama."</td>
						<td>".$obj2->uraian."</td>
						<td>".$obj2->target." ".satuan($obj2->satuan)."</td>
						<td align='center'>100</td>
						<td>".$obj2->targetwaktu." ".waktu($obj2->satuanwaktu)."</td>";
				
				echo "	<td>".$obj2->kuantitas." ".satuan($obj2->satuan)."</td>";
				if($obj2->nilai==0){
					echo "<td bgcolor='#ff7c7c' align='center'>".$obj2->nilai."</td>";
				}else{
					echo "<td align='center'>".$obj2->nilai."</td>";
				}
				echo "	<td>".$obj2->waktu." ".waktu($obj2->satuanwaktu)."</td>";
				echo "<td>".$obj2->notes."</td>";
				/*
				if($obj2->notes!='' || $obj2->notes!=NULL){
					echo "<td><a id='".$obj2->id_lapnew."' tipe='2' class='open_modal' href='#'><img src='../images/note.png'></a></td>";
				}else{
					echo "<td></td>";
				}*/
				
				//echo "<td align='center'>".$nilai."</td>";
				echo "<td align='center'>".$nilai."</td>";
				if($_SESSION['seksickp']==$_SESSION['bidang'] || substr($_SESSION['wilker'],2,2)=='00'){		
					if($obj2->nilai==0){		
						echo	"<td><div align='center'>
									<a id='".$obj2->id_lapnew."' tipe='1' class='open_modal' href='#'><img src='../images/icon-plus.png'></a>					
								</div>
								</td>";			
					}else{
						echo	"<td><div align='center'>
									<a id='".$obj2->id_lapnew."' tipe='1' class='open_modal' href='#'><img src='../images/edit.png'></a>					
								</div>
								</td>";	
						echo	"<td><div align='center'>
									<a href='?page=entrypenilaianckp&action=hapus&id=".$obj2->id_lapnew."' onclick='return confirm(\"Are you sure you want to delete this item?\");'><img src='../images/del.png'></a>					
								</div>
								</td>";		
					}
				}
				echo "</tr>";
				
				$no++;
				$total+=$nilai;
			}
		}
		if(substr($_SESSION['wilker'],2,2)=='00'){
			echo "<tr><td colspan='11' align='center'><strong>Jumlah Nilai</strong></td><td align='center'>".$total."</td></tr>";
			echo "<tr><td colspan='11' align='center'><strong>Rata-rata (Jml Nilai / Jml Pekerjaan) </strong></td><td align='center'>".round($total/($no-1),2)."</td></tr>";
		}	
	?>
	</tbody>
</table>
<br><br><br>
<?php 
} 		
?>
<link rel="stylesheet" href="../css/chosen.css">
<script src="../js/jquery.min.js" type="text/javascript"></script>
<script src="../js/chosen.jquery.js" type="text/javascript"></script>
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