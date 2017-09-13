<?php
require_once '../connect/db_connect.php';
session_start();
if(isset($_SESSION['adminEmail']))
{
	$db=new DB_Connect();
	$conn=$db->connect();
	if(isset($_POST['addKM']))
	{
		if($_POST['loaikhuyenmai']==1)
		{
			$sql="Insert into khuyenmai(loaikhuyenmai,thoigianbatdau,thoigianketthuc,sanpham) values('$_POST[loaikhuyenmai]','$_POST[thoigianbatdau]','$_POST[thoigianketthuc]','$_POST[sanpham]')";
		}else{
			$sql="Insert into khuyenmai(loaikhuyenmai,thoigianbatdau,thoigianketthuc,sanpham,giamgia) values('$_POST[loaikhuyenmai]','$_POST[thoigianbatdau]','$_POST[thoigianketthuc]',null,'$_POST[giamgia]')";
		}
		$result=$conn->query($sql);
		if($result)
		{
			$response['message']='Thêm thành công';
			$response['success']=1;
			echo json_encode($response);
		}else{
			$response['message']='Thêm thất bại';
			$response['success']=4;
			echo json_encode($response);
		}
	}else if(isset($_POST['deleteKM'])){
		$sql="delete from khuyenmai where makhuyenmai='$_POST[id]'";
		$result=$conn->query($sql);
		if($result)
		{
			$response['message']='Xóa thành công';
			$response['success']=1;
			echo json_encode($response);
		}else{
			$response['message']='Có lỗi xảy ra';
			$response['success']=2;
			echo json_encode($response);
		}
	}
}else{
	header("Location: /xedap/404.php");
}
?>