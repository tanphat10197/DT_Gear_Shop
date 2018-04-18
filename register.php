<?php
	session_start();
	include_once('lib/DataProvider.php');
	$tenDangNhap = "";
	$matKhau = "";
	$reMatKhau = "";
	$tenHienThi = "";
	$diaChi = "";
	$dienThoai = "";
	$email = "";
	$maBaoMat = "";
	$err = "";
	
	
	if(!isset($_SESSION['tenHT']) && !isset($_SESSION['matKhau']) && !isset($_SESSION['tenDN']))
	{
		if(isset($_POST['btnDangKy']))
		{
			$tenDangNhap = $_POST['txtTenDangNhap'];
			$matKhau = $_POST['txtMatKhau'];
			$reMatKhau = $_POST['txtReMatKhau'];
			$tenHienThi = $_POST['txtTenHienThi'];
			$diaChi = $_POST['txtDiaChi'];
			$dienThoai = $_POST['txtDienThoai'];
			$email = $_POST['txtEmail'];
			$maBaoMat = $_POST['txtMaBaoMat'];
			
			$sql2 ="select TenDangNhap from taikhoan where TenDangNhap='$tenDangNhap'";
			$sql3 = "select Email from taikhoan where Email='$email'";
			$result2 = DataProvider::ExcuteQuery($sql2);
			$result3 = DataProvider::ExcuteQuery($sql3);
			$row2 = mysqli_fetch_row($result2);
			$row3 = mysqli_fetch_row($result3);
			
			if(empty($tenDangNhap) || empty($matKhau) || empty($reMatKhau) || empty($tenHienThi) || empty($diaChi) || empty($dienThoai) || empty($email))
			{
				$err = "<p style='color:red'>Vui lòng điền đầy đủ thông tin.</p>";
			}
			
			else if(!is_numeric($dienThoai))
			{
				$err = "<p style='color:red'>Điện thoại phải là số.</p>";
			}
			
			else if(strlen($matKhau)<8)
			{
				$err = "<p style='color:red'>Mật khẩu phải lớn hơn 8 ký tự.</p>";
			}
			
			else if($reMatKhau != $matKhau)
			{
				$err = "<p style='color:red'>Mật khẩu không khớp.";
			}
			else if(empty($maBaoMat))
			{
				$err = "<p style='color:red'>Vui lòng nhập mã bảo mật.</p>";
			}

			else if($maBaoMat != $_SESSION['code'])
			{
				$err = "<p style='color:red'>Mã bảo mật không đúng.</p>";
			}
			else if($tenDangNhap == $row2[0])
			{
				$err = "<p style='color:red'>Tên đăng nhập đã có người sử dụng.</p>";
			}
			
			else if($email == $row3[0])
			{
				$err = "<p style='color:red'>Email này đã có người sử dụng</br>Vui lòng chọn email khác.</p>";
			}
			
			else
			{
				$sql = "INSERT INTO taikhoan(TenDangNhap, MatKhau, TenHienThi, DiaChi, DienThoai, Email, BiXoa, MaLoaiTaiKhoan) VALUES('".$tenDangNhap."','".$matKhau."','".$tenHienThi."','".$diaChi."',".$dienThoai.",'".$email."',0, 0)";
				
				DataProvider::ExcuteQuery($sql);
	
				$err = "<p style='color:red'>Đăng ký thành công</p>";
			}
		}
	}
	else
	{
		header('location:index.php');
	}
		
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Tạo tài khoản - DTGEARSHOP.VN | SHOP GAMING GEAR HCM</title>
<link rel="stylesheet" type="text/css" href="css/style.css"/>
<link rel="stylesheet" type="text/css" href="css/design_form.css"/>
</head>

<body>
<div class="main">
	<!-- Header -->
   	<?php 
		include('layout/header.php');
	?>
    <!-- Content -->
    <div class="content">
    	<div class="frmDangKy">
            <h1 align="center">Tạo tài khoản của bạn</h1>
            <form method="post">
                <div>
                	<strong>Tên đăng nhập</strong>
                    </br>
                	<label>
                    	<input type="text" id="txtTenDangNhap" name="txtTenDangNhap" placeholder="Tên đăng nhập" value="<?php echo $tenDangNhap ?>"  />
                    </label>
                </div>
                
                <div>
                	<strong>Mật khẩu</strong>
                    </br>
                	<label>
                    	<input type="password" id="txtMatKhau" name="txtMatKhau" placeholder="Mật khẩu" value="<?php echo $matKhau ?>"  />
                    </label>
                </div>
                
                <div>
                	<strong>Nhập lại mật khẩu</strong>
                    </br>
                	<label>
                    	<input type="password" id="txtReMatKhau" name="txtReMatKhau" placeholder="Nhập lại mật khẩu" value="<?php echo $reMatKhau ?>"  />
                    </label>
                </div>
                
                <div>
                	<strong>Tên hiển thị</strong>
                    </br>
                	<label>
                    	<input type="text" id="txtTenHienThi" name="txtTenHienThi" placeholder="Tên hiển thị" value="<?php echo $tenHienThi ?>" size="32" />
                    </label>
                </div>
                
                <div>
                	<strong>Địa chỉ</strong>
                    </br>
                	<label>
                    	<input type="text" id="txtDiaChi" name="txtDiaChi" placeholder="Địa chỉ" value="<?php echo $diaChi ?>" size="32" />
                    </label>
                </div>
                
                <div>
                	<strong>Điện thoại</strong>
                    </br>
                	<label>
                    	<input type="text" id="txtDienThoai" name="txtDienThoai" placeholder="0123456789" value="<?php echo $dienThoai ?>" size="32" />
                    </label>
                </div>
                
                <div>
                	<strong>Email</strong>
                    </br>
                	<label>
                    	<input type="email" id="txtEmail" name="txtEmail" placeholder="example@gmail.com" value="<?php echo $email ?>" size="32" />
                    </label>
                </div>
                
				<div>
                    <strong>Mã bảo mật</strong>
                    <div id="div-capcha">
                    	<?php
                    		$text = rand(1000,100000);
                    		$_SESSION['code'] = $text;
                    		echo $_SESSION['code'];
                    	?>
                    </div>
                	<label>
                    	<input type="text" id="txtMaBaoMat" name="txtMaBaoMat" placeholder="Nhập mã bảo mật" value="<?php $maBaoMat ?>"  />
                    </label>
                </div>

                <div>
                	<strong><hr /></strong>
                	<strong><a href="login.php">Bạn đã có tài khoản?</a></strong>
                </div>
                
                <div align="center" style="margin-top:10px;" id="btn">
                	<label>
                    	<input type="submit" id="btnDangKy" name="btnDangKy" value="Đăng Ký" />
                    </label>
                    <label>
                    	<a href="index.php"><input type="button" value="Quay về" /></a>
                    </label>
                </div>
            </form>
        </div>
        
        <div align="center">
        	<?php
				echo $err;
			?>
        </div>
        
    </div>
    <div style="clear:both"></div>
    <!-- Footer -->
    <?php 
		include('layout/footer.php');
	?> 
</div>
</body>
</html>