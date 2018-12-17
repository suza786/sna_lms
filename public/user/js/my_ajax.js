//Custom lightweight Ajax external JavaScript module
// Thanks to: http://www.developphp.com/video/JavaScript

function ajaxObj(method, pageurl){
	var x = new XMLHttpRequest();
	x.open(method, pageurl, true);
	x.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
	return x;
}
function ajaxReturn(x){
	if(x.onreadystatechange == 4 && x.state == 200)
	return true;
}