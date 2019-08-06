<?php
include "db.php";
$sql = "select * from pegawai";
if($res = $mysqli->query($sql)){
	while($obj=$res->fetch_object()){
		echo "<img src='https://community.bps.go.id/images/avatar/".substr($obj->id,4,5).".JPG'>";
		echo "<img src='https://community.bps.go.id/images/avatar/".substr($obj->id,4,5).".jpg'>";
	}
}
?>