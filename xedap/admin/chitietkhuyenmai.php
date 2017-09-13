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
                                <i class="fa fa-table"></i> Khuyến mãi
                            </li>
							<li class="active">
                                <i class="fa fa-table"></i> Danh sách
                            </li>
                        </ol>
                    </div>
                </div>
                <!-- /.row -->
				<div class="row">
					<div class="col-md-10 col-md-offset-4">
						<div class="col-lg-4">
							<div class="alert alert-success" id="alert-success-top" ></div>
							<form role="form">
								<table>
									<tr>
									<?php
									require_once '../connect/db_connect.php';
									require_once '../quanly/paging.php';
									$db=new DB_Connect();
									$conn=$db->connect();
									$loaikhuyenmai=mysqli_fetch_array($conn->query("select * from khuyenmai where makhuyenmai='$_GET[id]'"))['loaikhuyenmai'];
									$date=date("Y/m/d");
									$sql="select nhomsanpham.manhom,tennhom from nhomsanpham where manhom not in (select manhom from chitietkhuyenmai where makhuyenmai in(select makhuyenmai from khuyenmai where makhuyenmai='$_GET[id]'))";
									$result=$conn->query($sql);
									?>
										<td><label>Nhóm sản phẩm</label></td>
										<td><select type="text" id="manhom" class="form-control">
										<?php
										while($row=mysqli_fetch_array($result))
										{
											echo '<option value='.$row['manhom'].'>'.$row['tennhom'].'</option>';
										}
										?>
										</select></td>
									</tr>
									<tr>
										<td></td>
										<td><button type="button" class="btn btn-sm btn-success" onclick="add(<?php echo $_GET['id']?>);">OK</button>
										<button type="reset" class="btn btn-sm btn-warning">Reset</button></td>
									</tr>
								</table>
							</form>
						</div>
					</div>
				</div>
                <div class="row">
                    <div class="col-lg-4 col-md-offset-4">
                        <div class="table-responsive">
                            <table class="table table-bordered table-hover table-striped">
                                <thead>
                                    <tr>
                                        <th class="col-md-1">Tên nhóm</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php
									$sql="select tennhom,makhuyenmai,nhomsanpham.manhom from chitietkhuyenmai,nhomsanpham where chitietkhuyenmai.manhom=nhomsanpham.manhom and chitietkhuyenmai.makhuyenmai='$_GET[id]'";
									$result=$conn->query($sql);
									while($row=mysqli_fetch_assoc($result))
									{
									echo '
                                    <tr>
                                        <td class="col-md-3">'.$row['tennhom'].'</td>
										<td class="col-md-1"><input type="image" src="/xedap/images/icons/del.gif" onclick="del('.$row['makhuyenmai'].','.$row['manhom'].')"/></td>
									</tr>';
									}
									?>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
                <!-- /.row -->
            </div>
            <!-- /.container-fluid -->

        </div>
        <!-- /#page-wrapper -->

    </div>
    <!-- /#wrapper -->
<script src="/xedap/js/jquery.js"></script>
    <!-- Bootstrap Core JavaScript -->
    <script src="/xedap/js/bootstrap.min.js"></script>
	<script src="/xedap/js/admin/chitietkhuyenmai.js"></script>
</body>

</html>
