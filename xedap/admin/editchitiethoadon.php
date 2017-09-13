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
                                <i class="fa fa-dashboard"></i>  <a href="index.html">Admin</a>
                            </li>
                            <li class="active">
                                <i class="fa fa-table"></i> Tài khoản
                            </li>
                        </ol>
                    </div>
                </div>
                <!-- /.row -->
				<div class="row">
					<div class="col-md-10 col-md-offset-3">
						<div class="col-lg-5">
						<?php
							require_once '../connect/db_connect.php';
							$maCT=$_GET['maCT'];
							$db=new DB_Connect();
							$conn=$db->connect();
							$sql="select sanpham,gia,soluong,mahoadon from chitiethoadon where machitiet='$maCT'";
							$result=$conn->query($sql);
							$row=mysqli_fetch_row($result);
							if(isset($_POST["submit"]))
							{
								$gia=$_POST['gia'];
								$soluong=$_POST['soluong'];
								$sql="Update chitiethoadon set gia='$gia',soluong='$soluong' where machitiet='$maCT'";
								$result=$conn->query($sql);
								if($result)
								{
									header("Location: /xedap/admin/chitiethoadon.php?maHD=$row[3]");
								}else{
									echo '<script language="javascript">';
									echo 'alert("Sửa thất bại")';
									echo '</script>';
								}
							}
							?>
							<form action="" method="post" role="form">
							<div class="form-group">
								<table>
									<tr>
										<td><label>Sản phẩm</label></td>
										<td><input type="text" name="sanpham" class="form-control" readonly="true" value="<?php echo $row['0']?>"></td>
									</tr>
									<tr>
										<td><label>Giá</label></td>
										<td><input type="number" min="0"  name="gia" class="form-control" value="<?php echo $row['1']?>"></td>
									</tr>
									<tr>
										<td><label>Số lượng</label></td>
										<td><input type="number" min="0"  name="soluong" class="form-control" value="<?php echo $row['2']?>"></td>
									</tr>
									<tr>
										<td></td>
										<td><button type="submit" name="submit" class="btn btn-sm btn-success">OK</button>
									</tr>
								</table>
							</div>
							</form>
						</div>
					</div>
				</div>
            </div>
            <!-- /.container-fluid -->

        </div>
        <!-- /#page-wrapper -->

    </div>
    <!-- /#wrapper -->

    <!-- jQuery -->
    <script src="/xedap/js/jquery.js"></script>

    <!-- Bootstrap Core JavaScript -->
    <script src="/xedap/js/bootstrap.min.js"></script>
	<script src="/xedap/js/hoadon.js"></script>

</body>

</html>
