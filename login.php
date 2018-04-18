<?php
	session_start();
	include_once('lib/DataProvider.php');
	$tenDangNhap = "";
	$matKhau = "";
	$tenHienThi = "";
	$maBaoMat = "";
	$maLoai = "";
	$idMaHang = "";
	$check = 0;
	$err = "";
	if(isset($_POST['btnDangNhap']))
	{
		$tenDangNhap = $_POST['txtTenDangNhap'];
		$matKhau = $_POST['txtMatKhau'];
		$maBaoMat = $_POST['txtMaBaoMat'];
		if(empty($tenDangNhap))
		{
			$err = "<p style='color:red'>Vui lòng nhập tài khoản.</p>";
		}
		
		else if(empty($matKhau))
		{
			$err = "<p style='color:red'>Vui lòng nhập mật khẩu.</p>";
		}

		else if(empty($maBaoMat))
		{
			$err = "<p style='color:red'>Vui lòng nhập mã bảo mật.</p>";
		}

		else if($maBaoMat != $_SESSION['code'])
		{
			$err = "<p style='color:red'>Mã bảo mật không đúng.</p>";
		}
		
		
		else
		{
			$sql = "SELECT MaTaiKhoan, TenDangNhap, MatKhau, TenHienThi, MaLoaiTaiKhoan FROM taikhoan WHERE BiXoa=0 AND TenDangNhap='$tenDangNhap'";
			$result = DataProvider::ExcuteQuery($sql);
			
			$row = mysqli_fetch_row($result);
			
			if($tenDangNhap == $row[1] && $matKhau== $row[2])
			{
				$tenHienThi = $row[3];
				$maLoai = $row[4];
				$mataikhoan = $row[0];
				$_SESSION['tenHT'] = $tenHienThi;
				$_SESSION['tenDN'] = $tenDangNhap;
				$_SESSION['matKhau'] = $matKhau;
				$_SESSION['maLoai'] = $maLoai; 
				$check = 1;
			}

			else
			{
				$err = "<p style='color:red'>Đăng nhập thất bại</br>Vui lòng kiểm tra lại tên đăng nhập và mật khẩu</p>";
			}
		}
	}
	
	if($check == 1 && $maLoai != 1)
	{
		header('location:index.php');
	}
	
	else if($check == 1 && $maLoai == 1)
	{
		header('location:admin/index.php');	
	}
	
	include("layout/head.php");
?>

<body>
<div class="main">
	<!-- Header -->
   	<?php 
		include('layout/header.php');
	?>
    <!-- Content -->
    <div class="content">
    	<div class="frmDangKy">
            <h1 align="center">Đăng nhập</h1>
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
                </div>
                
                <div>
                	<strong><a href="register.php">Đăng ký</a></strong>
                </div>
                
                <div align="center" style="margin-top:10px;" id="btn">
                    	<input type="submit" id="btnDangNhap" name="btnDangNhap" value="Đăng nhập" />
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