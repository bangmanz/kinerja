
<?php
	if(isset($_POST['tambah'])){
		$sql = "insert into masterkegiatan values('',".$_POST['seksi'].",'',4,".$_POST['parent'].",".$_POST['satuan'].",".$_POST['waktu'].",".$_POST['angkred'].",'','".$_POST['uraian']."','".$_SESSION['id']."','','')";
//		echo $sql;
		if($a=$mysqli->query($sql)){
			echo "<script> location.replace('?page=usulanmasterpekerjaan'); </script>";
		}
	}
	
	if(isset($_POST['edit'])){
		$sql = "update masterkegiatan set kode_seksi=".$_POST['seksi']." , parent=".$_POST['parent']." , uraian='".$_POST['uraian']."' , id_satuan=".$_POST['satuan']."
		, id_satuan_waktu=".$_POST['waktu']." , angkred=".$_POST['angkred']." where id_keg=".$_POST['id_keg'];
		//echo $sql;
		if($a=$mysqli->query($sql)){
			echo "<script> location.replace('?page=usulanmasterpekerjaan'); </script>";
		}
	}
	
	if(isset($_GET['action'])){
		if($_GET['action']=="reject"){
			$dddd = "delete from masterkegiatan where id_keg=".$_GET['id'];
			$dd = "insert into notifikasi values('','".$_GET['ins']."','Usulan Master Pekerjaan Anda ditolak','".date('Y-m-d')."','0')";
			if($rr=$mysqli->query($dddd)){
				if($r=$mysqli->query($dd)){
					echo "<script> location.replace('?page=usulanmasterpekerjaan'); </script>";
				}
			}
		}else if($_GET['action']=="approve"){
			$dddd = "update masterkegiatan set approved='1' , approved_by='".$_SESSION['id']."' where id_keg='".$_GET['id']."'";
			$dd = "insert into notifikasi values('','".$_GET['ins']."','Usulan Master Pekerjaan Anda telah diapprove','".date('Y-m-d')."','0')";
			//echo $dddd;
			if($rr=$mysqli->query($dddd)){
				if($r=$mysqli->query($dd)){
                    echo "<script> location.replace('?page=usulanmasterpekerjaan'); </script>";
				}
			}
		}		
	}
?>

<!--	Javascript	untuk	popup	modal	Edit-->	
<link rel="stylesheet" href="css/tstyle.css" />
<script type="text/javascript" src="js/tinybox.js"></script>
<script	type="text/javascript">
	$(document).ready(function	()	{
		$(".open_modal").click(function(e)	{
			var	m	=	$(this).attr("id");
			$.ajax({
				url:	"../page/edit_usulan_pekerjaan.php",
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
<script src="../js/jquery.tablesorter.min.js"></script>
<link href="../css/theme.blue.css" rel="stylesheet">

<div class="container">
	<h2>Master Pekerjaan - Usulan - <?php echo namaseksi($_SESSION['bidang']);?></h2>			
	<table	class="table	table-unbordered">
		<tr>
			<td colspan="6">
			<div align="left">
				<strong>Search : </strong><input align="left" type="text" id="search" class='form-control input-md'>
			</div>
			</td>
		</tr>
	</table>
	<div	id="ModalEdit"	class="modal	fade"	tabindex="-1"	role="dialog"	aria-labelledby="myModalLabel"	aria-hidden="true"></div>

	<table	id="mytable"	class="table	table-bordered">
		<thead style="background: #cccccc;">
			<th>No</th>
			<th>Bidang/Seksi</th>
			<th>Komponen/Uraian Tugas Jabatan</th>
			<th>Satuan</th>
			<th>Waktu</th>
			<th>Angka Kredit</th>
			<th>Insert By</th>
			<th>Edit</th>
			<th>Setujui</th>
			<th>Tolak</th>
		</thead>
	<?php	
		$no	=	0;
		$sqqc = "select distinct m1.id_keg,m1.kode_kegiatan, m1.uraian from masterkegiatan_lvl1 m1, masterkegiatan mk where mk.parent=m1.id_keg and mk.approved=0";
		//$sqqc = "select * from masterkegiatan where  level=0 order by kode_kegiatan";
		if($ress=$mysqli->query($sqqc)){
			while($r=$ress->fetch_object()){
				$no++;							
	?>
		<tr>
			<td><strong><?php echo $no;	?></strong></td>
			<td colspan="5"><?php echo "<strong>".$r->kode_kegiatan." - ".$r->uraian."</strong>";	?></td>			

			<?php		
				echo "<td></td><td></td><td></td><td></td></tr>";
				$urut=1;
				$sqqq = "select * from masterkegiatan m, satuan s, satwaktu w, fungsional f, pegawai p where p.id=m.insert_by and m.angkred=f.id_fungsional and s.id_satuan=m.id_satuan and w.id_satuan_waktu=m.id_satuan_waktu and level=4 and approved=0 and parent=".$r->id_keg." ";
				
				//echo $sqqq."<br>";
				if($ressqqq=$mysqli->query($sqqq)){
					while($rqqq=$ressqqq->fetch_object()){
						echo "<tr><td></td><td>".namaseksi($rqqq->kode_seksi)."</td><td>___".$rqqq->uraian."</td>";
						echo "<td>".$rqqq->satuan."</td><td>".$rqqq->waktu."</td><td align='right'>".$rqqq->kode_perka."</td>";
						echo "<td>".$rqqq->username."</td>";
						
						if($_SESSION['level_user']<=4 && $_SESSION['level_wilayah']==2){
							if($rqqq->kode_seksi==$_SESSION['bidang']){
							    echo "<td><a id='".$rqqq->id_keg."' class='open_modal' href='#'><img src='../images/edit.png'></a></td>";
								echo "
									<td><a href='?page=usulanmasterpekerjaan&action=approve&id=".$rqqq->id_keg."&ins=".$rqqq->insert_by."' onclick='return confirm(\"Apakah anda yakin item ini disetujui?\");'><img src='../images/v.png'></a></td>
									<td><a href='?page=usulanmasterpekerjaan&action=reject&id=".$rqqq->id_keg."&ins=".$rqqq->insert_by."' onclick='return confirm(\"Apakah yakin item ini akan dihapus?\");'><img src='../images/x.gif'></a></td>
								</tr>";
							}else{
								echo "<td></td><td></td><td></td></tr>";							
							}	
						}else{
							echo "<td></td><td></td><td></td></tr>";
						}
					}
				}
			}
		}	
	?>
	</table>	
</div>

<link rel="stylesheet" href="../css/chosen.css">
<script src="../js/chosen.jquery.js" type="text/javascript"></script>
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