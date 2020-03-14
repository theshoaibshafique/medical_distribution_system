<?php
	include 'database.php';	
	if (!isset($_SESSION['employee_username'])) {
		echo "<script>window.location.href = 'login.php';</script>";
	}
	if (!isset($_GET['id'])) {
		echo "<script>window.location.href = 'index.php';</script>";
	}
	if (isset($_POST['supply'])) {
		$query="select * from invoices where booking_id=".$_POST['supply'];
		$result=mysqli_query($con,$query);
		while ($row=mysqli_fetch_array($result)) {
			$res=mysqli_query($con,"select m_quantity from medicine where m_id='".$row[6]."'");
			$rwt=mysqli_fetch_array($res);
			$temp=(int)$rwt[0]-(int)$row[8];
			$res=mysqli_query($con,"update medicine set m_quantity=$temp where m_id='".$row[6]."'");
			if(!$res)
				break;
		}
		/**/
		if($res)
		{
			$query="update supplies set status=1,supplyDate=NOW() where booking_id=".$_POST['supply'];
			mysqli_query($con,$query);
			$query="update invoices set supplied=1 where booking_id=".$_POST['supply'];
			mysqli_query($con,$query);			
			echo "<script>alert('Medicine Supplied!')</script>";
			echo "<script>window.location.href = 'notifications.php';</script>";
		}
		else
		{
			echo "<script>alert('Unexpected Error!')</script>";
			echo "<script>window.location.href = 'view_invoice.php?id=".$_POST['supply']."&chk=1';</script>";
		}

		/*Update Vals*/
		/**/
		}	
	?>
<!DOCTYPE html>
<html>
<head>
	<title>View Invoice</title>
	<link rel="stylesheet"  href="./css/font-awesome.css">
	<link rel="stylesheet"  href="./fonts/FontAwesome.otf">
	<link rel="stylesheet" href="./css/bootstrap.css">
	<link rel="stylesheet" href="./css/animate.css">
	<link rel="stylesheet" href="./css/style.css">
	<style type="text/css">
		tr td{
			text-transform: capitalize;
			vertical-align: middle !important;
		}
	</style>
</head>
<body>
	<?php
		include 'navbar.php';
	?>
	<?php
		  $q="select * from bookings where id=".$_GET['id'];
		  $r=mysqli_query($con,$q);
		$row=mysqli_fetch_array($r);
	?>
	<br><br><br><br>
	<div class="container">
		<div class="panel panel-success">
		  <div class="panel-heading">View Invoice</div>
		  <div class="panel-body">
		  	<div class="table-responsive">
		  		<table class="table">
		  			<thead>
		  				<tr>
		  					<td style="font-size: 13px">Medical Store Name : <span style="font-weight: bold;"><?php echo $row[2]?></span></td>
		  					<td style="font-size: 13px">Booking Man Name : <span style="font-weight: bold;"><?php 
		  							$qt="select name from user where username='".$row[1]."'";
		  							$rwt=mysqli_fetch_array(mysqli_query($con,$qt));
		  							echo $rwt[0];
		  					?></span></td>
		  					<td style="font-size: 13px">
		  						Booked By : <span style="font-weight: bold;"><?php 
		  							$qt="select name from user where username='".$row[3]."'";
		  							$rwt=mysqli_fetch_array(mysqli_query($con,$qt));
		  							echo $rwt[0];
		  					?></span>
		  					</td>
		  					<td style="font-size: 13px">
		  						Booking Date : <span style="font-weight: bold;"><?php 
		  							echo $row[5];
		  					?></span>
		  					</td>
		  					<td style="font-size: 13px">
		  						Invoice Date : <span style="font-weight: bold;"><?php 
		  							$qt="select date from invoices where booking_id=".$_GET['id']." limit 1";
		  							$rwt=mysqli_fetch_array(mysqli_query($con,$qt));
		  							echo $rwt[0];
		  					?></span>	
		  					</td>		  					
		  				</tr>
		  			</thead>
		  		</table>
		  		<table class="table table-hover">
		  			<thead>
		  				<tr>
		  					<th>Sr#</th>
		  					<th>Medicine Name</th>
		  					<th class="text-right">Quantity</th>
		  					<th class="text-right">Price</th>
		  					<th class="text-right">Total</th>
		  				</tr>
		  			</thead>
		  			<tbody>
		  				<?php
		  					$qt="select * from invoices where booking_id=".$_GET['id'];
		  					$rwr=mysqli_query($con,$qt);
		  					$i=1;
		  					$j=0;
		  					while($rwt=mysqli_fetch_array($rwr)){
		  				?>
		  				<tr>
		  					<td><?php echo $i++;?></td>
		  					<td><?php echo $rwt[7];?></td>
		  					<td class="text-right"><?php echo $rwt[8];?></td>
		  					<td class="text-right"><?php echo $rwt[9];?></td>
		  					<td class="text-right"><?php echo $rwt[10];$j+=$rwt[10]?></td>
		  				</tr>

		  			<?php }?>
		  					  				<tr>
		  					<td colspan="4" class="text-right" style="font-weight: bold;">Total</td>
		  					<td class="text-right" colspan="1" style="font-weight: bold;"><?php echo $j;?></td>
		  				</tr>
		  			</tbody>
		  		</table>
		  		<br>
		  		<?php
		  			if (isset($_GET['chk']) && $currType=='supplier') {
		  		?>
		  		<form method="post">
		  			<button name="supply" value="<?php echo $row[0]?>" class="btn btn-success btn-block"><i class="fa fa-fw fa-check"></i> Supply Medicines!</button>
		  		</form>
		  		<?php
		  			}
		  		?>
		  	</div>

		</div>
	</div>
	</div>
	<!--Script Files-->
	<script src="./js/jquery-3.3.1.min.js"></script>
	<script src="./js/bootstrap.js"></script>
	<script src="./js/script.js"></script>	
</body>
</html>
