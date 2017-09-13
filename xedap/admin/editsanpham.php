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
                                <i class="fa fa-table"></i> Sản phẩm
                            </li>
                        </ol>
                    </div>
                </div>
                <div class="row">
					<div class="col-md-12 col-md-offset-2">
						<div class="col-lg-12 ">
							 <form action="#" method="post" enctype="multipart/form-data">
								<table>
									<tr>
									<?php
									require_once '../connect/db_connect.php';
									$db=new DB_Connect();
									$conn=$db->connect();
									$masp=$_GET['masp'];
									$sqlSP="select tensanpham,gia,anh,mota,sanpham.manhom,loaisanpham,tennhom,soluongcon,khungxe,mausac,giamxoc,yenxe,vanhxe,lopxe,phanhxe,thongsokythuat from sanpham,nhomsanpham where masanpham='$masp' and sanpham.manhom=nhomsanpham.manhom";
									$resultSP=$conn->query($sqlSP);
									$rowSP=mysqli_fetch_array($resultSP);
									$sqlNSP="select * from nhomsanpham";
									$resultNSP=$conn->query($sqlNSP);
									echo '<tr>
										<td><label>Nhóm sản phẩm</label></td>
										<td><select class="form-control" id="manhom" name="manhom">
										<option value='.$rowSP['manhom'].'>'.$rowSP['tennhom'].'</option>';
									while($row=mysqli_fetch_assoc($resultNSP))
									{
									echo		'<option value='.$row['manhom'].'>'.$row['tennhom'].'</option>';
									}
									echo 	'</select>
										</td>
									</tr>';
									if(isset($_POST["submit"]))
									{
										if(empty($_FILES['file']['tmp_name']))
										{
											$sql="Update sanpham set manhom='$_POST[manhom]',loaisanpham='$_POST[loaisanpham]',tensanpham='$_POST[tensanpham]',gia='$_POST[gia]',soluongcon='$_POST[soluongcon]',mota='$_POST[mota]',khungxe='$_POST[khungxe]',mausac='$_POST[mausac]',giamxoc='$_POST[giamxoc]',yenxe='$_POST[yenxe]',vanhxe='$_POST[vanhxe]',lopxe='$_POST[lopxe]',phanhxe='$_POST[phanhxe]',thongsokythuat='$_POST[thongsokythuat]' where masanpham='$masp'";
											$result=$conn->query($sql);
											if($result)
											{
												header("Location: /xedap/admin/sanpham.php");
											}else{
												echo '<script language="javascript">';
												echo 'alert("Sửa thất bại")';
												echo '</script>';
											}
										}else{
											$tensanpham=$_POST['tensanpham'];
											$gia=$_POST['gia'];
											$mota=$_POST['mota'];
											$thongsokythuat=$_POST['thongsokythuat'];
											move_uploaded_file($_FILES['file']['tmp_name'], '../images/products/'.$_FILES['file']['name']);
											$anh =$_FILES['file']['name'];
											$sql="Update sanpham set manhom='$_POST[manhom]',loaisanpham='$_POST[loaisanpham]',tensanpham='$_POST[tensanpham]',gia='$_POST[gia]',soluongcon='$_POST[soluongcon]',mota='$_POST[mota]',anh='$anh',khungxe='$_POST[khungxe]',mausac='$_POST[mausac]',giamxoc='$_POST[giamxoc]',yenxe='$_POST[yenxe]',vanhxe='$_POST[vanhxe]',lopxe='$_POST[lopxe]',phanhxe='$_POST[phanhxe]',thongsokythuat='$_POST[thongsokythuat]' where masanpham='$masp'";
											$result=$conn->query($sql);
											if($result)
											{
												header("Location: /xedap/admin/sanpham.php");
												echo $sql;
											}else{
												echo '<script language="javascript">';
												echo 'alert("Sửa thất bại")';
												echo '</script>';
											}
										}
									}
									?>
									<tr>
										<td><label>Loại sản phẩm</label></td>
										<td><select class="form-control" name="loaisanpham">
									<?php
									if($rowSP['loaisanpham']==1)
									{
										echo '<option value="1">Sản phẩm bán</option>';
										echo '<option value="0">Sản phẩm tặng</option>';
									}else{
										echo '<option value="0">Sản phẩm tặng</option>';
										echo '<option value="1">Sản phẩm bán</option>';
									}
									?>
									</select></td>
									<tr>
										<td><label>Tên sản phẩm</label></td>
										<td><input type="text" name="tensanpham" class="form-control" value="<?php echo $rowSP['tensanpham']?>"></td>
									</tr>
									<tr>
										<td><label>Giá</label></td>
										<td><input type="number" min="0"  name="gia" class="form-control" value="<?php echo $rowSP['gia']?>"></td>
									</tr>
									<tr>
										<td><label>Số lượng còn</label></td>
										<td><input type="number" min="0"  name="soluongcon" class="form-control" value="<?php echo $rowSP['soluongcon']?>"></td>
									</tr>
									<tr>
										<td><label>Ảnh</label></td>
										<td><image width="50px" height="50px" src="../images/products/<?php echo $rowSP['anh']?>"/><input type="file" id="file" name="file"></td>
									</tr>
									<tr>
										<td><label>Mô tả</label></td>
										<td><textarea rows="3" id="mota" name="mota" class="form-control" ><?php echo $rowSP['mota']?></textarea></td>
									</tr>
									<tr>
										<td><label>Thông số kỹ thuật</label></td>
										<td><textarea rows="5" id="thongsokythuat" name="thongsokythuat" class="form-control" ><?php echo $rowSP['thongsokythuat']?></textarea></td>
									</tr>
									<tr>
										<td><label>Khung xe</label></td>
										<td><input type="text" name="khungxe" class="form-control" value="<?php echo $rowSP['khungxe']?>"></td>
									</tr>
									<tr>
										<td><label>Màu sắc</label></td>
										<td><input type="text" name="mausac" class="form-control" value="<?php echo $rowSP['mausac']?>"></td>
									</tr>
									<tr>
										<td><label>Giảm xóc</label></td>
										<td><input type="text" name="giamxoc" class="form-control" value="<?php echo $rowSP['giamxoc']?>"></td>
									</tr>
									<tr>
										<td><label>Yên xe</label></td>
										<td><input type="text" name="yenxe" class="form-control" value="<?php echo $rowSP['yenxe']?>"></td>
									</tr>
									<tr>
										<td><label>Vành xe</label></td>
										<td><input type="text" name="vanhxe" class="form-control" value="<?php echo $rowSP['vanhxe']?>"></td>
									</tr>
									<tr>
										<td><label>Lốp xe</label></td>
										<td><input type="text" name="lopxe" class="form-control" value="<?php echo $rowSP['lopxe']?>"></td>
									</tr>
									<tr>
										<td><label>Phanh xe</label></td>
										<td><input type="text" name="phanhxe" class="form-control" value="<?php echo $rowSP['phanhxe']?>"></td>
									</tr>
									<tr>
										<td></td>
										<td><button type="submit" name="submit" class="btn btn-sm btn-success">OK</button>
										<button type="reset" class="btn btn-sm btn-warning">Reset</button></td>
									</tr>
								</table>
							</form>
						</div>
					</div>
				</div>
            </div>
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
