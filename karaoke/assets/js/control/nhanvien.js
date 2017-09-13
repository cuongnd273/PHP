function them_nhanvien(){
	if($('#taikhoan').val()=="" || $('#matkhau').val()=="" || $('#hoten').val()=="" || $('#sdt').val()=="" || $('#diachi').val()=="" || $('#luong').val()=="")
	{
		alert("Hãy nhập đầy đủ thông tin!!");
	}else{
		$.ajax({
			url:"quanly/nhanvien.php",
			type:"post",
			dateType:"text",
			data:{
				taikhoan:$('#taikhoan').val(),
				matkhau:$('#matkhau').val(),
				hoten:$('#hoten').val(),
				sdt:$('#sdt').val(),
				diachi:$('#diachi').val(),
				cmnd:$('#cmnd').val(),
				luong:$('#luong').val(),
				them:"them",
			},
			success:function(result){
				$('#alert-success-top').html(result);
				window.setTimeout(function(){location.reload()},500);
			}
		});
	}
}
function xoa_nhanvien(manhanvien){
	if(confirm("Bạn có muốn xóa không?")){
		$.ajax({
			url:"quanly/nhanvien.php",
			type:"post",
			dateType:"text",
			data:{
				manhanvien:manhanvien,
				xoa:"xoa",
			},
			success:function(result){
				$('#alert-success-top').html(result);
				window.setTimeout(function(){location.reload()},500);
			}
		});
	}else{
		return;
	}
}