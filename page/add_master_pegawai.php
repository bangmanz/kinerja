<?php	
	session_start();	
    include "../function/db.php";
    include "../function/func.php";
	if(isset($_POST['submit'])){
		$q1="insert into pegawai values('".$_POST['id']."','".$_POST['nip']."','".$_POST['nama']."'
		,'".$_POST['username']."','".$_POST['id']."','".$_POST['level']."','1')";		
		$q2="insert into jabatan_pegawai values('','".$_POST['seksi']."','".$_POST['id']."','".$_POST['jabatan']."','".$_POST['wilker']."','','1')";
		if($rr=$mysqli->query($q1)){
			if($rr2=$mysqli->query($q2)){
				echo "<script> location.replace('../dev3/?page=masterpegawai'); </script>";
			}
		}
		echo "gagal";
	}	
	if(isset($_GET['act'])){
		if($_GET['act']=='del'){
			$q1="delete from pegawai where id='".$_GET['id']."'";		
			$q2="delete from jabatan_pegawai where id_pegawai='".$_GET['id']."'";
			if($rr=$mysqli->query($q2)){
				if($rr2=$mysqli->query($q1)){
					echo "<script> location.replace('../dev3/?page=masterpegawai'); </script>";
				}
			}
			echo "gagal";			
		}	

	}
?>
<div class="modal-dialog">
    <div class="modal-content">
    	<div class="modal-header">
            <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
            <h4 class="modal-title" id="myModalLabel">Tambah Master Pegawai</h4>
        </div>

        <div class="modal-body">
        	<form action="../page/add_master_pegawai.php" name="modal_popup" enctype="multipart/form-data" method="POST">
        		<table class="table table-unbordered table-condensed">
				<thead>
				</thead>
				<tbody>
				<tr><td>
                	<label for="Modal Name">NIP Lama</label></td>
     				<td><input type="number" name="id"  class="form-control" />
				</td></tr>
				
				<tr><td>
                	<label for="Modal Name">NIP Baru</label></td>
     				<td><input type="number" name="nip"  class="form-control" />
				</td></tr>
				
				<tr><td>
                	<label for="Modal Name">Nama</label></td>
     				<td><input type="text" name="nama"  class="form-control" />
				</td></tr>
				
				<tr><td>
                	<label for="Modal Name">Username</label></td>
     				<td><input type="text" name="username"  class="form-control" />
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
						echo "<option value='2'>Kepala BPS Provinsi</option>";
						echo "<option value='3'>Kepala Bidang/Bagian/Kabupaten/Kota</option>";
						echo "<option value='4'>Kepala Seksi/Subbag</option>";
						echo "<option value='6'>Staff</option>";
						
					?>
					</select>
                </td></tr>
				
				<tr><td>
					<label for="Description">Level User</label></td>
					<td><select tabindex="2" name="level" id="level" class="form-control" required>
					<?php
						$q5="select * from level_user order by id_level_user";	
						if($re5=$mysqli->query($q5)){
							while($r5=$re5->fetch_object()){
								echo "<option value='".$r5->id_level_user."'>".$r5->nama_level_user."</option>";
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
	
}
</script>