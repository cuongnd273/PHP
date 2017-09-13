<?php
$msglogin="";
$msgregister="";
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="">
    <meta name="author" content="">
    <title>Đăng nhập | World Bike</title>
    <link href="css/bootstrap.min.css" rel="stylesheet">
    <link href="css/font-awesome.min.css" rel="stylesheet">
    <link href="css/prettyPhoto.css" rel="stylesheet">
    <link href="css/price-range.css" rel="stylesheet">
    <link href="css/animate.css" rel="stylesheet">
	<link href="css/main.css" rel="stylesheet">
	<link href="css/responsive.css" rel="stylesheet">
    <!--[if lt IE 9]>
    <script src="js/html5shiv.js"></script>
    <script src="js/respond.min.js"></script>
    <![endif]-->       
    <link rel="shortcut icon" href="images/ico/favicon.ico">
    <link rel="apple-touch-icon-precomposed" sizes="144x144" href="images/ico/apple-touch-icon-144-precomposed.png">
    <link rel="apple-touch-icon-precomposed" sizes="114x114" href="images/ico/apple-touch-icon-114-precomposed.png">
    <link rel="apple-touch-icon-precomposed" sizes="72x72" href="images/ico/apple-touch-icon-72-precomposed.png">
    <link rel="apple-touch-icon-precomposed" href="images/ico/apple-touch-icon-57-precomposed.png">
</head><!--/head-->

<body>
	<?php
	require 'block/header.php';
	?>
	<?php
	require_once 'connect/db_connect.php';
	$db=new DB_Connect();
	$conn=$db->connect();
	if(isset($_POST['login']))
	{
		$email=mysqli_real_escape_string($conn,$_POST['login_email']);
		$pass=mysqli_real_escape_string($conn,$_POST['login_pass']);
		$sql="select mataikhoan,hoten,email from taikhoan where email='$email' and matkhau='$pass' and maquyen=2";
		$result=$conn->query($sql);
		if(mysqli_num_rows($result)>0)
		{
			$row=mysqli_fetch_row($result);
			$_SESSION['username']=$row['1'];
			$_SESSION['email']=$row['2'];
			$_SESSION['id']=$row['0'];
			header("Location: /xedap/index.php");
		}else{
			$msglogin='Sai thông tin đăng nhập';
		}
	}
	if(isset($_POST['register']))
	{
		$name=mysqli_real_escape_string($conn,$_POST['register_name']);
		$email=mysqli_real_escape_string($conn,$_POST['register_email']);
		$pass=mysqli_real_escape_string($conn,$_POST['register_pass']);
		$sql="select * from taikhoan where email='$email'";
		$result=$conn->query($sql);
		if(mysqli_num_rows($result)>0)
		{
			$msgregister="Email đã được sử dụng";
		}else{
			$sql="Insert into taikhoan(hoten,email,matkhau,maquyen) values('$name','$email','$pass','2')";
			$result=$conn->query($sql);
			if($result)
			{
				echo '<script language="javascript">';
				echo 'alert("Tài khoản của bạn đã tạo thành công,hãy đăng nhập và mua hàng")';
				echo '</script>';
			}else{
				$msgregister="Có lỗi xảy ra";
			}
		}
	}
	?>
	<script>
	function valid()
	{
		var name=document.getElementById('register_name').value;
		var pass=document.getElementById('register_pass').value;
		var pass_again=document.getElementById('register_pass_again').value;
		if(name.length<5)
		{
			document.getElementById("alert_register").innerHTML = "Tên phải lớn hơn 5 ký tự ";
			return false;
		}else if( pass.length <6 || pass.length >20)
		{
			document.getElementById("alert_register").innerHTML = "Mật khẩu phải lớn hơn 6 và nhỏ hơn 20 ký tự";
			return false;
		}else if(pass!=pass_again)
		{
			document.getElementById("alert_register").innerHTML = "Nhập lại mật khẩu sai";
			return false;
		}
		
		return true;
	}
	</script>	
	<section id="form"><!--form-->
		<div class="container">
			<div class="row">
				<div class="col-sm-4 col-sm-offset-1">
					<div class="login-form"><!--login form-->
						<h2>Đăng nhập</h2>
						<form action="" method="post">
						  <h4 class = "form-signin-heading" id="alert_login"><?php echo $msglogin; ?></h4>
							<input type="email" placeholder="Email" name="login_email"/>
							<input type="password" placeholder="Mật khẩu" name="login_pass"/>
							<span>
								<input type="checkbox" class="checkbox"> 
								Keep me signed in
							</span>
							<button type="submit" class="btn btn-default" name="login">Đăng nhập</button>
						</form>
					</div><!--/login form-->
				</div>
				<div class="col-sm-1">
					<h2 class="or">OR</h2>
				</div>
				<div class="col-sm-4">
					<div class="signup-form"><!--sign up form-->
						<h2>Đăng ký</h2>
						<form action="" method="post" onsubmit="return valid()">
						<h4 class = "form-signin-heading" id="alert_register"><?php echo $msgregister; ?></h4>
							<input type="text" placeholder="Tên" name='register_name' id="register_name"/>
							<input type="email" placeholder="Email" name="register_email" id="register_email"/>
							<input type="password" placeholder="Mật khẩu" name="register_pass" id="register_pass"/>
							<input type="password" placeholder="Nhập lại mật khẩu" name="register_pass_again" id="register_pass_again"/>
							<button type="submit" class="btn btn-default" name="register">Đăng ký</button>
						</form>
					</div><!--/sign up form-->
				</div>
			</div>
		</div>
	</section><!--/form-->
	<?php
	require 'block/footer.php';
	?>
    <script src="js/jquery.js"></script>
	<script src="js/price-range.js"></script>
    <script src="js/jquery.scrollUp.min.js"></script>
	<script src="js/bootstrap.min.js"></script>
    <script src="js/jquery.prettyPhoto.js"></script>
    <script src="js/main.js"></script>
	<script src="js/search.js"></script>
</body>
</html>