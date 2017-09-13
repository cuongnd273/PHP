<?php
require_once '../connect/db_connect.php';
session_start();
if(isset($_POST['thang']))
{
	$db=new DB_Connect();
	$conn=$db->connect();
	$thang=$_POST['thang'];
	$sql="select DISTINCT(DAY(ngaytao)) as ngay from hoadon where MONTH(ngaytao)='$thang'";
	$result=$conn->query($sql);
	$text=""."<option value=''>Tất cả các ngày</option>";
	while($row=mysqli_fetch_array($result))
	{
		$text=$text.'<option value="'.$row['ngay'].'">'.$row['ngay'].'</option>';
	}
	echo $text;
}
?>