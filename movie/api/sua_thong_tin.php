<?php
include_once '../connect/db_connect.php';
if(isset($_POST['mataikhoan'])){
	$db=new DB_Connect();
	$conn=$db->connect();
	$result=mysqli_query($conn,"select * from taikhoan where mataikhoan='$_POST[mataikhoan]' and matkhau='$_POST[matkhaucu]'");
	if($result){
		if(mysqli_num_rows($result)>0){
			$result=mysqli_query($conn,"Update taikhoan set matkhau='$_POST[matkhaumoi]',hoten='$_POST[hoten]',ngaysinh='$_POST[ngaysinh]',sdt='$_POST[sdt]',diachi='$_POST[diachi]' where mataikhoan='$_POST[mataikhoan]' COLLATE utf8_unicode_ci");
			if($result){
				$result=mysqli_query($conn,"select * from taikhoan where mataikhoan='$_POST[mataikhoan]' and isDelete=false");
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
				$response['message']='Error';
				echo json_encode($response);
			}
		}else{
			$response['status']=202;
			$response['message']='Wrong password';
			echo json_encode($response);
		}
	}else{
		$response['status']=201;
		$response['message']='Error';
		echo json_encode($response);
	}
}
?>