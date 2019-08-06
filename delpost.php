<?php
	session_start();
	include "function/db.php";
	if(isset($_GET['action'])){
		if($_GET['action']=='del'){
			$q="update harian set t".$_GET['tgl']."=NULL where tahun='".$_GET['thn']."' and bulan='".$_GET['bln']."' and id='".$_GET['id']."'";
			//echo $q;
			if ($result = $mysqli->query($q)) { 
				$r="delete from dinas_luar where id=".$_GET['id']." and thn='".$_GET['thn']."' and bln='".$_GET['bln']."' and tgl='".$_GET['tgl']."'";
				//echo $r;
				if ($result2 = $mysqli->query($r)) {
					echo "<script> location.replace('dev3/?page=pertanggal'); </script>";
				}
			}
		}
	}
	if(isset($_POST['submit'])){
		$arr=explode("-",$_POST['kode_keg']);
		$warna="";
		if($_POST['kode_seksi']=='1'){
			$warna = "#F6277F";
		}else if($_POST['kode_seksi']=='2'){
			$warna = "#3366ff";
		}else if($_POST['kode_seksi']=='3'){
			$warna = "#2eff00";
		}else if($_POST['kode_seksi']=='4'){
			$warna = "#ff6e00";
		}else if($_POST['kode_seksi']=='5'){
			$warna = "#ff0000";
		}else if($_POST['kode_seksi']=='6'){
			$warna = "#ffff00";
		} 
		
		$q="update harian set t".$_POST['tgl']."='".$warna."-".$arr[1]."' where tahun='".$_POST['thn']."' and id='".$_POST['id']."' and bulan='".$_POST['bln']."'";
		if ($result = $mysqli->query($q)) { 
			$r="insert into dinas_luar values('',".$_POST['id'].",'".$_POST['thn']."','".$_POST['bln']."','".$_POST['tgl']."',".$arr[0].",'".$_POST['insert_dl_by']."','".$_POST['ket']."')";
			//echo $r;
			if ($result2 = $mysqli->query($r)) {
				echo "<script> location.replace('dev3/?page=pertanggal'); </script>";
			}
		}
	}
?>
