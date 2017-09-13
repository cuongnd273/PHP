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
						<div class="col-lg-6 col-md-offset-3">
							<!-- BORDERED TABLE -->
							<div class="panel">
								<div class="panel-heading">
									<h3 class="panel-title">Hóa đơn</h3>
								</div>
								<div class="panel-body">
									<table class="table table-bordered">
										<thead>
											<tr>
												<th>Nhân viên</th>
												<th>Phòng</th>
												<th>Thời gian lập</th>
												<th>Tổng tiền</th>
											</tr>
										</thead>
										<tbody>
											<?php
											include_once 'connect/db_connect.php';
											$db=new DB_Connect();
											$conn=$db->connect();
											if(isset($_GET['pay']) && $_GET['pay']=="dathanhtoan"){
												$result=mysqli_query($conn,'select mahoadon,hoten,tenphong,thoigianlap,tongtien from phong,nhanvien,hoadon where phong.maphong=hoadon.maphong and nhanvien.manhanvien=hoadon.manhanvien and tinhtrang=1');
											}else if(isset($_GET['pay']) && $_GET['pay']=="chuathanhtoan"){
												$result=mysqli_query($conn,'select mahoadon,hoten,tenphong,thoigianlap,tongtien from phong,nhanvien,hoadon where phong.maphong=hoadon.maphong and nhanvien.manhanvien=hoadon.manhanvien and tinhtrang=0');
											}else{
												$result=mysqli_query($conn,'select mahoadon,hoten,tenphong,thoigianlap,tongtien from phong,nhanvien,hoadon where phong.maphong=hoadon.maphong and nhanvien.manhanvien=hoadon.manhanvien and tinhtrang=1');
											}
											while($row=mysqli_fetch_array($result)){
												echo "<tr>";
												echo '
													<td>'.$row['hoten'].'</td>
													<td>'.$row['tenphong'].'</td>
													<td>'.$row['thoigianlap'].'</td>
													<td>'.number_format($row['tongtien']).'</td>
												';
												echo '<td><button type="button" class="btn btn-primary" onclick="thongtin('.$row['mahoadon'].');">Chi tiết</button></td>';
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
		</div>
		<?php include_once 'assets/blocks/footer.php';?>
		<!-- END MAIN -->
	</div>
	<!-- END WRAPPER -->
	<!-- Javascript -->
	<script src="assets/js/jquery/jquery-2.1.0.min.js"></script>
	<script src="assets/js/bootstrap/bootstrap.min.js"></script>
	<script src="assets/js/plugins/jquery-slimscroll/jquery.slimscroll.min.js"></script>
	<script src="assets/js/klorofil.min.js"></script>
	<script src="assets/js/control/hoadon.js"></script>
</body>

</html>
