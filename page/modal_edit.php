<?php
    include "../function/db.php";
    include "../function/func.php";
	$modal_id=$_GET['modal_id'];
	$q1="SELECT * FROM masterkegiatan WHERE id_keg='$modal_id'";
	if($re=$mysqli->query($q1)){
		while($r=$re->fetch_object()){
?>
<div class="modal-dialog">
    <div class="modal-content">

    	<div class="modal-header">
            <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
            <h4 class="modal-title" id="myModalLabel">Edit Master Pekerjaan</h4>
        </div>

        <div class="modal-body">
        	<form action="?page=masterpekerjaan" name="modal_popup" enctype="multipart/form-data" method="POST">
        		
                <div class="form-group" style="padding-bottom: 20px;">
                	<label for="Modal Name">Seksi</label>
                    <input type="hidden" name="id_keg"  class="form-control" value="<?php echo $r->id_keg; ?>" />
     				<input type="text" name="seksi"  class="form-control" value="<?php echo namaseksi($r->kode_seksi); ?>" disabled/>
                </div>

                <div class="form-group" style="padding-bottom: 20px;">
                	<label for="Description">Eselon</label>
					<select data-placeholder="Pilih Eselon..." tabindex="2" name="eselon" class="form-control" required>
						<option <?php if($r->eselon==3){echo "selected";}?> value="3">Eselon 3</option>
						<option <?php if($r->eselon==4){echo "selected";}?> value="4">Eselon 4</option>
						<option <?php if($r->eselon==9){echo "selected";}?> value="9">Staff/KSK</option>
					</select>
                </div>

                <div class="form-group" style="padding-bottom: 20px;">
                	<label for="Date">Nama Kegiatan</label>       
     				<input type="text" name="uraian"  class="form-control" value="<?php echo $r->uraian; ?>" required/>
                </div>

	            <div class="modal-footer">
	                <button class="btn btn-success" type="submit" name="edit_pekerjaan">
	                    Confirm
	                </button>

	                <button type="reset" class="btn btn-danger"  data-dismiss="modal" aria-hidden="true">
	               		Cancel
	                </button>
	            </div>

            	</form>

		<?php }} ?>

            </div>

           
        </div>
    </div>