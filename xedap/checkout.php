<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="">
    <meta name="author" content="">
    <title>Thanh toán | World Bike</title>
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
	<script>
	function thanhtoanjs()
	{
		var hoten=document.getElementById('hoten').value;
		var email=document.getElementById('email').value;
		var sdt=document.getElementById('sdt').value;
		var diachi=document.getElementById('diachi').value;
		if(hoten.length<5)
		{
			document.getElementById("alert").innerHTML = "Tên phải lớn hơn 5 ký tự ";
			return false;
		}else if(sdt.length<10)
		{
			document.getElementById("alert").innerHTML = "Hãy nhập đủ số điện thoại ";
			return false;
		}else if(diachi.length<10)
		{
			document.getElementById("alert").innerHTML = "Hãy nhập đúng địa chỉ";
			return false;
		}
		return true;
	}
	</script>
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
				  <li class="active">Thanh toán</li>
				</ol>
			</div><!--/breadcrums-->
			<?php
			require_once 'connect/db_connect.php';
			$db=new DB_Connect();
			$conn=$db->connect();
			if(!isset($_SESSION['username']))
			{
				echo '<div class="register-req">
				<p>Bạn chưa đăng nhập,vui lòng đăng nhập và thanh toán,hoặc thanh toán như khách!!</p>
					  </div><!--/register-req-->';
			}
			if(isset($_POST['thanhtoan']))
			{
				$total_money=0;
				foreach($_SESSION['cart'] as $key=>$value)
				{
					$total_money=$value['money']+$total_money;
				}
				$date=date("Y/m/d");
				if(isset($_SESSION['username']))
				{
					$hoten=$_POST['hoten'];
					$email=$_POST['email'];
					$sdt=$_POST['sdt'];
					$diachi=$_POST['diachi'];
					$thanhtoan=$_POST['loaithanhtoan'];
					$ghichu=$_POST['ghichu'];
					$mataikhoan=$_SESSION['id'];
					if($thanhtoan=="tructiep")
					{
						$thanhtoan="Trực tiếp khi nhận hàng";
						$sql="Insert into hoadon(mataikhoan,ngaytao,tenkhachhang,sdt,diachi,hinhthucthanhtoan,ghichu,trangthai,tongtien) values('$mataikhoan',NOW(),'$hoten','$sdt','$diachi','$thanhtoan','$ghichu',0,'$total_money')";
						$result=$conn->query($sql);
						$last_id = $conn->insert_id;
						foreach($_SESSION['cart'] as $key=>$value)
						{
							$sql="Insert into chitiethoadon(mahoadon,masanpham,sanpham,gia,soluong) values('$last_id','$value[id]','$value[name]','$value[price]','$value[count]')";
							$conn->query($sql);
						}
						echo "<script>";
						echo "var link='tructiep_thanhcong.php';
								window.location.href=link;";
						echo "</script>";
					}else if($thanhtoan=="paypal")
					{
						$thanhtoan="Thanh toán qua paypal";
						$sql="Insert into hoadon(mataikhoan,ngaytao,tenkhachhang,sdt,diachi,hinhthucthanhtoan,ghichu,trangthai,tongtien) values('$mataikhoan',NOW(),'$hoten','$sdt','$diachi','$thanhtoan','$ghichu',0,'$total_money')";
						$result=$conn->query($sql);
						$last_id = $conn->insert_id;
						foreach($_SESSION['cart'] as $key=>$value)
						{
							$sql="Insert into chitiethoadon(mahoadon,masanpham,sanpham,gia,soluong) values('$last_id','$value[id]','$value[name]','$value[price]','$value[count]')";
							$conn->query($sql);
						}
						$_SESSION['mahoadon']=$last_id;
						echo "<script>";
						echo "var link='paypal.php';
								window.location.href=link;";
						echo "</script>";
						
					}
				}else{
					$hoten=$_POST['hoten'];
					$email=$_POST['email'];
					$sdt=$_POST['sdt'];
					$diachi=$_POST['diachi'];
					$thanhtoan=$_POST['loaithanhtoan'];
					$ghichu=$_POST['ghichu'];
					$sql="select mataikhoan from taikhoan where email='Default@gmail.com'";
					$result=$conn->query($sql);
					$row=mysqli_fetch_row($result);
					$mataikhoan=$row[0];
					if($thanhtoan=="tructiep")
					{
						$thanhtoan="Trực tiếp khi nhận hàng";
						$sql="Insert into hoadon(mataikhoan,ngaytao,tenkhachhang,sdt,diachi,hinhthucthanhtoan,ghichu,trangthai,tongtien) values('$mataikhoan',NOW(),'$hoten','$sdt','$diachi','$thanhtoan','$ghichu',0,'$total_money')";
						$result=$conn->query($sql);
						$last_id = $conn->insert_id;
						foreach($_SESSION['cart'] as $key=>$value)
						{
							$sql="Insert into chitiethoadon(mahoadon,masanpham,sanpham,gia,soluong) values('$last_id','$value[id]','$value[name]','$value[price]','$value[count]')";
							$conn->query($sql);
						}
						echo "<script>";
						echo "var link='tructiep_thanhcong.php';
								window.location.href=link;";
						echo "</script>";
					}else if($thanhtoan=="paypal")
					{
						$thanhtoan="Thanh toán qua paypal";
						$sql="Insert into hoadon(mataikhoan,ngaytao,tenkhachhang,sdt,diachi,hinhthucthanhtoan,ghichu,trangthai,tongtien) values('$mataikhoan',NOW(),'$hoten','$sdt','$diachi','$thanhtoan','$ghichu',0,'$total_money')";
						$result=$conn->query($sql);
						$last_id = $conn->insert_id;
						foreach($_SESSION['cart'] as $key=>$value)
						{
							$sql="Insert into chitiethoadon(mahoadon,masanpham,sanpham,gia,soluong) values('$last_id','$value[id]','$value[name]','$value[price]','$value[count]')";
							$conn->query($sql);
						}
						$_SESSION['mahoadon']=$last_id;
						echo "<script>";
						echo "var link='paypal.php';
								window.location.href=link;";
						echo "</script>";
						
					}
				}
				
			}
			?>

			<div class="shopper-informations">
				<div class="row">
					<div class="col-sm-3">
						<div class="shopper-info">
							<p>Thông tin đơn hàng</p>
							<form id="formthanhtoan" action="" method="post" onsubmit="return thanhtoanjs();">
							<h4 class = "form-signin-heading" id="alert"></h4>
								<input type="text" placeholder="Họ tên" id="hoten" name="hoten">
								<input type="text" placeholder="Email" id="email" name="email" value="<?php if(isset($_SESSION['email'])){echo $_SESSION['email'];}?>">
								<input type="text" placeholder="Số điện thoại" id="sdt" name="sdt">
								<input type="text" placeholder="Địa chỉ" id="diachi" name="diachi">
								</br>
								</br>
								<div class="payment-options" >
									<span>
										<li style="list-style:none"><input type="radio" name="loaithanhtoan" checked="checked" value="tructiep"> Thanh toán khi nhận hàng</li>
									</span>
									<span>
										<li style="list-style:none"><input type="radio" name="loaithanhtoan" value="paypal"> Thanh toán qua paypal</li>
									</span>
								</div>
							<input type="submit" class="btn btn-primary" name="thanhtoan" value="Thanh toán">
						</div>
					</div>
					<div class="col-sm-5 clearfix">
						<div class="order-message">
							<p>Ghi chú</p>
							<textarea name="ghichu" placeholder="Ghi chú về đơn hàng" rows="16" form="formthanhtoan"></textarea>
						</div>		
							</form>
					</div>			
				</div>
			</div>
			<div class="review-payment">
				<h2>Giỏ hàng</h2>
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
												<input readonly="true" class="cart_quantity_input" type="text" name="quantity" value="'.$value["count"].'" autocomplete="off" size="2">
											</div>
										</td>
										<td class="cart_total">
											<p class="cart_total_price">'.number_format($value["money"]).'</p>
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
					<tr>
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
					echo '		<td colspan="4">&nbsp;</td>
								<td colspan="2">
									<table class="table table-condensed total-result">
										<tr>
											<td>Số mặt hàng</td>
											<td>'.$toal_product.'</td>
										</tr>
										<tr>
											<td>Số lượng sản phẩm</td>
											<td>'.$count.'</td>
										</tr>
										<tr class="shipping-cost">
											<td>Tổng tiền</td>
											<td>'.number_format($total_money).' VND</td>										
										</tr>
									</table>
								</td>';
					}
					?>
					</tr>
					</tbody>
				</table>
			</div>
		</div>
	</section> <!--/#cart_items-->
	<?php
	require 'block/footer.php';
	?>
    <script src="js/jquery.js"></script>
	<script src="js/bootstrap.min.js"></script>
    <script src="js/jquery.scrollUp.min.js"></script>
    <script src="js/jquery.prettyPhoto.js"></script>
    <script src="js/main.js"></script>
	<script src="js/search.js"></script>
</body>
</html>