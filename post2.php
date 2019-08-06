<?php
	session_start();
	include "function/func.php";
	include "function/db.php";
?>
<link rel="stylesheet" href="css/style.css" />
<link rel="stylesheet" href="css/tstyle.css" />
<!--<h3>Daftar Pekerjaan</h3>-->
<div class="modal-dialog">
<div class="modal-content">

<div class="modal-header">
	<button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
	<h4 class="modal-title" id="myModalLabel">Entry Dinas Luar Pegawai</h4>
</div>
<div class="modal-body">
<form action='../delpost.php' name='modal_popup' enctype='multipart/form-data' method='POST'>
<table class="table table-unbordered table-condensed">
	<thead>
	</thead>
	<tbody>
		<tr>
			<td>Nama </td>
			<td><?php echo $_GET['nama'];?></td>
		</tr>		
		<tr>
			<td>Tanggal </td>
			<td><?php echo $_GET['tgl']." ".bulan($_GET['bln'])." ".$_GET['thn'];?></td>
		</tr>
		
		<?php						
			if($_GET['kode']==""){	
				if($_GET['aa']==1 && $_SESSION['level_user']<=5){
					echo "<tr><td>Seksi/Bidang</td><td>".namaseksi($_SESSION['bidang'])."</td></tr>";
 				}
				echo "<input type='hidden' name='tgl' value='".$_GET['tgl']."'>";
 				echo "<input type='hidden' name='bln' value='".$_GET['bln']."'>";
 				echo "<input type='hidden' name='thn' value='".$_GET['thn']."'>";
 				echo "<input type='hidden' name='id' value='".$_GET['id']."'>";
 				echo "<input type='hidden' name='insert_dl_by' value='".$_SESSION['id']."'>";
 				echo "<input type='hidden' name='kode_seksi' value='".$_SESSION['bidang']."'>";
				if($_GET['aa']==1 && $_SESSION['level_user']<=5){
				echo "	<tr>
							<td>Nama Kegiatan</td>";
				echo "<td>";
				echo "<select name='kode_keg' required class='form-control' data-placeholder='Pilih Kegiatan...'><option></option>";
				$sql12="select * from m_kode_kegiatan where kode_seksi='".$_SESSION['bidang']."' order by kode_kegiatan, keterangan";
				if ($result12 = $mysqli->query($sql12)) { 
					while($obj12 = $result12->fetch_object()){
						echo "<option value='".$obj12->id_m_kode."-".$obj12->kode_kegiatan."'>".$obj12->kode_kegiatan." - ".$obj12->keterangan."</option>";
					}
				}
				echo "</td></tr>";	
				echo "<tr><td>keterangan</td>
						<td><input type='text' name='ket' placeholder='Isikan keterangan jika diperlukan' class='form-control'></td></tr>";				
				
					echo "<tr>
								<td></td>
								<td align='right'>
								<button class='btn btn-success' type='submit' name='submit'>
		                    		Tambah
		                		</button>
								</td>
							</tr>";
				}

			}else{
				$sql3="select kode_seksi,keterangan,insert_dl_by, nama,ket from m_kode_kegiatan m, dinas_luar dl, pegawai p 
				where insert_dl_by=p.id and dl.id=".$_GET['id']." 
				and dl.thn='".$_GET['thn']."' and dl.bln='".$_GET['bln']."' and dl.tgl='".$_GET['tgl']."' 
				and m.id_m_kode=dl.id_m_kode and kode_kegiatan='".substr($_GET['kode'],8)."'";
				//echo $sql3;
				if ($result3 = $mysqli->query($sql3)) { 
				while($obj3 = $result3->fetch_object()){
						echo "
							<tr>
								<td>Seksi/Bidang</td>
								<td>".namaseksi($obj3->kode_seksi)."</td>
							</tr>
							<tr>
								<td>Nama Kegiatan</td>
								<td>".$obj3->keterangan."</td>
							</tr>
							<tr>
								<td>Insert by</td>
								<td>".$obj3->insert_dl_by." (".$obj3->nama.")</td>
							</tr>
							<tr>
								<td>Keterangan</td>
								<td>".$obj3->ket."</td>
							</tr>";

						if($_SESSION['bidang']==$obj3->kode_seksi && $_SESSION['level_user']<=5){
							echo "	
								<tr>
									<td></td>
									<td><div align='right'>
									<a href='../delpost.php?action=del&id=".$_GET['id']."&thn=".$_GET['thn']."&bln=".$_GET['bln']."&tgl=".$_GET['tgl']."' 
									onclick='return confirm(\"Are you sure you want to delete this item?\");>
									<button id='edit' name='edit' class='btn btn-primary'>Hapus</button>
									</a></div></td>
								</tr>";
						}
					}
				}
			}	
		?>
		
	</tbody>
</table>
</form>
</div></div></div>