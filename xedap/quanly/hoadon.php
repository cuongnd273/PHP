<?php
require_once '../connect/db_connect.php';
session_start();
if(isset($_SESSION['adminEmail']))
{
	$db=new DB_Connect();
	$conn=$db->connect();
	if(isset($_POST['addHD']))
	{
		$mataikhoan=mysqli_real_escape_string($conn,$_POST['mataikhoan']);
		$tenkhachhang=mysqli_real_escape_string($conn,$_POST['tenkhachhang']);
		$sdt=mysqli_real_escape_string($conn,$_POST['sdt']);
		$diachi=mysqli_real_escape_string($conn,$_POST['diachi']);
		$hinhthucthanhtoan=mysqli_real_escape_string($conn,$_POST['hinhthuc']);
		$trangthai=mysqli_real_escape_string($conn,$_POST['trangthai']);
		$sql="Insert into hoadon(mataikhoan,ngaytao,tenkhachhang,sdt,diachi,hinhthucthanhtoan,trangthai) values('$mataikhoan',NOW(),'$tenkhachhang','$sdt','$diachi','$hinhthucthanhtoan','$trangthai')";
		$result=$conn->query($sql);
		if($result)
		{
			$response['message']='Thêm thành công';
			$response['success']=1;
			echo json_encode($response);
		}else{
			$response['message']='Thêm thất bại';
			$response['success']=2;
			echo json_encode($response);
		}
	}else if(isset($_POST['deleteHD'])){
		$mahoadon=mysqli_real_escape_string($conn,$_POST['mahoadon']);
		$sql="delete from hoadon where mahoadon='$mahoadon'";
		$result=$conn->query($sql);
		if($result)
		{
			$response['message']='Xóa thành công';
			$response['success']=1;
			echo json_encode($response);
		}else{
			$response['message']='Xóa thất bại';
			$response['success']=2;
			echo json_encode($response);
		}
	}
}else{
	header("Location: /xedap/404.php");
}
?>