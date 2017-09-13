<?php
require_once '../connect/db_connect.php';
session_start();
if(isset($_SESSION['adminEmail']))
{
	$db=new DB_Connect();
	$conn=$db->connect();
	if(isset($_POST['addSP']))
	{
		move_uploaded_file($_FILES['file']['tmp_name'], '../images/products/'.$_FILES['file']['name']);
		$anh =$_FILES['file']['name'];
		$sql="select * from sanpham where tensanpham='$_POST[tensanpham]'";
		$result=$conn->query($sql);
		if($result)
		{
			if(mysqli_num_rows($result)>0)
			{
				$response['message']='Sản phẩm đã tồn tại';
				$response['success']=3;
				echo json_encode($response);
			}else{
				$sql="Insert into sanpham(manhom,loaisanpham,tensanpham,gia,soluongcon,anh,mota,khungxe,mausac,giamxoc,yenxe,vanhxe,lopxe,phanhxe,thongsokythuat) values('$_POST[manhom]','$_POST[loaisanpham]','$_POST[tensanpham]','$_POST[gia]','$_POST[soluongcon]','$anh','$_POST[mota]','$_POST[khungxe]','$_POST[mausac]','$_POST[giamxoc]','$_POST[yenxe]','$_POST[vanhxe]','$_POST[lopxe]','$_POST[phanhxe]','$_POST[thongsokythuat]')";
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
				echo $sql;
			}
		}else{
			$response['message']='Có lỗi xảy ra';
			$response['success']=2;
			echo json_encode($response);
		}
	}else if(isset($_POST['deleteSP'])){
		$masanpham=mysqli_real_escape_string($conn,$_POST['masp']);
		$sql="delete from sanpham where masanpham='$masanpham'";
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