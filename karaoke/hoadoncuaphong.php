<?php
session_start();
if(!isset($_SESSION["nhanvien"]))
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
											<td><label>Sản phẩm</label></td>
											<td>
											<select id="mathang" class="form-control">
											<option value="">Chọn sản phẩm</option>
											<?php
											include_once 'connect/db_connect.php';
											$db=new DB_Connect();
											$conn=$db->connect();
											$result=mysqli_query($conn,"select * from mathang");
											while($row=mysqli_fetch_array($result)){
												echo '<option value="'.$row['mamathang'].'">'.$row['tenmathang'].'</option>';
											}
											?>
											</select>
											</td>
										</tr>
										<tr>
											<td><label>Số lượng</label></td>
											<td><input type="number" id="soluong" value="1" min="1" class="form-control"></td>
										</tr>
										<tr>
											<td></td>
											<td><button type="button" name="them" class="btn btn-sm btn-success" onclick="them_chitiet(<?php echo $_GET['maphong'];?>);">OK</button>
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
									<h3 class="panel-title">Chi tiết hóa đơn</h3>
								</div>
								<div class="panel-body">
									<table class="table table-bordered">
										<thead>
											<tr>
												<th>Sản phẩm</th>
												<th>Số lượng</th>
												<th>Đơn giá</th>
												<th>Xóa</th>
											</tr>
										</thead>
										<tbody>
											<?php
											$result=mysqli_query($conn,"select tenmathang,soluong,chitiethoadon.dongia from chitiethoadon,mathang where chitiethoadon.mamathang=mathang.mamathang and chitiethoadon.mahoadon=(select mahoadon from hoadon where maphong='$_GET[maphong]' ORDER by mahoadon desc limit 1)");
											while($row=mysqli_fetch_array($result)){
												echo "<tr>";
												echo '
													<td>'.$row['tenmathang'].'</td>
													<td>'.$row['soluong'].'</td>
													<td>'.number_format($row['dongia']).'</td>
												';
												echo '<td><input type="image" width="40dp" heigth="40dp" src="assets/img/delete_icon.png" onclick="xoa_thietbiphong()"/></td>';
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
	<script src="assets/js/control/chitiethoadon.js"></script>
</body>

</html>
