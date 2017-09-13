<?php
if(!isset($_SESSION))
{
	ob_start();
    session_start();
}  
?>
<header id="header"><!--header-->
		<div class="header_top"><!--header_top-->
			<div class="container">
				<div class="row">
					<div class="col-sm-6">
						<div class="contactinfo">
							<ul class="nav nav-pills">
								<li><a href="#"><i class="fa fa-phone"></i> +2 95 01 88 821</a></li>
								<li><a href="#"><i class="fa fa-envelope"></i> worldbike@gmail.com</a></li>
							</ul>
						</div>
					</div>
				</div>
			</div>
		</div><!--/header_top-->
		
		<div class="header-middle"><!--header-middle-->
			<div class="container">
				<div class="row">
					<div class="col-sm-4">
						<div class="logo pull-left">
							<a href="index.php"><img src="images/home/logo.png" alt="" /></a>
						</div>
					</div>
					<div class="col-sm-8">
						<div class="shop-menu pull-right">
							<ul class="nav navbar-nav">
								<li><a href="cart.php"><i class="fa fa-shopping-cart"></i> Giỏ hàng<?php 
								if(!isset($_SESSION['cart']))
								{
									echo "(0)";
								}else{
									$total_products=0;
									foreach($_SESSION['cart'] as $key=>$value)
									{
										if(isset($key))
										{
											$total_products=$total_products+$value['count'];
										}
									}
									echo "(".$total_products.")";
								}
								?>
									</a></li>
								<?php
								if(!isset($_SESSION['username']))
								{
								echo "<li><a href='login.php'><i class='fa fa-lock'></i> Đăng nhập</a></li>";
								}else
								{
									echo "<li><a href='logout.php'><i class='fa fa-sign-out'></i> Đăng xuất</a></li>";
									echo "<li><a href=''><i class='fa fa-user'></i>Xin chào: <b>".$_SESSION['username']."</b></a></li>";
								}
								?>
							</ul>
						</div>
					</div>
				</div>
			</div>
		</div><!--/header-middle-->
	
		<div class="header-bottom"><!--header-bottom-->
			<div class="container">
				<div class="row">
					<div class="col-sm-9">
						<div class="navbar-header">
							<button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-collapse">
								<span class="sr-only">Toggle navigation</span>
								<span class="icon-bar"></span>
								<span class="icon-bar"></span>
								<span class="icon-bar"></span>
							</button>
						</div>
						<div class="mainmenu pull-left">
							<ul class="nav navbar-nav collapse navbar-collapse">
								<li><a href="index.php" class="active">Trang chủ</a></li>
								<li class="dropdown"><a href="#">Shop<i class="fa fa-angle-down"></i></a>
                                    <ul role="menu" class="sub-menu">
										<li><a href="checkout.php">Thanh toán</a></li> 
										<li><a href="cart.php">Giỏ hàng</a></li>  
                                    </ul>
                                </li> 
								<li><a href="contact-us.php">Liên hệ</a></li>
								<li class="dropdown">
								  <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">Tìm kiếm <span class="caret"></span></a>
								  <ul class="dropdown-menu">
									<form class="navbar-form navbar-left navbar-input-group" role="search" style="width:600px;" action="index.php" method="get">
										<div style="width:600px;margin:0 auto;">
											<div style="float:left;width:200px;">
											<label>Nhóm sản phẩm</label><br>
											<?php
											require_once 'connect/db_connect.php';
											$sql="select * from nhomsanpham where tennhom!='Quà khuyến mãi'";
											$db=new DB_Connect();
											$conn=$db->connect();
											$result=mysqli_query($conn,$sql) or die('Cau lenh sai');
											while($row=mysqli_fetch_array($result))
											{
												echo	'<input type="checkbox" name="nhomsanpham[]" value="'.$row['manhom'].'">'.$row['tennhom'].'<br>';
											}
											?>
											</div>
											<div style="float:left;width:auto;">
											<label>Khung</label><br>
												<input type="checkbox" name="khungxe[]" value="nhôm">Khung nhôm<br>
												<input type="checkbox" name="khungxe[]" value="sắt">Khung sắt<br>
											</div>
											<div style="float:right;width:200px;">
											<label>Màu sắc</label><br>
												<input type="checkbox" name="mausac[]" value="đỏ">Màu đỏ<br>
												<input type="checkbox" name="mausac[]" value="xanh">Màu xanh<br>
												<input type="checkbox" name="mausac[]" value="vàng">Màu vàng<br>
												<input type="checkbox" name="mausac[]" value="trắng">Màu trắng<br>
											</div>
											<div style="float:right;width:200px;">
											<label>Giảm xóc</label><br>
												<input type="checkbox" name="giamxoc[]" value="đơn">Giảm xóc đơn<br>
												<input type="checkbox" name="giamxoc[]" value="kép">Giảm xóc kép<br>
											</div>
											<div style="float:right;width:200px;">
											<label>Yên xe</label><br>
												<input type="checkbox" name="yenxe[]" value="da">Yên da<br>
												<input type="checkbox" name="yenxe[]" value="nhựa">Yên nhựa<br>
												<input type="checkbox" name="yenxe[]" value="nhung">Yên nhung<br>
												<input type="checkbox" name="yenxe[]" value="carbon">Yên Carbon<br>
											</div>
											<div style="float:right;width:200px;">
											<label>Vành xe</label><br>
												<input type="checkbox" name="vanhxe[]" value="đúc">Vành đúc<br>
												<input type="checkbox" name="vanhxe[]" value="nan hoa">Vành nan hoa<br>
											</div>
											<div style="float:right;width:200px;">
											<label>Lốp xe</label><br>
												<input type="checkbox" name="lopxe[]" value="chống dính">Lốp chống đinh<br>
												<input type="checkbox" name="lopxe[]" value="thường">Lốp thường<br>
											</div>
											<div style="float:right;width:200px;">
											<label>Phanh xe</label><br>
												<input type="checkbox" name="phanhxe[]" value="dia">Phanh đĩa<br>
												<input type="checkbox" name="phanhxe[]" value="co">Phanh cơ<br>
											</div>
											<button style="position:absolute; margin-left:-50px;left:50%;width:100px;bottom:0px;" type="submit" class="btn btn-primary" name="search_box"><span class="glyphicon glyphicon-search" aria-hidden="true"></span></button>
										</div>
									</form>
								  </ul>
								</li>
							</ul>
						</div>
					</div>
					<form action="javascript:checkURL();">
						<div class="col-sm-3">
							<div class="search_box pull-right">
								<input id="search" type="text" placeholder="Search" autofocus"/>
							</div>
						</div>
					</form>
				</div>
			</div>
		</div><!--/header-bottom-->
	</header><!--/header-->
