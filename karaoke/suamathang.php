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
								<?php
								include_once 'connect/db_connect.php';
								$db=new DB_Connect();
								$conn=$db->connect();
								$mathang=mysqli_fetch_array(mysqli_query($conn,"select * from mathang where mamathang='$_GET[mamathang]'"));
								if(isset($_POST['them'])){
									$result=mysqli_query($conn,"Update mathang set dongia='$_POST[gia]' where mamathang='$_GET[mamathang]'");
									if($result){
										header("Location: mathang.php");
									}else{
										echo "<script>";
										echo "alert('Cập nhập thất bại')";
										echo "</script>";
									}
								}
								?>
								<form action="" method="post">
									<table>
										<tr>
											<td><label>Mặt hàng</label></td>
											<td><input type="text" class="form-control" value="<?php echo $mathang['tenmathang'];?>" disabled></td>
										</tr>
										<tr>
											<td><label>Giá</label></td>
											<td><input type="text" name="gia" class="form-control" value="<?php echo $mathang['dongia'];?>"></td>
										</tr>
										<tr>
											<td></td>
											<td><button type="submit" name="them" class="btn btn-sm btn-success">OK</button>
											<button type="reset" class="btn btn-sm btn-warning">Reset</button></td>
										</tr>
									</table>
								</form>
							</div>
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
	<script src="assets/js/control/mathang.js"></script>
</body>

</html>
