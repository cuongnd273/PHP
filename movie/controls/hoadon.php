<?php
include '../connect/db_connect.php';
$db=new DB_Connect();
$conn=$db->connect();
if(isset($_POST['edit'])){
	$result=mysqli_query($conn,"Update hoadon set trangthai=true where mahoadon='$_POST[mahoadon]'");
	if($result){
		echo "Thanh toán thành công";
	}else
	 	echo "Thanh toán thất bại";
}
?>