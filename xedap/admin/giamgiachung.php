<?php
session_start();
 ob_start();
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
							require_once '../connect/db_connect.php';
							require_once '../quanly/paging.php';
							$db=new DB_Connect();
							$conn=$db->connect();									  
							$result = $conn->query("select * from giamgiachung");
							$row = mysqli_fetch_array($result);
							if(isset($_POST['submit']))
							{
								$sql="Update giamgiachung set sukien='$_POST[sukien]',thoigianbatdau='$_POST[batdau]',thoigianketthuc='$_POST[ketthuc]',giamgia='$_POST[giamgia]'";
								$result=$conn->query($sql);
								if($result)
								{
									header("Location: /xedap/admin/giamgiachung.php");
								}else{
									echo '<script language="javascript">';
									echo 'alert("S?a th?t b?i")';
									echo '</script>';
								}
							}
							?>
							<form role="form" action="" method="post">
								<table>
								<tr>
										<td><label>Sự kiện</label></td>
										<td><input type="text" name="sukien" id="sukien" class="form-control" value="<?php echo $row['sukien']?>"></td>
									</tr>
									<tr>
										<td><label>Thời gian bắt đầu</label></td>
										<td><input type="text" name="batdau" id="batdau" class="form-control" value="<?php echo $row['thoigianbatdau']?>"></td>
									</tr>
									<tr>
										<td><label>Thời gian kết thúc</label></td>
										<td><input type="text" name="ketthuc" id="ketthuc" class="form-control" value="<?php echo $row['thoigianketthuc']?>"></td>
									</tr>
									<tr>
										<td><label>Giảm giá</label></td>
										<td><input type="number" name="giamgia" id="giamgia" class="form-control" value="<?php echo $row['giamgia']?>"></td>
									</tr>
									<tr>
										<td></td>
										<td><button type="submit" class="btn btn-sm btn-success" name="submit">OK</button>
									</tr>
								</table>
							</form>
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

</body>

</html>
