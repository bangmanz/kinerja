<?php
	if(isset($_POST['btn-login'])){
		$username = trim($_POST['username']);
		$password = trim($_POST['password']);
		$kode_error = 1;
		$sql = "select * from pegawai p, jabatan j, level_user l, jabatan_pegawai jp where p.id=jp.id_pegawai and j.id_jabatan=jp.id_jabatan and username='".$username."' and  password='".$password."' and p.level_user=l.id_level_user";
		//echo $sql;
		if($result=$mysqli->query($sql)){
			while($ob=$result->fetch_object()){
				$_SESSION['username'] = $ob->username;
				$_SESSION['id'] = $ob->id;
				$_SESSION['nama'] = $ob->nama;
				$_SESSION['id_jabatan'] = $ob->id_jabatan;
				$_SESSION['jabatan'] = $ob->jabatan;
				$_SESSION['bidang'] = $ob->bidang;
				$_SESSION['eselon'] = $ob->eselon;
				$_SESSION['level_wilayah'] = $ob->level_wilayah;
				$_SESSION['level_jabatan'] = $ob->level_jabatan;
				$_SESSION['level_user'] = $ob->level_user;
				$_SESSION['wilker'] = $ob->wilker;
				echo "<script> location.replace('?page=home'); </script>";
				//header("Location:?page=home");
			}
			$kode_error = 1;
		}
	}
?>
<div class="container">    
	<div id="loginbox" style="margin-top:50px;" class="mainbox col-md-6 col-md-offset-3 col-sm-8 col-sm-offset-2">                    
		<div class="panel panel-info" >
			<div class="panel-heading">
				<div class="panel-title">Sign In</div>
				<div style="float:right; font-size: 80%; position: relative; top:-10px"><a href="#"></a></div>
			</div>     

			<div style="padding-top:30px" class="panel-body" >
				<div id="error">
				<?php 
					if(isset($kode_error)){
						if($kode_error==1){
							echo "<label>username atau password salah<label>";
						}
					} 
				?>
				</div>
				<div style="display:none" id="login-alert" class="alert alert-danger col-sm-12"></div>
				
				<form class="form-signin" method="post" id="login-form">														
					<div style="margin-bottom: 25px" class="input-group">
						<span class="input-group-addon"><i class="glyphicon glyphicon-user"></i></span>
						<input required="required" id="login-username" type="text" class="form-control" name="username" value="" placeholder="username">                                        
					</div>
						
					<div style="margin-bottom: 25px" class="input-group">
						<span class="input-group-addon"><i class="glyphicon glyphicon-lock"></i></span>
						<input required="required" id="login-password" type="password" class="form-control" name="password" placeholder="password">
					</div>
													
					<div style="margin-top:10px" class="form-group">
						<!-- Button -->
						<div class="col-sm-12 controls">
						  <!--<a id="btn-login" href="#" class="btn btn-success">Login  </a>-->
						  <button type="Submit"  name="btn-login" id="btn-login" value="Login" class="btn btn-success">Login</button>
						</div>
					</div>  
				</form>     
			</div>                     
		</div>  
	</div>
</div>

