<?php
	include "db.php";
	if(isset($_POST['tambah_btn'])){
		$q = "insert into kegiatanharian values('','".$_GET['tahun']."','".$_GET['bln']."','".$_GET['tanggal']."','".$_GET['id']."','".$_POST['seksi']."','".$_POST['id_keg']."','".$_SESSION['eselon']."','".$_POST['uraian']."','".$_POST['dl']."','".$_SESSION['id']."')";
		if($re = $mysqli->query($q)){
			echo "$q";
		}else{
			echo "ggl";
		}
	}
?>