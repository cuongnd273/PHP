function add()
{
	ma=$('#ma').val();
	giamgia=$('#giamgia').val();
	ngayhethan=$('#ngayhethan').val();
	soluong=$('#soluong').val();
	if(ma!="" && giamgia > 0 && soluong >0)
	{
		$.ajax({
			url: "../controls/phieugiamgia.php",
			type: "post",
			dateType: "text",
			data: {
				add:"add",
				ma:ma,
				giamgia:giamgia,
				ngayhethan:ngayhethan,
				soluong:soluong,
			},
			success: function(result){
				document.getElementById("alert-success-top").innerHTML = result;
				window.setTimeout(function(){location.reload()},500)
			}
		});
	}else{
			alert('Hãy nhập đầy đủ thông tin');
	}
}