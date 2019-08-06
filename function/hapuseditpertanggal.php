<?php
	include "db.php";

	$aa="t".$_GET['tanggal'];
	$ss1 = "select * from harian where id='".$_GET['id']."' and tahun='".$_GET['tahun']."' and bulan='".$_GET['bln']."'"; 
	if($ress1 = $mysqli->query($ss1)){
		while($resss1=$ress1->fetch_object()){
			$harian=$resss1->$aa;
		}
	}
	$seksi='';
	$ss = "select * from kegiatanharian where id_keg_harian=".$_GET['idkeg']; 
	if($ress = $mysqli->query($ss)){
		while($resss=$ress->fetch_object()){
			if($resss->dinasluar==1){
				$harian=str_replace('+', '', $harian);
			}
			$seksi=$resss->kode_seksi;
		}
	}

	if($seksi==1){
		$hurufseksi="T";
	}else if($seksi==2){
		$hurufseksi="S";
	}else if($seksi==3){
		$hurufseksi="P";
	}else if($seksi==4){
		$hurufseksi="D";
	}else if($seksi==5){
		$hurufseksi="N";
	}else if($seksi==6){
		$hurufseksi="I";
	}

	$s = "select * from kegiatanharian where id='".$_GET['id']."' and tahun='".$_GET['tahun']."' and bln='".$_GET['bln']."' and tanggal='".$_GET['tanggal']."' and kode_seksi='".$seksi."'";
	echo $s."<br>";
	if($rs=$mysqli->query($s)){
		if(mysqli_num_rows($rs)==1){
			echo "<br>".$harian."<br>";
			$harian=str_replace($hurufseksi, '', $harian);				
		}
	}

	$sql="delete from kegiatanharian where id_keg_harian=".$_GET['idkeg'];
	if($res = $mysqli->query($sql)){
		$updt="update `harian` set `".$aa."`='".$harian."' where id='".$_GET['id']."' and tahun='".$_GET['tahun']."' and bulan='".$_GET['bln']."'";
		echo $updt;
		$mysqli->query($updt);
	
	}else{
		echo "gak ada";
	}
	header("Location:../?page=editpertanggal&id=".$_GET['id']."&tahun=".$_GET['tahun']."&bln=".$_GET['bln']."&tanggal=".$_GET['tanggal']);
?>