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
	 <script>
	  $( function() {
			$( "#ngaybatdau" ).datepicker({
				 dateFormat: "yy-mm-dd",
			}).datepicker("setDate", new Date());;
			$( "#ngayketthuc" ).datepicker({
				 dateFormat: "yy-mm-dd",
			}).datepicker("setDate", new Date());;
		  } );
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
				<input type="button" class="btn btn-sm btn-success" name="show" value="Nhập thông tin" onclick="show();">
					<div class="row" id="form_them" hidden="true">
							<div class="col-md-12 col-md-offset-2">
								<div class="col-lg-8">
									<form action="" method="post">
										<table>
											<tr>
												<td><label>Tên phim </label></td>
												<td><input type="text" id="tenphim" class="form-control"></td>
											</tr>
											<tr>
												<td><label>Ngày bắt đầu </label></td>
												<td><input type="text" id="ngaybatdau" class="form-control"></td>
											</tr>
											<tr>
												<td><label>Ngày kết thúc </label></td>
												<td><input type="text" id="ngayketthuc" class="form-control"></td>
											</tr>
											<tr>
												<td><label>Đạo diễn </label></td>
												<td><input type="text" id="daodien" class="form-control"></td>
											</tr>
											<tr>
												<td><label>Diễn viên </label></td>
												<td><input type="text" id="dienvien" class="form-control"></td>
											</tr>
											<tr>
												<td><label>Thời lượng </label></td>
												<td><input type="number" value="100" id="thoiluong" class="form-control"></td>
											</tr>
											<tr>
												<td><label>Ảnh </label></td>
												<td><input type="file" id="anh" name="anh"></td>
											</tr>
											<tr>
												<td><label>Tóm tắt </label></td>
												<td><textarea id="tomtat" rows="10" cols="100" class="form-control"></textarea></td>
											</tr>
											<?php
											require_once '../connect/db_connect.php';
											$db=new DB_Connect();
											$conn=$db->connect();
											$sql="select * from giave";
											$result=$conn->query($sql);
											echo '<tr>
												<td><label>Loại vé</label></td>
												<td><select class="form-control" id="loaive">';
											while($row=mysqli_fetch_assoc($result))
											{
											echo		'<option value='.$row['magia'].'>'.$row['loaive'].'</option>';
											}
											echo 	'</select>
												</td>
											</tr>';
									?>
											<tr>
												<td></td>
												<td><button style="margin-top: 20px" type="button" name="them" class="btn btn-sm btn-success" onclick="add();">Thêm</button>
											</tr>
										</table>
									</form>
								</div>
							</div>
						</div>
					<div class="row" style="margin-top: 20px">
						<div class="col-lg-10 col-md-offset-1">
							<!-- BORDERED TABLE -->
							<div class="alert alert-success" id="alert-success-top" ><?php if(isset($mess)) echo $mess;?></div>
							<div class="panel">
								<div class="panel-heading">
									<h3 class="panel-title">Phim</h3>
								</div>
								<div class="panel-body">
									<table class="table table-bordered">
										<thead>
											<tr>
												<th style="text-align:center">Tên phim</th>
												<th style="text-align:center">Ngày bắt đầu</th>
												<th style="text-align:center">Ngày kết thúc</th>
												<th style="text-align:center">Ảnh</th>
												<th style="text-align:center">Giá vé</th>
												<?php
												if(isset($_SESSION['admin'])){
													echo '
														<th style="text-align:center">Sửa</th>
														<th style="text-align:center">Xóa</th>
													';
												}
												?>
												<th style="text-align:center">Lịch chiếu</th>
											</tr>
										</thead>
										<tbody>
											<?php
											if(!isset($_GET['type'])){
												$sql="select maphim,tenphim,ngaybatdau,ngayketthuc,gia,anh from phim,giave where phim.loaive=giave.magia and isDelete=false";
											}else if(isset($_GET['type']) && $_GET['type']=='now'){
												$sql="select maphim,tenphim,ngaybatdau,ngayketthuc,gia,anh from phim,giave where phim.loaive=giave.magia and isDelete=false and ngaybatdau < NOW() and ngayketthuc >= NOW()";
											}else if(isset($_GET['type']) && $_GET['type']=='comingsoon'){
												$sql="select maphim,tenphim,ngaybatdau,ngayketthuc,gia,anh from phim,giave where phim.loaive=giave.magia and isDelete=false and ngaybatdau > NOW() ";
											}
											else if(isset($_GET['type']) && $_GET['type']=='shown'){
												$sql="select maphim,tenphim,ngaybatdau,ngayketthuc,gia,anh from phim,giave where phim.loaive=giave.magia and isDelete=false and  ngayketthuc < NOW()";
											}
											$result=mysqli_query($conn,$sql);
											while($row=mysqli_fetch_array($result)){
												echo '
												<tr>
													<td>'.$row['tenphim'].'</td>
													<td>'.$row['ngaybatdau'].'</td>
													<td>'.$row['ngayketthuc'].'</td>
													<td><img width="50" height="50" src="../images/'.$row['anh'].'"></td>
													<td>'.$row['gia'].'</td>';
												if(isset($_SESSION['admin']))
												echo '
													<td align="center" class="col-md-1"><input width="30" height="30" type="image" src="../assets/img/edit.png" onclick="edit('.$row['maphim'].')"/></td>
													<td align="center" class="col-md-1"><input width="30" height="30" type="image" src="../assets/img/delete.png" onclick="del('.$row['maphim'].')"/></td>';
												echo '
													<td align="center" class="col-md-1"><input width="30" height="30" type="image" src="../assets/img/calendar.png" onclick="calendar('.$row['maphim'].')"/></td>
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
	<script src="../assets/admin/phim.js"></script>
</body>

</html>
