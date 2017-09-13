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
								$thietbi=mysqli_fetch_array(mysqli_query($conn,"select * from danhsachthietbi where id='$_GET[id]'"));
								if(isset($_POST['them'])){
									$result=mysqli_query($conn,"Update danhsachthietbi set tinhtrang='$_POST[tinhtrang]' where id='$_GET[id]'");
									if($result){
										header("Location: thietbicuaphong.php?maphong=".$thietbi['maphong']);
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
											<td><label>Tình trạng</label></td>
											<td><input type="text" name="tinhtrang" class="form-control" value="<?php echo $thietbi['tinhtrang'];?>"></td>
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
	<script src="assets/js/control/thietbi.js"></script>
</body>

</html>
