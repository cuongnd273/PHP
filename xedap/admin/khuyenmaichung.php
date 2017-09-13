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
  <link rel="stylesheet" href="//code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css">
  <link rel="stylesheet" href="http://jqueryui.com/resources/demos/style.css">
  <script src="https://code.jquery.com/jquery-1.12.4.js"></script>
  <script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>
  <script>
  $( function() {
		$( "#batdau" ).datepicker({
			 dateFormat: "yy-mm-dd",
		});
		$( "#ketthuc" ).datepicker({
			 dateFormat: "yy-mm-dd",
		});
	  } );
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
                                <i class="fa fa-dashboard"></i>  Admin
                            </li>
                            <li >
                                <i class="fa fa-table"></i> Khuyến mại chung
                            </li>
                        </ol>
                    </div>
                </div>
                <!-- /.row -->
				<div class="row">
					<div class="col-md-10 col-md-offset-4">
						<div class="col-lg-4">
							<div class="alert alert-success" id="alert-success-top" ></div>
							<?php
							?>
							<form role="form">
								<table>
								<tr>
										<td><label>Khuyến mại</label></td>
										<td><input type="text" id="khuyenmai" class="form-control"></td>
									</tr>
									<tr>
										<td><label>Thời gian bắt đầu</label></td>
										<td><input type="text" id="batdau" class="form-control"></td>
									</tr>
									<tr>
										<td><label>Thời gian kết thúc</label></td>
										<td><input type="email" id="ketthuc" class="form-control"></td>
									</tr>
									<tr>
										<td></td>
										<td><button type="button" class="btn btn-sm btn-success" onclick="add()">OK</button>
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
                                        <th class="col-md-3">Khuyến mại</th>
                                        <th class="col-md-2">Bắt đầu</th>
                                        <th class="col-md-2">Kết thúc</th>
                                    </tr>
                                </thead>
                                <tbody>
									<?php
									require_once '../connect/db_connect.php';
									require_once '../quanly/paging.php';
									$db=new DB_Connect();
									$conn=$db->connect();									  
									$result = mysqli_query($conn, 'select count(id) as total from khuyenmaichung');
									$row = mysqli_fetch_assoc($result);
									$total_records = $row['total'];
									$config = array(
										'current_page'  => isset($_GET['page']) ? $_GET['page'] : 1,
										'total_record'  => $total_records,
										'limit'         => 10,
										'link_full'     => 'khuyenmaichung.php?page={page}',
										'link_first'    => 'khuyenmaichung.php',
										'range'         => 10 
									);
									$paging = new Pagination();	 
									$paging->init($config);
									$start=$paging->_config['start'];
									$limit=$paging->_config['limit'];
									$sql="select * from khuyenmaichung limit $start,$limit";
									$result=$conn->query($sql);
									while($row=mysqli_fetch_array($result))
									{
									echo '
                                    <tr>
                                        <td class="col-md-3">'.$row['khuyenmai'].'</td>
                                        <td class="col-md-2">'.$row['thoigianbatdau'].'</td>
                                        <td class="col-md-2">'.$row['thoigianketthuc'].'</td>
										<td style="width:10%"><input type="image" src="/xedap/images/icons/del.gif" onclick="del('.$row['id'].')"/></td>
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

    <!-- Bootstrap Core JavaScript -->
    <script src="/xedap/js/bootstrap.min.js"></script>
	<script src="/xedap/js/admin/khuyenmaichung.js"></script>

</body>

</html>
