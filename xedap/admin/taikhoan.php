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
										<td><label>Tên hiển thị</label></td>
										<td><input type="text" id="hoten" class="form-control"></td>
									</tr>
									<tr>
										<td><label>Email</label></td>
										<td><input type="email" id="email" class="form-control"></td>
									</tr>
									<tr>
										<td><label>Mật khẩu</label></td>
										<td><input type="text" id="matkhau" class="form-control"></td>
									</tr>
									<tr>
										<td><label>Quyền</label></td>
										<td><select id="quyen" class="form-control">
												<option>Người dùng</option>
												<option>Admin</option>
											</select>
										</td>
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
                                        <th class="col-md-1">Mã tài khoản</th>
                                        <th class="col-md-3">Tên hiển thị</th>
                                        <th class="col-md-3">Email</th>
										<th class="col-md-3">Quyền</th>
                                    </tr>
                                </thead>
                                <tbody>
									<?php
									require_once '../connect/db_connect.php';
									require_once '../quanly/paging.php';
									$db=new DB_Connect();
									$conn=$db->connect();									  
									$result = mysqli_query($conn, 'select count(mataikhoan) as total from taikhoan');
									$row = mysqli_fetch_assoc($result);
									$total_records = $row['total'];
									$config = array(
										'current_page'  => isset($_GET['page']) ? $_GET['page'] : 1,
										'total_record'  => $total_records,
										'limit'         => 10,
										'link_full'     => 'taikhoan.php?page={page}',
										'link_first'    => 'taikhoan.php',
										'range'         => 10 
									);
									$paging = new Pagination();	 
									$paging->init($config);
									$start=$paging->_config['start'];
									$limit=$paging->_config['limit'];
									$sql="select mataikhoan,hoten,email,tenquyen from taikhoan,quyen where taikhoan.maquyen=quyen.maquyen limit $start,$limit";
									$result=$conn->query($sql);
									while($row=mysqli_fetch_assoc($result))
									{
									echo '
                                    <tr>
                                        <td class="col-md-1">'.$row['mataikhoan'].'</td>
                                        <td class="col-md-3">'.$row['hoten'].'</td>
                                        <td class="col-md-3">'.$row['email'].'</td>
										<td class="col-md-3">'.$row['tenquyen'].'</td>
										<td style="width:10%"><input type="image" src="/xedap/images/icons/del.gif" onclick="del('.$row['mataikhoan'].')"/></td>
										<td style="width:10%"><input type="image" src="/xedap/images/icons/edit.png" onclick="edit('.$row['mataikhoan'].')"/></td>
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
	<script src="/xedap/js/admin/taikhoan.js"></script>

</body>

</html>
