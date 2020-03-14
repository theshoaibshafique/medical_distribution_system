<?php
	$con=mysqli_connect("localhost","root","","final") or die();
	session_start();
	if (isset($_SESSION['employee_username'])) {
		$q="select * from user where username='".$_SESSION['employee_username']."'";
		$r=mysqli_query($con,$q);
		$row=mysqli_fetch_array($r);
		$currUsername=$row[1];
		$currName=$row[3];
		$currPic=$row[9];
		$currType=$row[4];
		$currCon=$row[6];
	}
	function card($tableName,$logo,$title,$conn,$currUsername)
	{
		$query="select count(*) from $tableName where employee='$currUsername'";
		$result=mysqli_query($conn,$query);
		$row=mysqli_fetch_array($result);
		?>
		<div class="col-xs-12 col-sm-3 col-md-3">
			<div class="cardBody">
				<div class="cardLogo">
					<i class="fa fa-fw fa-<?php echo $logo?>"></i><br>
				</div>
				<div class="cardBody2">
				<div class="cardTitle">
					<?php echo $title;?>
				</div>
				<div class="cardVals">
					<?php echo $row[0]?>
				</div>
				</div>
			</div>
		</div>
		<?php		
	}
?>