function add()
{
	tenphong=$('#tenphong').val();
	soghe=$('#soghe').val();
	if(tenphong!="" && soghe > 0)
	{
		$.ajax({
			url: "../controls/phongchieu.php",
			type: "post",
			dateType: "text",
			data: {
				add:"add",
				tenphong:tenphong,
				soghe:soghe,
			},
			success: function(result){
				document.getElementById("alert-success-top").innerHTML = result;
				window.setTimeout(function(){location.reload()},500)
			}
		});
	}else{
			alert('Hãy nhập đầy đủ thông tin');
	}
}
function del(maphong)
{
	if(confirm('Bạn có muốn xóa không?'))
	{
	$.ajax({
			url : "../controls/phongchieu.php",
			type : "post",
			dateType:"text",
			data : {
				delete:"delete",
				maphong:maphong,
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