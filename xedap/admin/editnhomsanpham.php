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
                            <li>
                                <i class="fa fa-table"></i> Nhóm sản phẩm
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
							$manhom=$_GET['manhom'];
							$db=new DB_Connect();
							$conn=$db->connect();
							$sql="select tennhom from nhomsanpham where manhom='$manhom'";
							$result=$conn->query($sql);
							$row=mysqli_fetch_row($result);
							if(isset($_POST["submit"]))
							{
								$tennhom=$_POST['tennhom'];
								$sql="select * from nhomsanpham where tennhom='$tennhom' and $manhom!='$manhom'";
								$result=$conn->query($sql);
								if($result)
								{
									if(mysqli_num_rows($result)>0)
									{
										echo '<script language="javascript">';
										echo 'alert("Đã có nhóm này rồi này")';
										echo '</script>';
									}else{
										$sql="Update nhomsanpham set tennhom='$tennhom' where manhom='$manhom'";
										$result=$conn->query($sql);
										if($result)
										{
											header("Location: /xedap/admin/nhomsanpham.php");
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
							<form action="#" role="form" method="post">
								<table>
									<tr>
										<td><label>Tên nhóm</label></td>
										<td><input type="text" name="tennhom" class="form-control" value="<?php echo $row['0'] ?>"></td>
									</tr>
									<tr>
										<td></td>
										<td><button type="submit" name="submit" class="btn btn-sm btn-success">OK</button>
										<button type="reset" class="btn btn-sm btn-warning">Reset</button></td>
									</tr>
								</table>
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
	<script src="/xedap/js/nhomsanpham.js"></script>
</body>

</html>
