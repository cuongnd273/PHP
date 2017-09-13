<?php
require_once '../connect/db_connect.php';
session_start();
if(isset($_SESSION['adminEmail']))
{
	$db=new DB_Connect();
	$conn=$db->connect();
	if(isset($_POST['addKMC']))
	{
		$khuyenmai=mysqli_real_escape_string($conn,$_POST['khuyenmai']);
		$batdau=mysqli_real_escape_string($conn,$_POST['batdau']);
		$ketthuc=mysqli_real_escape_string($conn,$_POST['ketthuc']);
		$sql="Insert into khuyenmaichung(khuyenmai,thoigianbatdau,thoigianketthuc) values('$khuyenmai','$batdau','$ketthuc')";
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
	}else if(isset($_POST['deleteKMC'])){
		$id=mysqli_real_escape_string($conn,$_POST['id']);
		$sql="delete from khuyenmaichung where id='$id'";
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