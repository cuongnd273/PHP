<?php
session_start();
if(!isset($_SESSION["admin"]) && !isset($_SESSION["nhanvien"]))
{
	header("Location: login.php");
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
									<h3 class="panel-title">Phòng</h3>
								</div>
								<div class="panel-body">
									<table class="table table-bordered">
										<thead>
											<tr>
												<th>Mã phòng</th>
												<th>Tên phòng</th>
												<th>Trạng thái</th>
												<th>Hóa đơn</th>
												<th>Thay đổi</th>
											</tr>
										</thead>
										<tbody>
											<?php
											include_once 'connect/db_connect.php';
											$db=new DB_Connect();
											$conn=$db->connect();
											if(isset($_GET['active']) && $_GET['active']=="true"){
												$result=mysqli_query($conn,'select * from phong where trangthai=true');	
											}else if(isset($_GET['active']) && $_GET['active']=="false"){
												$result=mysqli_query($conn,'select * from phong where trangthai=false');												
											}else{ $result=mysqli_query($conn,'select * from phong');}
											while($row=mysqli_fetch_array($result)){
												echo '
												<tr>
													<td>'.$row['maphong'].'</td>
													<td>'.$row['tenphong'].'</td>
												';
												if($row['trangthai']==true){
													echo '<td><span id="status" class="label label-success">Sử dụng</span></td>';
													
												}else{
													echo '<td><span id="status" class="label label-warning">Trống</span></td>';
													
												}
												if(isset($_SESSION['nhanvien'])){
													if($row['trangthai']==true){
														echo '<td><input type="image" width="40dp" heigth="40dp" src="assets/img/bill.png" onclick="hoadon_phong('.$row['maphong'].');"/></td>';
														echo '<td><button type="button" class="btn btn-primary" onclick="thaydoi('.$row['maphong'].','.$row['trangthai'].');">Thanh toán</button></td>';
													}else{
														echo '<td></td>';
														echo '<td><button type="button" class="btn btn-primary" onclick="thaydoi('.$row['maphong'].','.$row['trangthai'].');">Thay đổi</button></td>';
													}
												}else{
													echo '<td></td>';
													echo '<td></td>';
												}
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
	<script src="assets/js/control/phong.js"></script>
</body>

</html>
