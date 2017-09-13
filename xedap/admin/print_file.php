<?php
include '../lib/PHPExcel_1.8.0_doc/Classes/PHPExcel.php';
include '../connect/db_connect.php';
if( isset($_POST['thang'])){
	$objPHPExcel = new PHPExcel();
	$thang=$_POST['thang'];
	$ngay=$_POST['ngay'];
	if($ngay=="0")
	{
		$db=new DB_Connect();
		$conn=$db->connect();
		$sql="SELECT sanpham,sum(soluong) as soluong,sum(gia*soluong) as thanhtien FROM `chitiethoadon` where mahoadon in(select mahoadon from hoadon where MONTH(ngaytao)='$_POST[thang]') group by sanpham";
		$result=$conn->query($sql);
		$objPHPExcel->setActiveSheetIndex(0)
		->setCellValue('A1', 'Sản phẩm')
		->setCellValue('B1', 'Số lượng')
		->setCellValue('C1', 'Thành tiền');
		$i = 2;
		$tongtien=0;
		$tongsoluong=0;
		while($row=mysqli_fetch_array($result))
		{
			$tongsoluong=$tongsoluong+$row['soluong'];
			$tongtien=$tongtien+$row['thanhtien'];
			$objPHPExcel->setActiveSheetIndex(0)
			->setCellValue('A'.$i, $row['sanpham'])
			->setCellValue('B'.$i, $row['soluong'])
			->setCellValue('C'.$i, number_format($row['thanhtien']));
			$i++;
		}		
		$objPHPExcel->setActiveSheetIndex(0)
		->setCellValue('A'.$i, 'Tổng cộng:')
		->setCellValue('B'.$i, $tongsoluong)
		->setCellValue('C'.$i, number_format($tongtien));
		
		$objWriter = PHPExcel_IOFactory::createWriter($objPHPExcel, 'Excel2007');
		$full_path = '../file/Thongkethang'.$thang.'.xlsx';
		$objWriter->save($full_path);
		echo "Thành công";
	}else{
		$db=new DB_Connect();
		$conn=$db->connect();
		$sql="SELECT sanpham,sum(soluong) as soluong,sum(gia*soluong) as thanhtien FROM `chitiethoadon` where mahoadon in(select mahoadon from hoadon where MONTH(ngaytao)='$_POST[thang]' and DAY(ngaytao)='$_POST[ngay]') group by sanpham";
		$result=$conn->query($sql);
		$objPHPExcel->setActiveSheetIndex(0)
		->setCellValue('A1', 'Sản phẩm')
		->setCellValue('B1', 'Số lượng')
		->setCellValue('C1', 'Thành tiền');
		$i = 2;
		$tongtien=0;
		$tongsoluong=0;
		while($row=mysqli_fetch_array($result))
		{
			$tongsoluong=$tongsoluong+$row['soluong'];
			$tongtien=$tongtien+$row['thanhtien'];
			$objPHPExcel->setActiveSheetIndex(0)
			->setCellValue('A'.$i, $row['sanpham'])
			->setCellValue('B'.$i, $row['soluong'])
			->setCellValue('C'.$i, number_format($row['thanhtien']));
			$i++;
		}	
		$objPHPExcel->setActiveSheetIndex(0)
		->setCellValue('A'.$i, 'Tổng cộng:')
		->setCellValue('B'.$i, $tongsoluong)
		->setCellValue('C'.$i, number_format($tongtien));
		
		$objWriter = PHPExcel_IOFactory::createWriter($objPHPExcel, 'Excel2007');
		$full_path = '../file/Thongke'.$ngay.'.'.$thang.'.xlsx';
		$objWriter->save($full_path);
		echo "Thành công";
	}
}
?>