<?php
	if(isset($_POST['tambah'])){
		$sql = "insert into m_kode_kegiatan values('','".$_POST['seksi']."','".strtoupper($_POST['kode'])."','".$_POST['uraian']."','1')";
		//echo $sql;
		if($a=$mysqli->query($sql)){
			echo "<script> location.replace('?page=masterkodedl'); </script>";
		}
	}
?>
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
	<h2>Master Kode Dinas Luar</h2>			
	<table	class="table	table-unbordered">
		<tr>
			<td colspan="4">
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
			<th>Kode Kegiatan</th>
			<th>Keterangan Kegiatan</th>
			<th>Aktif</th>
			<!--<th>Edit</th>
			<th>Delete</th>-->
		</thead>
		<tr>
			<td><strong>1</strong></td>
			<td colspan="4"><strong>TATA USAHA</strong></td>
		</tr>
		<?php
			$s1 = "select * from m_kode_kegiatan where kode_seksi=1 order by kode_kegiatan";
			if($re1=$mysqli->query($s1)){
				while($r1=$re1->fetch_object()){
		?>
		<tr>
			<td></td>
			<td><?php echo namaseksi($r1->kode_seksi); ?></td>
			<td><?php echo $r1->kode_kegiatan; ?></td>
			<td><?php echo $r1->keterangan; ?></td>
			<td align="center"><?php if($r1->stat==1){echo "<img src='../images/v.png'>";}else{echo "<img src='../images/x.gif'>";} ?></td>
			<!--<td align="center"><img src='images/edit.png'></td>
			<td align="center"><img src='images/del.png'></td>-->
		<tr>
		<?php }} ?>
		<tr>
			<td><strong>2</strong></td>
			<td colspan="4"><strong>SOSIAL</strong></td>
		</tr>
		<?php
			$s1 = "select * from m_kode_kegiatan where kode_seksi=2 order by kode_kegiatan";
			if($re1=$mysqli->query($s1)){
				while($r1=$re1->fetch_object()){
		?>
		<tr>
			<td></td>
			<td><?php echo namaseksi($r1->kode_seksi); ?></td>
			<td><?php echo $r1->kode_kegiatan; ?></td>
			<td><?php echo $r1->keterangan; ?></td>
			<td align="center"><?php if($r1->stat==1){echo "<img src='../images/v.png'>";}else{echo "<img src='../images/x.gif'>";} ?></td>
			<!--<td align="center"><img src='images/edit.png'></td>
			<td align="center"><img src='images/del.png'></td>-->
		<tr>
		<?php }} ?>
		<tr>
			<td><strong>3</strong></td>
			<td colspan="4"><strong>PRODUKSI</strong></td>
		</tr>
		<?php
			$s1 = "select * from m_kode_kegiatan where kode_seksi=3 order by kode_kegiatan";
			if($re1=$mysqli->query($s1)){
				while($r1=$re1->fetch_object()){
		?>
		<tr>
			<td></td>
			<td><?php echo namaseksi($r1->kode_seksi); ?></td>
			<td><?php echo $r1->kode_kegiatan; ?></td>
			<td><?php echo $r1->keterangan; ?></td>
			<td align="center"><?php if($r1->stat==1){echo "<img src='../images/v.png'>";}else{echo "<img src='../images/x.gif'>";} ?></td>
			<!--<td align="center"><img src='images/edit.png'></td>
			<td align="center"><img src='images/del.png'></td>-->
		<tr>
		<?php }} ?>
		<tr>
			<td><strong>4</strong></td>
			<td colspan="4"><strong>DISTRUBUSI</strong></td>
		</tr>
		<?php
			$s1 = "select * from m_kode_kegiatan where kode_seksi=4 order by kode_kegiatan";
			if($re1=$mysqli->query($s1)){
				while($r1=$re1->fetch_object()){
		?>
		<tr>
			<td></td>
			<td><?php echo namaseksi($r1->kode_seksi); ?></td>
			<td><?php echo $r1->kode_kegiatan; ?></td>
			<td><?php echo $r1->keterangan; ?></td>
			<td align="center"><?php if($r1->stat==1){echo "<img src='../images/v.png'>";}else{echo "<img src='../images/x.gif'>";} ?></td>
			<!--<td align="center"><img src='images/edit.png'></td>
			<td align="center"><img src='images/del.png'></td>-->
		<tr>
		<?php }} ?>
		<tr>
			<td><strong>5</strong></td>
			<td colspan="4"><strong>NERACA</strong></td>
			<?php
			$s1 = "select * from m_kode_kegiatan where kode_seksi=5 order by kode_kegiatan";
			if($re1=$mysqli->query($s1)){
				while($r1=$re1->fetch_object()){
		?>
		<tr>
			<td></td>
			<td><?php echo namaseksi($r1->kode_seksi); ?></td>
			<td><?php echo $r1->kode_kegiatan; ?></td>
			<td><?php echo $r1->keterangan; ?></td>
			<td align="center"><?php if($r1->stat==1){echo "<img src='../images/v.png'>";}else{echo "<img src='../images/x.gif'>";} ?></td>
			<!--<td align="center"><img src='images/edit.png'></td>
			<td align="center"><img src='images/del.png'></td>-->
		<tr>
		<?php }} ?>
		</tr>
		<tr>
			<td><strong>6</strong></td>
			<td colspan="4"><strong>IPDS</strong></td>
		</tr>
		<?php
			$s1 = "select * from m_kode_kegiatan where kode_seksi=6 order by kode_kegiatan";
			if($re1=$mysqli->query($s1)){
				while($r1=$re1->fetch_object()){
		?>
		<tr>
			<td></td>
			<td><?php echo namaseksi($r1->kode_seksi); ?></td>
			<td><?php echo $r1->kode_kegiatan; ?></td>
			<td><?php echo $r1->keterangan; ?></td>
			<td align="center"><?php if($r1->stat==1){echo "<img src='../images/v.png'>";}else{echo "<img src='../images/x.gif'>";} ?></td>
			<!--<td align="center"><img src='images/edit.png'></td>
			<td align="center"><img src='images/del.png'></td>-->
		<tr>
		<?php }} ?>
	</table>	
	
	<?php if($_SESSION['level_user']>1 && $_SESSION['level_user']<6){?>	
	<table	id="mytable2"	class="table table-borderless">
		<tr  data-toggle="collapse" data-target=".demo1">
			<td colspan="4">
			<div align="right">
				<button class="btn btn-primary">Tambah Kode</button>
			</div>
			</td>
		</tr>
		<tr>
	        <td class="hiddenRow" colspan="4">
	            <div class="collapse demo1">
	            	<table	id="mytable3" class="table table-bordered">
	            		<tr>
	            			<td>
	            				<form class="form-horizontal" role="form" action="?page=masterkodedl" method="post">
									<div class="form-group">
										<label for="inputEmail3" class="col-sm-2 control-label">
											Kode Bidang/Seksi
										</label>
										<div class="col-sm-10">
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
										<label for="inputEmail3" class="col-sm-2 control-label">
											Kode Kegiatan
										</label>
										<div class="col-sm-10">
											<input placeholder="Kode Kegiatan..." id='kode' required name='kode' type='text' class='form-control input-md'>
											<span class="help-block">*) Tuliskan kode kegiatan, Maks 5 huruf kapital, Jangan memakai tanda strip (-)</span>
										</div>
									</div>

									<div class="form-group">
										<label for="inputEmail3" class="col-sm-2 control-label">
											Uraian Pekerjaan
										</label>
										<div class="col-sm-10">
											<input placeholder="Uraian Kegiatan..." id='uraian' required name='uraian' type='text' class='form-control input-md'>
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
</div>
<script src="js/jquery.min.js" type="text/javascript"></script>
