function add(maHD)
{
	sanpham=$('#sanpham').val();
	soluong=$('#soluong').val();
	if(parseInt(soluong)>0)
	{
		$.ajax({
			url: "../quanly/chitiethoadon.php",
			type: "post",
			dateType: "json",
			data: {
				addCTHD:"add",
				mahoadon:maHD,
				sanpham:sanpham,
				soluong:soluong,
			},
			success: function(result){
				var obj=JSON.parse(result);
				document.getElementById("alert-success-top").innerHTML = obj.message;
				window.setTimeout(function(){location.reload()},500)
			}
		});
	}else{
			alert('Hãy nhập đúng số lượng');
	}
}
function del(machitiet)
{
	if(confirm('Bạn có muốn xóa không?'))
	{
	$.ajax({
			url : "../quanly/chitiethoadon.php",
			type : "post",
			dateType:"json",
			data : {
				deleteCTHD:"delete",
				machitiet:machitiet,
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
function edit(machitiet)
{
	var link="../admin/editchitiethoadon.php?maCT="+machitiet;
	window.location.href=link;
}