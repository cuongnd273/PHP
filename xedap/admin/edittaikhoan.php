<?php
session_start();
if(!isset($_SESSION["adminEmail"]))
{
	header("Location: /xedap/404.php");
}
?>
<!DOCTYPE html>
<html lang="en">
<head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>Admin</title>

    <!-- Bootstrap Core CSS -->
    <link href="/xedap/css/bootstrap.min.css" rel="stylesheet">

    <!-- Custom CSS -->
    <link href="/xedap/css/sb-admin.css" rel="stylesheet">

    <!-- Custom Fonts -->
    <link href="/xedap/font-awesome/css/font-awesome.min.css" rel="stylesheet" type="text/css">
</head>

<body>

    <div id="wrapper">

        <!-- Navigation -->
        <?php
		require_once 'menu.php';
		?>

        <div id="page-wrapper">

            <div class="container-fluid">

                <!-- Page Heading -->
                <div class="row">
                    <div>
                        <ol class="breadcrumb">
                            <li>
                                <i class="fa fa-dashboard"></i>  Admin
                            </li>
                            <li >
                                <i class="fa fa-table"></i> Tài khoản
                            </li>
							<li class="active">
                                <i class="fa fa-table"></i> Sửa
                            </li>
                        </ol>
                    </div>
                </div>
                <!-- /.row -->
				<div class="row">
					<div class="col-md-10 col-md-offset-4">
						<div class="col-lg-4">
							<?php
							require_once '../connect/db_connect.php';
							$matk=$_GET['matk'];
							$db=new DB_Connect();
							$conn=$db->connect();
							$sql="select hoten,email,matkhau,tenquyen,taikhoan.maquyen from taikhoan,quyen where mataikhoan='$matk' and taikhoan.maquyen=quyen.maquyen";
							$result=$conn->query($sql);
							$row=mysqli_fetch_row($result);
							if(isset($_POST["submit"]))
							{
								$hoten=$_POST['hoten'];
								$email=$_POST['email'];
								$matkhau=$_POST['matkhau'];
								$quyen=$_POST['quyen'];
								$sql="select * from taikhoan where email='$email'and mataikhoan!='$matk'";
								$result=$conn->query($sql);
								if($result)
								{
									if(mysqli_num_rows($result)>0)
									{
										echo '<script language="javascript">';
										echo 'alert("Không thể dùng email này")';
										echo '</script>';
									}else{
										$sql="Update taikhoan set hoten='$hoten',email='$email',matkhau='$matkhau',maquyen='$quyen' where mataikhoan='$matk'";
										$result=$conn->query($sql);
										if($result)
										{
											header("Location: /xedap/admin/taikhoan.php");
										}else{
											echo '<script language="javascript">';
											echo 'alert("Sửa thất bại")';
											echo '</script>';
										}
									}
								}else{
									echo '<script language="javascript">';
									echo 'alert("Có lỗi xảy ra")';
									echo '</script>';
								}
							}
							?>
							<form action="#" method="post" role="form">
								<table>
									<tr>
										<td><label>Tên hiển thị</label></td>
										<td><input type="text" name="hoten" class="form-control" value="<?php echo $row['0'] ?>"></td>
									</tr>
									<tr>
										<td><label>Email</label></td>
										<td><input type="email" name="email" class="form-control" value="<?php echo $row['1'] ?>"></td>
									</tr>
									<tr>
										<td><label>Mật khẩu</label></td>
										<td><input type="text" name="matkhau" class="form-control" value="<?php echo $row['2'] ?>"></td>
									</tr>
									<tr>
										<td><label>Quyền</label></td>
										<td>
												<select name="quyen" class="form-control">
												<option value="<?php echo $row['4']?>"><?php echo $row['3'] ?></option>';
												<?php
												$sql="select tenquyen,maquyen from quyen where tenquyen!='$row[3]'";
												echo $sql;
												$result=$conn->query($sql);
												while($roww=mysqli_fetch_assoc($result))
												{
													echo '<option value="'.$roww['maquyen'].'">'.$roww['tenquyen'].'</option>';
												}
												?>
												</select>
										</td>
									</tr>
									<tr>
										<td></td>
										<td><button type="submit" name="submit" class="btn btn-sm btn-success" >OK</button>
										<button type="reset" class="btn btn-sm btn-warning">Reset</button></td>
									</tr>
								</table>
							</form>
						</div>
					</div>
				</div>
            </div>
        </div>
    </div>
    <script src="/xedap/js/jquery.js"></script>

    <!-- Bootstrap Core JavaScript -->
    <script src="/xedap/js/bootstrap.min.js"></script>

</body>

</html>
