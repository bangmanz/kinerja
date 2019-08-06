<?php
	session_start();
	include_once "../function/db.php";
	include_once "../function/func.php";
?>
<link href="../css/fSelect.css" rel="stylesheet">
<script src="../js/fSelect.js"></script>
<script>
(function($) {
    $(function() {
        $('.test').fSelect();
    });
})(jQuery);
</script>


<div class="modal-dialog">
    <div class="modal-content">

    	<div class="modal-header">
			<button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
            <h4 class="modal-title" id="myModalLabel">Edit Master Pekerjaan</h4>
        </div>

        <?php
        	$wq = "select * from masterkegiatan where id_keg=".$_GET['modal_id'];
        	if($ww = $mysqli->query($wq)){
        		while($we = $ww->fetch_object()){
        			$uraian = $we->uraian;
        			$parent = $we->parent;
        			$satuan = $we->id_satuan;
        			$waktu = $we->id_satuan_waktu;
        			$angkred = $we->angkred;
        		}
        	}	
        ?>
        <div class="modal-body">
			<table	id="mytablee2"	class="table table-borderless">
				<tr>
			        <td colspan="6">
			            <div>
			            	<table	id="mytable3" class="table table-bordered">
			            		<tr>
			            			<td>
			            				<form class="form-horizontal" role="form" action="?page=usulanmasterpekerjaan" method="post">
			            				<input type="hidden" name="id_keg" value="<?php echo $_GET['modal_id']?>">
											<div class="form-group">
												<label for="inputEmail3" class="col-sm-4 control-label">
													Kode Bidang/Seksi
												</label>
												<div class="col-sm-8">
													<select data-placeholder="Pilih Seksi..." tabindex="2" name="seksi" class="form-control" required>
														<?php															
															if($_SESSION['level_user']>=2 && $_SESSION['level_user']<=5){
																if($_SESSION['bidang']==1){
																	echo "<option value='1'>Tata Usaha</option>";
																}else if($_SESSION['bidang']==2){
																	echo "<option value='2'>Sosial</option>";
																}else if($_SESSION['bidang']==3){
																	echo "<option value='3'>Produksi</option>";
																}else if($_SESSION['bidang']==4){
																	echo "<option value='4'>Distribusi</option>";
																}else if($_SESSION['bidang']==5){
																	echo "<option value='5'>Neraca</option>";
																}else if($_SESSION['bidang']==6){
																	echo "<option value='6'>IPDS</option>";
																}
															}
														?>						
													</select>
												</div>
											</div>

											<div class="form-group">
												<label for="inputEmail3" class="col-sm-4 control-label">
													Komponen Kegiatan
												</label>
												<div class="col-sm-8">
													<select tabindex="2" name="parent" class="form-control  chosen-select" required>
													<option></option>>
														<?php
															$sql = "select * from masterkegiatan where level=0";
															if($res = $mysqli->query($sql)){
																while($obj=$res->fetch_object()){
																	if($parent==$obj->id_keg){
																		echo "<option value='".$obj->id_keg."' selected>".$obj->uraian."</option>";
																	}else{
																		echo "<option value='".$obj->id_keg."'>".$obj->uraian."</option>";
																	}
																	echo "<option value='".$obj->id_keg."'>".$obj->uraian."</option>";
																}
															}
														?>						
													</select>
												</div>
											</div>

											<div class="form-group">
												<label for="inputEmail3" class="col-sm-4 control-label">
													Uraian Pekerjaan
												</label>
												<div class="col-sm-8">
													<input placeholder="Nama Pekerjaan..." id='uraian' value='<?php echo $uraian;?>' required name='uraian' type='text' class='form-control input-md'>
												</div>
											</div>


											<div class="form-group">
												<label for="inputEmail3" class="col-sm-4 control-label">
													Satuan Pekerjaan
												</label>
												<div class="col-sm-8">
													<select tabindex="2" name="satuan" class="form-control" required>
													<option></option>>
														<?php
															$sql = "select * from satuan order by id_satuan asc";
															if($res = $mysqli->query($sql)){
																while($obj=$res->fetch_object()){
																	if($satuan==$obj->id_satuan){
 																		echo "<option value='".$obj->id_satuan."' selected>".$obj->satuan."</option>";
																	}else{
																		echo "<option value='".$obj->id_satuan."'>".$obj->satuan."</option>";	
																	}
																	
																}
															}
														?>						
													</select>
												</div>
											</div>


											<div class="form-group">
												<label for="inputEmail3" class="col-sm-4 control-label">
													Satuan Waktu Pelaksanaan Kegiatan
												</label>
												<div class="col-sm-8">
													<select tabindex="2" name="waktu" class="form-control" required>
													<option></option>>
														<?php
															$sql = "select * from satwaktu order by id_satuan_waktu asc";
															if($res = $mysqli->query($sql)){
																while($obj=$res->fetch_object()){
																	if($waktu==$obj->id_satuan_waktu){
																		echo "<option value='".$obj->id_satuan_waktu."' selected>".$obj->waktu."</option>";
																	}else{
																		echo "<option value='".$obj->id_satuan_waktu."'>".$obj->waktu."</option>";
																	}
																	
																}
															}
														?>						
													</select>
												</div>
											</div>

											<div class="form-group">
												<label for="inputEmail3" class="col-sm-4 control-label">
													Angka Kredit per Satuan Pekerjaan
												</label>
												<div class="col-sm-8">
													<select tabindex="2" name="angkred" class="form-control" >
														<option></option>>
														<?php
															$sql = "select * from fungsional order by id_fungsional asc";
															if($res = $mysqli->query($sql)){
																while($obj=$res->fetch_object()){
																	if($obj->id_fungsional==$angkred){
																		echo "<option value='".$obj->id_fungsional."' selected>".$obj->kode_perka." - ".$obj->uraian_singkat."</option>";
																	}else{
																		echo "<option value='".$obj->id_fungsional."'>".$obj->kode_perka." - ".$obj->uraian_singkat."</option>";
																	}
																}
															}
														?>						
													</select>
												</div>
											</div>



											<div class="form-group">
												<div class="col-sm-offset-2 col-sm-8">											 
													<button id="edit" type="sumbit" name="edit" class="btn btn-primary"><image src="../images/icon-plus.png"> TAMBAH</button>
												</div>
											</div>

										</form>
			            			</td>
			            		</tr>
			            	</table>
			            </div>
			        </td>
			    </tr>
			</table>


        </div>
    </div>
</div>