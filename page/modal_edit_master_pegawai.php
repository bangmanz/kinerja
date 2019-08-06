<?php
	session_start();
    include "../function/db.php";
    include "../function/func.php";
	$modal_id=$_GET['modal_id'];
	$q1="select * from pegawai p, jabatan j, jabatan_pegawai jp 
	where p.id=jp.id_pegawai and j.id_jabatan=jp.id_jabatan and id='$modal_id'";
	
	if($re=$mysqli->query($q1)){
		while($r=$re->fetch_object()){
?>
<div class="modal-dialog">
    <div class="modal-content">
    	<div class="modal-header">
            <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
            <h4 class="modal-title" id="myModalLabel">Edit Master Pegawai</h4>
        </div>

        <div class="modal-body">
        	<form action="../page/editmasterpegawai.php" name="modal_popup" enctype="multipart/form-data" method="POST">
        		<table class="table table-unbordered table-condensed">
				<thead>
				</thead>
				<tbody>
				<tr><td>
                	<label for="Modal Name">Nama</label></td>
                    <td><input type="hidden" name="id"  class="form-control" value="<?php echo $r->id; ?>" />
     				<input type="text" name="nama"  class="form-control" value="<?php echo $r->nama; ?>" disabled/>
				</td></tr>
				
				<tr><td>
                	<label >Wilayah Kerja</label></td>
					<?php
						if($_SESSION['level_user']==2){
							echo "<td><select data-placeholder='Pilih Wilker...' name='wilker'  class='form-control'>";
							$q3="SELECT * FROM `m_wilayah` where sub_kode_wilayah='0' ORDER BY `m_wilayah`.`kode_wilayah`";
							if($re3=$mysqli->query($q3)){
								while($r3=$re3->fetch_object()){
									if($r3->kode_wilayah==$r->wilker){
										echo "<option selected value='".$r3->kode_wilayah."'>".$r3->nama_wilayah."</option>";
									}else{
										echo "<option value='".$r3->kode_wilayah."'>".$r3->nama_wilayah."</option>";
									}
								}
							}
							echo "</select>";
						}else{
							echo "<td><input type='text' name='wilker'  class='form-control' value=".$r->wilker." disabled/>";
						}
					?>
				</td></tr>

				<tr><td>
					<label for="Description">Bidang/Seksi</label></td>
					<td><select data-placeholder="Pilih Seksi..." tabindex="2" name="seksi" class="form-control" onchange="showKab()" required>
					<?php
						$q2="";
						if($_SESSION['level_user']==3){
							$q2="select * from jabatan where level_wilayah=3 and id_jabatan!=101 order by bidang, id_jabatan";
							if($r->eselon=='3'){
								echo "<option selected value='101'>Kepala BPS Kabupaten/Kota</option>";
							}else{
								if($re2=$mysqli->query($q2)){
									while($r2=$re2->fetch_object()){
										if($r2->id_jabatan==$r->id_jabatan){
											echo "<option selected value='".$r2->id_jabatan."'>".$r2->jabatan."</option>";
										}else{
											echo "<option value='".$r2->id_jabatan."'>".$r2->jabatan."</option>";
										}
									}
								}
							}
						}else{
							$q2="select * from jabatan order by bidang, id_jabatan";	
							if($re2=$mysqli->query($q2)){
								while($r2=$re2->fetch_object()){
									if($r2->id_jabatan==$r->id_jabatan){
										echo "<option selected value='".$r2->id_jabatan."'>".$r2->jabatan."</option>";
									}else{
										echo "<option value='".$r2->id_jabatan."'>".$r2->jabatan."</option>";
									}
								}
							}
						}						
						 
					?>
					</select>
                </td></tr>
				
				<tr><td>
					<label for="Description">Jabatan</label></td>
					<td><select data-placeholder="Pilih Jabatan..." tabindex="2" name="jabatan" id="jabatan" class="form-control" required>
					<?php
						if($_SESSION['level_user']==3){
							if($r->eselon=='4'){
								echo "<option selected value='4'>Kepala Seksi/Subbag</option>";
								echo "<option value='6'>Staff</option>";
								echo "<option value='7'>KSK</option>";
							} else if($r->eselon=='6'){
								echo "<option value='4'>Kepala Seksi/Subbag</option>";
								echo "<option selected value='6'>Staff</option>";
								echo "<option value='7'>KSK</option>";
							} else if($r->eselon=='7'){
								echo "<option value='4'>Kepala Seksi/Subbag</option>";
								echo "<option value='6'>Staff</option>";
								echo "<option selected value='7'>KSK</option>";
							} else{
								echo "<option value='3'>Kepala BPS Kabupaten/Kota</option>";
							}
						}else if($_SESSION['level_user']<=2){
							if($r->eselon=='2'){
								echo "<option selected value='2'>Kepala BPS Provinsi</option>";
								echo "<option value='3'>Kepala Bidang/Bagian/Kabupaten/Kota</option>";
								echo "<option value='4'>Kepala Seksi/Subbag</option>";
								echo "<option value='6'>Staff</option>";
								echo "<option value='7'>KSK</option>";
							} else if($r->eselon=='3'){
								echo "<option value='2'>Kepala BPS Provinsi</option>";
								echo "<option selected value='3'>Kepala Bidang/Bagian/Kabupaten/Kota</option>";
								echo "<option value='4'>Kepala Seksi/Subbag</option>";
								echo "<option value='6'>Staff</option>";
								echo "<option value='7'>KSK</option>";
							} else if($r->eselon=='4'){
								echo "<option value='2'>Kepala BPS Provinsi</option>";
								echo "<option value='3'>Kepala Bidang/Bagian/Kabupaten/Kota</option>";
								echo "<option selected value='4'>Kepala Seksi/Subbag</option>";
								echo "<option value='6'>Staff</option>";
								echo "<option value='7'>KSK</option>";
							} else if($r->eselon=='6'){
								echo "<option value='2'>Kepala BPS Provinsi</option>";
								echo "<option value='3'>Kepala Bidang/Bagian/Kabupaten/Kota</option>";
								echo "<option value='4'>Kepala Seksi/Subbag</option>";
								echo "<option selected value='6'>Staff</option>";
								echo "<option value='7'>KSK</option>";
							} else if($r->eselon=='7'){
								echo "<option value='2'>Kepala BPS Provinsi</option>";
								echo "<option value='3'>Kepala Bidang/Bagian/Kabupaten/Kota</option>";
								echo "<option value='4'>Kepala Seksi/Subbag</option>";
								echo "<option value='6'>Staff</option>";
								echo "<option selected value='7'>KSK</option>";
							} else{
								echo "<option value='3'>Kepala BPS Kabupaten/Kota</option>";
							}
						}			
					?>
					</select>
                </td></tr>

				<tr><td></td><td align='right'><button class='btn btn-success' type='submit' name='submit'>
		            Simpan
		        </button></td></tr>

				</tbody></table>
            </form>

		<?php //echo $q1;
		}} ?>
		</div>         
	</div>
