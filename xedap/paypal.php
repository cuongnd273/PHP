<!DOCTYPE html>
<html>
<head>
      <meta http-equiv="Content-Type" content="text/html;charset=UTF-8" />
	<title>Thanh toán qua Paypal</title>
</head>
<body>
	<?php
	session_start();
	$total_money=0;
	foreach($_SESSION['cart'] as $key=>$value)
	{
		$total_money=$value['money']+$total_money;
	}
	$total_money=$total_money*0.00004;
echo'	<fieldset>
			<legend>Thanh toán qua cổng PayPal</legend>
			<form action="https://www.sandbox.paypal.com/cgi-bin/webscr" method="post">

					<!-- Nhập địa chỉ email người nhận tiền (người bán) -->
					<input type="hidden" name="business" value="nguoimuademo@gmail.com">

					<!-- tham số cmd có giá trị _xclick chỉ rõ cho paypal biết là người dùng nhất nút thanh toán -->
					<input type="hidden" name="cmd" value="_xclick">

					<!-- Thông tin mua hàng. -->
					<input type="hidden" name="item_name" value="HoaDonMuaHang">
					<!--Trị giá của giỏ hàng, vì paypal không hỗ trợ tiền việt nên phải đổi ra tiền $-->
					<input type="hidden" name="amount"  value="'.$total_money.'">
					<!--Loại tiền-->
					<input type="hidden" name="currency_code" value="USD">
					<!--Đường link mình cung cấp cho Paypal biết để sau khi xử lí thành công nó sẽ chuyển về theo đường link này-->
					<input type="hidden" name="return" value="http://localhost/xedap/paypal_thanhcong.php">
					<!--Đường link mình cung cấp cho Paypal biết để nếu  xử lí KHÔNG thành công nó sẽ chuyển về theo đường link này-->
					<input type="hidden" name="cancel_return" value="http://localhost/xedap/paypal_loi.php">
					<!-- Nút bấm. -->
					<input type="image" name="submit" border="0"
					  src="https://www.paypalobjects.com/en_US/i/btn/btn_buynow_LG.gif"
					  alt="PayPal - The safer, easier way to pay online">
					  <img alt="" border="0" width="1" height="1"
					  src="https://www.paypalobjects.com/en_US/i/scr/pixel.gif" >
			</form>
		</fieldset>';
?>
</body>
</html>