function add()
{
	khuyenmai=$('#khuyenmai').val();
	batdau=$('#batdau').val();
	ketthuc=$('#ketthuc').val();
	if(khuyenmai!="" && batdau!="" && ketthuc!="")
	{
		$.ajax({
			url: "../quanly/khuyenmaichung.php",
			type: "post",
			dateType: "json",
			data: {
				addKMC:"add",
				khuyenmai:khuyenmai,
				batdau:batdau,
				ketthuc:ketthuc,
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
function del(id)
{
	if(confirm('Bạn có muốn xóa không?'))
	{
	$.ajax({
			url : "../quanly/khuyenmaichung.php",
			type : "post",
			dateType:"json",
			data : {
				deleteKMC:"delete",
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