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
	function load_date()
	{
		$.ajax({
			url: "getdate.php",
			type: "post",
			dataType: "text",
			data: {
			thang : $('#thang').val()
			},
			success: function(result){
				$('#ngay').html(result);
			}
		});
	}
	function print_file(thang,ngay)
	{
		$.ajax({
			url: "print_file.php",
			type: "post",
			dataType: "text",
			data: {
			thang : thang,
			ngay:ngay,
			},
			success: function(result){
				alert(result);
			}
		});
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
                                <i class="fa fa-table"></i> Nhóm sản phẩm
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
							<form role="form" method="post" action="">
								<table>
									<tr>
										<td><label>Tháng</label></td>
										<td>
											<select class="form-control" id="thang" name="thang" onchange="load_date();">
											<option value="">Hãy chọn 1 tháng</option>
											<?php
											require_once '../connect/db_connect.php';
											require_once '../quanly/paging.php';
											$db=new DB_Connect();
											$conn=$db->connect();
											$sql="select DISTINCT(MONTH(ngaytao)) as thang from hoadon";
											$result=$conn->query($sql);
											while($row=mysqli_fetch_array($result))
											{
												echo '<option value="'.$row['thang'].'">'.$row['thang'].'</option>';
											}
											?>
											</select>
										</td>
									</tr>
									<tr>
										<td><label>Ngày</label></td>
										<td><select class="form-control" id="ngay" name="ngay"><option value="">Tất cả các ngày</option></select></td>
									</tr>
									<tr>
										<td></td>
										<td><button type="submit" name="thongke" class="btn btn-sm btn-success">OK</button>
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
                                        <th class="col-md-1">Sản phẩm</th>
                                        <th class="col-md-3">Số lượng</th>
										<th class="col-md-3">Thành tiền</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php
									if(isset($_POST['thongke']))
									{
										if(!empty($_POST['thang']) && $_POST['thang']!="")
										{
											if(empty($_POST['ngay']))
											{
												$sql="SELECT sanpham,sum(soluong) as soluong,sum(gia*soluong) as thanhtien FROM `chitiethoadon` where mahoadon in(select mahoadon from hoadon where MONTH(ngaytao)='$_POST[thang]') group by sanpham";
												echo "<h2 align='center' style='color:red;'>Thống kê tháng $_POST[thang]</h2>";
												echo'
												<form>
													<input type="button" onclick="print_file('.$_POST['thang'].',0);" value="Xuất ra exels"></input>
												</form>
												';
											}else{
												$sql="SELECT sanpham,sum(soluong) as soluong,sum(gia*soluong) as thanhtien FROM `chitiethoadon` where mahoadon in(select mahoadon from hoadon where MONTH(ngaytao)='$_POST[thang]' and DAY(ngaytao)='$_POST[ngay]') group by sanpham";
												echo "<h2 align='center' style='color:red;'>Thống kê ngày $_POST[ngay] tháng $_POST[thang]</h2>";
												echo'
												<form>
													<input type="button" onclick="print_file('.$_POST['thang'].','.$_POST['ngay'].');" value="Xuất ra exels"></input>
												</form>
												';
											}										
											$result=$conn->query($sql);
											$tongtien=0;
											$tongsoluong=0;
											while($row=mysqli_fetch_array($result))
											{
												$tongtien=$tongtien+$row['thanhtien'];
												$tongsoluong=$tongsoluong+$row['soluong'];
											echo '
											<tr>
												<td class="col-md-5">'.$row['sanpham'].'</td>
												<td class="col-md-3">'.$row['soluong'].'</td>
												<td class="col-md-3">'.number_format($row['thanhtien']).'</td>
											</tr>';
											}
										}else{
											echo '
												<script>
												alert("Hãy chọn 1 tháng");
												</script>
											';
										}
									}
									?>
                                </tbody>
                            </table>
							<?php
							if(isset($tongtien))
							{
								echo '<h3 style="color:green;">Tổng số lượng: '.$tongsoluong.'</h3>';
								echo '<h3 style="color:green;">Tổng tiền: '.number_format($tongtien).'</h3>';
								
							}
							?>
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
</body>

</html>
