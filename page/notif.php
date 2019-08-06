<div class="container">
<h2>Pemberitahuan </h2>				
<table	id="mytable"	class="table table-bordered">
	<thead  style="background: #cccccc;">
		<th>No</th>
		<th>Tanggal</th>
		<th>Isi Pemberitahuan</th>
		<th>Status</th>
	</thead>
<?php	
	$no	=	0;
	$sqqc = "select * from notifikasi where id_pegawai='".$_SESSION['id']."' order by baca asc, tanggal desc ";
	if($ress=$mysqli->query($sqqc)){
		while($r=$ress->fetch_object()){
			$no++;							
			echo "
			<tr>
				<td>".$no."</td>
				<td>".$r->tanggal."</td>
				<td>".$r->uraian_notif."</td>";
			if($r->baca==0){
				echo "<td><img src='images/new.gif'></td>";
			}else{
				echo "<td></td>";
			}
			echo "</tr>";
		}
	}	
?>
</table>
</div>
<?php
	$sqc = "update notifikasi set baca=1 where baca=0 and id_pegawai='".$_SESSION['id']."'";
	$mysqli->query($sqc);
?>
