<?php
	session_start();
	include_once "../function/db.php";
	include_once "../function/func.php";	
?>
<script type="text/javascript">
    window.onload=function(){
      $('#mdp-demo').multiDatesPicker();
    }
</script>


<div class="modal-dialog">
    <div class="modal-content">
    	<div class="modal-header">
			<button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
            <h4 class="modal-title" id="myModalLabel">Entry Laporan Bulanan</h4>
        </div>

        <div class="modal-body">
        	<form action="?page=entrylaporanpekerjaan" name="modal_popup" enctype="multipart/form-data" method="POST" >
			<input type="hidden" name="id_penugasan" value="<?php echo $_GET['modal_id']?>">
			<table class="table table-unbordered table-condensed" >
				<tbody>
				<?php
					$qq="select * from penugasan lp, masterkegiatan mk where id_penugasan=".$_GET['modal_id']." and lp.id_keg=mk.id_keg";
					if($res = $mysqli->query($qq)){
						while($res2 = $res->fetch_object()){
							echo "<tr><td><label>Seksi</label></td><td colspan='2'>".namaseksi($res2->kode_seksi)."</td></tr>";
							echo "<tr><td><label>Kegiatan</label></td><td colspan='2'>".$res2->uraian."</td></tr>";
							echo "<tr><td><label>Target</label></td><td colspan='2'>".$res2->target." ".satuan($res2->satuan)." - ".$res2->targetwaktu." ".waktu($res2->satuanwaktu)."</td></tr>";							
							echo "<tr><td colspan='3'><label>Realisasi</label></td></tr>";
							$quan = satuan($res2->satuan);
							$timee = waktu($res2->satuanwaktu);
						}
					}
				?>
					<!--<tr>
						<td><label>Kualitas (%)</label></td>
						<td colspan="2"><input placeholder="Isikan Kualitas dalam persen.." type="number" name="kualitas"  class="form-control" value="" required/></td>
					</tr>-->

					
					<tr>
						<td><label>Kuantitas</label></td>
						<td><input type="number" name="kuantitas"  class="form-control" value="" required placeholder="Isikan Kuantitas Pekerjaan.."/></td>
						<td>
							<?php echo $quan;?>
						</td>
					</tr>
					
					<tr>
						<td><label>Waktu</label></td>
						<td><input type="number" name="waktu" placeholder="Isikan Waktu yang Dibutuhkan.." class="form-control" value="" required/></td>
						<td>
							<?php echo $timee;?>
						</td>
					</tr>
					<tr>
						<td><label>Tanggal</label></td>
						<td colspan="2">
						<!--  <select name="tanggal[]" class="test" multiple="multiple">-->
    						<select name="tanggal[]"  multiple id="framework">
							<?php
								for($e=1;$e<=31;$e++){
									echo"<option value='".substr("0".$e,-2)."'>".substr("0".$e,-2)."</option>";
								}
							?>
						</select>
						
                        
						</td>
					</tr>		
					<tr>
						<td><label>Keterangan *)</label></td>
						<td colspan="2"><textarea rows="4" class="form-control" id="textarea" name="keterangan" placeholder="Isikan keterangan jika dibutuhkan (tempat tugas, waktu) atau ada perbedaan target, waktu, dll.."></textarea></td>
					</tr>			
				</tbody>
			</table>
	            <div align="right">
	                <button class="btn btn-success" type="submit" name="edit_pekerjaan">
	                    Tambah
	                </button>
	            </div>
				
            	</form>
            </div>
        </div>
</div>

