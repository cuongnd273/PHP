<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="">
    <meta name="author" content="">
    <title>Thông tin sản phẩm | World Bike</title>
    <link href="css/bootstrap.min.css" rel="stylesheet">
    <link href="css/font-awesome.min.css" rel="stylesheet">
    <link href="css/prettyPhoto.css" rel="stylesheet">
    <link href="css/price-range.css" rel="stylesheet">
    <link href="css/animate.css" rel="stylesheet">
	<link href="css/main.css" rel="stylesheet">
	<link href="css/responsive.css" rel="stylesheet">
    <!--[if lt IE 9]>
    <script src="js/html5shiv.js"></script>
    <script src="js/respond.min.js"></script>
    <![endif]-->       
    <link rel="shortcut icon" href="images/ico/favicon.ico">
    <link rel="apple-touch-icon-precomposed" sizes="144x144" href="images/ico/apple-touch-icon-144-precomposed.png">
    <link rel="apple-touch-icon-precomposed" sizes="114x114" href="images/ico/apple-touch-icon-114-precomposed.png">
    <link rel="apple-touch-icon-precomposed" sizes="72x72" href="images/ico/apple-touch-icon-72-precomposed.png">
    <link rel="apple-touch-icon-precomposed" href="images/ico/apple-touch-icon-57-precomposed.png">
</head><!--/head-->

<body>
	<?php
	require 'block/header.php';
	?>
	<section>
		<div class="container">
			<div class="row">
				<div class="col-sm-3">
					<?php
					require 'block/left_sidebar.php';
					?>
				</div>
				<?php
				require_once 'connect/db_connect.php';
				require_once 'quanly/paging.php';
				$db=new DB_Connect();
				$conn=$db->connect();
				$date=date("Y/m/d");
				$masp=$_GET['id'];
				$result = mysqli_query($conn, "select * from sanpham where masanpham='$masp'");
				$row=mysqli_fetch_array($result);
				?>
				<div class="col-sm-9 padding-right">
					<div class="product-details"><!--product-details-->
						<div class="col-sm-5">
							<div class="view-product">
								<img src="images/products/<?php echo $row['anh']?>"/>
							</div>
						</div>
						<div class="col-sm-7">
							<div class="product-information"><!--/product-information-->
								<?php
								$sql="select COUNT(manhom) as total,giamgia from chitietkhuyenmai,khuyenmai where chitietkhuyenmai.makhuyenmai=khuyenmai.makhuyenmai and '$date'<khuyenmai.thoigianketthuc and '$date'>khuyenmai.thoigianbatdau and loaikhuyenmai=0 and manhom='$row[manhom]'";
								$resultGiamgia=$conn->query($sql);
								$set=mysqli_fetch_array($resultGiamgia);
								if($set['total']>0)
								{
									echo '<img src="images/home/sale.png" class="new" alt="" />';
								}
								?>
								<h1><?php echo $row['tensanpham']?></h1>
								<p>Mã sản phẩm: <?php echo $row['masanpham']?></p>
								<span>
									<?php 
										if($set['total']>0)
										{
											echo '<span style="text-decoration:line-through;">$'.number_format($row['gia']).'</span>';
											echo '<span>$'.number_format($row['gia']-($row['gia']*$set['giamgia']/100)).'</span>';
										}else{
											echo '<span>$ '.number_format($row['gia']).'</span>';
										}
									?>
									<label>Số lượng:</label>
									<input type="number" name="soluong" id="soluong" value="1" />
									<button type="button" class="btn btn-fefault cart" onclick="<?php echo "add(".$row['masanpham'].",0,".$row['soluongcon'].")"?>">
										<i class="fa fa-shopping-cart"></i>
										Add to cart
									</button>
								</span>
								<p><b>Mô tả:</b></p>
								<p><?php echo $row['mota']?></p>
							</div><!--/product-information-->
						</div>
					</div><!--/product-details-->
					
					<div class="category-tab shop-details-tab"><!--category-tab-->
						<div class="tab-content">
							<div class="tab-pane fade active in" id="reviews" >
								<div class="col-sm-12">
								<?php
								$result=$conn->query("select sanpham,tensanpham,soluongcon from chitietkhuyenmai,khuyenmai,sanpham where chitietkhuyenmai.makhuyenmai=khuyenmai.makhuyenmai and thoigianbatdau<'$date' and thoigianketthuc>'$date' and loaikhuyenmai=1 and chitietkhuyenmai.manhom='$row[manhom]' and sanpham=masanpham");
								if(mysqli_num_rows($result)>0)
								{
									echo '<h3>Khuyến mãi</h3>';
									while($set=mysqli_fetch_array($result))
									{
										echo '<h3 style="color:orange"><b>+ Tặng '.$set['tensanpham'];
										if($set['soluongcon']==0)echo " (Hiện tại sản phẩm tặng đang hết!!)";
										echo '</b></h3></br>';
									}
								}
								?>
									<h3>Thông số kỹ thuật</h3>
									<p>Khung xe : <?php echo$row['khungxe']?></p>
									<p>Màu sắc : <?php echo$row['mausac']?></p>
									<p>Giảm xóc : <?php echo$row['giamxoc']?></p>
									<p>Yên xe : <?php echo$row['yenxe']?></p>
									<p>Vành xe : <?php echo$row['vanhxe']?></p>
									<p>Lốp xe : <?php echo$row['lopxe']?></p>
									<p>Phanh xe : <?php echo$row['phanhxe']?></p>
								</div>
							</div>
							<div class="tab-pane fade active in" id="reviews" >
								<h3>Chi tiết</h3>
								<p><?php echo $row['thongsokythuat']?></p>
							</div>
						</div>
					</div><!--/category-tab-->
					<?php
					require 'block/recommended_items.php';
					?>
				</div>
			</div>
		</div>
	</section>
	<?php
	require 'block/footer.php';
	?>
    <script src="js/jquery.js"></script>
	<script src="js/price-range.js"></script>
    <script src="js/jquery.scrollUp.min.js"></script>
	<script src="js/bootstrap.min.js"></script>
    <script src="js/jquery.prettyPhoto.js"></script>
    <script src="js/main.js"></script>
	<script src="js/cart.js"></script>
	<script src="js/search.js"></script>
</body>
</html>