<?php
ob_start();
session_start();
$msg="";
if(isset($_SESSION["adminEmail"]))
{
	header("Location: /xedap/admin/nhomsanpham.php");
}
?>
	<?php
	include_once '../connect/db_connect.php';
	if(isset($_POST["login"]))
	{
		$db=new DB_Connect();
		$conn=$db->connect();
		$user=mysqli_real_escape_string($conn,$_POST["username"]);
		$pass=mysqli_real_escape_string($conn,$_POST["password"]);
		$sql="select email,hoten from taikhoan where email='$user' and matkhau='$pass' and maquyen='1'";
		$result=$conn->query($sql);
		$count=mysqli_num_rows($result);
		$row=mysqli_fetch_row($result);
		if($count==1)
		{
			$_SESSION['adminEmail']=$row[0];
			$_SESSION['adminName']=$row[1];
			header("Location: /xedap/admin/taikhoan.php");
		}
		else
		{
			$msg = 'Wrong username or password';
		}
	}
	?>
<html>
	<head>
	<title>Đăng nhập</title>
	<link rel="stylesheet" href="../css/style.css"/>
	</head>
	<body>
		  <div class="wrapper">
    <form class="form-signin" method="post" action="">       
      <h2 class="form-signin-heading">Please login</h2>
      <input type="text" class="form-control" name="username" placeholder="Email Address" required="" autofocus="" />
      <input type="password" class="form-control" name="password" placeholder="Password" required=""/>      
      <button class="btn btn-lg btn-primary btn-block" type="submit" name="login">Login</button>   
	  <h4 class = "form-signin-heading"><?php echo $msg; ?></h4>
    </form>
  </div>
	</body>
</html>