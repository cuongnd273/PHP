<?php
include_once '../connect/db_connect.php';
$db=new DB_Connect();
$conn=$db->connect();
$domain=$_SERVER['HTTP_HOST'];
$result=mysqli_query($conn,"select * from phim ngaybatdau <= NOW() and ngayketthuc >= NOW()");
if($result){
	$phim=array();
	while($row=mysqli_fetch_array($result)){
		$item=array();
		$item['maphim']=$row['maphim'];
		$item['tenphim']=$row['tenphim'];
		$item['ngaybatdau']=$row['ngaybatdau'];
		$item['anh']="http://".$domain.'/movie/images/'.$row['anh'];
		array_push($phim,$item);
	}
	echo json_encode($phim);
}
?>