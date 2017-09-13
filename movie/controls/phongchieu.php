<?php
include '../connect/db_connect.php';
$db=new DB_Connect();
$conn=$db->connect();
if(isset($_POST['add'])){
	$result=mysqli_query($conn,"Insert into phongchieu(tenphong,soghe) values('$_POST[tenphong]','$_POST[soghe]')");
	if($result){
		echo "Thêm thành công";
	}else
	 	echo "Thêm thất bại";
}else if(isset($_POST['delete'])){
	$result=mysqli_query($conn,"Update phongchieu set isDelete=true where maphong='$_POST[maphong]'");
	if($result){
		echo "Xóa thành công";
	}else
	 	echo "Xóa thất bại";
}
?>