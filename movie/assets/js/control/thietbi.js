function them_thietbi(){
	if($('#thietbi').val()==""){
		alert("Hãy nhập thông tin!!");
	}else{
		$.ajax({
			url:"quanly/thietbi.php",
			type:"post",
			dateType:"text",
			data:{
				tenthietbi:$('#thietbi').val(),
				them:"them",
			},
			success:function(result){
				$('#alert-success-top').html(result);
				window.setTimeout(function(){location.reload()},500);
			}
		});
	}
}
function xoa_thietbi(mathietbi){
	if(confirm("Bạn có muốn xóa không?")){
		$.ajax({
			url:"quanly/thietbi.php",
			type:"post",
			dateType:"text",
			data:{
				mathietbi:mathietbi,
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
function them_thietbiphong(maphong){
	if($('#thietbi').val()=="" || $('#tinhtrang').val()==""){
		alert("Hãy nhập thông tin!!");
	}else{
		$.ajax({
			url:"quanly/thietbi.php",
			type:"post",
			dateType:"text",
			data:{
				thietbi:$('#thietbi').val(),
				soluong:$('#soluong').val(),
				tinhtrang:$('#tinhtrang').val(),
				maphong:maphong,
				them_p:"them",
			},
			success:function(result){
				$('#alert-success-top').html(result);
				window.setTimeout(function(){location.reload()},500);
			}
		});
	}
}
function xoa_thietbiphong(id){
	if(confirm("Bạn có muốn xóa không?")){
		$.ajax({
			url:"quanly/thietbi.php",
			type:"post",
			dateType:"text",
			data:{
				id:id,
				xoa_p:"xoa",
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
function sua_thietbi(id)
{
	var link="suathietbi.php?id="+id;
	window.location.href=link;
}