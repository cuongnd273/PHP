<?php
include_once '../connect/db_connect.php';
$db=new DB_Connect();
$conn=$db->connect();
$domain=$_SERVER['HTTP_HOST'];
$result=mysqli_query($conn,"select * from phim,giave where maphim='$_GET[maphim]' and phim.loaive=giave.magia");
if($result){
	$row=mysqli_fetch_array($result);
	$item=array();
	$item['maphim']=$row['maphim'];
	$item['tenphim']=$row['tenphim'];
	$item['gia']=$row['gia'];
	$item['ngaybatdau']=$row['ngaybatdau'];
	$item['ngayketthuc']=$row['ngayketthuc'];
	$item['daodien']=$row['daodien'];
	$item['dienvien']=$row['dienvien'];
	$item['thoiluong']=$row['thoiluong'];
	$item['anh']="http://".$domain.'/movie/images/'.$row['anh'];
	$item['tomtat']=$row['tomtat'];
	echo json_encode($item);
}
?>