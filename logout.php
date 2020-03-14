<?php
	session_start();
	unset($_SESSION['employee_username']);
	echo "<script>window.location.href = 'login.php';</script>";
?>