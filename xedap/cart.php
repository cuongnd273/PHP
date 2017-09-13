<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="">
    <meta name="author" content="">
    <title>Giỏ hàng | World Bike</title>
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
	<section id="cart_items">
		<div class="container">
			<div class="breadcrumbs">
				<ol class="breadcrumb">
				  <li><a href="#">Home</a></li>
				  <li class="active">Giỏ hàng</li>
				</ol>
			</div>
			<div class="table-responsive cart_info">
				<table class="table table-condensed">
					<thead>
						<tr class="cart_menu">
							<td class="image">Sản phẩm</td>
							<td class="description"></td>
							<td class="price">Giá</td>
							<td class="quantity">Số lượng</td>
							<td class="total">Tổng tiền</td>
							<td></td>
						</tr>
					</thead>
					<tbody>
					<?php
					$ok=1;
					if(isset($_SESSION['cart']))
					{
						 foreach($_SESSION['cart'] as $k => $v)
						 {
						  if(isset($k))
						  {
						   $ok=2;
						  }
						 }
						 if($ok==2)
						 {
							 require_once 'connect/db_connect.php';
							 $db=new DB_Connect();
							 $conn=$db->connect();
							 foreach($_SESSION['cart'] as $key=>$value)
							 {
								echo'	 <tr>
											<td class="cart_product">
												<a href=""><img src="images/products/'.$value["image"].'" alt="" width="80px" height="80px"></a>
											</td>
											<td class="cart_description">
												<h4><a href="">'.$value["name"].'</a></h4>
												<p>Mã sản phẩm: '.$value["id"].'</p>
											</td>
											<td class="cart_price">
												<p>'.number_format($value["price"]).'</p>
											</td>
											<td class="cart_quantity">
												<div class="cart_quantity_button">
													<input class="cart_quantity_input" type="number" min="1" style="width:50px;" name="soluong" value="'.$value["count"].'" autocomplete="off" size="2" required>
												</div>
											</td>
											<td class="cart_total">
												<p class="cart_total_price">'.number_format($value["money"]).'</p>
											</td>
											<td class="cart_delete">
												<button class="cart_quantity_delete" type="button" onclick="del('.$value["id"].')"><i class="fa fa-times"></i></button>
											</td>
										</tr>';
							 }
						 }else{
							 echo '<h4 align="center">Bạn chưa có sản phẩm nào trong giỏ hàng!</h4>';
						 }
					}else{
						echo '<h4 align="center">Bạn chưa có sản phẩm nào trong giỏ hàng!!</h4>';
					}
					?>
					</tbody>
				</table>
			</div>
		</div>
	</section> <!--/#cart_items-->

	<section id="do_action">
		<div class="container">
			<div class="row">
				<div class="col-sm-6">
				<?php
				if($ok!=1)
				{
					$count=0;
					$total_money=0;
					$toal_product=0;
					foreach($_SESSION['cart'] as $key=>$value)
					{
						$count=$value['count']+$count;
						$total_money=$value['money']+$total_money;
						$toal_product++;
					}
				echo'	<div class="total_area">
							<ul>
								<li>Số loại sản phẩm <span>'.$toal_product.'</span></li>
								<li>Tổng số sản phẩm <span>'.$count.'</span></li>
								<li>Tổng tiền <span>'.number_format($total_money).'</span></li>
							</ul>
								<input class="btn btn-default update" type="button" value="Cập nhập" onclick="update()"></a>
								<a class="btn btn-default check_out" href="checkout.php">Thanh toán</a>
								<input class="btn btn-default check_out" type="button" value="Xóa hết" onclick="delAll()"></a>
						</div>';
				}
				?>
				</div>
			</div>
		</div>
	</section><!--/#do_action-->
	<?php
	require 'block/footer.php';
	?>
    <script src="js/jquery.js"></script>
	<script src="js/bootstrap.min.js"></script>
	<script src="js/jquery.scrollUp.min.js"></script>
    <script src="js/jquery.prettyPhoto.js"></script>
    <script src="js/main.js"></script>
	<script src="js/cart.js"></script>
	<script src="js/search.js"></script>
</body>
</html>