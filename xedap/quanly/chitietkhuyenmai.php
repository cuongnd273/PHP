<?php
require_once '../connect/db_connect.php';
session_start();
if(isset($_SESSION['adminEmail']))
{
	$db=new DB_Connect();
	$conn=$db->connect();
	if(isset($_POST['addCTKM']))
	{
		$date=date("Y/m/d");
		$loaikhuyenmai=mysqli_fetch_array($conn->query("select loaikhuyenmai from khuyenmai where makhuyenmai='$_POST[makhuyenmai]'"))['loaikhuyenmai'];
		if($loaikhuyenmai==0)
		{
			$sql="select count(manhom) as total from chitietkhuyenmai,khuyenmai where chitietkhuyenmai.makhuyenmai=khuyenmai.makhuyenmai and manhom='$_POST[manhom]' and '$date'>thoigianbatdau and thoigianketthuc>'$date' and loaikhuyenmai=0";
			$result=$conn->query($sql);
			$total=mysqli_fetch_array($result)['total'];
			if($total>0)
			{
				$response['message']='Nhóm sản phẩm đang tham gia 1 chương trình giảm giá';
				$response['success']=3;
				echo json_encode($response);
			}else{
				$sql="Insert into chitietkhuyenmai(makhuyenmai,manhom) values('$_POST[makhuyenmai]','$_POST[manhom]')";
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
			$sql="Insert into chitietkhuyenmai(makhuyenmai,manhom) values('$_POST[makhuyenmai]','$_POST[manhom]')";
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
	}else if(isset($_POST['deleteCTKM'])){
		$sql="delete from chitietkhuyenmai where makhuyenmai='$_POST[makhuyenmai]' and manhom='$_POST[manhom]'";
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