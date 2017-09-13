<?php
require_once '../connect/db_connect.php';
session_start();
$db=new DB_Connect();
$conn=$db->connect();
if(isset($_POST['add']))
{
	$date=date("Y/m/d");
	$id=$_POST['id'];
	$count=$_POST['count'];
	if(!isset($_SESSION['cart']))
	{
		$cart=array();
		$sql="select tensanpham,gia,anh,manhom from sanpham where masanpham='$id'";
		$result=$conn->query($sql);
		$row=mysqli_fetch_array($result);
		$product['id']=$id;
		$product['name']=$row['tensanpham'];
		$product['image']=$row['anh'];
		$product['count']=$count;
		
		$sql="select COUNT(manhom) as total,giamgia from chitietkhuyenmai,khuyenmai where chitietkhuyenmai.makhuyenmai=khuyenmai.makhuyenmai and '$date'<khuyenmai.thoigianketthuc and '$date'>khuyenmai.thoigianbatdau and loaikhuyenmai=0 and manhom='$row[manhom]'";
		$resultGiamgia=$conn->query($sql);
		$set=mysqli_fetch_array($resultGiamgia);
		if($set['total']>0)
		{
			$product['price']=$row['gia']-$row['gia']*$set['giamgia']/100;
		}else{
			$product['price']=$row['gia'];
		}
		
		$product['money']=$product['price']*$count;
		array_push($cart,$product);
		$response['message']='Thêm thành công';
		$response['success']=1;
		echo json_encode($response);
		$_SESSION['cart']=$cart;
	}else{
		$ok=1;
		$cart=$_SESSION['cart'];
		foreach($cart as $key=>&$value)
		{
			if($id==$value['id'])
			{
				$value['count']=$value['count']+$count;
				$value['money']=$value['price']*$value['count'];
				$ok=2;
			}
		}
		if($ok==1)
		{
			$sql="select tensanpham,gia,anh,manhom from sanpham where masanpham='$id'";
			$result=$conn->query($sql);
			$row=mysqli_fetch_array($result);
			$product['id']=$id;
			$product['name']=$row['tensanpham'];
			$product['image']=$row['anh'];
			$product['count']=$count;
			
			$sql="select COUNT(manhom) as total,giamgia from chitietkhuyenmai,khuyenmai where chitietkhuyenmai.makhuyenmai=khuyenmai.makhuyenmai and '$date'<khuyenmai.thoigianketthuc and '$date'>khuyenmai.thoigianbatdau and loaikhuyenmai=0 and manhom='$row[manhom]'";
			$resultGiamgia=$conn->query($sql);
			$set=mysqli_fetch_array($resultGiamgia);
			if($set['total']>0)
			{
				$product['price']=$row['gia']-$row['gia']*$set['giamgia']/100;
			}else{
				$product['price']=$row['gia'];
			}
				
			$product['money']=$product['price']*$count;
			array_push($cart,$product);
		}
		$_SESSION['cart']=$cart;
		$response['message']='Thêm thành công';
		$response['success']=1;
		echo json_encode($response);
	}
}else if(isset($_POST['del']))
{
	$id=$_POST['id'];
	if(isset($_SESSION['cart']))
	{
		$cart=$_SESSION['cart'];
		foreach($cart as $key=>$value)
		{
			if($id==$value['id'])
			{
				unset($cart[$key]);
			}
		}
		$_SESSION['cart']=$cart;
		$response['message']='Xóa thành công';
		$response['success']=1;
		echo json_encode($response);
	}
}else if(isset($_POST['update']))
{
	$soluong=$_POST['soluong'];
	if(isset($_SESSION['cart']))
	{
		$cart=$_SESSION['cart'];
		foreach($cart as $key=>&$value)
		{
			$sql="select soluongcon from sanpham where masanpham='$value[id]'";
			$result=$conn->query($sql);
			$row=mysqli_fetch_array($result);
			if($soluong[$key]>$row['soluongcon'])
			{
				$value['count']=$row['soluongcon'];
			}else{
				$value['count']=$soluong[$key];
			}
			$value['money']=$value['price']*$value['count'];
		}
		$_SESSION['cart']=$cart;
		$response['message']='Xóa thành công';
		$response['success']=1;
		echo json_encode($response);
	}
}else if(isset($_POST['delete_all']))
{
	unset($_SESSION['cart']);
	$response['message']='Xóa giỏ hàng thành công';
	$response['success']=1;
	echo json_encode($response);
}
?>