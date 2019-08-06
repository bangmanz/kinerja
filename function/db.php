<?php
$mysqli = new mysqli("localhost", "root", "", "kinerja2");
	if ($mysqli->connect_errno) {
		printf("Connect failed: %s\n", $mysqli->connect_error);
		exit();
	}
?>