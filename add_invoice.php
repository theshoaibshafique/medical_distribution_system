<?php
	include 'database.php';	
	if (!isset($_SESSION['employee_username'])) {
		echo "<script>window.location.href = 'login.php';</script>";
	}
	if (!isset($_GET['id'])) {
		echo "<script>window.location.href = 'index.php';</script>";
	}
	?>
	<?php
	if (isset($_POST['addInvoice'])) 
	{
		if(!empty($_POST['check_list']))
		{
			$inv_id=uniqid();
			foreach($_POST['check_list'] as $selected)
			{
				$booking_id=$_GET['id'];
				$r=mysqli_query($con,"select * from bookings where id='$booking_id'");
				$rw=mysqli_fetch_array($r);
				/**/
				$r=mysqli_query($con,"select id from medicalstore where name='".$rw[2]."'");
				$rw1=mysqli_fetch_array($r);
				$medicalstore_id=$rw1[0];
				/**/
				$r=mysqli_query($con,"select id from user where username='".$rw[1]."'");
				$rw1=mysqli_fetch_array($r);
				$book_to=$rw1[0];				
				/**/
				$r=mysqli_query($con,"select id from user where username='".$rw[3]."'");
				$rw1=mysqli_fetch_array($r);
				$book_by=$rw1[0];
				/**/
				$m_id=$selected;
				$temp=$selected.'_name';
				$m_name=$_POST[$temp];
				/**/
				$temp=$selected.'_quantity';
				$m_quantity=$_POST[$temp];
				/**/
				$temp=$selected.'_price';
				$m_price=$_POST[$temp];
				/**/
				$m_total=(int)$m_quantity*(int)$m_price;
				/**/
				$query="insert into invoices(inv_id,booking_id,medicalstore_id,book_to,book_by,m_id,m_name,m_quantity,m_price,m_total,date) values('$inv_id',$booking_id,$medicalstore_id,$book_to,$book_by,'$m_id','$m_name',$m_quantity,$m_price,$m_total,NOW())";
				$result=mysqli_query($con,$query);
				if(!$result){
					break;
				}
			}
			if($result)
			{
				$query="update bookings set status=1 where id=".$_GET['id'];
				mysqli_query($con,$query);				
				echo "<script>alert('Invoice Added!')</script>";
				echo "<script>window.location.href = 'notifications.php';</script>";
			}
			else
				echo "<script>alert('Invalid Error!')</script>";

		}
		else
			echo "<script>alert('Please select any medicine!')</script>";
	}
?>
<!DOCTYPE html>
<html>
<head>
	<title>Add Invoice</title>
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
		.simpleTextBox{
			background-color: transparent;
		}
	</style>
</head>
<body>
	<?php
		include 'navbar.php';
	?>
	<br><br><br><br>
	<?php
		  			$q="select * from bookings where id=".$_GET['id']." AND employee='$currUsername'";
		  			$r=mysqli_query($con,$q);
					$row=mysqli_fetch_array($r);
	?>
	<div class="container">
		<div class="panel panel-success">
		  <div class="panel-heading">Add Invoice</div>
		  <div class="panel-body">
		  	<div class="table-responsive">
		  		<table class="table">
		  			<thead>
		  				<tr>
		  					<td>Medical Store Name : <span style="font-weight: bold;"><?php echo $row[2]?></span></td>
		  					<td>Booking Man Name : <span style="font-weight: bold;"><?php 
		  							$qt="select name from user where username='".$row[1]."'";
		  							$rwt=mysqli_fetch_array(mysqli_query($con,$qt));
		  							echo $rwt[0];
		  					?></span></td>
		  					<td>
		  						Booked By : <span style="font-weight: bold;"><?php 
		  							$qt="select name from user where username='".$row[3]."'";
		  							$rwt=mysqli_fetch_array(mysqli_query($con,$qt));
		  							echo $rwt[0];
		  					?></span>
		  					</td>
		  					<td>
		  						Booking Date : <span style="font-weight: bold;"><?php 
		  							echo $row[5];
		  					?></span>
		  					</td>		  					
		  				</tr>
		  			</thead>
		  		</table>
		  	</div>
		  	<div class="table-responsive" style="max-height: 650px">
		  		<form method="post">
		  		<table class="table table-hover table-condensed" style="margin-bottom: 0px">
		  			<thead>
		  				<tr>
		  					<th><input id="tempChk" class="checkbox" type="checkbox" name=""></th>
		  					<th>Medicine Name</th>
		  					<th>Quantity</th>
		  					<th class="text-right">Price</th>
		  					<th class="text-right">Total</th>
		  				</tr>
		  			</thead>
		  			<tbody>
		  				<?php 
		  					$q="select * from medicine order by m_name";
							$r=mysqli_query($con,$q);
							$total=0;
							while ($row=mysqli_fetch_array($r))
		  				{?>
		  				<tr>
		  					<td style="width: 50px;"><input value="<?php echo $row[0]?>" class="checkbox" type="checkbox" name="check_list[]"></td>

		  					<td id="">
		  						<input style="width: 100%"  class="simpleTextBox" type="text" readonly="" value="<?php echo $row[1]?>" name="<?php echo $row[0].'_name'?>">
		  						</td>

		  					<td style="width: 120px"><input required="" value="1" type="text" class="form-control input-sm" name="<?php echo $row[0].'_quantity'?>"></td>

		  					<td style="width: 120px">
		  						<input style="width: 120px" readonly="" value="<?php echo $row[5]?>"  type="text"  class="simpleTextBox text-right" name="<?php echo $row[0].'_price'?>">	
		  					</td>
		  					<td style="width: 120px" class="text-right">
		  						<input style="width: 120px" readonly="" value="<?php echo $row[5]?>"  type="text"  class="simpleTextBox text-right" name="<?php echo $row[0].'_total'?>">
		  					</td>
		  				</tr>
		  				<?php
		  					$total+=$row[5];
		  				 }?>
		  				<tr>
		  					<td colspan="4" class="text-right" style="font-weight: bold;">Total</td>
		  					<td colspan="1" class="text-right" style="font-weight: bold;"><?php echo $total?></td></tr>
		  			</tbody>
		  		</table>
		  		
		  		<div class="table-responsive">
		  			<table class="table" style="margin-bottom: 0px">
		  				<tr><td style="padding: 5px"><button class="btn btn-success" name="addInvoice" style="float: right;"><i class="fa fa-fw fa-money"></i> Add Invoice</button></td></tr>
		  			</table>
		  		</div>
		  		</form>
		  	</div>
		  </div>
		</div>
	</div>
	<!--Script Files-->
	<script src="./js/jquery-3.3.1.min.js"></script>
	<script src="./js/bootstrap.js"></script>
	<script src="./js/script.js"></script>	
	<script type="text/javascript">
		$('#tempChk').click(function(){
			if($(this).prop("checked") == true)
			{
				$(':checkbox').each(function(){
					this.checked = true;
				});
			}
			else
			{
				$(':checkbox').each(function(){
					this.checked = false;
				});
			}
		})
	</script>
</body>
</html>
