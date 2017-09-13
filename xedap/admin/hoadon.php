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
									$sql="select mataikhoan,email from taikhoan";
									$result=$conn->query($sql);
									echo '<tr>
										<td><label>Tài khoản</label></td>
										<td><select class="form-control" id="mataikhoan" name="mataikhoan">';
									while($row=mysqli_fetch_assoc($result))
									{
									echo		'<option value='.$row['mataikhoan'].'>'.$row['email'].'</option>';
									}
									echo 	'</select>
										</td>
									</tr>';
									?>
									</tr>
									<tr>
										<td><label>Tên khách hàng</label></td>
										<td><input type="text" id="tenkhachhang" name="tenkhachhang" class="form-control"></td>
									</tr>
									<tr>
										<td><label>SDT</label></td>
										<td><input type="text" id="sdt" name="tennhom" class="form-control"></td>
									</tr>
									<tr>
										<td><label>Địa chỉ</label></td>
										<td><input type="text" id="diachi" name="tennhom" class="form-control"></td>
									</tr>
									<tr>
										<td><label>Hình thức thanh toán</label></td>
										<td><select id="hinhthucthanhtoan" class="form-control">
												<option>Trực tiếp khi nhận hàng</option>
												<option>Thanh toán qua paypal</option>
											</select>
										</td>
									</tr>
									<tr>
										<td><label>Trạng thái</label></td>
										<td><select id="trangthai" class="form-control">
												<option value="0" >Chưa thanh toán</option>
												<option value="1" >Đã thanh toán</option>
											</select>
										</td>
									</tr>
									<tr>
										<td></td>
										<td><button type="button" class="btn btn-sm btn-success" onclick="add()">OK</button>
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
									<form method="get" action="">
										<tr>
											<td><input type="text" name="search" style="width:200px;" class="form-control" placeholder="Nhập tên khách hàng"></td>
											<td><input type="submit" class="btn btn-sm btn-success" value="Tìm"></td>
											<th></th><th></th><th></th><th></th><th></th><th></th><th></th><th></th><th></th>
										</tr>
									</form>
                                    <tr>
                                        <th>Mã tài khoản</th>
                                        <th>Email tài khoản</th>
										<th>Tên khách hàng</th>
                                        <th>SDT</th>
                                        <th>Địa chỉ</th>
										<th>Tồng tiền</th>
										<th>Hình thức thanh toán</th>
										<th>Trạng thái</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php
									if(isset($_GET['search']))
									{
										$result = mysqli_query($conn, "select count(mahoadon) as total from hoadon where tenkhachhang like '%$_GET[search]%'");
										$link_full="hoadon.php?search=".$_GET['search']."&page={page}";
										$link_first="hoadon.php?search=".$_GET['search'];
									}else{
										$result = mysqli_query($conn, 'select count(mahoadon) as total from hoadon');
										$link_full="hoadon.php?page={page}";
										$link_first="hoadon.php";
									}
									$row = mysqli_fetch_assoc($result);
									$total_records = $row['total'];
									$config = array(
										'current_page'  => isset($_GET['page']) ? $_GET['page'] : 1,
										'total_record'  => $total_records,
										'limit'         => 10,
										'link_full'     => $link_full,
										'link_first'    => $link_first,
										'range'         => 10 
									);
									$paging = new Pagination();	 
									$paging->init($config);
									$start=$paging->_config['start'];
									$limit=$paging->_config['limit'];
									if(isset($_GET['search']))
									{
										$sql="select taikhoan.mataikhoan,mahoadon,email,hoadon.tenkhachhang,sdt,diachi,tongtien,hinhthucthanhtoan,trangthai from hoadon,taikhoan where hoadon.mataikhoan=taikhoan.mataikhoan and hoadon.tenkhachhang like '%$_GET[search]%' limit $start,$limit";
									}else{
										$sql="select taikhoan.mataikhoan,mahoadon,email,hoadon.tenkhachhang,sdt,diachi,tongtien,hinhthucthanhtoan,trangthai from hoadon,taikhoan where hoadon.mataikhoan=taikhoan.mataikhoan limit $start,$limit";
									}
									$result=$conn->query($sql);
									while($row=mysqli_fetch_assoc($result))
									{
									echo '
                                    <tr>
										<td class="col-md-1">'.$row['mataikhoan'].'</td>
                                        <td class="col-md-1">'.$row['email'].'</td>
										<td class="col-md-1">'.$row['tenkhachhang'].'</td>
                                        <td class="col-md-1">'.$row['sdt'].'</td>
										<td class="col-md-2">'.$row['diachi'].'</td>
										<td class="col-md-2">'.$row['tongtien'].'</td>
										<td class="col-md-1">'.$row['hinhthucthanhtoan'].'</td>
										';
										if($row['trangthai']==0)
										{
											echo '<td class="col-md-1">Chưa thanh toán</td>';
										}else{
											echo '<td class="col-md-1">Đã thanh toán</td>';
										}
									echo'
										<td class="col-md-1"><input type="image" src="/xedap/images/icons/del.gif" onclick="del('.$row['mahoadon'].')"/></td>
										<td class="col-md-1"><input type="image" src="/xedap/images/icons/edit.png" onclick="edit('.$row['mahoadon'].')"/></td>
										<td class="col-md-1"><input type="image" src="/xedap/images/icons/info.png" onclick="info('.$row['mahoadon'].')"/></td>
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
	<script src="/xedap/js/admin/hoadon.js"></script>

</body>

</html>
