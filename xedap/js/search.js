function checkURL()
{
	var search=document.getElementById("search").value;
	if(location.pathname=="/xedap/shop.php")
	{
		var id = getUrlVars()["id"];
		var link="/xedap/shop.php?id="+id+"&search="+search;
		window.location.href=link;
	}else{
		var link="/xedap/index.php?search="+search;
		window.location.href=link;
	}
}
function search()
{
	var priceFrom = $('#sl2').data('slider').getValue()[0];
	var priceTo=$('#sl2').data('slider').getValue()[1];
	if(location.pathname=="/xedap/shop.php")
	{
		var id = getUrlVars()["id"];
		var link="/xedap/shop.php?id="+id+"&from="+priceFrom+"&to="+priceTo;
		window.location.href=link;
	}else{
		var link="/xedap/index.php?from="+priceFrom+"&to="+priceTo;
		window.location.href=link;
	}
}
function getUrlVars() {
var vars = {};
var parts = window.location.href.replace(/[?&]+([^=&]+)=([^&]*)/gi, function(m,key,value) {
vars[key] = value;
});
return vars;
}