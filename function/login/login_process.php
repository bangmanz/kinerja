<?php
session_start();
require_once 'function/db.php';
if(isset($_POST['btn-login'])){
	$username = trim($_POST['username']);
	$password = trim($_POST['password']);
	$jm = 0;

	$sql = "SELECT * FROM user WHERE username='".$username."'";
	if($result=$mysqli->query($sql)){
		while($ob=$result->fetch_object()){
			$a = $ob->username;
			$b = $ob->password;
			$jm = 1;
		}
	}
	if($jm==0){
		echo "email or password does not exist."; // wrong details 	
	}else if($b==$password){
		echo "ok";
	}
}
?>