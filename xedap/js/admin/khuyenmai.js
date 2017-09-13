function add(id)
{
	if(thoigianbatdau!="" && thoigianketthuc!="")
	{
		if($("#loaikhuyenmai").val()=="")
		{
			alert("Hãy chọn loại khuyến mãi");
		}else{
			if($("#loaikhuyenmai").val()==0 && $("#giamgia").val()<=0)
			{
				alert("Nhập phần trăm giảm giá");
				return;
			}
			$.ajax({
			url: "../quanly/khuyenmai.php",
			type: "post",
			dateType: "json",
			data: {
				addKM:"add",
				loaikhuyenmai:$("#loaikhuyenmai").val(),
				thoigianbatdau:$("#thoigianbatdau").val(),
				thoigianketthuc:$("#thoigianketthuc").val(),
				sanpham:$("#sanpham").val(),
				giamgia:$("#giamgia").val(),
			},
			success: function(result){
				var obj=JSON.parse(result);
				document.getElementById("alert-success-top").innerHTML = obj.message;
				window.setTimeout(function(){location.reload()},500)
			}
		})
		}
	}else{
			alert('Hãy nhập đầy đủ thông tin');
	}
}
function del(id)
{
	if(confirm('Bạn có muốn xóa không?'))
	{
	$.ajax({
			url : "../quanly/khuyenmai.php",
			type : "post",
			dateType:"json",
			data : {
				deleteKM:"delete",
				id:id,
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
function addproduct(id)
{
	var link="../admin/chitietkhuyenmai.php?id="+id;
	window.location.href=link;
}