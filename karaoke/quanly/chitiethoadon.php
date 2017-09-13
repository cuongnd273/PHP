<?php
include_once '../connect/db_connect.php';
if(isset($_POST['them'])){
	$db=new DB_Connect();
	$conn=$db->connect();
	$hoadon=mysqli_fetch_array(mysqli_query($conn,"select * from hoadon where tinhtrang=0 order by mahoadon desc limit 1"));
	$mathang=mysqli_fetch_array(mysqli_query($conn,"select * from mathang where mamathang='$_POST[mamathang]'"));
	$resultCT=mysqli_query($conn,"select * from chitiethoadon where mahoadon='$hoadon[mahoadon]' and mamathang='$_POST[mamathang]'");
	if($resultCT){
		if(mysqli_num_rows($resultCT)>0){
			mysqli_query($conn,"Update chitiethoadon set chitiethoadon.soluong=chitiethoadon.soluong+$_POST[soluong] where mahoadon='$hoadon[mahoadon]' and mamathang='$_POST[mamathang]'");
			echo "Cập nhập";
		}else{
			mysqli_query($conn,"Insert chitiethoadon(mahoadon,mamathang,soluong,dongia) values('$hoadon[mahoadon]','$mathang[mamathang]','$_POST[soluong]','$mathang[dongia]')");
			echo "Thêm mới";
		}
	}else{
		echo "Có lỗi xảy ra";
	}
}
?>