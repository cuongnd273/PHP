function add()
{
	taikhoan=$('#mataikhoan').val();
	tenkh=$('#tenkhachhang').val();
	sdt=$('#sdt').val();
	diachi=$('#diachi').val();
	hinhthuc=$('#hinhthucthanhtoan').val();
	trangthai=$('#trangthai').val();
	if(tenkh!="" && sdt!="" && diachi!="")
	{
		$.ajax({
			url: "../quanly/hoadon.php",
			type: "post",
			dateType: "json",
			data: {
				addHD:"add",
				mataikhoan:taikhoan,
				tenkhachhang:tenkh,
				sdt:sdt,
				diachi:diachi,
				hinhthuc:hinhthuc,
				trangthai:trangthai,
			},
			success: function(result){
				var obj=JSON.parse(result);
				document.getElementById("alert-success-top").innerHTML = obj.message;
				window.setTimeout(function(){location.reload()},500)
			}
		});
	}else{
			alert('Hãy nhập đầy đủ thông tin');
	}
}
function del(mahoadon)
{
	if(confirm('Bạn có muốn xóa không?'))
	{
	$.ajax({
			url : "../quanly/hoadon.php",
			type : "post",
			dateType:"json",
			data : {
				deleteHD:"delete",
				mahoadon:mahoadon,
			},
			success : function (result){		
				var obj = JSON.parse(result);
				document.getElementById("alert-success-top").innerHTML = obj.message;
				window.setTimeout(function(){location.reload()},500)
			}
		});
	}else{
		return;
	}
}
function edit(maHD)
{
	var link="../admin/edithoadon.php?maHD="+maHD;
	window.location.href=link;
}
function info(maHD)
{
	var link="../admin/chitiethoadon.php?maHD="+maHD;
	window.location.href=link;
}