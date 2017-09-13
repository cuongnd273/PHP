<?php
include_once '../connect/db_connect.php';
if(isset($_POST['them'])){
	$db=new DB_Connect();
	$conn=$db->connect();
	$result=mysqli_query($conn,"Select * from thietbi where tenthietbi='$_POST[tenthietbi]'");
	if($result){
		if(mysqli_num_rows($result)>0){
			echo "Thiết bị đã tồn tại";
		}else{
			$result=mysqli_query($conn,"Insert into thietbi(tenthietbi) values('$_POST[tenthietbi]')");
			if($result){
				echo "Thêm thành công";
			}else{
				echo "Thêm thất bại";
			}
		}
	}else{
		echo "Có lỗi xảy ra";
	}
}else if(isset($_POST['xoa'])){
	$db=new DB_Connect();
	$conn=$db->connect();
	$result=mysqli_query($conn,"delete from thietbi where mathietbi='$_POST[mathietbi]'");
	if($result){
		echo "Xóa thành công";
	}else{
		echo "Xóa thất bại";
	}
}else if(isset($_POST['them_p'])){
	$db=new DB_Connect();
	$conn=$db->connect();
	$result=mysqli_query($conn,"Insert into danhsachthietbi(maphong,mathietbi,soluong,tinhtrang) values('$_POST[maphong]','$_POST[thietbi]','$_POST[soluong]','$_POST[tinhtrang]')");
	if($result){
		echo "Thêm thành công";
	}else{
		echo "Thêm thất bại";
	}
}
else if(isset($_POST['xoa_p'])){
	$db=new DB_Connect();
	$conn=$db->connect();
	$result=mysqli_query($conn,"delete from danhsachthietbi where id='$_POST[id]'");
	if($result){
		echo "Xóa thành công";
	}else{
		echo "Xóa thất bại";
	}
}
?>