</div>
<script language="JavaScript" type="text/JavaScript">

function showKab()
{
	if (document.modal_popup.seksi.value == "1"){document.getElementById('jabatan').innerHTML = "<option value='4'>Kepala Seksi/Subbag</option><option value='6'>Staff</option>"}
	if (document.modal_popup.seksi.value == "2"){document.getElementById('jabatan').innerHTML = "<option value='4'>Kepala Seksi/Subbag</option><option value='6'>Staff</option>"}
	if (document.modal_popup.seksi.value == "3"){document.getElementById('jabatan').innerHTML = "<option value='4'>Kepala Seksi/Subbag</option><option value='6'>Staff</option>"}
	if (document.modal_popup.seksi.value == "4"){document.getElementById('jabatan').innerHTML = "<option value='4'>Kepala Seksi/Subbag</option><option value='6'>Staff</option>"}
	if (document.modal_popup.seksi.value == "5"){document.getElementById('jabatan').innerHTML = "<option value='4'>Kepala Seksi/Subbag</option><option value='6'>Staff</option>"}
	if (document.modal_popup.seksi.value == "6"){document.getElementById('jabatan').innerHTML = "<option value='4'>Kepala Seksi/Subbag</option><option value='6'>Staff</option>"}
	if (document.modal_popup.seksi.value == "7"){document.getElementById('jabatan').innerHTML = "<option value='7'>KSK</option>"}
}
</script>