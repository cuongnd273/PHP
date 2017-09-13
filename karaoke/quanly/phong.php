<?php
session_start();
include_once '../connect/db_connect.php';
if(isset($_POST['them'])){
	$db=new DB_Connect();
	$conn=$db->connect();
	$result=mysqli_query($conn,"Insert into phong(tenphong) values('$_POST[tenphong]')");
	if($result){
		echo "Thêm thành công";
	}else{
		echo "Thêm thất bại";
	}
}else if(isset($_POST['xoa'])){
	$db=new DB_Connect();
	$conn=$db->connect();
	$result=mysqli_query($conn,"delete from phong where maphong='$_POST[maphong]'");
	if($result){
		echo "Xóa thành công";
	}else{
		echo "Xóa thất bại";
	}
}else if(isset($_POST['thaydoi'])){
	$db=new DB_Connect();
	$conn=$db->connect();
	$result=mysqli_query($conn,"select * from phong where maphong='$_POST[maphong]'");
	$phong=mysqli_fetch_array($result);
	if($phong['trangthai']==0){
		mysqli_query($conn,"Update phong set trangthai=1 where maphong='$_POST[maphong]'");
		mysqli_query($conn,"insert into hoadon(maphong,manhanvien,thoigianlap) values('$_POST[maphong]','$_SESSION[nhanvien]',NOW())");
	}else{
		mysqli_query($conn,"Update phong set trangthai=0 where maphong='$_POST[maphong]'");
		$result=mysqli_query($conn,"select * from hoadon where tinhtrang=0 order by mahoadon desc limit 1");
		$hoadon=mysqli_fetch_array($result);
		mysqli_query($conn,"Update hoadon set tinhtrang=1 where mahoadon='$hoadon[mahoadon]'");
		mysqli_query($conn,"Update hoadon set tongtien=(select sum(soluong*dongia) from chitiethoadon where mahoadon='$hoadon[mahoadon]') where mahoadon='$hoadon[mahoadon]'");
	}
}
?>