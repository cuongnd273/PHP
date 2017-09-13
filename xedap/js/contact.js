function sendemail()
{
	var name       = document.getElementById('name').value; 
    var email      = document.getElementById('email').value; 
    var subject    = document.getElementById('subject').value; 
    var message    = document.getElementById('message').value; 
	if(name!="" && email!="" && message!="" &&subject!="")
	{
		$.ajax({
			url: "sendemail.php",
			type: "post",
			dateType: "json",
			data: {
				name:name,
				email:email,
				subject:subject,
				message:message,
			},
			success: function(result){
				//var obj=JSON.parse(result);
				alert("Cảm ơn sự góp ý của bạn.Chúng tôi sẽ hồi âm cho bạn sớm nhất.");
			}
		});
	}else{
		alert("Hãy nhập đầy đủ thông tin");
	}
}