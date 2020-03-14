<?php
	include 'database.php';
	if (isset($_SESSION['employee_username'])) {
		echo "<script>window.location.href = 'index.php';</script>";
	}
	else if (isset($_POST['submit'])) {
		$username=$_POST['username'];
		$pass=SHA1($_POST['password']);
		$q="select * from user where username='".$username."' AND password='".$pass."' AND type<>'admin'";
		$r=mysqli_query($con,$q);
		if (mysqli_num_rows($r)==1) 
		{
			$_SESSION['employee_username']=$username;
			echo "<script>window.location.href = 'index.php';</script>";
		}
		else{
			echo "<script>alert('Access Denied!')</script>";
		}
	}
?>
<!DOCTYPE html>
<html lang="en">
<head>
	<title>Anayat Traders</title>
	<meta charset="UTF-8">
	<link rel="stylesheet"  href="./css/font-awesome.css">
	<link rel="stylesheet"  href="./fonts/FontAwesome.otf">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<link rel="icon" type="image/png" href="./images/icons/favicon.ico"/>
	<link rel="stylesheet" href="./css/bootstrap.css">
	<link rel="stylesheet" type="text/css" href="fonts/iconic/css/material-design-iconic-font.min.css">
	<link rel="stylesheet" href="./css/animate.css">
	<link rel="stylesheet" type="text/css" href="vendor/css-hamburgers/hamburgers.min.css">
	<link rel="stylesheet" type="text/css" href="vendor/animsition/css/animsition.min.css">
	<link rel="stylesheet" type="text/css" href="vendor/select2/select2.min.css">
	<link rel="stylesheet" type="text/css" href="vendor/daterangepicker/daterangepicker.css">
	<link rel="stylesheet" type="text/css" href="./css/util.css">
	<link rel="stylesheet" type="text/css" href="./css/style.css">
<!--===============================================================================================-->
</head>
<body style="transform: scale(0.9);">
	<div class="limiter">
		<div class="container-login100">
			<div class="wrap-login100 p-t-5 p-b-10">
				<form method="post" style="transform: scale(0.8);">
					<span class="login100-form-title p-b-70">
						Anayat Traders
					</span>
					<span class="login100-form-avatar" style="border:1px solid #333333">
						<img src="./images/company.jpg"  alt="AVATAR">
					</span>

					<div class="wrap-input100 validate-input m-t-85 m-b-35" data-validate = "Enter username">
						<input required=""  class="input100" type="text" name="username">
						<span class="focus-input100" data-placeholder="Username"></span>
					</div>

					<div class="wrap-input100 validate-input m-b-50" data-validate="Enter password">
						<input required=""  name="password" class="input100" type="password" name="password">
						<span class="focus-input100" data-placeholder="Password"></span>
					</div>

					<div class="container-login100-form-btn">
						<button name="submit" class="login100-form-btn">
							Login
						</button>
					</div>

					<ul class="login-more p-t-100">
						<li class="m-b-8">
							<span class="txt1">
								Forgot
							</span>

							<a href="#" class="txt2">
								Username / Password?
							</a>
						</li>

						<li>
							<span class="txt1">
								Don’t have an account?
							</span>

							<a href="#" class="txt2">
								Sign up
							</a>
						</li>
					</ul>
				</form>
			</div>
		</div>
	</div>
	<div id="dropDownSelect1"></div>
	<script src="./js/jquery-3.3.1.min.js"></script>
	<script src="vendor/animsition/js/animsition.min.js"></script>
	<script src="./js/bootstrap.js"></script>
	<script src="vendor/select2/select2.min.js"></script>
	<script src="vendor/daterangepicker/moment.min.js"></script>
	<script src="vendor/daterangepicker/daterangepicker.js"></script>
	<script src="vendor/countdowntime/countdowntime.js"></script>
	<script src="./js/script.js"></script>
</body>
</html>