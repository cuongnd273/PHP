function them_chitiet(maphong){
	if($('#mathang').val()==""){
		alert("Hãy chọn sản phẩm thêm!!");
	}else{
		$.ajax({
			url : "quanly/chitiethoadon.php",
			type : "post",
			dateType:"text",
			data : {
				 maphong : maphong,
				 soluong:$('#soluong').val(),
				 mamathang:$('#mathang').val(),
				 them:"them",
			},
			success : function (result){
				$('#alert-success-top').html(result);
				window.setTimeout(function(){location.reload()},500);
			}
		});
	}
}