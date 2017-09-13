<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="">
    <meta name="author" content="">
    <title>Shop | World Bike</title>
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
				
				<div class="col-sm-9 padding-right">
					<div class="features_items"><!--features_items-->
						<?php
						require_once 'connect/db_connect.php';
						require_once 'quanly/paging.php';
						$manhom=$_GET['id'];
						$date=date("Y/m/d");
						$result = mysqli_query($conn, "select * from nhomsanpham where manhom='$manhom'");
						if(mysqli_num_rows($result)>0)
						{
							$row=mysqli_fetch_row($result);
							$tennhom=$row[1];
						}else{
							header("Location: http://localhost/xedap/index.php");
						}
						if(isset($_GET['search']))
						{
							echo'<h2 class="title text-center">Sản phẩm của '.$tennhom.' tìm kiếm "'.$_GET['search'].'"</h2>';;
							$search=$_GET['search'];
							$result = mysqli_query($conn, "select count(masanpham) as total from sanpham where manhom='$manhom' and tensanpham like '%$search%'  and loaisanpham=1");
							$row = mysqli_fetch_assoc($result);
							$total_records = $row['total'];
							$config = array(
								'current_page'  => isset($_GET['page']) ? $_GET['page'] : 1,
								'total_record'  => $total_records,
								'limit'         => 9,
								'link_full'     => 'shop.php?id='.$manhom.'&search='.$search.'?page={page}',
								'link_first'    => 'shop.php?id='.$manhom.'&search='.$search,
								'range'         => 10 
							);
							$paging = new Pagination();	 
							$paging->init($config);
							$start=$paging->_config['start'];
							$limit=$paging->_config['limit'];
							$sql="select * from sanpham where manhom='$manhom' && tensanpham like '%$search%' and loaisanpham=1 limit $start,$limit";
						}else if(isset($_GET['from']) && isset($_GET['to']))
						{
							echo '<h2 class="title text-center">Sản phẩm của '.$tennhom.' giá từ "'.number_format($_GET['from']).'" tới "'.number_format($_GET['to']).'"</h2>';
							$from=$_GET['from'];
							$to=$_GET['to'];
							$result = mysqli_query($conn, "select count(masanpham) as total from sanpham where manhom='$manhom' and gia>=$from and loaisanpham=1 && gia<=$to");
							$row = mysqli_fetch_assoc($result);
							$total_records = $row['total'];
							$config = array(
								'current_page'  => isset($_GET['page']) ? $_GET['page'] : 1,
								'total_record'  => $total_records,
								'limit'         => 9,
								'link_full'     => 'shop.php?id='.$manhom.'&from='.$from.'&to='.$to.'&page={page}',
								'link_first'    => 'shop.php?id='.$manhom.'&from='.$from.'&to='.$to,
								'range'         => 10 
							);
							$paging = new Pagination();	 
							$paging->init($config);
							$start=$paging->_config['start'];
							$limit=$paging->_config['limit'];
							$sql="select * from sanpham where manhom='$manhom' && gia>=$from and gia<=$to and loaisanpham=1 limit $start,$limit";
						}else{
							echo'<h2 class="title text-center">Sản phẩm của '.$tennhom.'</h2>';
							$result = mysqli_query($conn, "select count(masanpham) as total from sanpham where manhom='$manhom' and loaisanpham=1");
							$row = mysqli_fetch_assoc($result);
							$total_records = $row['total'];
							$config = array(
								'current_page'  => isset($_GET['page']) ? $_GET['page'] : 1,
								'total_record'  => $total_records,
								'limit'         => 9,
								'link_full'     => 'shop.php?id='.$manhom.'&page={page}',
								'link_first'    => 'shop.php?id='.$manhom,
								'range'         => 10 
							);
							$paging = new Pagination();	 
							$paging->init($config);
							$start=$paging->_config['start'];
							$limit=$paging->_config['limit'];
							$sql="select * from sanpham where manhom='$manhom' and loaisanpham=1 limit $start,$limit ";
						}
						$result=$conn->query($sql);
						while($row=mysqli_fetch_assoc($result))
						{
						echo'	<div class="col-sm-4">
									<div class="product-image-wrapper">
										<div class="single-products">
											<div class="productinfo text-center" style="height:430px;">
												<a href="product-details.php?id='.$row['masanpham'].'"><img src="images/products/'.$row['anh'].'" alt="" width="280" height="200"/></a>';
							$sql="select COUNT(manhom) as total,giamgia from chitietkhuyenmai,khuyenmai where chitietkhuyenmai.makhuyenmai=khuyenmai.makhuyenmai and '$date'<khuyenmai.thoigianketthuc and '$date'>khuyenmai.thoigianbatdau and loaikhuyenmai=0 and manhom='$row[manhom]'";
							$resultGiamgia=$conn->query($sql);
							$set=mysqli_fetch_array($resultGiamgia);
							if($set['total']>0)
							{
								echo '<h2 style="text-decoration:line-through;">'.number_format($row['gia']).'</h2>';
								echo '<h2 >'.number_format($row['gia']-($row['gia']*$set['giamgia']/100)).'</h2>';
							}else{
								echo '<h2 style="text-decoration:line-through;"></h2>';
								echo '<h2>'.number_format($row['gia']).'</h2>';
							}
						echo						'<p style="height:60px;line-height:20px;">'.$row['tensanpham'].'</p>
													<button type="button" class="btn btn-fefault add-to-cart" onclick="add('.$row['masanpham'].',1,'.$row['masanpham'].')">
														<i class="fa fa-shopping-cart"></i>
														Add to cart
													</button>
												</div>';
							if($set['total']>0)
							{
								echo '<img src="images/home/sale.png" class="new" alt="" />';
							}
							echo'			</div>
									</div>
								</div>';
						}
						echo $paging->html();
						?>
					</div><!--features_items-->
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