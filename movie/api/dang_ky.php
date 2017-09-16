<?php
include_once '../connect/db_connect.php';
if(isset($_POST['cmnd'])){
	$response=array();
	$db=new DB_Connect();
	$conn=$db->connect();
	$result=mysqli_query($conn,"select * from taikhoan where cmnd='$_POST[cmnd]'");
	if(mysqli_num_rows($result)>0){
		$response['status']=201;
		$resposne['message']='Cmnd da su dung';
		echo json_encode($response);
	}else{
		$result=mysqli_query($conn,"select * from taikhoan where email='$_POST[email]'");
		if(mysqli_num_rows($result)>0){
			$response['status']=202;
			$resposne['message']='Email da su dung';
			echo json_encode($response);
		}else{
			$result=mysqli_query($conn,"select * from taikhoan where taikhoan='$_POST[taikhoan]'");
			if(mysqli_num_rows($result)>0){
				$response['status']=203;
				$resposne['message']='Tai khoan da su dung';
				echo json_encode($response);
			}else{
				$sql="Insert into taikhoan(cmnd,taikhoan,matkhau,hoten,email,sdt,diachi,ngaysinh) values('$_POST[cmnd]','$_POST[taikhoan]','$_POST[matkhau]','$_POST[hoten]','$_POST[email]','$_POST[sdt]','$_POST[diachi]','$_POST[ngaysinh]')";
				$result=mysqli_query($conn,$sql);
				if($result){
					$response['status']=200;
					$resposne['message']='Thanh cong';
					echo json_encode($response);
				}else{
					$response['status']=204;
					$response['message']='Co loi xay ra';
					echo json_encode($response);
				}
			}
		}
	}
}else{
	$response['status']=204;
	$response['message']='Co loi xay ra';
	echo json_encode($response);
}
?>