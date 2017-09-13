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
<script>
	function valid()
	{
		var pass_old=document.getElementById('matkhaucu').value;
		var pass_new=document.getElementById('matkhaumoi1').value;
		var pass_new_repeat=document.getElementById('matkhaumoi2').value;
		if(pass_new.length<5)
		{
			document.getElementById("alert-success-top").innerHTML = "Mật khẩu phải lớn hơn 5 ký tự ";
			return false;
		}else if( pass_new.localeCompare(pass_new_repeat))
		{
			document.getElementById("alert-success-top").innerHTML = "Nhập lại mật khẩu mới";
			return false;
		}		
		return true;
	}
	</script>
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
								if(isset($_POST['suamatkhau'])){
									$result=mysqli_query($conn,"Update nhanvien set matkhau='$_POST[matkhaumoi1]' where manhanvien='$_SESSION[nhanvien]'");
									if($result){
										echo "<script>";
										echo "alert('Thay đổi mật khẩu thành công')";
										echo "</script>";
									}else{
										echo "<script>";
										echo "alert('Thay đổi mật khẩu thất bại')";
										echo "</script>";
									}
								}
								?>
								<form action="" method="post" onsubmit="return valid()">
									<table>
										<tr>
											<td><label>Mật khẩu cũ</label></td>
											<td><input type="password" name="matkhaucu" id="matkhaucu" class="form-control"></td>
										</tr>
										<tr>
											<td><label>Mật khẩu mới</label></td>
											<td><input type="password" name="matkhaumoi1" id="matkhaumoi1" class="form-control"></td>
										</tr>
										<tr>
											<td><label>Nhập lại mật khẩu mới</label></td>
											<td><input type="password" name="matkhaumoi2" id="matkhaumoi2" class="form-control"></td>
										</tr>
										<tr>
											<td></td>
											<td><button type="submit" name="suamatkhau" class="btn btn-sm btn-success">OK</button>
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
