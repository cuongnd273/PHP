<?php
include '../connect/db_connect.php';
$db=new DB_Connect();
$conn=$db->connect();
if(isset($_POST['add'])){
	$result=mysqli_query($conn,"Insert into phieugiamgia(ma,giamgia,ngayhethan,soluong) values('$_POST[ma]','$_POST[giamgia]','$_POST[ngayhethan]','$_POST[soluong]')");
	if($result){
		echo "Thêm thành công";
	}else
	 	echo "Thêm thất bại";
}
?>