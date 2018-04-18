<?php
	$timsp = '';
	if(isset($_POST['btnSearch']))
	{
		$timsp = $_POST['txtSearch'];
		if($timsp == "")
		{
			echo '<h2>Kết quả tìm kiếm <span style="color:red">RỖNG</span></h2>';
		}
		else
		{
?>
			<h2>Kết quả tìm kiếm cho: "<span style="color:red"><?php echo $timsp?></span>"</h2>
<?php
			$sql = "SELECT MaSanPham, TenSanPham, HinhURL, GiaSanPham FROM SANPHAM 
			WHERE BiXoa=0 and TenSanPham like '%".$timsp."%'";
			$result = DataProvider::ExcuteQuery($sql);	
			$row = mysqli_fetch_array($result);
			if($row != null)
			{
				while($row = mysqli_fetch_array($result))
				{
					$MaSanPham = $row['MaSanPham'];
					$TenSanPham = $row['TenSanPham'];
					$HinhURL = $row['HinhURL'];
					$Gia = $row['GiaSanPham'];
				?>
						<div class="sp">
							<?php
								include('layout/thumpsanpham.php');
							?>
						</div>
					<?php
				}
			}
			else
				echo "<h2> KHÔNG CÓ SẢN PHẨM NÀO </h2>";
		}
	}
?>		
