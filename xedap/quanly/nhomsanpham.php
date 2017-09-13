<?php
require_once '../connect/db_connect.php';
session_start();
if(isset($_SESSION['adminEmail']))
{
	$db=new DB_Connect();
	$conn=$db->connect();
	if(isset($_POST['addNSP']))
	{
		$tennhom=mysqli_real_escape_string($conn,$_POST['tennhom']);
		$sql="select * from nhomsanpham where tennhom='$tennhom'";
		$result=$conn->query($sql);
		if($result)
		{
			if(mysqli_num_rows($result)>0)
			{
				$response['message']='Nhóm sản phẩm đã tồn tại';
				$response['success']=3;
				echo json_encode($response);
			}else{
				$sql="Insert into nhomsanpham(tennhom) values('$tennhom')";
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
			}
		}else{
			$response['message']='Có lỗi xảy ra';
			$response['success']=2;
			echo json_encode($response);
		}
	}else if(isset($_POST['deleteNSP'])){
		$manhom=mysqli_real_escape_string($conn,$_POST['manhom']);
		$sql="delete from nhomsanpham where manhom='$manhom'";
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