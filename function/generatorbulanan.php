<?php
	include "db.php";
	if(isset($_GET['tahun']) && isset($_GET['bulan'])){
		if(isset($_GET['id'])){
			$sq = "insert into harian (id,tahun,bulan) values('".$_GET['id']."','".$_GET['tahun']."','".$_GET['bulan']."')";
			echo $sq."<br>";
			$rt = $mysqli->query($sq);
			echo $rt;
		}else if(!isset($_GET['id'])){
			$sql2="SELECT * FROM `pegawai`";
			if ($result2 = $mysqli->query($sql2)) { 
				while($obj2 = $result2->fetch_object()){	
					$sq = "insert into harian (id,tahun,bulan) values('".$obj2->id."','".$_GET['tahun']."','".$_GET['bulan']."')";
					echo $sq."<br>";
					$rt = $mysqli->query($sq);
					echo $rt;
				}
			}
		}
	}
?>