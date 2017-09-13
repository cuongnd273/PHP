<?php
require_once '../connect/db_connect.php';
session_start();
if(isset($_SESSION['adminEmail']))
{
	$db=new DB_Connect();
	$conn=$db->connect();
	if(isset($_POST['addCTHD']))
	{
		$mahoadon=mysqli_real_escape_string($conn,$_POST['mahoadon']);
		$sanpham=mysqli_real_escape_string($conn,$_POST['sanpham']);
		$soluong=mysqli_real_escape_string($conn,$_POST['soluong']);
		$sql="select tensanpham,gia from sanpham where masanpham='$sanpham'";
		$result=$conn->query($sql);
		$row=mysqli_fetch_row($result);
		$tensanpham=$row[0];
		$gia=$row[1];
		$sql="select * from chitiethoadon where sanpham='$tensanpham' and mahoadon='$mahoadon'";
		$result=$conn->query($sql);
		if($result)
		{
			if(mysqli_num_rows($result)>0)
			{
				$response['message']='Sản phẩm đã có trong hóa đơn này';
				$response['success']=4;
				echo json_encode($response);
			}else{
				$sql="Insert into chitiethoadon(mahoadon,sanpham,gia,soluong) values('$mahoadon','$tensanpham','$gia','$soluong')";
				$result=$conn->query($sql);
				if($result)
				{
					$response['message']='Thêm thành công';
					$response['success']=1;
					echo json_encode($response);
				}else{
					$response['message']='Thêm thất bại';
					$response['success']=3;
					echo json_encode($response);
				}
			}
		}else{
			$response['message']='Có lỗi xảy ra';
			$response['success']=2;
			echo json_encode($response);
		}
	}else if(isset($_POST['deleteCTHD'])){
		$machitiet=mysqli_real_escape_string($conn,$_POST['machitiet']);
		$sql="delete from chitiethoadon where machitiet='$machitiet'";
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