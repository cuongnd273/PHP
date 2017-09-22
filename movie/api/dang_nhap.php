<?php
include_once '../connect/db_connect.php';
if(isset($_POST['taikhoan']) && isset($_POST['matkhau'])){
	$db=new DB_Connect();
	$conn=$db->connect();
	$result=mysqli_query($conn,"select * from taikhoan where taikhoan='$_POST[taikhoan]' and matkhau='$_POST[matkhau]' and isDelete=false");
	if($result){
		if(mysqli_num_rows($result)>0){
			$row=mysqli_fetch_array($result);
			$response['mataikhoan']=$row['mataikhoan'];
			$response['taikhoan']=$row['taikhoan'];
			$response['cmnd']=$row['cmnd'];
			$response['hoten']=$row['hoten'];
			$response['ngaysinh']=$row['ngaysinh'];
			$response['email']=$row['email'];
			$response['diachi']=$row['diachi'];
			$response['sdt']=$row['sdt'];
			$response['status']=200;
			$response['message']="Success";
			echo json_encode($response);
		}else{
			$response['status']=201;
			$response['message']="Not found";
			echo json_encode($response);
		}
	}else{
		$response['status']=201;
		$response['message']="Login fail";
		echo json_encode($response);
	}
}else{
	$response['status']=201;
	$response['message']="Error";
	echo json_encode($response);
}
?>