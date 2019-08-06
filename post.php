<link rel="stylesheet" href="css/style.css" />
<link rel="stylesheet" href="css/tstyle.css" />
<!--<h3>Daftar Pekerjaan</h3>-->

<table class="table table-unbordered table-condensed">
	<thead>
	</thead>
	<tbody>
		<tr>
			<td>Nama </td>
			<td><?php include "function/func.php"; echo $_POST['nama'];?></td>
		</tr>		
		<tr>
			<td>Tanggal </td>
			<td><?php echo $_POST['tanggal']." ".bulan($_POST['bulan'])." ".$_POST['tahun'];?></td>
		</tr>
		<tr>
			<td></td>
			<td></td>
		</tr>
	</tbody>
</table>

<table class="table table-bordered table-condensed">
	<thead>
		<tr>
			<th>
				No
			</th>
			<th>
				Seksi
			</th>
			<th>
				Nama Kegiatan
			</th>
			<th>
				Dinas Luar
			</th>
		</tr>
	</thead>
	<tbody>
	
	<?php
		session_start();
		include "function/db.php";
		$a=1;
		$sql3="SELECT k.kode_seksi,m.uraian as uraian, k.uraian as keterangan, dinasluar FROM `kegiatanharian` k, masterkegiatan m where k.kode_keg=m.id_keg and id='".$_POST['id']."' and tahun='".$_POST['tahun']."' and bln='".$_POST['bulan']."' and tanggal='".$_POST['tanggal']."'";
		//echo $sql3;
		if($result3 = $mysqli->query($sql3)) { 
			while($obj3 = $result3->fetch_object()){
				echo "<tr><td>".$a."</td><td>".namaseksi($obj3->kode_seksi)."</td><td>".$obj3->uraian."</td><td><input type='checkbox' disabled "; 				
				if($obj3->dinasluar==1){echo "checked ";} 
				echo "name='dl'></td></tr>";
				$a++;
			}	
		}	
	?>
	</tbody>
</table>
<?php echo "<a href='?page=editpertanggal&id=".$_POST['id']."&tahun=".$_POST['tahun']."&bln=".$_POST['bulan']."&tanggal=".$_POST['tanggal']."'>"; ?>
<div class="col-md-12" align="right">
	<?php if($_SESSION['level']<=2){?>
    <button id="edit" name="edit" class="btn btn-primary">Edit/Tambah/Hapus</button>
    <?php }?>
  </div></a>
<a href="">