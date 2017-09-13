function add()
{
	tennhom=$('#tennhom').val();
	if(tennhom!="")
	{
		$.ajax({
			url: "../quanly/nhomsanpham.php",
			type: "post",
			dateType: "json",
			data: {
				addNSP:"add",
				tennhom:tennhom,
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
function del(manhom)
{
	if(confirm('Bạn có muốn xóa không?'))
	{
	$.ajax({
			url : "../quanly/nhomsanpham.php",
			type : "post",
			dateType:"json",
			data : {
				deleteNSP:"delete",
				manhom:manhom,
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
function edit(manhom)
{
	var link="../admin/editnhomsanpham.php?manhom="+manhom;
	window.location.href=link;
}