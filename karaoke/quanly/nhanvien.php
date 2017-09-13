<?php
include_once '../connect/db_connect.php';
if(isset($_POST['them'])){
	$db=new DB_Connect();
	$conn=$db->connect();
	$result=mysqli_query($conn,"select * from nhanvien where taikhoan='$_POST[taikhoan]'");
	if($result){
		if(mysqli_num_rows($result)>0){
			echo "Tài khoản đã tồn tại";
		}else{
			$result=mysqli_query($conn,"Insert into nhanvien(taikhoan,matkhau,hoten,sdt,diachi,cmnd,luong) values('$_POST[taikhoan]','$_POST[matkhau]','$_POST[hoten]','$_POST[sdt]','$_POST[diachi]','$_POST[cmnd]','$_POST[luong]')");
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
	$result=mysqli_query($conn,"delete from nhanvien where manhanvien='$_POST[manhanvien]'");
	if($result){
		echo "Xóa thành công";
	}else{
		echo "Xóa thất bại";
	}
}
?>