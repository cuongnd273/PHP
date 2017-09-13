<?php
include_once '../connect/db_connect.php';
if(isset($_POST['them'])){
	$db=new DB_Connect();
	$conn=$db->connect();
	$result=mysqli_query($conn,"select * from mathang where tenmathang='$_POST[mathang]'");
	if($result){
		if(mysqli_num_rows($result)>0){
			echo "Mặt hàng đã tồn tại";
		}else{
			$result=mysqli_query($conn,"Insert into mathang(tenmathang,dongia) values('$_POST[mathang]','$_POST[gia]')");
			if($result){
				echo "Thêm thành công";
			}else{
				echo "Có lỗi xảy ra";
			}
		}
	}else{
		echo "Có lỗi xảy ra";
	}
}else if(isset($_POST['xoa'])){
	$db=new DB_Connect();
	$conn=$db->connect();
	$result=mysqli_query($conn,"delete from mathang where mamathang='$_POST[mamathang]'");
	if($result){
		echo "Xóa thành công";
	}else{
		echo "Xóa thất bại";
	}
}
?>