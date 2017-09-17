<?php
ob_start();
session_start();
if(!isset($_SESSION["nhanvien"]) && !isset($_SESSION['admin']))
{
	header("Location: index.php");
}
?>
<!doctype html>
<html lang="en">
<head>
	<title>Khali Cinema</title>
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
	<meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=0">
	<!-- CSS -->
	<link rel="stylesheet" href="../assets/css/bootstrap.min.css">
	<link rel="stylesheet" href="../assets/css/vendor/icon-sets.css">
	<link rel="stylesheet" href="../assets/css/main.min.css">
	<!-- FOR DEMO PURPOSES ONLY. You should remove this in your project -->
	<link rel="stylesheet" href="../assets/css/demo.css">
	<!-- GOOGLE FONTS -->
	<link href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,600,700" rel="stylesheet">
	<!-- ICONS -->
	<link rel="apple-touch-icon" sizes="76x76" href="../assets/img/apple-icon.png">
	<link rel="icon" type="image/png" sizes="96x96" href="../assets/img/favicon.png">
	<link rel="stylesheet" href="//code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css">
	<link rel="stylesheet" href="http://jqueryui.com/resources/demos/style.css">
	<script src="https://code.jquery.com/jquery-1.12.4.js"></script>
	<script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>
	<link rel="stylesheet" href="//cdnjs.cloudflare.com/ajax/libs/timepicker/1.3.5/jquery.timepicker.min.css">
	<script src="//cdnjs.cloudflare.com/ajax/libs/timepicker/1.3.5/jquery.timepicker.min.js"></script>
	 <script>
	  $( function() {
			$("#ngaychieu").datepicker({dateFormat: "yy-mm-dd",}).datepicker("setDate", new Date());

			$('#batdau').timepicker({ timeFormat: 'H:mm' });
		  });
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
	<!-- WRAPPER -->
	<div id="wrapper">
		<!-- SIDEBAR -->
		<?php include_once '../assets/blocks/menu.php';?>
		<!-- END SIDEBAR -->
		<!-- MAIN -->
		<div class="main">
			<!-- MAIN CONTENT -->
			<div class="main-content">
				<div class="container-fluid">
					<div class="row">
							<div class="col-md-10 col-md-offset-4">
								<div class="col-lg-5">
									<form action="" method="post">
										<table>
											<?php
											require_once '../connect/db_connect.php';
											$db=new DB_Connect();
											$conn=$db->connect();
											$id=$_GET['maphim'];
											$sql="select * from phongchieu where isDelete=false";
											$result=$conn->query($sql);
											echo '<tr>
												<td><label>Phòng chiếu</label></td>
												<td><select class="form-control" id="phongchieu">';
											while($row=mysqli_fetch_assoc($result))
											{
											echo		'<option value='.$row['maphong'].'>'.$row['tenphong'].'</option>';
											}
											echo 	'</select>
												</td>
											</tr>';
											?>
											<tr>
												<td><label>Ngày chiếu </label></td>
												<td><input type="text" id="ngaychieu" class="form-control"></td>
											</tr>
											<tr>
												<td><label>Bắt đầu </label></td>
												<td><input type="text" id="batdau" class="form-control"></td>
											</tr>
											<tr>
												<td></td>
												<td><button style="margin-top: 20px" type="button" class="btn btn-sm btn-success" onclick="add(<?php echo $id;?>);">Thêm</button>
											</tr>
										</table>
									</form>
								</div>
							</div>
						</div>
					<div class="row" style="margin-top: 20px">
						<div class="col-lg-7 col-md-offset-3">
							<!-- BORDERED TABLE -->
							<div class="alert alert-success" id="alert-success-top" ><?php if(isset($mess)) echo $mess;?></div>
							<div class="panel">
								<div class="panel-body">
									<table class="table table-bordered">
										<thead>
											<tr>
												<th style="text-align:center">Phòng chiếu</th>
												<th style="text-align:center">Ngày chiếu</th>
												<th style="text-align:center">Bắt đầu</th>
												<th style="text-align:center">Kết thúc</th>
											</tr>
										</thead>
										<tbody>
											<?php
											$result=mysqli_query($conn,"select tenphong,ngaychieu,batdau,ketthuc,DATE_FORMAT(batdau, '%H:%i') as batdau,DATE_FORMAT(ketthuc, '%H:%i') as ketthuc from lichchieu,phongchieu where lichchieu.phongchieu=phongchieu.maphong and phim='$id' order by ngaychieu desc");
											while($row=mysqli_fetch_array($result)){
												echo '
												<tr>
													<td align="center">'.$row['tenphong'].'</td>
													<td align="center">'.$row['ngaychieu'].'</td>
													<td align="center">'.$row['batdau'].'</td>
													<td align="center">'.$row['ketthuc'].'</td>
												';
												echo '</tr>';
											}
											?>
										</tbody>
									</table>
								</div>
							</div>
							<!-- END BORDERED TABLE -->
						</div>
					</div>
				</div>
			</div>
			<!-- END MAIN CONTENT -->
			<?php include_once '../assets/blocks/footer.php';?>
		</div>
		<!-- END MAIN -->
	</div>
	<!-- END WRAPPER -->
	<!-- Javascript -->
	<script src="../assets/js/bootstrap/bootstrap.min.js"></script>
	<script src="../assets/js/plugins/jquery-slimscroll/jquery.slimscroll.min.js"></script>
	<script src="../assets/js/klorofil.min.js"></script>
	<script src="../assets/admin/lichchieu.js"></script>
</body>

</html>
