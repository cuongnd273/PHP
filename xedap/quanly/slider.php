<?php
require_once '../connect/db_connect.php';
session_start();
if(isset($_SESSION['adminEmail']))
{
	$db=new DB_Connect();
	$conn=$db->connect();
	if(isset($_POST['addS']))
	{
		$gioithieu=mysqli_real_escape_string($conn,$_POST['gioithieu']);
		$link=mysqli_real_escape_string($conn,$_POST['link']);
		move_uploaded_file($_FILES['file']['tmp_name'], '../images/home/'.$_FILES['file']['name']);
		$anh =$_FILES['file']['name'];
		$sql="Insert into slider(anh,gioithieu,link) values('$anh','$gioithieu','$link')";
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
	}else if(isset($_POST['deleteS'])){
		$maslider=mysqli_real_escape_string($conn,$_POST['maslider']);
		$sql="delete from slider where maslider='$maslider'";
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