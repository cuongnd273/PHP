function them_phong(){
	if($('#tenphong').val()==""){
		alert("Hãy nhập tên phòng");
	}else{
		$.ajax({
		url : "quanly/phong.php",
		type : "post",
		dateType:"text",
		data : {
			 tenphong : $('#tenphong').val(),
			 them:"them",
		},
		success : function (result){
			$('#alert-success-top').html(result);
			window.setTimeout(function(){location.reload()},500);
		}
	});
	}
}
function xoa_phong(maphong){
	if(confirm("Bạn có muốn xóa không?")){
		$.ajax({
		url : "quanly/phong.php",
		type : "post",
		dateType:"text",
		data : {
			 maphong : maphong,
			 xoa:"xoa",
		},
		success : function (result){
			$('#alert-success-top').html(result);
			window.setTimeout(function(){location.reload()},500);
		}
		});
	}else{
		return;
	}
}
function thietbi(maphong)
{
	var link="thietbicuaphong.php?maphong="+maphong;
	window.location.href=link;
}
function hoadon_phong(maphong)
{
	var link="hoadoncuaphong.php?maphong="+maphong;
	window.location.href=link;
}
function thaydoi(maphong,trangthai){
	if(trangthai==1){
		if(confirm("Thanh toán luôn cho phòng này?")){
			$.ajax({
				url : "quanly/phong.php",
				type : "post",
				dateType:"text",
				data : {
					 maphong : maphong,
					 thaydoi:"thaydoi",
				},
				success : function (result){
					window.setTimeout(function(){location.reload()},500);
				}
			});
		}else{
			return;
		}
	}else{
		$.ajax({
				url : "quanly/phong.php",
				type : "post",
				dateType:"text",
				data : {
					 maphong : maphong,
					 thaydoi:"thaydoi",
				},
				success : function (result){
					window.setTimeout(function(){location.reload()},500);
				}
		});
	}
}