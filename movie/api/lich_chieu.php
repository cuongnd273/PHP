<?php
include_once '../connect/db_connect.php';
if(isset($_GET['maphim'])){
	$db=new DB_Connect();
	$conn=$db->connect();
	$sql="select ngaychieu from lichchieu where phim=$_GET[maphim] and ngaychieu > NOW() group by ngaychieu";
	$result=mysqli_query($conn,$sql);
	$response=array();
	if($result){
		$lichchieus=array();
		while($row=mysqli_fetch_array($result)){
			$ngaychieu=$row['ngaychieu'];
			$sql="select malichchieu,ngaychieu,DATE_FORMAT(batdau, '%H:%i') as 'batdau',DATE_FORMAT(ketthuc, '%H:%i') as 'ketthuc',tenphong from lichchieu,phongchieu where ngaychieu='$ngaychieu' and phim='$_GET[maphim]' and lichchieu.phongchieu=phongchieu.maphong";
			$resultTime=mysqli_query($conn,$sql);
			if($resultTime){
				$thoigians=array();
				while($rowTime=mysqli_fetch_array($resultTime)){
					$thoigian=array();
					$thoigian['malichchieu']=$rowTime['malichchieu'];
					$thoigian['ngaychieu']=$rowTime['ngaychieu'];
					$thoigian['batdau']=$rowTime['batdau'];
					$thoigian['ketthuc']=$rowTime['ketthuc'];
					$thoigian['phongchieu']=$rowTime['tenphong'];
					array_push($thoigians,$thoigian);
				}
				array_push($lichchieus,$thoigians);
			}
		}
		$response['status']=200;
		$response['message']='Success';
		$response['lichchieu']=$lichchieus;
		echo json_encode($response);
	}else{
		$response['status']=201;
		$response['message']='Error film id';
		echo json_encode($response);
	}
}else
?>