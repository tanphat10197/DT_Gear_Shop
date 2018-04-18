<?php
	session_start();
	
	$id = $_GET['id']; //lấy ra id của sản phẩm tương ứng khi xóa
	
	if(isset($id)) //nếu tồn tại id đó
	{
		unset($_SESSION['giohang'][$id]); //xóa thông tin giỏ hàng với id tương ứng
		header("location:gio_hang.php");//quay về trang gio_hang.php	
	}	
?>