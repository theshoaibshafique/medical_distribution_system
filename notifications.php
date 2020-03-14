<?php
	include 'database.php';	
	if (!isset($_SESSION['employee_username'])) {
		echo "<script>window.location.href = 'login.php';</script>";
	}
	if (isset($_POST['supply'])) {
		echo "<script>window.location.href = 'view_invoice.php?id=".$_POST['supply']."&chk=1';</script>";
	}
	if (isset($_POST['view'])) {
		echo "<script>window.location.href = 'view_invoice.php?id=".$_POST['view']."';</script>";
	}	
	if (isset($_POST['add'])) {
		echo "<script>window.location.href = 'add_invoice.php?id=".$_POST['add']."';</script>";
	}
	?>
<!DOCTYPE html>
<html>
<head>
	<title><?php echo $currName?> - Notifications</title>
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
	<br><br><br><br>
	<div class="container">
		<div class="panel panel-success">
		  <div class="panel-heading">Notifications</div>
		  <div class="panel-body">
		  	<div class="table-responsive">
		  		<?php if($currType=='booking'){?>
		  		<table class="table table-hover">
		  			<thead>
		  				<tr>
		  					<th>Sr#</th>
		  					<th>Medical Store</th>
		  					<th>Booked To</th>
		  					<th>Booked By</th>
		  					<th>Booking Date</th>
		  					<th>Invoice</th>
		  				</tr>
		  			</thead>
		  			<tbody>
		  				<?php 
		  					$q="select * from bookings where employee='$currUsername' order by status";
							$r=mysqli_query($con,$q);
							$i=1;
							while ($row=mysqli_fetch_array($r))
		  				{?>
		  				<tr>
		  					<form method="POST">
		  					<td><?php echo $i++?></td>
		  					<td><?php echo $row[2]?></td>
		  					<td>		  					<?php 
		  							$qt="select name from user where username='".$row[1]."'";
		  							$rwt=mysqli_fetch_array(mysqli_query($con,$qt));
		  							echo $rwt[0];
		  					?>	
		  					</td>
		  					
		  					<td>
		  					<?php 
		  							$qt="select name from user where username='".$row[3]."'";
		  							$rwt=mysqli_fetch_array(mysqli_query($con,$qt));
		  							echo $rwt[0];
		  					?>	
		  					</td>
		  					<td><?php echo $row[5]?></td>

		  					<td>
		  						<?php
		  							if($row[4]==0){
		  						?>
		  						<button name="add" value="<?php echo $row[0]?>" class="btn btn-danger"><i class="fa fa-plus fa-fw"></i> Add</button>
		  						<?php
		  							}else{
		  						?>
		  						<a href="view_invoice.php?id=<?php echo $row[0]?>" target="_blank" class="btn btn-success"><i class="fa fa-eye fa-fw"></i> View</a>
		  						<?php
		  							}
		  						?>
		  					</td>
		  					</form>
		  				</tr>
		  				<?php }?>
		  			</tbody>
		  		</table>
		  	<?php }?>
		  	<?php if($currType=='supplier'){?>
		  		<table class="table table-hover">
		  			<thead>
		  				<tr>
		  					<th>Sr#</th>
		  					<th>Supplier Name</th>
		  					<th>Supply Issued By</th>
		  					<th>Assigned Date</th>
		  					<th>Supplied Date</th>
		  					<th>Action</th>
		  				</tr>
		  			</thead>
		  			<tbody>
		  				<?php 
		  					$q="select * from supplies where employee='$currUsername' order by status";

							$r=mysqli_query($con,$q);
							$i=1;
							while ($row=mysqli_fetch_array($r))
		  				{?>
		  				<tr>
		  					<form method="post">
		  					<td><?php echo $i++?></td>
		  					<td>		  					<?php 
		  							$qt="select name from user where username='".$row[2]."'";
		  							$rwt=mysqli_fetch_array(mysqli_query($con,$qt));
		  							echo $rwt[0];
		  					?>	
		  					</td>
		  					<td>	<?php 
		  							$qt="select name from user where username='".$row[6]."'";
		  							$rwt=mysqli_fetch_array(mysqli_query($con,$qt));
		  							echo $rwt[0];
		  					?>	
		  					</td>		  					
		  					<td><?php echo $row[4]?></td>
		  					<td>
		  						<?php
		  							if($row[7])
		  								echo "$row[7]";
		  							else
		  								echo "---";
		  						?>
		  					</td>
		  					<td>
		  						<?php
		  							if(!$row[3]){
		  						?>
		  						<button name="supply" value="<?php echo $row[5]?>" class="btn btn-danger"><i class="fa fa-table fa-fw"></i> View & Supply</button>
		  					<?php } else{?>
								<button name="view" value="<?php echo $row[5]?>" class="btn btn-success"><i class="fa fa-eye fa-fw"></i> View</button>
							<?php }?>
		  					</td>
		  					</form>
		  				</tr>
		  				<?php }?>
		  			</tbody>
		  		</table>
		  	<?php }?>
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