<?php
	session_start();
	unset($_SESSION['tenHT']);
	unset($_SESSION['tenDN']);
	unset($_SESSION['matKhau']);
	unset($_SESSION['giohang']);
	//$message = "Đăng Xuất Thành Công";
	
	header("location:login.php");	
	echo '<script type="text/javascript">alert("Đăng Xuất Thành Công");</script>';
?>