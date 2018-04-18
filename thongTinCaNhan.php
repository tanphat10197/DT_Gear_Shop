<?php 
	session_start();
	include_once('lib/DataProvider.php');
		
	$id = "";
	$tenDangNhap = "";
	$tenHienThi = "";
	$diaChi = "";
	$dienThoai = "";
	$email = "";
	
	if(isset($_SESSION['tenDN']) && isset($_SESSION['matKhau']) && isset($_SESSION['tenHT']))
	{
		$sql = "SELECT MaTaiKhoan, TenDangNhap, TenHienThi, DiaChi, DienThoai, Email FROM taikhoan WHERE BiXoa=0 AND TenDangNhap='".$_SESSION['tenDN']."'";
		$result = DataProvider::ExcuteQuery($sql);
		
		$row = mysqli_fetch_row($result);
		
		$id = $row[0];
		$tenDangNhap = $row[1];
		$tenHienThi = $row[2];
		$diaChi = $row[3];
		$dienThoai = $row[4];
		$email = $row[5];
	}
	else
	{
		header('location:index.php');
	}
    include('layout/head.php');
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
            <h1 align="center">Thông tin cá nhân</h1>
            <form method="post">
            	<div>
                	<strong>ID</strong>
                    </br>
                	<label>
                    	<input type="text" id="txtTenDangNhap" name="txtTenDangNhap" disabled="disabled" value="<?php echo $id ?>"/>
                    </label>
                </div>
                
                <div>
                	<strong>Tên đăng nhập</strong>
                    </br>
                	<label>
                    	<input type="text" id="txtTenDangNhap" name="txtTenDangNhap" disabled="disabled" value="<?php echo $tenDangNhap ?>"/>
                    </label>
                </div>

                <div>
                	<strong>Tên hiển thị</strong>
                    </br>
                	<label>
                    	<input type="text" id="txtTenHienThi" name="txtTenHienThi" disabled="disabled" value="<?php echo $tenHienThi ?>" size="32" />
                    </label>
                </div>
                
                <div>
                	<strong>Địa chỉ</strong>
                    </br>
                	<label>
                    	<input type="text" id="txtDiaChi" name="txtDiaChi" disabled="disabled" value="<?php echo $diaChi ?>" size="32" />
                    </label>
                </div>
                
                <div>
                	<strong>Điện thoại</strong>
                    </br>
                	<label>
                    	<input type="text" id="txtDienThoai" name="txtDienThoai" disabled="disabled" value="<?php echo $dienThoai ?>" size="32" />
                    </label>
                </div>
                
                <div>
                	<strong>Email</strong>
                    </br>
                	<label>
                    	<input type="email" id="txtEmail" name="txtEmail" disabled="disabled" value="<?php echo $email ?>" size="32" />
                    </label>
                </div>
                
                <div align="center" style="margin-top:10px;" id="btn">
                	<label>
                    	<a href="cap_Nhat_Thong_Tin_TK.php"><input type="button" id="btnCapNhat" name="btnCapNhat" value="Cập nhật" /></a>
                    </label>
                    <label>
                    	<?php
							if($_SESSION['maLoai'] != 1)
							{
						?>
                    			<a href="index.php"><input type="button" value="Quay về" /></a>
                        <?php
							}
							else
							{
						?>
                        		<a href="admin/index.php"><input type="button" value="Quay về" /></a>
                        <?php
							}
						?>
                    </label>
                </div>
            </form>
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