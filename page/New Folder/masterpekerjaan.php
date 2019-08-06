<?php
	if(isset($_POST['tambah'])){
		$sql = "insert into masterkegiatan values('',".$_POST['seksi'].",'',4,".$_POST['parent'].",".$_POST['satuan'].",".$_POST['waktu'].",".$_POST['angkred'].",'','".$_POST['uraian']."','".$_SESSION['id']."','','')";
//		echo $sql;
		if($a=$mysqli->query($sql)){
			echo "<script> location.replace('?page=masterpekerjaan'); </script>";
		}
	}
	if(isset($_GET['action'])){
		if($_GET['action']=="hapus"){
			$dddd = "delete from masterkegiatan where id_keg=".$_GET['id'];
			echo $dddd;
			if($rr=$mysqli->query($dddd)){
		    	echo "<script> location.replace('?page=masterpekerjaan'); </script>";
			}
		}		
	}
	if(isset($_POST['edit_pekerjaan'])){
		$sql = "update masterkegiatan set eselon=".$_POST['eselon'].", uraian='".$_POST['uraian']."' where id_keg=".$_POST['id_keg']."";
		if($a=$mysqli->query($sql)){
			echo "<script> location.replace('?page=masterpekerjaan'); </script>";
		}
	}
?>
<div	id="ModalEdit"	class="modal	fade"	tabindex="-1"	role="dialog"	aria-labelledby="myModalLabel"	aria-hidden="true">

</div>
<!--	Javascript	untuk	popup	modal	Edit-->	
<script	type="text/javascript">
	$(document).ready(function	()	{
		$(".open_modal").click(function(e)	{
			var	m	=	$(this).attr("id");
			$.ajax({
				url:	"page/modal_edit.php",
				type:	"GET",
				data	:	{modal_id:	m,},
				success:	function	(ajaxData){
					$("#ModalEdit").html(ajaxData);
					$("#ModalEdit").modal('show',{backdrop:	'true'});
				}
			});
		});
	});
</script>
<style>
.hiddenRosw {
    padding: 0 !important;
}
</style>
<script type="text/javascript">
	$('.collapse').on('show.bs.collapse', function () {
    $('.collapse.in').collapse('hide');
});
</script>
<script type="text/javascript">
    $(document).ready(function () {
        $('#search').keyup(function () {
            searchTable($(this).val());
        });
    });
    function searchTable(inputVal) {
        var table = $('#mytable');
        table.find('tr').each(function (index, row) {
            var allCells = $(row).find('td');
            if (allCells.length > 0) {
                var found = false;
                allCells.each(function (index, td) {
                    var regExp = new RegExp(inputVal, 'i');
                    if (regExp.test($(td).text())) {
                        found = true;
                        return false;
                    }
                });
                if (found == true)
                    $(row).show();
                else
                    $(row).hide();
            }
        });
    }
</script>
<script src="js/jquery.tablessorter.min.js"></script>
<link href="css/theme.blue.css" rel="stylesheet">

