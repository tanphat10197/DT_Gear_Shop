<div class="sanpham">
	<?php
	 	$mahangsanxuat = $_GET['id'];
		include_once('lib/DataProvider.php');
		$sql = "SELECT MaSanPham ,TenSanPham, HinhURL, GiaSanPham, TenHangSanXuat FROM sanpham, hangsanxuat WHERE sanpham.SoLuongTon > 0 AND sanpham.BiXoa=0 AND sanpham.MaHangSanXuat = hangsanxuat.MaHangSanXuat
				and hangsanxuat.MaHangSanXuat =".$mahangsanxuat;
		
		$result = DataProvider::ExcuteQuery($sql);
		
		$row1 = mysqli_fetch_row($result);
		$TenHangSX = $row1[4];
	?>
    	<h2><?php echo $TenHangSX ?></h2>
   <?php
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
	?>
</div>