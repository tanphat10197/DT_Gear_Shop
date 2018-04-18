<?php
	include("lib/DataProvider.php");
	session_start(); //bắt đầu session
	
	$id = $_GET['id']; //lấy id của sản phẩm đó
	
	$sql = "select MaSanPham from sanpham where SoLuongTon >0 and BiXoa = 0 and MaSanPham=".$id; //viết câu truy vấn kiểm tra mã sản phẩm 
	//tồn tại
	$result = DataProvider::ExcuteQuery($sql); //thực thi câu truy cấn
	$num_row = mysqli_num_rows($result);//lấy ra số dòng

	if($num_row == 1)	//nếu số lượng dòng trả ra là 1 tức là tồn tại sản phẩm đó
	{
			if(isset($_SESSION['giohang'][$id])) // nếu sản phẩm đã có trong giỏ hàng
			{
				$_SESSION['giohang'][$id]++; // tăng số lượng lên 1	
			}
			else //sản phẩm chưa có trong giỏ hàng
			{
				$_SESSION['giohang'][$id] = 1; //gán số lượng bằng 1
			}
			
			//Mở trang giỏ hàng
			header("location:gio_hang.php");
	}
	
	//không có trong csdl
	else
	{
		header("location:index.php");	//nhảy tới trang index
	}
?>