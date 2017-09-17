<?php
include_once '../connect/db_connect.php';
if(isset($_POST['mataikhoan'])){
	$db=new DB_Connect();
	$conn=$db->connect();
	$sql="Insert into hoadon(taikhoan,ngaytao) values('$_POST[mataikhoan]',CURRENT_TIMESTAMP())";
	$result=mysqli_query($conn,$sql);
	if($result){
		$result=mysqli_query($conn,"select mahoadon from hoadon where taikhoan='$_POST[mataikhoan]' order by ngaytao desc limit 1");
		$mahoadon=mysqli_fetch_row($result)[0];
		$ghes=json_decode($_POST['ghes']);
		$tongtien=count($ghes)*$_POST['giave']-(count($ghes)*$_POST['giave']*$_POST['giamgia'])/100;
		mysqli_query($conn,"Update hoadon set tongtien=$tongtien,giamgia='$_POST[giamgia]' where mahoadon=$mahoadon");
		foreach($ghes as $item){
			$sql="Insert into chitiethoadon(mahoadon,lichchieu,ghengoi,giave) values('$mahoadon','$_POST[malichchieu]','$item','$_POST[giave]')";
			mysqli_query($conn,$sql);
		}
		$response['status']=200;
		$response['message']='Success';
		echo json_encode($response);
	}else{
		$response['status']=201;
		$response['message']='Error insert';
		echo json_encode($response);
	}
}else{
	$response['status']=201;
	$response['message']='Error not found taikhoan';
	echo json_encode($response);
}
?>