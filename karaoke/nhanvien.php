<?php
session_start();
if(!isset($_SESSION["admin"]))
{
	header("Location: 404.php");
}
?>
<!doctype html>
<html lang="en">
<?php include_once 'assets/blocks/header.php';?>
<body>
	<!-- WRAPPER -->
	<div id="wrapper">
		<!-- SIDEBAR -->
		<?php include_once 'assets/blocks/menu.php';?>
		<!-- END SIDEBAR -->
		<!-- MAIN -->
		<div class="main">
			<!-- MAIN CONTENT -->
			<div class="main-content">
				<div class="container-fluid">
					<div class="row">
						<div class="col-md-10 col-md-offset-4">
							<div class="col-lg-5">
								<div class="alert alert-success" id="alert-success-top" ><?php if(isset($mess)) echo $mess;?></div>
								<form action="" method="post">
									<table>
										<tr>
											<td><label>Tài khoản </label></td>
											<td><input type="text" id="taikhoan" class="form-control"></td>
										</tr>
										<tr>
											<td><label>Mật khẩu </label></td>
											<td><input type="text" id="matkhau" class="form-control"></td>
										</tr>
										<tr>
											<td><label>Họ tên </label></td>
											<td><input type="text" id="hoten" class="form-control"></td>
										</tr>
										<tr>
											<td><label>Địa chỉ </label></td>
											<td><input type="text" id="diachi" class="form-control"></td>
										</tr>
										<tr>
											<td><label>Số điện thoại </label></td>
											<td><input type="text" id="sdt" class="form-control"></td>
										</tr>
										<tr>
											<td><label>CMND </label></td>
											<td><input type="text" id="cmnd" class="form-control"></td>
										</tr>
										<tr>
											<td><label>Lương </label></td>
											<td><input type="text" id="luong" class="form-control"></td>
										</tr>
										<tr>
											<td></td>
											<td><button type="button" name="them" class="btn btn-sm btn-success" onclick="them_nhanvien();">OK</button>
											<button type="reset" class="btn btn-sm btn-warning">Reset</button></td>
										</tr>
									</table>
								</form>
							</div>
						</div>
					</div>
					<div class="row">
						<div class="col-lg-6 col-md-offset-3">
							<!-- BORDERED TABLE -->
							<div class="panel">
								<div class="panel-heading">
									<h3 class="panel-title">Nhân viên</h3>
								</div>
								<div class="panel-body">
									<table class="table table-bordered">
										<thead>
											<tr>
												<th>Nhân viên</th>
												<th>Số điện thoại</th>
												<th>Địa chỉ</th>
												<th>CMND</th>
												<th>Lương</th>
												<th>Xóa</th>
											</tr>
										</thead>
										<tbody>
											<?php
											include_once 'connect/db_connect.php';
											$db=new DB_Connect();
											$conn=$db->connect();
											$result=mysqli_query($conn,'select * from nhanvien');
											while($row=mysqli_fetch_array($result)){
												echo "<tr>";
												echo '
													<td>'.$row['hoten'].'</td>
													<td>'.$row['sdt'].'</td>
													<td>'.$row['diachi'].'</td>
													<td>'.$row['cmnd'].'</td>
													<td>'.$row['luong'].'</td>
												';
												echo '<td><input type="image" width="40dp" heigth="40dp" src="assets/img/delete_icon.png" onclick="xoa_nhanvien('.$row['manhanvien'].')"/></td>';
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
			<?php include_once 'assets/blocks/footer.php';?>
		</div>
		<!-- END MAIN -->
	</div>
	<!-- END WRAPPER -->
	<!-- Javascript -->
	<script src="assets/js/jquery/jquery-2.1.0.min.js"></script>
	<script src="assets/js/bootstrap/bootstrap.min.js"></script>
	<script src="assets/js/plugins/jquery-slimscroll/jquery.slimscroll.min.js"></script>
	<script src="assets/js/klorofil.min.js"></script>
	<script src="assets/js/control/nhanvien.js"></script>
</body>

</html>
