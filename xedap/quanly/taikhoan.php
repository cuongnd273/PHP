<?php
require_once '../connect/db_connect.php';
session_start();
if(isset($_SESSION['adminEmail']))
{
	$db=new DB_Connect();
	$conn=$db->connect();
	if(!empty($_POST['addTK']))
	{
		$hoten=mysqli_real_escape_string($conn,$_POST['hoten']);
		$taikhoan=mysqli_real_escape_string($conn,$_POST['email']);
		$matkhau=mysqli_real_escape_string($conn,$_POST['matkhau']);
		$quyen=mysqli_real_escape_string($conn,$_POST['quyen']);
		$sql="select maquyen from quyen where tenquyen='$quyen'";
		$result=$conn->query($sql);
		if($result)
		{
			$row=mysqli_fetch_row($result);
			$quyen=$row[0];
			$sql="select * from taikhoan where email='$taikhoan'";
			$result=$conn->query($sql);
			if($result)
			{
				if(mysqli_num_rows($result)>0)
				{
					$response['message']='Email đã được sử dụng';
					$response['success']=3;
					echo json_encode($response);
				}else{
					$sql="Insert into taikhoan(maquyen,hoten,email,matkhau) values('$quyen','$hoten','$taikhoan','$matkhau')";
					$result=$conn->query($sql);
					if($result)
					{
						$response['message']='Thêm thành công';
						$response['success']=1;
						echo json_encode($response);
					}else{
						$response['message']='Thêm thất bại ';
						$response['success']=4;
						echo json_encode($response);
					}
				}
			}else{
				$response['message']='Có lỗi xảy ra';
				$response['success']=2;
				echo json_encode($response);
			}
		}
	}else if(isset($_POST['deleteTK']))
	{
		$mataikhoan=mysqli_real_escape_string($conn,$_POST['mataikhoan']);
		$sql="delete from taikhoan where mataikhoan='$mataikhoan'";
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