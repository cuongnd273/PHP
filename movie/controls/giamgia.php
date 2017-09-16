<?php
include_once '../connect/db_connect.php';
if(isset($_POST['magiamgia'])){
	$db=new DB_Connect();
	$conn=$db->connect();
	$sql="select soluong,giamgia from phieugiamgia where ngayhethan >= NOW() and ma='$_POST[magiamgia]'";
	$result=mysqli_query($conn,$sql);
	if(mysqli_num_rows($result)>0){
		$row=mysqli_fetch_row($result);
		$soluong=$row[0];
		$giamgia=$row[1];
		if($soluong>0){
			mysqli_query($conn,"Update phieugiamgia set soluong=soluong-1 where ma='$_POST[magiamgia]'");
			$response['message']='Success';
			$response['status']=200;
			$response['giamgia']=$giamgia;
			echo json_encode($response);
		}else{
			$response['message']='Error';
			$response['status']=202;
			echo json_encode($response);
		}
	}else{
		$response['message']='Error';
		$response['status']=201;
		echo json_encode($response);
	}
}
?>