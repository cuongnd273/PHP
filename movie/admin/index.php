<?php
ob_start();
session_start();
$msg="";
if(isset($_SESSION["nhanvien"]) || isset($_SESSION['admin']))
{
	header("Location: phongchieu.php");
}
?>
<!doctype html>
<html lang="en" class="fullscreen-bg"> 	
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
		<div class="vertical-align-wrap">
			<div class="vertical-align-middle">
				<div class="auth-box ">
					<div class="left">
						<div class="content">
							<div class="logo text-center"><img src="../images/icon/logo_dark.png" alt="Klorofil Logo"></div>
							<?php
							include_once '../connect/db_connect.php';
							$db=new DB_Connect();
							$conn=$db->connect();
							if(isset($_POST['login'])){
								$result=mysqli_query($conn,"select * from admin where taikhoan='$_POST[taikhoan]' and matkhau='$_POST[matkhau]'");
								if(mysqli_num_rows($result)>0){
									$_SESSION['admin']=1;
									header("Location: phongchieu.php");
								}else{
									$result=mysqli_query($conn,"select * from nhanvien where taikhoan='$_POST[taikhoan]' and matkhau='$_POST[matkhau]'");
									if(mysqli_num_rows($result)>0)
									{
										$nhanvien=mysqli_fetch_array($result);
										$_SESSION['nhanvien']=$nhanvien['hoten'];
										header("Location: phongchieu.php");
									}
								}
								$msg="Sai thông tin đăng nhập!!!";
							}
							?>
							<h4 class = "form-signin-heading"><?php echo $msg; ?></h4>
							<form class="form-auth-small" action="" method="post">
								<div class="form-group">
									<label for="taikhoan" class="control-label sr-only">Tài khoản</label>
									<input type="text" class="form-control" id="taikhoan" name="taikhoan" placeholder="Tài khoản">
								</div>
								<div class="form-group">
									<label for="matkhau" class="control-label sr-only">Mật khẩu</label>
									<input type="password" class="form-control" id="matkhau" name="matkhau" placeholder="Mật khẩu">
								</div>
								<button type="submit" name="login" class="btn btn-primary btn-lg btn-block">LOGIN</button>
							</form>
						</div>
					</div>
					<div class="right">
						<div class="overlay">
							<img width="100%" height="100%" src="../images/icon/bg.jpg">
						</div>
					</div>
					<div class="clearfix"></div>
				</div>
			</div>
		</div>
	</div>
	<!-- END WRAPPER -->
</body>

</html>
