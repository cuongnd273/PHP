function them_mathang(){
	if($('#mathang').val()=="" || $('#gia').val()==""){
		alert("Hãy nhập đầy đủ thông tin!!");
	}else{
		$.ajax({
			url:"quanly/mathang.php",
			type:"post",
			dateType:"text",
			data:{
				mathang:$('#mathang').val(),
				gia:$('#gia').val(),
				them:"them",
			},
			success:function(result){
				$('#alert-success-top').html(result);
				window.setTimeout(function(){location.reload()},500);
			}
		});
	}
}
function xoa_mathang(mamathang){
	if(confirm("Bạn có muốn xóa không?")){
		$.ajax({
			url:"quanly/mathang.php",
			type:"post",
			dateType:"text",
			data:{
				mamathang:mamathang,
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
function sua(mamathang)
{
	var link="suamathang.php?mamathang="+mamathang;
	window.location.href=link;
}