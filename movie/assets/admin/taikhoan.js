function info(mataikhoan)
{
	var link="../admin/chitiettaikhoan.php?mataikhoan="+mataikhoan;
	window.location.href=link;
}
function bill(mataikhoan)
{
	var link="../admin/hoadon.php?mataikhoan="+mataikhoan;
	window.location.href=link;
}
function kick(mataikhoan){
	if(confirm('Bạn có muốn vô hiệu tài khoản này không?'))
	{
	$.ajax({
			url : "../controls/taikhoan.php",
			type : "post",
			dateType:"text",
			data : {
				kick:"kick",
				mataikhoan:mataikhoan,
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