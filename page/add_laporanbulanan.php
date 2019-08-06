	<?php
	include_once "../function/db.php";
	include_once "../function/func.php";
	session_start();
?>

<script src="../js/jquery.min.js"></script>
<script type="text/javascript">
	var htmlobjek;
	$(document).ready(function(){
	  //apabila terjadi event onchange terhadap object <select id=propinsi>
	  $("#lv1").change(function(){
		var lv1 = $("#lv1").val();
		$.ajax({
			url: "page/addkeg.php",
			data: "lv1="+lv1,
			cache: false,
			success: function(msg){
				//jika data sukses diambil dari server kita tampilkan
				//di <select id=kota>
				$("#lv2").html(msg);
			}
		});
	  });
	});
	 
</script>

<!--<h3>Daftar Pekerjaan</h3>-->
<div class="modal-dialog">
    <div class="modal-content">

    	<div class="modal-header">
			<button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
            <h4 class="modal-title" id="myModalLabel">Entry Laporan Bulanan</h4>
            Tanggal <?php echo $_GET['modal_id']."  ".bulan($_SESSION['entrylaporanbulanan']);?>
        </div>

        <div class="modal-body">
        	<form action="?page=entrylaporanbulanan" name="modal_popup" enctype="multipart/form-data" method="POST">		
			<input type="hidden" name="tanggal" value="<?php echo $_GET['modal_id'];?>" >
			<input type="hidden" name="bulan" value="<?php echo $_SESSION['entrylaporanbulanan'];?>" >
			<table class="table table-unbordered table-condensed">
				<thead>
				</thead>
				<tbody>
					<tr>
						<td><label>Seksi</label></td>
						<td colspan="2">
							<select placeholder="Pilih Seksi..." name="lv1" id="lv1" class="form-control" required>
								<option></option>
								<option value="1">Tata Usaha</option>
								<option value="2">Sosial</option>
								<option value="3">Produksi</option>
								<option value="4">Distribusi</option>
								<option value="5">Neraca</option>
								<option value="6">IPDS</option>
								<option value="7">Umum</option>
							</select>
						</td>
					</tr>		
					<tr>
						<td><label>Kegiatan</label></td>
						<td colspan="2">
							<select data-placeholder="Pilih Kegiatan..." name="lv2" id="lv2" class="form-control" required>
								<option></option>
							</select>
						</td>
					</tr>
					<tr>
						<td><label>Kuantitas</label></td>
						<td><input type="number" name="kuantitas"  class="form-control" value="" required placeholder="Isikan Kuantitas Pekerjaan.."/></td>
						<td>
							<select data-placeholder="Pilih Kegiatan..." tabindex="2" name="sat_kuantitas" class="form-control" required>
								<option></option>
									<option value="1">Blok Sensus</option>
									<option value="2">Dokumen</option>
									<option value="3">Rumah Tangga</option>
									<option value="4">Kegiatan</option>
									<option value="5">Paket</option>
									<option value="6">Perusahaan</option>
									<option value="7">Responden</option>
									<option value="8">Publikasi</option>
									<option value="9">Surat</option>
									<option value="10">Daftar</option>
									<option value="11">Orang</option>
							</select>
						</td>
					</tr>
					<tr>
						<td><label>Kualitas (%)</label></td>
						<td colspan="2"><input placeholder="Isikan Kualitas dalam persen.." type="number" name="kualitas"  class="form-control" value="" required/></td>
					</tr>
					<tr>
						<td><label>Waktu</label></td>
						<td><input type="number" name="waktu" placeholder="Isikan Waktu yang Dibutuhkan.." class="form-control" value="" required/></td>
						<td>
							<select data-placeholder="Pilih Waktu..." tabindex="2" name="sat_waktu" class="form-control" required>
								<option></option>							
									<option value="1">Hari</option>
									<option value="2">Jam</option>
							</select>
						</td>
					</tr>
					<tr>
						<td><label>Keterangan *)</label></td>
						<td colspan="2"><textarea rows="4" class="form-control" id="textarea" name="keterangan" placeholder="Isikan Keterangan Jika Dibutuhkan.."></textarea></td>
					</tr>
					<tr>
						<td colspan="3">*) Form Keterangan diisi keterangan yang dibutuhkan, misal :<br>1. nama kecamatan, desa ,blok sensus <br>2. keterangan pekerjaan(memperbaiki susenas, dll)</td>
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