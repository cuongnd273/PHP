<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="">
    <meta name="author" content="">
    <title>Home | World Bicycle</title>
    <link href="css/bootstrap.min.css" rel="stylesheet">
    <link href="css/font-awesome.min.css" rel="stylesheet">
    <link href="css/prettyPhoto.css" rel="stylesheet">
    <link href="css/price-range.css" rel="stylesheet">
    <link href="css/animate.css" rel="stylesheet">
	<link href="css/main.css" rel="stylesheet">
	<link href="css/responsive.css" rel="stylesheet">
</head><!--/head-->

<body>
	<?php
	require '/block/header.php';
	?>
	<?php
	require 'block/slider.php';
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
						$date=date("Y/m/d");
						if(isset($_GET['search']))//Tim kiem theo ten
						{
							echo '<h2 class="title text-center">Tất cả sản phẩm của tìm kiếm "'.$_GET['search'].'"</h2>';
							$search=$_GET['search'];
							$result = mysqli_query($conn, "select count(masanpham) as total from sanpham where tensanpham like '%$search%' and loaisanpham=1");
							$row = mysqli_fetch_assoc($result);
							$total_records = $row['total'];
							$config = array(
								'current_page'  => isset($_GET['page']) ? $_GET['page'] : 1,
								'total_record'  => $total_records,
								'limit'         => 9,
								'link_full'     => 'index.php?search='.$search.'?page={page}',
								'link_first'    => 'index.php?search='.$search,
								'range'         => 10 
							);
							$paging = new Pagination();	 
							$paging->init($config);
							$start=$paging->_config['start'];
							$limit=$paging->_config['limit'];
							$sql="select * from sanpham where tensanpham like '%$search%' and loaisanpham=1 limit $start,$limit";
						}else if(isset($_GET['from']) && isset($_GET['to']))//Tim kiem theo gia
						{
							echo '<h2 class="title text-center">Tất cả sản phẩm giá từ "'.number_format($_GET['from']).'" tới "'.number_format($_GET['to']).'"</h2>';
							$from=$_GET['from'];
							$to=$_GET['to'];
							$result = mysqli_query($conn, "select count(masanpham) as total from sanpham where gia>=$from and gia<=$to and loaisanpham=1");
							$row = mysqli_fetch_assoc($result);
							$total_records = $row['total'];
							$config = array(
								'current_page'  => isset($_GET['page']) ? $_GET['page'] : 1,
								'total_record'  => $total_records,
								'limit'         => 9,
								'link_full'     => 'index.php?from='.$from.'&to='.$to.'&page={page}',
								'link_first'    => 'index.php?from='.$from.'&to='.$to,
								'range'         => 10 
							);
							$paging = new Pagination();	 
							$paging->init($config);
							$start=$paging->_config['start'];
							$limit=$paging->_config['limit'];
							$sql="select * from sanpham where gia>=$from and gia<=$to and loaisanpham=1 limit $start,$limit";
						}else if(isset($_GET['search_box'])){//Tim kiem theo nhieu thuoc tinh
							echo '<h2 class="title text-center">Kết quả tìm kiếm</h2>';
							$link_first="index.php?";
							//Nhom san pham
							if(isset($_GET["nhomsanpham"]) && count($_GET["nhomsanpham"])>0){
								$sqlNSP="";
								$first=true;
								foreach ($_GET["nhomsanpham"] as $key => $value ) {
									if($first==true)
									{
										$sqlNSP=$sqlNSP." manhom='".$value."'";
										$first=false;
										$link_first=$link_first."nhomsanpham[]=".$value;
									}else{
										$sqlNSP=$sqlNSP." or manhom='".$value."'";
										$link_first=$link_first."&nhomsanpham[]=".$value;
									}
								}
							}else{
								$sqlNSP="";
							}
							//Khung xe
							if(isset($_GET["khungxe"]) && count($_GET["khungxe"])>0){
								if($sqlNSP!=""){$sqlK=" and ";}
								else{$sqlK="";}
								$first=true;
								foreach ($_GET["khungxe"] as $key => $value ) {
									if($first==true)
									{
										$sqlK=$sqlK." khungxe like '%".$value."%'";
										$first=false;
										$link_first=$link_first."&khungxe[]=".$value;
									}else{
										$sqlK=$sqlK." or khungxe like '%".$value."%'";
										$link_first=$link_first."&khungxe[]=".$value;
									}
								}
							}else{
								$sqlK="";
							}
							//Mau sac
							if(isset($_GET["mausac"]) && count($_GET["mausac"])>0){
								if($sqlK!="" || $sqlNSP!=""){$sqlM=" and ";}
								else{$sqlM="";}
								$first=true;
								foreach ($_GET["mausac"] as $key => $value ) {
									if($first==true)
									{
										$sqlM=$sqlM." mausac like '%".$value."%'";
										$first=false;
										$link_first=$link_first."&mausac[]=".$value;
									}else{
										$sqlM=$sqlM." or mausac like '%".$value."%'";
										$link_first=$link_first."&mausac[]=".$value;
									}
								}
							}else{
								$sqlM="";
							}
							//Giam xoc
							if(isset($_GET["giamxoc"]) && count($_GET["giamxoc"])>0){
								if($sqlK!="" || $sqlNSP!="" || $sqlM!=""){$sqlGX=" and ";}
								else{$sqlGX="";}
								$first=true;
								foreach ($_GET["giamxoc"] as $key => $value ) {
									if($first==true)
									{
										$sqlGX=$sqlGX." giamxoc like '%".$value."%'";
										$first=false;
										$link_first=$link_first."&giamxoc[]=".$value;
									}else{
										$sqlGX=$sqlGX." or giamxoc like '%".$value."%'";
										$link_first=$link_first."&giamxoc[]=".$value;
									}
								}
							}else{
								$sqlGX="";
							}
							//Yen xe
							if(isset($_GET["yenxe"]) && count($_GET["yenxe"])>0){
								if($sqlK!="" || $sqlNSP!="" || $sqlM!="" || $sqlGX!=""){$sqlYX=" and ";}
								else{$sqlYX="";}
								$first=true;
								foreach ($_GET["yenxe"] as $key => $value ) {
									if($first==true)
									{
										$sqlYX=$sqlYX." yenxe like '%".$value."%'";
										$first=false;
										$link_first=$link_first."&yenxe[]=".$value;
									}else{
										$sqlYX=$sqlYX." or yenxe like '%".$value."%'";
										$link_first=$link_first."&yenxe[]=".$value;
									}
								}
							}else{
								$sqlYX="";
							}
							//Vanh xe
							if(isset($_GET["vanhxe"]) && count($_GET["vanhxe"])>0){
							if($sqlK!="" || $sqlNSP!="" || $sqlM!="" || $sqlGX!="" || $sqlYX!=""){$sqlVX=" and ";}
								else{$sqlVX="";}
								$first=true;
								foreach ($_GET["vanhxe"] as $key => $value ) {
									if($first==true)
									{
										$sqlVX=$sqlVX." vanhxe like '%".$value."%'";
										$first=false;
										$link_first=$link_first."&vanhxe[]=".$value;
									}else{
										$sqlVX=$sqlVX." or vanhxe like '%".$value."%'";
										$link_first=$link_first."&vanhxe[]=".$value;
									}
								}
							}else{
								$sqlVX="";
							}
							//Lop xe
							if(isset($_GET["lopxe"]) && count($_GET["lopxe"])>0){
							if($sqlK!="" || $sqlNSP!="" || $sqlM!="" || $sqlGX!="" || $sqlYX!="" || $sqlVX!=""){$sqlLX=" and ";}
								else{$sqlLX="";}
								$first=true;
								foreach ($_GET["lopxe"] as $key => $value ) {
									if($first==true)
									{
										$sqlLX=$sqlLX." lopxe like '%".$value."%'";
										$first=false;
										$link_first=$link_first."&lopxe[]=".$value;
									}else{
										$sqlLX=$sqlLX." or lopxe like '%".$value."%'";
										$link_first=$link_first."&lopxe[]=".$value;
									}
								}
							}else{
								$sqlLX="";
							}
							//Phanh xe
							if(isset($_GET["phanhxe"]) && count($_GET["phanhxe"])>0){
							if($sqlK!="" || $sqlNSP!="" || $sqlM!="" || $sqlGX!="" || $sqlYX!="" || $sqlVX!="" || $sqlLX!=""){$sqlPX=" and ";}
								else{$sqlPX="";}
								$first=true;
								foreach ($_GET["phanhxe"] as $key => $value ) {
									if($first==true)
									{
										$sqlPX=$sqlPX." phanhxe like '%".$value."%'";
										$first=false;
										$link_first=$link_first."&phanhxe[]=".$value;
									}else{
										$sqlPX=$sqlPX." or phanhxe like '%".$value."%'";
										$link_first=$link_first."&phanhxe[]=".$value;
									}
								}
							}else{
								$sqlPX="";
							}
							//Noi chuoi truy van
							$link_first=$link_first."&search_box=";
							if($sqlNSP=="" && $sqlK=="" && $sqlM=="" && $sqlGX=="" && $sqlYX=="" && $sqlVX=="" && $sqlLX=="" && $sqlPX==""){
								$result = mysqli_query($conn, 'select count(masanpham) as total from sanpham where  loaisanpham=1');
							}else{
								$result = mysqli_query($conn, 'select count(masanpham) as total from sanpham where '.$sqlNSP.$sqlK.$sqlM.$sqlGX.$sqlYX.$sqlVX.$sqlLX.$sqlPX.'and loaisanpham=1');
							}
							$row = mysqli_fetch_assoc($result);
							$total_records = $row['total'];
							$config = array(
								'current_page'  => isset($_GET['page']) ? $_GET['page'] : 1,
								'total_record'  => $total_records,
								'limit'         => 9,
								'link_full'     => $link_first.'&page={page}',
								'link_first'    => $link_first,
								'range'         => 10 
							);
							$paging = new Pagination();	 
							$paging->init($config);
							$start=$paging->_config['start'];
							$limit=$paging->_config['limit'];
							if($sqlNSP=="" && $sqlK=="" && $sqlM=="" && $sqlGX=="" && $sqlYX=="" && $sqlVX=="" && $sqlLX=="" && $sqlPX==""){
								$sql="select * from sanpham where loaisanpham=1 limit $start,$limit";
							}else{
								$sql="select * from sanpham where ".$sqlNSP.$sqlK.$sqlM.$sqlGX.$sqlYX.$sqlVX.$sqlLX.$sqlPX." and loaisanpham=1 limit $start,$limit";
							}
						}else{
							echo '<h2 class="title text-center">Tất cả sản phẩm</h2>';
							$result = mysqli_query($conn, 'select count(masanpham) as total from sanpham where loaisanpham=1');
							$row = mysqli_fetch_assoc($result);
							$total_records = $row['total'];
							$config = array(
								'current_page'  => isset($_GET['page']) ? $_GET['page'] : 1,
								'total_record'  => $total_records,
								'limit'         => 9,
								'link_full'     => 'index.php?page={page}',
								'link_first'    => 'index.php',
								'range'         => 10 
							);
							$paging = new Pagination();	 
							$paging->init($config);
							$start=$paging->_config['start'];
							$limit=$paging->_config['limit'];
							$sql="select * from sanpham where loaisanpham=1 limit $start,$limit";
						}
						
						$result=$conn->query($sql);
						if(mysqli_num_rows($result)==0)
						{
							echo '<h3 style="color:orange;">Không tìm thấy sản phẩm</h3>';
						}
						while($row=mysqli_fetch_assoc($result))
						{
						echo	'<div class="col-sm-4">
									<div class="product-image-wrapper">
										<div class="single-products">
												<div class="productinfo text-center" style="height:430px;">
													<a href="product-details.php?id='.$row['masanpham'].'"><img src="images/products/'.$row['anh'].'" alt="" style="width:280px;height:200px;"/></a>';
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
													<button type="button" class="btn btn-fefault add-to-cart" onclick="add('.$row['masanpham'].',1,'.$row['soluongcon'].')">
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
					<?php
					require 'block/recommended_items.php';
					?>
				</div>
			</div>
		</div>
	</section>
	<?php
	require '/block/footer.php';
	?>
    <script src="js/jquery.js"></script>
	<script src="js/bootstrap.min.js"></script>
	<script src="js/jquery.scrollUp.min.js"></script>
	<script src="js/price-range.js"></script>
    <script src="js/jquery.prettyPhoto.js"></script>
    <script src="js/main.js"></script>
	<script src="js/cart.js"></script>
	<script src="js/search.js"></script>
</body>
</html>