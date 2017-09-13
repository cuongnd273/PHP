function thanhtoan(mahoadon)
{
	if(confirm('Bạn có muốn thanh toán không?'))
	{
	$.ajax({
			url : "../controls/hoadon.php",
			type : "post",
			dateType:"text",
			data : {
				edit:"edit",
				mahoadon:mahoadon,
			},
			success : function (result){		
				document.getElementById("alert-success-top").innerHTML = result;
				window.setTimeout(function(){location.reload()},500)
			}
		});
	}else{
		return;
	}
}