function add(id)
{
	$.ajax({
		url: "../quanly/chitietkhuyenmai.php",
		type: "post",
		dateType: "json",
		data: {
			addCTKM:"add",
			makhuyenmai:id,
			manhom:$("#manhom").val(),
		},
		success: function(result){
			var obj=JSON.parse(result);
			document.getElementById("alert-success-top").innerHTML = obj.message;
			window.setTimeout(function(){location.reload()},500)
		}
	})
}
function del(khuyenmai,manhom)
{
	if(confirm('Bạn có muốn xóa không?'))
	{
	$.ajax({
			url : "../quanly/chitietkhuyenmai.php",
			type : "post",
			dateType:"json",
			data : {
				deleteCTKM:"delete",
				makhuyenmai:khuyenmai,
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