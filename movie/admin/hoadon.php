<?php
ob_start();
session_start();
if(!isset($_SESSION["nhanvien"]) && !isset($_SESSION['admin']))
{
	header("Location: index.php");
}
?>
<!doctype html>
<html lang="en">
<head>
	<title>Khali Cinema</title>
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
	<meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=0">
	<!-- CSS -->
	<link rel="stylesheet" href="../assets/css/bootstrap.min.css">
	<link rel="stylesheet" href="../assets/css/vendor/icon-sets.css">
	<link rel="stylesheet" href="../assets/css/main.min.css">
	<!-- FOR DEMO PURPOSES ONLY. You should remove this in your project -->
	<link rel="stylesheet" href="../assets/css/demo.css">
	<!-- GOOGLE FONTS -->
	<link href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,600,700" rel="stylesheet">
	<!-- ICONS -->
	<link rel="apple-touch-icon" sizes="76x76" href="../assets/img/apple-icon.png">
	<link rel="icon" type="image/png" sizes="96x96" href="../assets/img/favicon.png">
</head>
<body>
	<!-- WRAPPER -->
	<div id="wrapper">
		<!-- SIDEBAR -->
		<?php include_once '../assets/blocks/menu.php';?>
		<!-- END SIDEBAR -->
		<!-- MAIN -->
		<div class="main">
			<!-- MAIN CONTENT -->
			<div class="main-content">
				<div class="container-fluid">
					<div class="row" style="margin-top: 20px">
						<div class="col-lg-7 col-md-offset-3">
							<!-- BORDERED TABLE -->
							<div class="panel">
								<div class="panel-heading">
									<h3 class="panel-title">Hóa đơn</h3>
								</div>
								<div class="panel-body">
								<div class="alert alert-success" id="alert-success-top" ><?php if(isset($mess)) echo $mess;?></div>
									<table class="table table-bordered">
										<thead>
											<tr>
												<th  style="text-align:center">Ngày tạo</th>
												<th  style="text-align:center">Tổng tiền</th>
												<th  style="text-align:center">Giảm giá</th>
												<th  style="text-align:center">Chi tiết</th>
												<th  style="text-align:center">Trạng thái</th>
												<th></th>
											</tr>
										</thead>
										<tbody>
											<?php
											include_once '../connect/db_connect.php';
											$db=new DB_Connect();
											$conn=$db->connect();
											$id=$_GET['mataikhoan'];
											$result=mysqli_query($conn,"select * from hoadon where taikhoan='$id' order by ngaytao desc");
											while($row=mysqli_fetch_array($result)){
												echo '
												<tr>
													<td align="center">'.$row['ngaytao'].'</td>
													<td align="center">'.$row['tongtien'].'</td>
													<td align="center">'.$row['giamgia'].' %</td>';
												
												echo	
													'<td align="center" class="col-md-1"><a href="chitiethoadon.php?mahoadon='.$row['mahoadon'].'"><img width="30" height="30" type="image" src="../assets/img/info.png"/></a></td>
												';

												if($row['trangthai']==0){
													echo '<td align="center">Chưa thanh toán</td>';
													echo '<td ><button type="button" class="btn btn-sm btn-success" onclick="thanhtoan('.$row['mahoadon'].')">Thanh toán</button></td>';
												}
												else
													echo '<td align="center">Đã thanh toán</td>';

												echo '</tr>';
											}
											?>
										</tbody>
									</table>
								</div>
							</div>
							<!-- END BORDERED TABLE -->
						</div>
					</div>
				</div>
			</div>
			<!-- END MAIN CONTENT -->
			<?php include_once '../assets/blocks/footer.php';?>
		</div>
		<!-- END MAIN -->
	</div>
	<!-- END WRAPPER -->
	<!-- Javascript -->
	<script src="../assets/js/jquery/jquery-2.1.0.min.js"></script>
	<script src="../assets/js/bootstrap/bootstrap.min.js"></script>
	<script src="../assets/js/plugins/jquery-slimscroll/jquery.slimscroll.min.js"></script>
	<script src="../assets/js/klorofil.min.js"></script>
	<script src="../assets/admin/hoadon.js"></script>
</body>

</html>
