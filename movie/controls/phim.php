<?php
include '../connect/db_connect.php';
$db=new DB_Connect();
$conn=$db->connect();
if(isset($_POST['add'])){
	move_uploaded_file($_FILES['file']['tmp_name'], '../images/'.$_FILES['file']['name']);
	$anh =$_FILES['file']['name'];
	$sql="Insert into phim(tenphim,ngaybatdau,ngayketthuc,daodien,dienvien,thoiluong,anh,tomtat,loaive) values('$_POST[tenphim]','$_POST[ngaybatdau]','$_POST[ngayketthuc]','$_POST[daodien]','$_POST[dienvien]','$_POST[thoiluong]','$anh','$_POST[tomtat]','$_POST[loaive]')";
	$result=mysqli_query($conn,$sql);
	if($result){
		echo "Thêm thành công";
	}else
	 	echo "Thêm thất bại";
}else if(isset($_POST['delete'])){
	$result=mysqli_query($conn,"Update phim set isDelete=true where maphim='$_POST[maphim]'");
	if($result){
		echo "Xóa thành công";
	}else
	 	echo "Xóa thất bại";
}
?>