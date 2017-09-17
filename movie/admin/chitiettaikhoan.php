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
					<div class="row">
							<div class="col-md-10 col-md-offset-4">
								<div class="col-lg-5">
										<table class="table table-bordered" >
										<?php
										include '../connect/db_connect.php';
										$db=new DB_Connect();
										$conn=$db->connect();
										$id=$_GET['mataikhoan'];
										$result=mysqli_query($conn,"select * from taikhoan where mataikhoan='$id'");
										$row=mysqli_fetch_array($result);
										?>
											<tr>
												<td><label>Tài khoản </label></td>
												<td><input type="text" value="<?php echo $row['taikhoan'] ?>" class="form-control" disabled></td>
											</tr>
											<tr>
												<td><label>Họ tên </label></td>
												<td><input type="text" value="<?php echo $row['hoten'] ?>" class="form-control" disabled></td>
											</tr>
											<tr>
												<td><label>Email </label></td>
												<td><input type="text" value="<?php echo $row['email'] ?>" class="form-control" disabled></td>
											</tr>
											<tr>
												<td><label>SĐT </label></td>
												<td><input type="text" value="<?php echo $row['sdt'] ?>" class="form-control" disabled></td>
											</tr>
											<tr>
												<td><label>CMND </label></td>
												<td><input type="text" value="<?php echo $row['cmnd'] ?>" class="form-control" disabled></td>
											</tr>
											<tr>
												<td><label>Ngày sinh </label></td>
												<td><input type="text" value="<?php echo $row['ngaysinh'] ?>" class="form-control" disabled></td>
											</tr>
											<tr>
												<td><label>Địa chỉ </label></td>
												<td><input type="text" value="<?php echo $row['diachi'] ?>" class="form-control" disabled></td>
											</tr>
										</table>
								</div>
							</div>
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
	<script src="../assets/js/control/phong.js"></script>
</body>

</html>
