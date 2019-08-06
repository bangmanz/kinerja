<?php
	session_start();
	include_once "../function/db.php";
	$aa = "select * from penugasan p, masterkegiatan m where p.id_keg=m.id_keg and p.kode_seksi=".$_GET['lv1']." and p.id_pegawai='".$_SESSION['id']."' and p.bulan='".$_SESSION['entrylaporanbulanan']."'";
//	$aa = "SELECT * FROM `masterkegiatan` where kode_seksi=".$_GET['lv1'];
	echo "<select>-pilih pekerjaan-</select>";
	if($tt=$mysqli->query($aa)){
		while($yy=$tt->fetch_object()){
			echo "<option value='".$yy->id_keg."'>".$yy->uraian."</option>";
		}		
	}
?>
