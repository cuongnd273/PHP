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
							<div class="alert alert-success" id="alert-success-top" ></div>
							<form role="form">
							<div class="form-group">
								<table>
									<tr>
									<?php
									require_once '../connect/db_connect.php';
									require_once '../quanly/paging.php';
									$db=new DB_Connect();
									$conn=$db->connect();
									$maHD=$_GET['maHD'];
									$sql="select masanpham,tensanpham from sanpham";
									$result=$conn->query($sql);
									echo '<tr>
										<td><label>Sản phẩm</label></td>
										<td><select class="form-control" id="sanpham" name="mataikhoan">';
									while($row=mysqli_fetch_assoc($result))
									{
										echo '<option value='.$row['masanpham'].'>'.$row['tensanpham'].'</option>';
									}
									echo		'</select>';
									?>
									</tr>
									<tr>
										<td><label>Số lượng</label></td>
										<td><input type="number" min="0"  id="soluong" name="tennhom" class="form-control" value="1"></td>
									</tr>
									<tr>
										<td></td>
										<td><button type="button" class="btn btn-sm btn-success" onclick="add(<?php echo $maHD?>)">OK</button>
										<button type="reset" class="btn btn-sm btn-warning">Reset</button></td>
									</tr>
								</table>
							</div>
							</form>
						</div>
					</div>
				</div>
                <div class="row">
                    <div class="col-lg-12">
                        <div class="table-responsive">
                            <table class="table table-bordered table-hover table-striped">
                                <thead>
                                    <tr>
                                        <th>Mã sản phẩm</th>
                                        <th>Sản phẩm</th>
                                        <th>Số lượng</th>
                                        <th>Giá</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php
									$result = mysqli_query($conn, 'select count(machitiet) as total from chitiethoadon');
									$row = mysqli_fetch_assoc($result);
									$total_records = $row['total'];									
									$config = array(
										'current_page'  => isset($_GET['page']) ? $_GET['page'] : 1,
										'total_record'  => $total_records,
										'limit'         => 10,
										'link_full'     => 'chitiethoadon.php?maHD='.$maHD.'&page={page}',
										'link_first'    => 'chitiethoadon.php?maHD='.$maHD,
										'range'         => 10 
									);
									$paging = new Pagination();	 
									$paging->init($config);
									$start=$paging->_config['start'];
									$limit=$paging->_config['limit'];
									$sql="select * from chitiethoadon where mahoadon='$maHD' limit $start,$limit";
									$result=$conn->query($sql);
									while($row=mysqli_fetch_assoc($result))
									{
									echo '
                                    <tr>
										<td class="col-md-1">'.$row['masanpham'].'</td>
										<td class="col-md-1">'.$row['sanpham'].'</td>
                                        <td class="col-md-1">'.$row['soluong'].'</td>
                                        <td class="col-md-1">'.$row['gia'].'</td>
										<td class="col-md-1"><input type="image" src="/xedap/images/icons/del.gif" onclick="del('.$row['machitiet'].')"/></td>
										<td class="col-md-1"><input type="image" src="/xedap/images/icons/edit.png" onclick="edit('.$row['machitiet'].')"/></td>
									</tr>';
									}
									echo $paging->html();
									$paging=null;
									?>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
                <!-- /.row -->
            </div>
        </div>
        <!-- /#page-wrapper -->

    </div>
    <!-- /#wrapper -->

    <!-- jQuery -->
    <script src="/xedap/js/jquery.js"></script>

    <!-- Bootstrap Core JavaScript -->
    <script src="/xedap/js/bootstrap.min.js"></script>
	<script src="/xedap/js/admin/chitiethoadon.js"></script>

</body>

</html>
