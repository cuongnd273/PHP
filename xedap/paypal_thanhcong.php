﻿<?php
$msglogin="";
$msgregister="";
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="">
    <meta name="author" content="">
    <title>Paypal thành công | World Bike</title>
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
    <link rel="shortcut icon" href="../images/ico/favicon.ico">
    <link rel="apple-touch-icon-precomposed" sizes="144x144" href="images/ico/apple-touch-icon-144-precomposed.png">
    <link rel="apple-touch-icon-precomposed" sizes="114x114" href="images/ico/apple-touch-icon-114-precomposed.png">
    <link rel="apple-touch-icon-precomposed" sizes="72x72" href="images/ico/apple-touch-icon-72-precomposed.png">
    <link rel="apple-touch-icon-precomposed" href="images/ico/apple-touch-icon-57-precomposed.png">
</head><!--/head-->

<body>
	<?php
	require 'block/header.php';
	?>
	<?php
	require_once 'connect/db_connect.php';
	$db=new DB_Connect();
	$conn=$db->connect();
	$mahoadon=$_SESSION['mahoadon'];
	$date=date("Y/m/d");
	$sql="Update hoadon set trangthai='1' where mahoadon='$mahoadon'";
	$result=$conn->query($sql);
	$sql="select masanpham,soluong from chitiethoadon where mahoadon='$mahoadon'";
	$result=$conn->query($sql);
	while($row=mysqli_fetch_array($result))
	{
		$sql="Update sanpham set soluongcon=soluongcon-$row[soluong] where masanpham='$row[masanpham]'";
		$conn->query($sql);
		$resultKM=$conn->query("select DISTINCT(sanpham),soluongcon from chitietkhuyenmai,khuyenmai,sanpham where khuyenmai.sanpham=sanpham.masanpham and chitietkhuyenmai.makhuyenmai=khuyenmai.makhuyenmai and thoigianbatdau<'$date' and thoigianketthuc>'$date' and loaikhuyenmai=1 and chitietkhuyenmai.manhom=(select manhom from sanpham where masanpham='$row[masanpham]')");
		if(mysqli_num_rows($resultKM)>0)
		{
			while($set=mysqli_fetch_array($resultKM))
			{
				if($set['soluongcon']>$row['soluong'])
				{
					$conn->query("Update sanpham set soluongcon=soluongcon-$row[soluong] where masanpham='$set[sanpham]'");
				}else{
					$conn->query("Update sanpham set soluongcon=0 where masanpham='$set[sanpham]'");
				}
				
			}
		}
	}
	unset($_SESSION['mahoadon']);
	unset($_SESSION['cart']);
	?>
	<section id="form"><!--form-->
		<div class="container">
			<div class="row" align="center">
				<h1>Bạn đã thanh toán thành công.Chúng tôi sẽ giao hàng sớm nhất cho bạn!!</h1>
			</div>
		</div>
	</section><!--/form-->
	<?php
	require 'block/footer.php';
	?>
    <script src="js/jquery.js"></script>
	<script src="js/price-range.js"></script>
    <script src="js/jquery.scrollUp.min.js"></script>
	<script src="js/bootstrap.min.js"></script>
    <script src="js/jquery.prettyPhoto.js"></script>
    <script src="js/main.js"></script>
</body>
</html>