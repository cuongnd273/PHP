<?php
include_once '../connect/db_connect.php';
$db=new DB_Connect();
$conn=$db->connect();
$response=array();
if(isset($_GET['malichchieu'])){
	$resultG=mysqli_query($conn,"select soghe from phongchieu,lichchieu where phongchieu=maphong and malichchieu='$_GET[malichchieu]'");
	$soghe=mysqli_fetch_row($resultG)[0];
	$result=mysqli_query($conn,"select gia,tenphim,ngaychieu,DATE_FORMAT(batdau, '%H:%i') as batdau,DATE_FORMAT(ketthuc, '%H:%i') as ketthuc from lichchieu,giave,phim where malichchieu='$_GET[malichchieu]' and giave.magia=phim.loaive and lichchieu.phim=phim.maphim");
	$info=mysqli_fetch_row($result);
	$giave=$info[0];
	$tenphim=$info[1];
	$ngaychieu=$info[2];
	$batdau=$info[3];
	$ketthuc=$info[4];
	$sql="select ghengoi from chitiethoadon where lichchieu='$_GET[malichchieu]'";
	$result=mysqli_query($conn,$sql);
	$response['ghengois']=array();
	$ghengois=array();
	if($result){
		while($row=mysqli_fetch_array($result)){
			$ghengoi=array();
			$ghengoi['vitri']=(int)$row['ghengoi'];
			array_push($response['ghengois'],$ghengoi);
		}
		$response['status']=200;
		$response['message']='success';
		$response['soghe']=(int)$soghe;
		$response['giave']=(int)$giave;
		$response['phim']=$tenphim;
		$response['ngaychieu']=$ngaychieu;
		$response['thoigian']=$batdau."-".$ketthuc;
		echo json_encode($response);
	}
}else{
	$response['status']=201;
	$response['message']='Error';
	echo json_encode($response);
}
?>