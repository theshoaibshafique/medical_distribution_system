<?php
	include 'database.php';
	if (!isset($_SESSION['employee_username'])) {
		echo "<script>window.location.href = 'login.php';</script>";
	}
?>
<!DOCTYPE html>
<html>
<head>
	<title>Home - Employee</title>
	<link rel="stylesheet"  href="./css/font-awesome.css">
	<link rel="stylesheet"  href="./fonts/FontAwesome.otf">
	<link rel="stylesheet" href="./css/bootstrap.css">
	<link rel="stylesheet" href="./css/animate.css">
	<link rel="stylesheet" href="./css/style.css">
	<link rel="stylesheet" href="./css/util.css">
</head>
<body class="container">
	<?php
		include 'navbar.php';
	?>
	<br><br><br><br>
	<h1>Dashboard</h1>
	<br>
	<div class="row">
		<?php
		if ($currType=='booking')
			card("bookings","tasks","Bookings",$con,$currUsername);
		else
		 	card("supplies","building","Supplies",$con,$currUsername);
		 ?>
	</div>
	<!--Script Files-->
	<script src="./js/jquery-3.3.1.min.js"></script>
	<script src="./js/bootstrap.js"></script>
	<script src="./js/script.js"></script>	
</body>
</html>