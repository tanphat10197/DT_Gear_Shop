<div class="sanpham">
    <h2> Sản phẩm bán chạy nhất</h2>
    <?php
		include_once('lib/DataProvider.php');
		$sql = "SELECT MaSanPham, TenSanPham, HinhURL, GiaSanPham FROM SANPHAM WHERE SoLuongTon > 0 AND BiXoa=0 ORDER by SoLuongBan DESC LIMIT 0,9";
		
		$result = DataProvider::ExcuteQuery($sql);
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