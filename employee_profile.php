<?php
	include 'database.php';	
	if (!isset($_SESSION['employee_username'])) {
		echo "<script>window.location.href = 'login.php';</script>";
	}
?>
<!DOCTYPE html>
<html>
<head>
	<title><?php echo $currName." - Home"?></title>
	<link rel="stylesheet"  href="./css/font-awesome.css">
	<link rel="stylesheet"  href="./fonts/FontAwesome.otf">
	<link rel="stylesheet" href="./css/bootstrap.css">
	<link rel="stylesheet" href="./css/animate.css">
	<link rel="stylesheet" href="./css/style.css">
	<link rel="stylesheet" href="./css/util.css">
	<style type="text/css">	
	.cardMain {
	  box-shadow: 0 4px 8px 0 rgba(0, 0, 0, 0.2);
	  max-width: 300px;
	  margin: auto;
	  text-align: center;
	}

	.titleCard {
	  color: grey;
	  font-size: 18px;
	  text-transform: capitalize;
	  
	}
	.btn.btn-default.btn-block.c1{
		background-color: #101010;
		border-radius: 0px;
		height: 50px;
		font-size: 20px;
		border:1px solid #101010;
		color: white;
	}
	.btn.btn-default.btn-block.c1:hover{
		background-color: white;
		border-radius: 0px;
		height: 50px;
		font-size: 20px;
		color: #101010;
	}	
	</style>
</head>
<body>
	<?php
		include 'navbar.php';
	?>
	<br><br><br><br>
	<div class="container">
		<div class="cardMain">
		  <img src="<?php echo $currPic?>" alt="John" style="width:100%;margin-bottom: 15px">
		  <h1><?php echo $currName?></h1>
		  <p class="titleCard"><?php echo $currType?></p>
		  <p><?php echo $currCon?></p>
		  <div style="margin: 24px 0;">
		    <a href="#"><i class="fa fa-dribbble"></i></a> 
		    <a href="#"><i class="fa fa-twitter"></i></a>  
		    <a href="#"><i class="fa fa-linkedin"></i></a>  
		    <a href="#"><i class="fa fa-facebook"></i></a> 
		  </div>
		  <p><a href="tel:<?php echo $currCon?>"><button class="btn btn-default btn-block c1">Contact</button></a></p>
		</div>
	</div>
	<!--Script Files-->
	<script src="./js/jquery-3.3.1.min.js"></script>
	<script src="./js/bootstrap.js"></script>
	<script src="./js/script.js"></script>	
</body>
</html>