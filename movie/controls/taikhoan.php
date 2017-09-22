<?php
include '../connect/db_connect.php';
if(isset($_POST['kick'])){
	$db=new DB_Connect();
	$conn=$db->connect();
	$result=mysqli_query($conn,"Update taikhoan set isDelete=true where mataikhoan='$_POST[mataikhoan]'");
	if($result){
		echo 'Vô hiệu thành công';
	}else
		echo 'Vô hiệu thất bại';
}
?>