<?php
	session_start();
	if(isset($_POST['submit'])){
		include "function/func.php";
		include "function/db.php";
		$kab = "select * from pegawai where id=".$_POST['id'];
		if($kab2 = $mysqli->query($kab)){
			while($kab3 = $kab2->fetch_object()){
				if($kab3->password==$_POST['passlama']){
					$q = "update pegawai set password ='".$_POST['passbaru']."' where id=".$_POST['id'];
					if($qw = $mysqli->query($q)){
						echo "<script> location.replace('dev3/?page=home&alert=1'); </script>";
					}
				}else{
					echo "<script> location.replace('dev3/?page=home&alert=2'); </script>";
				}
			}
		}
	}else{
?>
<link rel="stylesheet" href="css/style.css" />
<link rel="stylesheet" href="css/tstyle.css" />
<!--<h3>Daftar Pekerjaan</h3>-->
<div class="modal-dialog">
<div class="modal-content">

<div class="modal-header">
	<button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
	<h4 class="modal-title" id="myModalLabel">Ganti Password</h4>
</div>
<div class="modal-body">
<form action='../ganti.php' name='modal_popup' enctype='multipart/form-data' method='POST'>
<table class="table table-unbordered table-condensed">
	<thead>
	</thead>
	<tbody>
		<tr>
			<td>Password Lama </td>
			<td><input type='password' name='passlama' class='form-control' required></td>
			<input type='hidden' name='id' value='<?php echo $_SESSION['id'];?>'>
		</tr>		
		<tr>
			<td>Password Baru </td>
			<td><input type='password' name='passbaru' class='form-control' required></td>
		</tr>
		<tr><td></td><td align='right'><button class='btn btn-success' type='submit' name='submit'>
			Ganti
		</button></td></tr>
				
	</tbody>
</table>
</form>
</div></div></div>
<?php } ?>