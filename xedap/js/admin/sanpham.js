function add()
{
	manhom=$('#manhom').val();
	loaisanpham=$('#loaisanpham').val();
	tensanpham=$('#tensanpham').val();
	gia=$('#gia').val();
	soluongcon=$('#soluongcon').val();
	mota=window.parent.tinymce.get('mota').getContent();
	thongsokythuat=window.parent.tinymce.get('thongsokythuat').getContent();
	khungxe=$('#khungxe').val();
	mausac=$('#mausac').val();
	giamsoc=$('#giamsoc').val();
	yenxe=$('#yenxe').val();
	vanhxe=$('#vanhxe').val();
	lopxe=$('#lopxe').val();
	phanhxe=$('#phanhxe').val();
	file=$('#file').val();
	if(tensanpham!="" && file!=null)
	{
		if(gia<0)gia=0;
		if(soluongcon<0)soluongcon=0;
		var m_data = new FormData(); 
		m_data.append('addSP',"add");
		m_data.append('manhom',manhom);
		m_data.append('tensanpham',tensanpham);
		m_data.append('gia',gia);
		m_data.append('loaisanpham',loaisanpham);
		m_data.append('soluongcon',soluongcon);
		m_data.append('mota',mota);
		m_data.append('khungxe',khungxe);
		m_data.append('mausac',mausac);
		m_data.append('giamxoc',giamxoc);
		m_data.append('yenxe',yenxe);
		m_data.append('vanhxe',vanhxe);
		m_data.append('lopxe',lopxe);
		m_data.append('phanhxe',phanhxe);
		m_data.append('thongsokythuat',thongsokythuat);
		m_data.append( 'file', $('input[name=file]')[0].files[0]);
		
		$.ajax({
			url: "../quanly/sanpham.php",
			type: "post",
			dateType: "json",
			data: m_data,
			processData: false,
			contentType: false,
			success: function(result){
				alert(result);
				// var obj=JSON.parse(result);
				// document.getElementById("alert-success-top").innerHTML = obj.message;
				// window.setTimeout(function(){location.reload()},500)
			}
		});
	}else{
			alert('Hãy nhập đầy đủ thông tin');
	}
}
function del(masp)
{
	if(confirm('Bạn có muốn xóa không?'))
	{
	$.ajax({
			url : "../quanly/sanpham.php",
			type : "post",
			dateType:"json",
			data : {
				deleteSP:"delete",
				masp:masp,
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
function edit(masp)
{
	var link="../admin/editsanpham.php?masp="+masp;
	window.location.href=link;
}