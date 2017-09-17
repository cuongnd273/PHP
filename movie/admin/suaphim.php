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
	<link rel="stylesheet" href="//code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css">
	  <link rel="stylesheet" href="http://jqueryui.com/resources/demos/style.css">
	  <script src="https://code.jquery.com/jquery-1.12.4.js"></script>
	  <script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>
	  <script>
	  $( function() {
			$( "#ngaybatdau" ).datepicker({
				 dateFormat: "yy-mm-dd",
			});
			$( "#ngayketthuc" ).datepicker({
				 dateFormat: "yy-mm-dd",
			});
		  } );
	  </script>
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
							<div class="col-md-12 col-md-offset-2">
								<div class="col-lg-8">
									<form action="" method="post">
										<table>
										<?php
										include '../connect/db_connect.php';
										$db=new DB_Connect();
										$conn=$db->connect();
										$id=$_GET['maphim'];
										$result=mysqli_query($conn,"select * from phim,giave where phim.loaive=giave.magia and maphim='$id'");
										$row=mysqli_fetch_array($result);
										if(isset($_POST['submit'])){
											$sql="Update phim set tenphim='$_POST[tenphim]',ngaybatdau='$_POST[ngaybatdau]',ngayketthuc='$_POST[ngayketthuc]',daodien='$_POST[daodien]',dienvien='$_POST[dienvien]',thoiluong='$_POST[thoiluong]',tomtat='$_POST[tomtat]' where maphim='$id'";
											$result=mysqli_query($conn,$sql);
											if($result){
												header("Location: phim.php");
											}else{
												echo "<script>";
												echo "alert('Có lỗi xảy ra')";
												echo "</script>";
											}
										}
										?>
											<tr>
												<td><label>Tên phim </label></td>
												<td><input type="text" value="<?php echo $row['tenphim'];?>" name="tenphim" class="form-control"></td>
											</tr>
											<tr>
												<td><label>Ngày bắt đầu </label></td>
												<td><input type="text" value="<?php echo $row['ngaybatdau'];?>" name="ngaybatdau" class="form-control"></td>
											</tr>
											<tr>
												<td><label>Ngày kết thúc </label></td>
												<td><input type="text" value="<?php echo $row['ngayketthuc'];?>" name="ngayketthuc" class="form-control"></td>
											</tr>
											<tr>
												<td><label>Đạo diễn </label></td>
												<td><input type="text" value="<?php echo $row['daodien'];?>" name="daodien" class="form-control"></td>
											</tr>
											<tr>
												<td><label>Diễn viên </label></td>
												<td><input type="text" value="<?php echo $row['dienvien'];?>" name="dienvien" class="form-control"></td>
											</tr>
											<tr>
												<td><label>Thời lượng </label></td>
												<td><input type="number" value="<?php echo $row['thoiluong'];?>" name="thoiluong" class="form-control"></td>
											</tr>
											<tr>
												<td><label>Ảnh </label></td>
												<td><img width="50" height="50" src="<?php echo '../images/'.$row['anh'];?>">
											</tr>
											<tr>
												<td><label>Tóm tắt </label></td>
												<td><textarea name="tomtat" rows="10" cols="100" class="form-control"><?php echo $row['tomtat'];?></textarea></td>
											</tr>
											<tr>
												<td></td>
												<td><button style="margin-top: 20px" type="submit" name="submit" class="btn btn-sm btn-success">OK</button>
											</tr>
										</table>
									</form>
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
	<script src="../assets/js/bootstrap/bootstrap.min.js"></script>
	<script src="../assets/js/plugins/jquery-slimscroll/jquery.slimscroll.min.js"></script>
	<script src="../assets/js/klorofil.min.js"></script>
	<script src="../assets/admin/phim.js"></script>
</body>

</html>
