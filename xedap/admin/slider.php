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
                                <i class="fa fa-table"></i> Slider
                            </li>
							<li class="active">
                                <i class="fa fa-table"></i> Danh sách
                            </li>
                        </ol>
                    </div>
                </div>
                <!-- /.row -->
				<div class="row">
					<div class="col-md-6 col-md-offset-4">
						<div class="col-lg-12 ">
							<div class="alert alert-success" id="alert-success-top" ></div>
							<form id="formslider" method="post" enctype="multipart/form-data">
								<table>
									<tr>
										<td><label>Ảnh</label></td>
										<td><input type="file" id="anh" name="anh"></td>
									</tr>
									<tr>
										<td><label>Giới thiệu</label></td>
										<td><textarea id="gioithieu" rows="6" cols="50"></textarea></td>
									</tr>
									</tr>
									<tr>
										<td><label>Mã sản phẩm</label></td>
										<td><input type="text" id="link" class="form-control"></td>
									</tr>
									<tr>
										<td></td>
										<td><button type="button" class="btn btn-sm btn-success" onclick="add()">OK</button>
										<button type="reset" class="btn btn-sm btn-warning">Reset</button></td>
									</tr>
								</table>
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
                                        <th class="col-md-1">Ảnh</th>
                                        <th class="col-md-3">Giới thiệu</th>
                                        <th class="col-md-3">Mã sản phẩm</th>
                                    </tr>
                                </thead>
                                <tbody>
									<?php
									require_once '../connect/db_connect.php';
									require_once '../quanly/paging.php';
									$db=new DB_Connect();
									$conn=$db->connect();									  
									$result = mysqli_query($conn, 'select count(maslider) as total from slider');
									$row = mysqli_fetch_assoc($result);
									$total_records = $row['total'];
									$config = array(
										'current_page'  => isset($_GET['page']) ? $_GET['page'] : 1,
										'total_record'  => $total_records,
										'limit'         => 10,
										'link_full'     => 'slider.php?page={page}',
										'link_first'    => 'slider.php',
										'range'         => 10 
									);
									$paging = new Pagination();	 
									$paging->init($config);
									$start=$paging->_config['start'];
									$limit=$paging->_config['limit'];
									$sql="select * from slider limit $start,$limit";
									$result=$conn->query($sql);
									while($row=mysqli_fetch_assoc($result))
									{
									echo '
                                    <tr>
                                        <td class="col-md-1"><image width="30px" height="30px" src="../images/products/'.$row['anh'].'"</td>
                                        <td class="col-md-3">'.$row['gioithieu'].'</td>
                                        <td class="col-md-3">'.$row['link'].'</td>
										<td style="width:10%"><input type="image" src="/xedap/images/icons/del.gif" onclick="del('.$row['maslider'].')"/></td>
                                    </tr>';
									}
									echo $paging->html();
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

    <!-- jQuery -->
    <script src="/xedap/js/jquery.js"></script>

    <!-- Bootstrap Core JavaScript -->
    <script src="/xedap/js/bootstrap.min.js"></script>
	<script src="/xedap/js/admin/slider.js"></script>
</body>

</html>
