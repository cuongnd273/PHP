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
	<script>
	function show()
	{
		if(document.getElementById("form_them").hidden==true)
		{
			document.getElementById("form_them").hidden=false;
		}else{
			document.getElementById("form_them").hidden=true;
		}
	}
	</script>
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
                                <i class="fa fa-table"></i> Sản phẩm
                            </li>
                        </ol>
                    </div>
                </div>
                <!-- /.row -->
				<div class="row">
					<input type="button" class="btn btn-sm btn-success" name="show" value="Nhập thông tin" onclick="show();">
					<div class="col-md-12 col-md-offset-2" id="form_them" hidden="true">
						<div class="col-lg-12 ">
							<div class="alert alert-success" id="alert-success-top" ></div>
							 <form id="formsanpham" method="post" enctype="multipart/form-data">
								<table>
									<?php
									require_once '../connect/db_connect.php';
									require_once '../quanly/paging.php';
									$db=new DB_Connect();
									$conn=$db->connect();
									$sql="select * from nhomsanpham";
									$result=$conn->query($sql);
									echo '<tr>
										<td><label>Nhóm sản phẩm</label></td>
										<td><select class="form-control" id="manhom" name="manhom">';
									while($row=mysqli_fetch_assoc($result))
									{
									echo		'<option value='.$row['manhom'].'>'.$row['tennhom'].'</option>';
									}
									echo 	'</select>
										</td>
									</tr>';
									?>
									<tr>
										<td><label>Loại sản phẩm</label></td>
										<td><select class="form-control" id="loaisanpham" name="manhom">
											<option value="1">Sản phẩm bán</option>
											<option value="0">Sản phẩm tặng</option>
										</select>
										</td>
									<tr>
										<td><label>Tên sản phẩm</label></td>
										<td><input type="text" id="tensanpham" class="form-control"></td>
									</tr>
									<tr>
										<td><label>Giá </label></td>
										<td><input type="number" min="0" id="gia" class="form-control" value="0"></td>
									</tr>
									<tr>
										<td><label>Số lượng còn </label></td>
										<td><input type="number" min="0" id="soluongcon" class="form-control" value="0"></td>
									</tr>
									<tr>
										<td><label>Ảnh</label></td>
										<td><input type="file" id="file" name="file"></td>
									</tr>
									<tr>
										<td><label>Mô tả</label></td>
										<td><textarea id="mota" ></textarea></td>
									</tr>
									<tr>
										<td><label>Thông số kỹ thuật</label></td>
										<td><textarea id="thongsokythuat" ></textarea></td>
									</tr>
									<tr>
										<td><label>Khung xe</label></td>
										<td><input type="text" id="khungxe" class="form-control"></td>
									</tr>
									<tr>
										<td><label>Màu sắc</label></td>
										<td><input type="text" id="mausac" class="form-control"></td>
									</tr>
									<tr>
										<td><label>Giảm xóc</label></td>
										<td><input type="text" id="giamxoc" class="form-control"></td>
									</tr>
									<tr>
										<td><label>Yên xe</label></td>
										<td><input type="text" id="yenxe" class="form-control"></td>
									</tr>
									<tr>
										<td><label>Vành xe</label></td>
										<td><input type="text" id="vanhxe" class="form-control"></td>
									</tr>
									<tr>
										<td><label>Lốp xe</label></td>
										<td><input type="text" id="lopxe" class="form-control"></td>
									</tr>
									<tr>
										<td><label>Phanh xe</label></td>
										<td><input type="text" id="phanhxe" class="form-control"></td>
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
									<form method="get" action="">
										<tr>
											<td><input type="text" name="search" style="width:200px;" class="form-control" placeholder="Nhập tên sản phẩm"></td>
											<td><input type="submit" class="btn btn-sm btn-success" value="Tìm"></td>
											<th></th>
											<th></th>
											<th></th>
											<th></th>
											<th></th>
										</tr>
									</form>
                                    <tr>
										<th>Mã sản phẩm</th>
										<th>Ảnh</th>
                                        <th>Nhóm sản phẩm</th>
										<th>Loại sản phẩm</th>
                                        <th>Sản phẩm</th>
                                        <th>Giá </th>
										<th>Số lượng còn </th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php
									if(isset($_GET['search']))
									{
										$result = mysqli_query($conn, "select count(masanpham) as total from sanpham where tensanpham like '%$_GET[search]%'");
										$link_full="sanpham.php?search=".$_GET['search']."&page={page}";
										$link_first="sanpham.php?search=".$_GET['search'];
									}else{
										$result = mysqli_query($conn, 'select count(masanpham) as total from sanpham');
										$link_full="sanpham.php?page={page}";
										$link_first="sanpham.php";
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
										$sql="select tennhom,masanpham,loaisanpham,tensanpham,gia,anh,soluongcon from sanpham,nhomsanpham where sanpham.manhom=nhomsanpham.manhom and tensanpham like '%$_GET[search]%' order by masanpham desc limit $start,$limit";
									}else{
										$sql="select tennhom,masanpham,loaisanpham,tensanpham,gia,anh,soluongcon from sanpham,nhomsanpham where sanpham.manhom=nhomsanpham.manhom order by masanpham desc limit $start,$limit";
									}
									$result=$conn->query($sql);
									while($row=mysqli_fetch_assoc($result))
									{
									echo '
                                    <tr>
										<td class="col-md-1">'.$row['masanpham'].'</td>
										<td class="col-md-1"><img width="30px" height="30px" src="../images/products/'.$row['anh'].'"/></td>
                                        <td class="col-md-1">'.$row['tennhom'].'</td>
										';
										if($row['loaisanpham']==1)
										{
											echo '<td class="col-md-1">Sản phẩm bán</td>';
										}else{
											echo '<td class="col-md-1">Sản phẩm tặng</td>';
										}
									echo'	
										<td class="col-md-2">'.$row['tensanpham'].'</td>
										<td class="col-md-1">'.$row['gia'].'</td>
										<td class="col-md-1">'.$row['soluongcon'].'</td>
										<td class="col-md-1"><input type="image" src="/xedap/images/icons/del.gif" onclick="del('.$row['masanpham'].')"/></td>
										<td class="col-md-1"><input type="image" src="/xedap/images/icons/edit.png" onclick="edit('.$row['masanpham'].')"/></td>
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
	<script src="/xedap/js/admin/sanpham.js"></script>
	<script src='//cdn.tinymce.com/4/tinymce.min.js'></script>
 <script>
  tinymce.init({
	selector: '#mota'
  });
  tinymce.init({
	selector: '#thongsokythuat'
  });
  </script>

</body>

</html>
