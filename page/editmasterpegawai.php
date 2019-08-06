<?php
	session_start();
	include "../function/db.php";
	if(isset($_POST['submit'])){
		if($_SESSION['level_user']==2){
			$q="update jabatan_pegawai set id_jabatan=".$_POST['seksi'].",eselon=".$_POST['jabatan'].",wilker=".$_POST['wilker']."  where id_pegawai='".$_POST['id']."'";
		}else{
			$q="update jabatan_pegawai set id_jabatan=".$_POST['seksi'].",eselon=".$_POST['jabatan']." where id_pegawai='".$_POST['id']."'";
		}
		//echo $q;
		if ($result = $mysqli->query($q)) { 
			echo "<script> location.replace('../dev3/?page=masterpegawai'); </script>";
		}
	}
?>