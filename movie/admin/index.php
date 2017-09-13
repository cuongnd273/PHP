<?php
// session_start();
// if(!isset($_SESSION["admin"]) && !isset($_SESSION["nhanvien"]))
// {
// 	header("Location: login.php");
// }
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
									<form action="" method="post">
										<table>
											<tr>
												<td><label>Tên phòng </label></td>
												<td><input type="text" id="tenphong" class="form-control"></td>
											</tr>
											<tr>
												<td><label>Số ghế </label></td>
												<td><input type="number" id="soghe" value="50" class="form-control"></td>
											</tr>
											<tr>
												<td></td>
												<td><button style="margin-top: 20px" type="button" class="btn btn-sm btn-success" onclick="add();">Thêm</button>
											</tr>
										</table>
									</form>
								</div>
							</div>
						</div>
					<div class="row" style="margin-top: 20px">
						<div class="col-lg-4 col-md-offset-4">
							<!-- BORDERED TABLE -->
							<div class="alert alert-success" id="alert-success-top" ><?php if(isset($mess)) echo $mess;?></div>
							<div class="panel">
								<div class="panel-heading">
									<h3 class="panel-title">Phòng chiếu</h3>
								</div>
								<div class="panel-body">
									<table class="table table-bordered">
										<thead>
											<tr>
												<th style="text-align:center">Tên phòng</th>
												<th style="text-align:center">Số ghế</th>
												<th style="text-align:center">Xóa</th>
											</tr>
										</thead>
										<tbody>
											<?php
											include_once '../connect/db_connect.php';
											$db=new DB_Connect();
											$conn=$db->connect();
											$result=mysqli_query($conn,"select * from phongchieu where isDelete=false");
											while($row=mysqli_fetch_array($result)){
												echo '
												<tr>
													<td>'.$row['tenphong'].'</td>
													<td>'.$row['soghe'].'</td>
													<td><input width="30" height="30" type="image" src="../assets/img/delete.png" onclick="del('.$row['maphong'].')"/></td>
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
	<script src="../assets/admin/phongchieu.js"></script>
</body>

</html>