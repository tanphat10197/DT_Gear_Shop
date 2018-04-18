<div class="sanpham">
	<?php
	 	$maloaisanpham = $_GET['id'];
		include_once('lib/DataProvider.php');
		$sql = "SELECT MaSanPham ,TenSanPham, HinhURL, GiaSanPham, TenLoaiSanPham FROM sanpham, loaisanpham WHERE sanpham.SoLuongTon > 0 AND sanpham.BiXoa=0 AND sanpham.MaLoaiSanPham = loaisanpham.MaLoaiSanPham
				and loaisanpham.MaLoaiSanPham =".$maloaisanpham;
		
		$result = DataProvider::ExcuteQuery($sql);
		$row1 = mysqli_fetch_row($result);
		$TenLoaiSp = $row1[4];
	?>
    	<h2><?php echo $TenLoaiSp?></h2>
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