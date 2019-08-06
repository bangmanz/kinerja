<div class="container">
<h2>Master Pegawai</h2>			
<table	class="table	table-unbordered">
	<tr>
		<td colspan="6">
		<div align="left">
			<strong>Search : </strong><input align="left" type="text" id="search" class='form-control input-md'>
		</div>
		</td>
	</tr>
</table>	
<?php
if($_SESSION['level_user']==2){ ?>
<table	id="mytable2"	class="table table-borderless">
	<tr  data-toggle="collapse" data-target=".demo1">
		<td colspan="6">
		<div align="right">
			<a href="#" class='open_modal2'><button class="btn btn-primary" >Tambah Pegawai</button></a>
		</div>
		</td>
	</tr>
</table>
<?php } ?>
<table	id="mytable"	class="table table-bordered">
	<thead  style="background: #cccccc;">
		<th>No</th>
		<th>NIP</th>
		<th>Nama</th>
		<th>Jabatan</th>
		<th>Wilayah Kerja</th>
		<th>Edit</th>
		<th>Hapus</th>
	</thead>
<?php	
	$no	=	0;
	$sqqc = "";
	if($_SESSION['level_user']<=2){
		$sqqc = "select * from pegawai p, jabatan j, jabatan_pegawai jp 
		where p.id=jp.id_pegawai and j.id_jabatan=jp.id_jabatan order by wilker, bidang, eselon, j.id_jabatan, nama";	
	}else{
		$sqqc = "select * from pegawai p, jabatan j, jabatan_pegawai jp 
		where p.id=jp.id_pegawai and j.id_jabatan=jp.id_jabatan and jp.wilker=".$_SESSION['wilker']." order by wilker, bidang, eselon, j.id_jabatan, nama";
	}
	if($ress=$mysqli->query($sqqc)){
		while($r=$ress->fetch_object()){
			$no++;		
			$id=$r->id;
?>
			<tr>
				<td><?php	echo		$no;	?></td>
				<td><?php	echo		$r->id;	?></td>
				<td><?php	echo		$r->nama;	?></td>
				<td><?php	if($r->eselon<6){echo "Kepala ";}else if($r->eselon==6){echo "Staff ";}
							echo		$r->jabatan;	?></td>
				<td><?php	echo		$r->wilker;	?></td>
				<td><a href="#" class='open_modal'	id='<?php echo $r->id;	?>'><img src='../images/edit.png'></a></td>
				<td><a onclick='return confirm(\"Are you sure you want to delete this item?\");' href="../page/add_master_pegawai.php?act=del&id=<?php echo $id; ?>"> <img src='../images/del.png'></a></td>
								
			</tr>
		

<?php	}}	?>
</table>
</div>

<!--	Modal	Popup	untuk	Edit-->	
<div	id="ModalEdit"	class="modal fade"	tabindex="-1"	role="dialog"	aria-labelledby="myModalLabel"	aria-hidden="true">

</div>

<!--	Modal	Popup	untuk	delete-->	
<div	class="modal	fade"	id="modal_delete">
	<div	class="modal-dialog">
		<div	class="modal-content"	style="margin-top:100px;">
			<div	class="modal-header">
				<button	type="button"	class="close"	data-dismiss="modal"	aria-hidden="true">&times;</button>
				<h4	class="modal-title"	style="text-align:center;">Are	you	sure	to	delete	this	information	?</h4>
			</div>
													
			<div	class="modal-footer"	style="margin:0px;	border-top:0px;	text-align:center;">
				<a	href="#"	class="btn	btn-danger"	id="delete_link">Delete</a>
				<button	type="button"	class="btn	btn-success"	data-dismiss="modal">Cancel</button>
			</div>
		</div>
	</div>
</div>

<!--	Javascript	untuk	popup	modal	Edit-->	
<script	type="text/javascript">
	$(document).ready(function	()	{
	$(".open_modal").click(function(e)	{
		var	m	=	$(this).attr("id");
		$.ajax({
			url:	"../page/modal_edit_master_pegawai.php",
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
<script	type="text/javascript">
	$(document).ready(function	()	{
	$(".open_modal2").click(function(e)	{
		var	m	=	$(this).attr("id");
		$.ajax({
			url:	"../page/add_master_pegawai.php",
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