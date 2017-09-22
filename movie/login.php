<?php
ob_start();
session_start();
$msg="";
$msgregister="";
if(isset($_SESSION["user"]))
{
  header("Location: index.php");
}
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
<!--[if IE 6]><link rel="stylesheet" href="css/ie6.css" type="text/css" media="all" /><![endif]-->
<script type="text/javascript">
  function show()
    {
      if(document.getElementById("dangky").hidden==true)
      {
        document.getElementById("dangky").hidden=false;
      }else{
        document.getElementById("dangky").hidden=true;
      }
    }
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
        <li><a class="active" href="index.php">HOME</a></li>
        <li><a href="#">LOGIN</a></li>
      </ul>
    </div>
    <div id="sub-navigation">     
    </div>
  </div>
  <?php
  include_once 'connect/db_connect.php';
  $db=new DB_Connect();
  $conn=$db->connect();
  if(isset($_POST['dangnhap'])){
    $result=mysqli_query($conn,"select * from taikhoan where taikhoan='$_POST[taikhoan]' and matkhau='$_POST[matkhau]' and isDelete=false");
    if(mysqli_num_rows($result)>0){
      $row=mysqli_fetch_array($result);
      $_SESSION['user']=$row['hoten'];
      $_SESSION['id']=$row['mataikhoan'];
      header("Location: index.php");
    }else{
        $msg="Sai thông tin đăng nhập!!!";
    }
  }else if(isset($_POST['dangky'])){
    $result=mysqli_query($conn,"select * from taikhoan where cmnd='$_POST[dk_cmnd]'");
    if(mysqli_num_rows($result)>0){
      $msg="Chứng minh nhân dân đã sử dụng".$sql;
    }else{
      $result=mysqli_query($conn,"select * from taikhoan where email='$_POST[dk_email]'");
      if(mysqli_num_rows($result)>0){
       $msg="Email đã sử dụng";
      }else{
        $result=mysqli_query($conn,"select * from taikhoan where taikhoan='$_POST[dk_taikhoan]'");
        if(mysqli_num_rows($result)>0){
          $msg="Tài khoản đã sử dụng";
        }else{
          $sql="Insert into taikhoan(cmnd,taikhoan,matkhau,hoten,email,sdt,diachi,ngaysinh) values('$_POST[dk_cmnd]','$_POST[dk_taikhoan]','$_POST[dk_matkhau]','$_POST[dk_hoten]','$_POST[dk_email]','$_POST[dk_sdt]','$_POST[dk_diachi]','$_POST[dk_ngaysinh]')";
          $result=mysqli_query($conn,$sql);
          if($result){
            $msg="Đăng ký thành công";
          }else{
            $msg="Có lỗi xảy ra".$sql;
          }
        }
      }
    }
  }
  ?>
  <div id="main">
    <h4 class = "form-signin-heading" id="alert_register"><?php echo $msgregister; ?></h4>
    <div id="content">
      <div class="row">
          <div class="col-md-12 col-md-offset-2">
            <div class="col-lg-5" style="margin-top: 100px;">
              <h4 class = "form-signin-heading"><?php echo $msg; ?></h4>
              <form action="" method="post">
                <table style="border-collapse:separate;border-spacing:0 10px;">
                  <tr>
                    <td><input placeholder="Tài khoản" type="text" name="taikhoan" class="form-control"></td>
                  </tr>
                  <tr>
                    <td><input placeholder="Mật khẩu" type="password" name="matkhau" class="form-control"></td>
                  </tr>
                  <tr>
                    <td><input style="margin-top: 20px;width:100px;height: 40px;" type="submit" name="dangnhap" class="btn btn-sm btn-success" value="Đăng nhập" />
                    <td><input style="margin-top: 20px;width:100px;height: 40px;" type="button" class="btn btn-sm btn-success" value="Đăng ký" onclick="show();"></td>
                  </tr>
                </table>
              </form>
            </div>
            <div class="col-lg-6">
              <form action="" method="post" id="dangky" hidden="true" onsubmit="return valid()">
                <table style="border-collapse:separate;border-spacing:0 10px;">
                  <tr>
                    <td><input placeholder="Tài khoản" type="text" name="dk_taikhoan" class="form-control"></td>
                  </tr>
                  <tr>
                    <td><input placeholder="Mật khẩu" type="password" id="dk_matkhau" name="dk_matkhau" class="form-control"></td>
                  </tr>
                  <tr>
                    <td><input placeholder="Nhập lại mật khẩu" type="password" id="dk_nhaplaimatkhau" name="dk_nhaplaimatkhau" class="form-control"></td>
                  </tr>
                  <tr>
                    <td><input placeholder="Họ tên" type="text" name="dk_hoten" class="form-control"></td>
                  </tr>
                  <tr>
                    <td><input placeholder="Ngày sinh" type="text" name="dk_ngaysinh" class="form-control"></td>
                  </tr>
                  <tr>
                    <td><input placeholder="Chứng minh nhân dân" name="dk_cmnd" type="text" class="form-control"></td>
                  </tr>
                  <tr>
                    <td><input placeholder="Email" type="email" name="dk_email" class="form-control"></td>
                  </tr>
                  <tr>
                    <td><input placeholder="Số điện thoại" type="text" name="dk_sdt" class="form-control"></td>
                  </tr>
                  <tr>
                    <td><input placeholder="Địa chỉ" type="text" name="dk_diachi" class="form-control"></td>
                  </tr>
                  <tr>
                    <td><button style="margin-top: 20px" type="submit" name="dangky" class="btn btn-sm btn-success">Đăng ký</button>
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