function add(maphim)
{
	phongchieu=$('#phongchieu').val();
	ngaychieu=$('#ngaychieu').val();
	batdau=$('#batdau').val();
	if(batdau != "")
	{
		$.ajax({
			url: "../controls/lichchieu.php",
			type: "post",
			dateType: "text",
			data: {
				add:"add",
				phongchieu:phongchieu,
				maphim:maphim,
				ngaychieu:ngaychieu,
				batdau:batdau,
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