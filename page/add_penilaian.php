<?php
    session_start();
	include_once "../function/db.php";
	include_once "../function/func.php";
	
?>
<link href="css/fSelect.css" rel="stylesheet">
<script src="js/fSelect.js"></script>
<script>
(function($) {
    $(function() {
        $('.test').fSelect();
    });
})(jQuery);
</script>


<div class="modal-dialog">
    <div class="modal-content">
    <?php

		$qq="SELECT * FROM laporanpekerjaan_new l, penugasan p, pegawai pg, masterkegiatan mk where l.id_penugasan=p.id_penugasan and l.id_pegawai=pg.id and p.id_keg=mk.id_keg and id_lapnew=".$_GET['modal_id']." ";
		if($res = $mysqli->query($qq)){
			while($res2 = $res->fetch_object()){
				$nama =  $res2->nama;
				$namaseksi = namaseksi($res2->kode_seksi);
				$uraian = $res2->uraian;
				$quantarget = $res2->target;
				$timetarget = $res2->targetwaktu;
				$quan = satuan($res2->satuan);
				$timee = waktu($res2->satuanwaktu);
				$quanrealisasi = $res2->kuantitas;
				$timerealisasi = $res2->waktu;
				$nilai = $res2->nilai;
				$id_penugasan = $res2->id_penugasan;
				$notes = $res2->notes;
			}
		}
	



    	if($_GET['tipe']=='1' || $_GET['tipe']==1){
    ?>
    	<div class="modal-header">
			<button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
            <h4 class="modal-title" id="myModalLabel">Entry Penilaian CKP</h4>
        </div>

        <div class="modal-body">
        	<form action="?page=entrypenilaianckp" name="modal_popup" enctype="multipart/form-data" method="POST" >
			<input type="hidden" name="id_lapnew" value="<?php echo $_GET['modal_id']?>">
			<table class="table table-unbordered table-condensed" >
				<tbody>
					<?php
						echo "<tr><td><label>Nama</label></td><td colspan='2'>".$nama."</td></tr>";
						echo "<tr><td><label>Seksi</label></td><td colspan='2'>".$namaseksi."</td></tr>";
						echo "<tr><td><label>Kegiatan</label></td><td colspan='2'>".$uraian."</td></tr>";
						echo "<tr><td colspan='3'><label>Target</label></td></tr>";							
						echo "";


					?>
					<tr>
						<td><label> - Kuantitas</label></td>
						<td><input type="number" name="kuantitastarget"  class="form-control" value="<?php echo $quantarget;?>" required placeholder="Isikan Kuantitas Pekerjaan.."/></td>
						<td>
							<?php echo $quan;?>
						</td>
					</tr>
					
					<tr>
						<td><label> - Waktu</label></td>
						<td><input type="number" name="waktutarget" placeholder="Isikan Waktu yang Dibutuhkan.." class="form-control" value="<?php echo $timetarget;?>" required/></td>
						<td>
							<?php echo $timee;?>
						</td>
					</tr>
				
					<tr><td colspan='3'><label>Realisasi</label></td></tr>
					
					<tr>
						<td><label> - Kualitas (%)</label></td>
						<td colspan="2"><input placeholder="Isikan Kualitas dalam persen.." type="number" name="kualitas"  class="form-control" value="<?php echo $nilai;?>" required/></td>
					</tr>

					
					<tr>
						<td><label> - Kuantitas</label></td>
						<td><input type="number" name="kuantitas"  class="form-control" value="<?php echo $quanrealisasi;?>" required placeholder="Isikan Kuantitas Pekerjaan.."/></td>
						<td>
							<?php echo $quan;?>
						</td>
					</tr>
					
					<tr>
						<td><label> - Waktu</label></td>
						<td><input type="number" name="waktu" placeholder="Isikan Waktu yang Dibutuhkan.." class="form-control" value="<?php echo $timerealisasi;?>" required/></td>
						<td>
							<?php echo $timee;?>
						</td>
					</tr>					
				</tbody>
			</table>
				<input type="hidden" name="id_penugasan" value="<?php echo $id_penugasan;?>">
	            <div align="right">
	                <button class="btn btn-success" type="submit" name="edit_pekerjaan">
	                    Simpan
	                </button>
	            </div>
				
            	</form>
            </div>

    <?php
    	}else{
    ?>
    		



<div class="modal-header">
			<button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
            <h4 class="modal-title" id="myModalLabel">Catatan</h4>
        </div>

        <div class="modal-body">
			<table class="table table-unbordered table-condensed" >
				<tbody>
					<tr>
						<td><label>Keterangan *)</label></td>
						<td colspan="2"><textarea rows="4" class="form-control" id="textarea" name="keterangan" placeholder="Isikan Keterangan Jika Dibutuhkan atau ada perbedaan target, waktu, dll.."><?php echo $notes;?></textarea></td>
					</tr>								
				</tbody>
			</table>				
        </div>




    <?php
    	}
    ?>
    </div>
</div>