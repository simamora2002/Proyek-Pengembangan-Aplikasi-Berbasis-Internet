<?php
session_start();
include 'dbconnect.php';
$alert = '';

if(isset($_SESSION['role'])){
	$role = $_SESSION['role'];

	if($role=='Admin'){
		header("location:admin");
	} else {
		header("location:user");
	}
	
}


if(isset($_POST['btn-login']))
{
 $email = mysqli_real_escape_string($conn,$_POST['email']);
 $password = mysqli_real_escape_string($conn,$_POST['password']);

 // menyeleksi data user dengan username dan password yang sesuai
$cariadmin = mysqli_query($conn,"select * from admin where adminemail='$email' and adminpassword='$password';");
$cariuser = mysqli_query($conn,"select * from user where useremail='$email' and userpassword='$password';");

// menghitung jumlah data yang ditemukan
$cekadmin = mysqli_num_rows($cariadmin);
$cekuser = mysqli_num_rows($cariuser);
 
// cek apakah username dan password di temukan pada database
	if($cekadmin > 0){
	
	//jika admin
	$data = mysqli_fetch_assoc($cariadmin);
 
		// buat session login dan username
		$_SESSION['email'] = $data['adminemail'];
		$_SESSION['role'] = "Admin";
		header("location:admin");
 	} else if($cekuser > 0){
	//jika user biasa
	$data = mysqli_fetch_assoc($cariuser);
 
		// buat session login dan username
		$_SESSION['email'] = $data['useremail'];
		$_SESSION['userid'] = $data['userid'];
		$_SESSION['role'] = "User";
		header("location:user");
	} else {
	//jika user tidak ditemukan
	echo "<div class='alert alert-warning'>Username atau Password salah</div>
    <meta http-equiv='refresh' content='2'>";
	}
 
}


?>

<!DOCTYPE html>
<html lang="en">
<head>
	<meta http-equiv="X-UA-Compatible" content="IE=edge" />
	<title>Log-In Bimbel</title>
	<meta content='width=device-width, initial-scale=1.0, shrink-to-fit=no' name='viewport' />

	<!-- Fonts and icons -->
	<script src="assets/js/plugin/webfont/webfont.min.js"></script>
	<script>
		WebFont.load({
			google: {"families":["Open+Sans:300,400,600,700"]},
			custom: {"families":["Flaticon", "Font Awesome 5 Solid", "Font Awesome 5 Regular", "Font Awesome 5 Brands"], urls: ['assets/css/fonts.css']},
			active: function() {
				sessionStorage.fonts = true;
			}
		});
	</script>
	
	<!-- CSS Files -->
	<link rel="stylesheet" href="assets/assets/css/bootstrap.min.css">
	<link rel="stylesheet" href="assets/assets/css/azzara.min.css">
</head>
<body class="login">
	<div class="wrapper wrapper-login">
		<div class="container container-login animated fadeIn">
			<h3 class="text-center">Login</h3>
			
			<div class="login-form">
				<form method="POST">
				<div class="form-group form-floating-label">
				<input type="email" class="form-control" placeholder="Email" name="email" autofocus required>
				</div>
				<div class="form-group form-floating-label">
				<input type="password" class="form-control" placeholder="Password" name="password" required>
				</div>
				
				<div class="form-action mb-3">
					<button type="submit" class="btn btn-primary btn-rounded btn-login" name="btn-login">Login</button>
				</div>
				</form>
				<div class="login-account">
					<span class="msg">Belum Punya Akun ?</span>
					<a href="register.php" id="show-signup" class="link">Daftar</a>
				</div>
			</div>
		</div>
	</div>

	<script src="assets/assets/js/core/jquery.3.2.1.min.js"></script>
	<script src="assets/assets/js/plugin/jquery-ui-1.12.1.custom/jquery-ui.min.js"></script>
	<script src="assets/assets/js/core/popper.min.js"></script>
	<script src="assets/assets/js/core/bootstrap.min.js"></script>
	<script src="assets/assets/js/ready.js"></script>
</body>
</html>
