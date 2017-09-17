<?php
include '../connect/db_connect.php';
$db=new DB_Connect();
$conn=$db->connect();
if(isset($_POST['add'])){
	$phim=mysqli_fetch_array(mysqli_query($conn,"select thoiluong from phim where maphim='$_POST[maphim]'"));
	$thoiluong=$phim['thoiluong'];
	$batdau=$_POST['batdau'];
	$ketthuc = date('H:i', strtotime($batdau.'+'.$thoiluong.' minute'));
	$sql="select * from lichchieu where phongchieu='$_POST[phongchieu]' and ngaychieu='$_POST[ngaychieu]' and ((batdau < '$batdau' and ketthuc > '$batdau') or (batdau > '$batdau' and ketthuc < '$ketthuc') or (batdau < '$ketthuc' and ketthuc > '$ketthuc'))";
	$result=mysqli_query($conn,$sql);
	$count=mysqli_num_rows($result);
	if($count >0){
		echo "Lịch chiếu bị trùng thời gian chiếu";
	}else{
		$sql="Insert into lichchieu(phongchieu,ngaychieu,phim,batdau,ketthuc) values('$_POST[phongchieu]','$_POST[ngaychieu]','$_POST[maphim]','$batdau','$ketthuc')";
		$result=mysqli_query($conn,$sql);
		if($result)
			echo "Thêm thành công";
		else
		 	echo "Thêm thất bại";
	}
}
	
?>