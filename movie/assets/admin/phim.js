function add()
{
	tenphim=$('#tenphim').val();
	ngaybatdau=$('#ngaybatdau').val();
	ngayketthuc=$('#ngayketthuc').val();
	daodien=$('#daodien').val();
	dienvien=$('#dienvien').val();
	thoiluong=$('#thoiluong').val();
	tomtat=$('#tomtat').val();
	loaive=$('#loaive').val();
	file=$('#anh').val();
	if(tenphim != "" && daodien != "" && dienvien != "" && thoiluong != "" && tomtat != "" && file!=null)
	{
		var m_data = new FormData(); 
		m_data.append('add',"add");
		m_data.append('tenphim',tenphim);
		m_data.append('ngaybatdau',ngaybatdau);
		m_data.append('ngayketthuc',ngayketthuc);
		m_data.append('daodien',dienvien);
		m_data.append('dienvien',dienvien);
		m_data.append('thoiluong',tenphim);
		m_data.append('tomtat',tomtat);
		m_data.append('loaive',loaive);
		m_data.append( 'file', $('input[name=anh]')[0].files[0]);
		
		$.ajax({
			url: "../controls/phim.php",
			type: "post",
			dateType: "text",
			data: m_data,
			processData: false,
			contentType: false,
			success: function(result){
				document.getElementById("alert-success-top").innerHTML = result;
				window.setTimeout(function(){location.reload()},500)
			}
		});
	}else{
			alert('Hãy nhập đầy đủ thông tin');
	}
}
function del(maphim)
{
	if(confirm('Bạn có muốn xóa không?'))
	{
	$.ajax({
			url : "../controls/phim.php",
			type : "post",
			dateType:"text",
			data : {
				delete:"delete",
				maphim:maphim,
			},
			success : function (result){		
				document.getElementById("alert-success-top").innerHTML = result;
				window.setTimeout(function(){location.reload()},500)
			}
		});
	}else{
		return;
	}
}
function edit(maphim)
{
	var link="../admin/suaphim.php?maphim="+maphim;
	window.location.href=link;
}
function calendar(maphim)
{
	var link="../admin/lichchieu.php?maphim="+maphim;
	window.location.href=link;
}