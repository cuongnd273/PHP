function add(id,count,soluongcon)
{
	if(soluongcon!=0)
	{
		if(count!=0)
		{
			count=1;
		}else{
			count=document.getElementById('soluong').value;
			if(count>soluongcon)count=soluongcon;
		}
		$.ajax({
			url: "/xedap/nguoidung/cart.php",
			type: "post",
			dateType: "json",
			data: {
				add:"add",
				id:id,
				count:count,
			},
			success: function(result){
				var obj=JSON.parse(result);
				if(obj.success==1)
				{
					alert('Thêm sản phẩm vào giỏ hàng thành công');
					location.reload(); 
				}
			}
		});
	}else{
		alert("Hiện tại sản phẩm đang hết hàng");
	}
}
function del(id)
{
	if(confirm('Bạn có xóa sản phẩm này không?'))
	{
	$.ajax({
		url: "/xedap/nguoidung/cart.php",
		type: "post",
		dateType: "json",
		data: {
			del:"delete",
			id:id,
		},
		success: function(result){
			var obj=JSON.parse(result);
			if(obj.success==1)
			{
				window.location="../xedap/cart.php";
			}
		}
	});
	}else{
		return;
	}
}
function delAll()
{
	if(confirm('Bạn có muốn xóa hết sản phẩm không?'))
	{
		$.ajax({
			url: "/xedap/nguoidung/cart.php",
			type: "post",
			dateType: "json",
			data: {
				delete_all:"delete_all",
			},
			success: function(result){
				var obj=JSON.parse(result);
				if(obj.success==1)
				{
					window.location="../xedap/cart.php";
				}
			}
		});
	}else{
		return;
	}
}
function update()
{
	var arraySoluong=[];
	var soluong=[];
	arraySoluong=document.getElementsByName('soluong');
	for(var i=0;i<arraySoluong.length;i++)
	{
		if(isNaN(arraySoluong[i].value) || arraySoluong[i].value=="")
		{
			soluong.push(1);
		}else if(arraySoluong[i].value<=0)
		{
			soluong.push(1);
		}else{
			soluong.push(arraySoluong[i].value);
		}
	}
	$.ajax({
		url: "/xedap/nguoidung/cart.php",
		type: "post",
		dateType: "json",
		data: {
			update:"update",
			soluong:soluong,
		},
		success: function(result){
			var obj=JSON.parse(result);
			if(obj.success==1)
			{
				window.location="../xedap/cart.php";
			}
		}
	});
}