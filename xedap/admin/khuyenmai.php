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
  <link rel="stylesheet" href="//code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css">
  <link rel="stylesheet" href="http://jqueryui.com/resources/demos/style.css">
  <script src="https://code.jquery.com/jquery-1.12.4.js"></script>
  <script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>
  <script>
  $( function() {
		$( "#thoigianbatdau" ).datepicker({
			 dateFormat: "yy-mm-dd",
		});
		$( "#thoigianketthuc" ).datepicker({
			 dateFormat: "yy-mm-dd",
		});
	  } );
	  function thaydoi()
	  {
		  if($("#loaikhuyenmai").val()==1)
		  {
			  document.getElementById("sanpham").disabled = false;
			  document.getElementById("giamgia").disabled = true;
		  }else{
			  document.getElementById("sanpham").disabled = true;
			  document.getElementById("giamgia").disabled = false;
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
                            <li>
                                <i class="fa fa-table"></i> Sản phẩm
                            </li>
							<li class="active">
                                <i class="fa fa-table"></i> Khuyến mãi
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
										<td><label>Loại khuyến mại</label></td>
										<td><select id="loaikhuyenmai" class="form-control" onchange="thaydoi();">
											<option value="">Hãy chọn loại khuyến mãi</option>
											<option value="1">Tặng quà</option>
											<option value="0">Giảm giá</option>
										</select></td>
									</tr>
									<tr>
										<td><label>Thời gian bắt đầu</label></td>
										<td><input type="text" id="thoigianbatdau" class="form-control"></td>
									</tr>
									<tr>
										<td><label>Thời gian kết thúc</label></td>
										<td><input type="text" id="thoigianketthuc" class="form-control"></td>
									</tr>
									<tr>
										<td><label>Tặng sản phẩm</label></td>
										<td><select id="sanpham" class="form-control">
										<?php
										require_once '../connect/db_connect.php';
										require_once '../quanly/paging.php';
										$db=new DB_Connect();
										$conn=$db->connect();
										$sql="select * from sanpham where loaisanpham=0";
										$result=$conn->query($sql);
										while($row=mysqli_fetch_array($result))
										{
											echo '<option value="'.$row['masanpham'].'">'.$row['tensanpham'].'</option>';
										}
											?>
										</select></td>
									</tr>
									<tr>
										<td><label>Giảm giá</label></td>
										<td><input type="number" min="0" value="0" id="giamgia" class="form-control"></td>
									</tr>
									<tr>
										<td></td>
										<td><button type="button" class="btn btn-sm btn-success" onclick="add();">OK</button>
										<button type="reset" class="btn btn-sm btn-warning">Reset</button></td>
									</tr>
								</table>
							</form>
						</div>
					</div>
				</div>
                <div class="row">
                    <div class="col-lg-6 col-md-offset-3">
                        <div class="table-responsive">
                            <table class="table table-bordered table-hover table-striped">
                                <thead>
                                    <tr>
                                        <th class="col-md-2">Loại khuyến mãi</th>
										<th class="col-md-1">Thời gian bắt đầu</th>
										<th class="col-md-1">Thời gian kết thúc</th>
										<th class="col-md-1">Khuyến mãi</th>
										<th class="col-md-1">Trạng thái</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php
									$date=date("Y/m/d");
									$result = mysqli_query($conn, "select count(makhuyenmai) as total from khuyenmai");
									$row = mysqli_fetch_assoc($result);
									$total_records = $row['total'];
									$config = array(
										'current_page'  => isset($_GET['page']) ? $_GET['page'] : 1,
										'total_record'  => $total_records,
										'limit'         => 10,
										'link_full'     => 'khuyenmai.php?page={page}',
										'link_first'    => 'khuyenmai.php',
										'range'         => 10 
									);
									$paging = new Pagination();	 
									$paging->init($config);
									$start=$paging->_config['start'];
									$limit=$paging->_config['limit'];
									$sql="select * from khuyenmai limit $start,$limit";
									$result=$conn->query($sql);
									while($row=mysqli_fetch_assoc($result))
									{
										echo '
										<tr>';
										if($row['loaikhuyenmai']==1)
										{
											echo '<td class="col-md-1">Tặng quà</td>';
											echo'
											<td class="col-md-1">'.$row['thoigianbatdau'].'</td>
											<td class="col-md-1">'.$row['thoigianketthuc'].'</td>';
											$set=mysqli_fetch_array($conn->query("select tensanpham from sanpham where masanpham='$row[sanpham]'"));
											echo '<td class="col-md-1">'.$set['tensanpham'].'</td>';
										}else{
											echo '<td class="col-md-1">Giảm giá</td>';
											echo'
											<td class="col-md-1">'.$row['thoigianbatdau'].'</td>
											<td class="col-md-1">'.$row['thoigianketthuc'].'</td>
											<td class="col-md-1">'.$row['giamgia'].' %</td>';
										}
										if(strtotime($date)>strtotime($row['thoigianbatdau']) && strtotime($date)<strtotime($row['thoigianketthuc']))
										{
											echo '<td class="col-md-1">Còn khuyến mãi</td>';
										}else{
											echo '<td class="col-md-1">Hết khuyến mãi</td>';
										}
										echo'
											<td class="col-md-1"><input type="image" src="/xedap/images/icons/del.gif" onclick="del('.$row['makhuyenmai'].')"/></td>
											<td class="col-md-1"><input type="image" src="/xedap/images/icons/addproduct.png" onclick="addproduct('.$row['makhuyenmai'].')"/></td>
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

    <!-- Bootstrap Core JavaScript -->
    <script src="/xedap/js/bootstrap.min.js"></script>
	<script src="/xedap/js/admin/khuyenmai.js"></script>
</body>

</html>
