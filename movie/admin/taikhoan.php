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
						<div class="col-lg-9 col-md-offset-2">
							<!-- BORDERED TABLE -->
							<div class="panel">
								<div class="panel-heading">
									<h3 class="panel-title">Tài khoản</h3>
									<div id="alert-success-top" ><?php if(isset($mess)) echo $mess;?></div>
								</div>
								<div class="panel-body">
									<table class="table table-bordered">
										<thead>
											<tr>
												<th>Tài khoản</th>
												<th>Email</th>
												<th>Số điện thoại</th>
												<th>Chi tiết</th>
												<th>Hóa đơn</th>
												<th>Vô hiệu</th>
											</tr>
										</thead>
										<tbody>
											<?php
											include_once '../connect/db_connect.php';
											$db=new DB_Connect();
											$conn=$db->connect();
											$result=mysqli_query($conn,"select * from taikhoan where isDelete=false");
											while($row=mysqli_fetch_array($result)){
												echo '
												<tr>
													<td>'.$row['taikhoan'].'</td>
													<td width=215>'.$row['email'].'</td>
													<td>'.$row['sdt'].'</td>
													<td align="center" class="col-md-1"><input width="30" height="30" type="image" src="../assets/img/edit.png" onclick="info('.$row['mataikhoan'].')"/></td>
													<td align="center" class="col-md-1"><input width="30" height="30" type="image" src="../assets/img/bill.png" onclick="bill('.$row['mataikhoan'].')"/></td>
													<td align="center" class="col-md-1"><input width="30" height="30" type="image" src="../assets/img/cancle.png" onclick="kick('.$row['mataikhoan'].')"/></td>
												';
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
	<script src="../assets/admin/taikhoan.js"></script>
</body>

</html>
