<?php
session_start();
include 'dbconnect.php';
$alert = '';

if(isset($_SESSION['role'])){
	header("location:index.php");
}

if(isset($_POST['btn-daftar']))
{
 $email = mysqli_real_escape_string($conn,$_POST['email']);
 $password = mysqli_real_escape_string($conn,$_POST['password']);

 //cek apakah email sudah pernah digunakan
$lihat1 = mysqli_query($conn,"select * from user where useremail='$email'");
$lihat2 = mysqli_num_rows($lihat1);
 
if($lihat2 < 1){
    //email belum pernah digunakan
    $insert = mysqli_query($conn,"insert into user (useremail,userpassword) values ('$email','$password')");
        
        //eksekusi query
        if($insert){
            echo "<div class='alert alert-success'>Berhasil mendaftar, silakan login.</div>
            <meta http-equiv='refresh' content='2; url= login.php'/>  ";
        } else {
            //daftar gagal
            echo "<div class='alert alert-warning'>Gagal mendaftar, silakan coba lagi.</div>
            <meta http-equiv='refresh' content='2'>";
        }

    }
 else
    {
    //jika email sudah pernah digunakan
    $alert = '<strong><font color="red">Email sudah pernah digunakan</font></strong>';
    echo '<meta http-equiv="refresh" content="2">';
    }
 
};
?>


<!DOCTYPE html>
<html lang="en">
<head>
	<meta http-equiv="X-UA-Compatible" content="IE=edge" />
	<title>Registrasi akun</title>
	<meta content='width=device-width, initial-scale=1.0, shrink-to-fit=no' name='viewport' />
	<link rel="icon" href="assets/img/iconWPPL.png" type="image/x-icon"/>

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
                <h3 class="text-center">Daftar</h3>
                <label><?php echo $alert ?></label>
                    <div class="login-form">
                        <form method="POST">

                        <div class="form-group form-floating-label">
                        <input type="email" class="form-control" placeholder="Email" name="email" autofocus required>
                        </div>
                        <div class="form-group form-floating-label">
                        <input type="password" class="form-control" placeholder="Password" name="password" required>
                        </div>
                        <div class="form-action">
                            <a href="index.php" id="show-signin" class="btn btn-danger btn-rounded btn-login mr-3">Cancel</a>
                            <button name="btn-daftar" type="submit" class="btn btn-primary btn-rounded btn-login">Daftar</button>
                        </div>
                        </form>
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