<div class="container">
	<h2>Master Pekerjaan</h2>			
	<?php if($_SESSION['level_user']>1 && $_SESSION['level_user']<6){?>	
	<table	id="mytable2"	class="table table-borderless">
		<tr  data-toggle="collapse" data-target=".demo1">
			<td colspan="6">
			<div align="right">
				<button class="btn btn-primary">Tambah Master Pekerjaan</button>
			</div>
			</td>
		</tr>
		<tr>
	        <td class="hiddenRow" colspan="6">
	            <div class="collapse demo1">
	            	<table	id="mytable3" class="table table-bordered">
	            		<tr>
	            			<td>
	            				<form class="form-horizontal" role="form" action="?page=masterpekerjaan" method="post">
									<div class="form-group">
										<label for="inputEmail3" class="col-sm-2 control-label">
											Kode Bidang/Seksi
										</label>
										<div class="col-sm-10">
											<select data-placeholder="Pilih Seksi..." tabindex="2" name="seksi" class="form-control" required>
												<?php
													/*if($_SESSION['level_user']==3){
														echo "
															<option></option>
															<option value='1'>Tata Usaha</option>
															<option value='2'>Sosial</option>
															<option value='3'>Produksi</option>
															<option value='4'>Distribusi</option>
															<option value='5'>Neraca</option>
															<option value='6'>IPDS</option>
															<option value='7'>Umum</option>";												
													}else
													 */
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
										<label for="inputEmail3" class="col-sm-2 control-label">
											Komponen Kegiatan
										</label>
										<div class="col-sm-10">
											<select tabindex="2" name="parent" class="form-control  chosen-select" required>
											<option></option>>
												<?php
													$sql = "select * from masterkegiatan where level=0";
													if($res = $mysqli->query($sql)){
														while($obj=$res->fetch_object()){
															echo "<option value='".$obj->id_keg."'>".$obj->uraian."</option>";
														}
													}
												?>						
											</select>
										</div>
									</div>

									<div class="form-group">
										<label for="inputEmail3" class="col-sm-2 control-label">
											Uraian Pekerjaan
										</label>
										<div class="col-sm-10">
											<input placeholder="Nama Pekerjaan..." id='uraian' required name='uraian' type='text' class='form-control input-md'>
										</div>
									</div>


									<div class="form-group">
										<label for="inputEmail3" class="col-sm-2 control-label">
											Satuan Pekerjaan
										</label>
										<div class="col-sm-10">
											<select tabindex="2" name="satuan" class="form-control" required>
											<option></option>>
												<?php
													$sql = "select * from satuan order by id_satuan asc";
													if($res = $mysqli->query($sql)){
														while($obj=$res->fetch_object()){
															echo "<option value='".$obj->id_satuan."'>".$obj->satuan."</option>";
														}
													}
												?>						
											</select>
										</div>
									</div>


									<div class="form-group">
										<label for="inputEmail3" class="col-sm-2 control-label">
											Satuan Waktu Pelaksanaan Kegiatan
										</label>
										<div class="col-sm-10">
											<select tabindex="2" name="waktu" class="form-control" required>
											<option></option>>
												<?php
													$sql = "select * from satwaktu order by id_satuan_waktu asc";
													if($res = $mysqli->query($sql)){
														while($obj=$res->fetch_object()){
															echo "<option value='".$obj->id_satuan_waktu."'>".$obj->waktu."</option>";
														}
													}
												?>						
											</select>
										</div>
									</div>

									<div class="form-group">
										<label for="inputEmail3" class="col-sm-2 control-label">
											Angka Kredit per Satuan Pekerjaan
										</label>
										<div class="col-sm-10">
											<input type="number" name="angkred" step="0.001" class="form-control" value="" required placeholder="Isikan Perkiraan Angka Kredit.."/>
										</div>
									</div>



									<div class="form-group">
										<div class="col-sm-offset-2 col-sm-10">											 
											<button id="tambah" type="sumbit" name="tambah" class="btn btn-primary"><image src="images/icon-plus.png"> TAMBAH</button>
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
	<?php }?>



	<table	class="table	table-unbordered">
		<tr>
			<td colspan="6">
			<div align="left">
				<strong>Search : </strong><input align="left" type="text" id="search" class='form-control input-md'>
			</div>
			</td>
		</tr>
	</table>

	<table	id="mytable"	class="table	table-bordered">
		<thead style="background: #cccccc;">
			<th>No</th>
			<th>Bidang/Seksi</th>
			<th>Komponen/Uraian Tugas Jabatan</th>
			<th>Satuan</th>
			<th>Waktu</th>
			<th>Angka Kredit</th>
			<th>Edit</th>
			<th>Delete</th>
		</thead>
	<?php	
		$no	=	0;
		$sqqc = "select * from masterkegiatan where  level=0 order by kode_kegiatan";
		if($ress=$mysqli->query($sqqc)){
			while($r=$ress->fetch_object()){
				$no++;							
	?>
		<tr>
			<td><strong><?php echo $no;	?></strong></td>
			<td colspan="5"><?php echo "<strong>".$r->kode_kegiatan." - ".$r->uraian."</strong>";	?></td>			

			<?php			
				if($_SESSION['level_user']==3 || $_SESSION['level_user']==2){
					echo "
							<td><a id='".$r->id_keg."' class='open_modal' href='#'><img src='images/edit.png'></a></td>
							<td><a href='?page=masterpekerjaan&action=hapus&id=".$r->id_keg."' onclick='return confirm(\"Are you sure you want to delete this item?\");'><img src='images/del.png'></a></td></tr>";
				}else{
					echo "<td></td><td></td></tr>";
				}
				

				$urut=1;
				$sqqq = "select * from masterkegiatan m, satuan s, satwaktu w where s.id_satuan=m.id_satuan and w.id_satuan_waktu=m.id_satuan_waktu and level=4 and approved=1 and parent=".$r->id_keg;
				if($ressqqq=$mysqli->query($sqqq)){
					while($rqqq=$ressqqq->fetch_object()){
						echo "<tr><td></td><td>".namaseksi($rqqq->kode_seksi)."</td><td>___".$rqqq->uraian."</td>";
						echo "<td>".$rqqq->satuan."</td><td>".$rqqq->waktu."</td><td align='right'>".$rqqq->angkred."</td>";
						if($_SESSION['level_user']==5){
							if($rqqq->kode_seksi==$_SESSION['bidang'] && $_SESSION['wilker']==$rqqq->insert_by){
								echo "
									<td><a id='".$rqqq->id_keg."' class='open_modal' href='#'><img src='images/edit.png'></a></td>
									<td><a href='?page=masterpekerjaan&action=hapus&id=".$rqqq->id_keg."' onclick='return confirm(\"Are you sure you want to delete this item?\");'><img src='images/del.png'></a></td>
								</tr>";
							}else{
								echo "<td></td><td></td>";							
							}			
						}else if($_SESSION['level_user']==4){
							if($rqqq->kode_seksi==$_SESSION['bidang']){
								echo "
									<td><a id='".$rqqq->id_keg."' class='open_modal' href='#'><img src='images/edit.png'></a></td>
									<td><a href='?page=masterpekerjaan&action=hapus&id=".$rqqq->id_keg."' onclick='return confirm(\"Are you sure you want to delete this item?\");'><img src='images/del.png'></a></td>
								</tr>";
							}else{
								echo "<td></td><td></td>";							
							}	
						}else if($_SESSION['level_user']==3 || $_SESSION['level_user']==2){
							echo "
								<td><a id='".$rqqq->id_keg."' class='open_modal' href='#'><img src='images/edit.png'></a></td>
								<td><a href='?page=masterpekerjaan&action=hapus&id=".$rqqq->id_keg."' onclick='return confirm(\"Are you sure you want to delete this item?\");'><img src='images/del.png'></a></td></tr>";
						}else{
							echo "<td></td><td></td></tr>";
						}
					}
				}
			}
		}	
	?>
	</table>	
</div>

<link rel="stylesheet" href="css/chosen.css">
<script src="js/jquery.min.js" type="text/javascript"></script>
<script src="js/chosen.jquery.js" type="text/javascript"></script>
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