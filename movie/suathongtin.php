<?php
ob_start();
session_start();
$msg="";
// if(isset($_SESSION["user"]))
// {
//   header("Location: index.php");
// }
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<title>Khali Cinema</title>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<link rel="stylesheet" href="assets/css/style.css" type="text/css" media="all" />
<link rel="stylesheet" href="assets/css/bootstrap.min.css">
<script type="text/javascript" src="assets/js/jquery-1.4.2.min.js"></script>
<script type="text/javascript" src="assets/js/jquery-func.js"></script>
<script type="text/javascript">
   function valid()
  {
    var pass=document.getElementById('dk_matkhau').value;
    var pass_again=document.getElementById('dk_nhaplaimatkhau').value;
    if( pass.length <6 || pass.length >20)
    {debugger
      alert("Mật khẩu phải lớn hơn 6 và nhỏ hơn 20 ký tự");
      return false;
    }else if(pass!=pass_again)
    {
      alert("Nhập lại mật khẩu sai");
      return false;
    }    
    return true;
  }
</script>
</head>
<body>
<!-- START PAGE SOURCE -->
<div id="shell">
  <div id="header">
    <h1 id="logo"><a href="index.php">MovieHunter</a></h1>
    <div id="navigation">
     <ul>
        <li><a href="index.php">HOME</a></li>
        <?php
        if(!isset($_SESSION['user']))
          echo '<li><a href="login.php">LOGIN</a></li>';
        else {
           echo '<li><a href="suathongtin.php?mataikhoan='.$_SESSION['id'].'">Hi, '.$_SESSION['user'].'</a></li>';
          echo '<li><a href="logout.php">Thoát</a></li>';
        }
          
        ?>
      </ul>
    </div>
    <div id="sub-navigation">     
    </div>
  </div>
  <?php
  include_once 'connect/db_connect.php';
  $db=new DB_Connect();
  $conn=$db->connect();
  $id=$_GET['mataikhoan'];
  $row=mysqli_fetch_array(mysqli_query($conn,"select * from taikhoan where mataikhoan='$id'"));
  if(isset($_POST['suathongtin'])){
    $sql="Update taikhoan set matkhau='$_POST[dk_matkhau]',hoten='$_POST[dk_hoten]',ngaysinh='$_POST[dk_ngaysinh]',sdt='$_POST[dk_sdt]',diachi='$_POST[dk_diachi]' where mataikhoan='$id'";
    $result=mysqli_query($conn,$sql);
    if($result){
      $msg="Cập nhập thành công";
    }else
      $msg="Cập nhập thất bại";
  }
  ?>
  <div id="main">
    <div id="content">
      <div class="row">
          <div class="col-md-6 col-md-offset-4">
            <div class="col-lg-6">
              <h4 class = "form-signin-heading" id="alert_register"><?php echo $msg; ?></h4>
              <form action="" method="post" onsubmit="return valid()">
                <table style="border-collapse:separate;border-spacing:0 10px;">
                  <tr>
                    <td><input style="width:250px;" value="<?php echo $row['taikhoan']?>" placeholder="Tài khoản" type="text" name="dk_taikhoan" class="form-control" disabled></td>
                  </tr>
                  <tr>
                    <td><input value="<?php echo $row['matkhau']?>" placeholder="Mật khẩu" type="password" id="dk_matkhau" name="dk_matkhau" class="form-control"></td>
                  </tr>
                  <tr>
                    <td><input value="<?php echo $row['matkhau']?>" placeholder="Nhập lại mật khẩu" type="password" id="dk_nhaplaimatkhau" name="dk_nhaplaimatkhau" class="form-control"></td>
                  </tr>
                  <tr>
                    <td><input value="<?php echo $row['hoten']?>" placeholder="Họ tên" type="text" name="dk_hoten" class="form-control"></td>
                  </tr>
                  <tr>
                    <td><input value="<?php echo $row['ngaysinh']?>" placeholder="Ngày sinh" type="text" name="dk_ngaysinh" class="form-control"></td>
                  </tr>
                  <tr>
                    <td><input value="<?php echo $row['cmnd']?>" placeholder="Chứng minh nhân dân" name="dk_cmnd" type="text" class="form-control" disabled></td>
                  </tr>
                  <tr>
                    <td><input value="<?php echo $row['email']?>" placeholder="Email" type="email" name="dk_email" class="form-control" disabled></td>
                  </tr>
                  <tr>
                    <td><input value="<?php echo $row['sdt']?>" placeholder="Số điện thoại" type="text" name="dk_sdt" class="form-control"></td>
                  </tr>
                  <tr>
                    <td><input value="<?php echo $row['diachi']?>" placeholder="Địa chỉ" type="text" name="dk_diachi" class="form-control"></td>
                  </tr>
                  <tr>
                    <td><button style="margin-top: 20px" type="submit" name="suathongtin" class="btn btn-sm btn-success">Cập nhập</button>
                  </tr>
                </table>
              </form>
            </div>
          </div>
        </div>
    </div>

    <div class="cl">&nbsp;</div>
  </div>
  <div id="footer">
    <p class="lf">Khali Cinema &copy; 2017 </p>
    <p class="rf">Design by <a href="http://chocotemplates.com/">Anonymous</a></p>
    <div style="clear:both;"></div>
  </div>
</div>
<!-- END PAGE SOURCE -->
</body>
</html>