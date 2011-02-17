function getHTTPObject() {
	var xmlhttp;
	/*@cc_on
	@if (@_jscript_version >= 5)
	try {
	  xmlhttp = new ActiveXObject("Msxml2.XMLHTTP");
	} catch (e) {
	  try {
		xmlhttp = new ActiveXObject("Microsoft.XMLHTTP");
	  } catch (E) {
		xmlhttp = false;
	  }
	}
	@else
	xmlhttp = false;
	@end @*/
	if (!xmlhttp && typeof XMLHttpRequest != 'undefined'){
		try {
			xmlhttp = new XMLHttpRequest();
		} catch (e) {
			xmlhttp = false;
		}//try - catch
	}
	return xmlhttp;
}//getHTTPObject
var http = getHTTPObject();
var div = "";
function obterPagina(_url,_div,_action){ 
	var rnd = (_url.indexOf("?")!=-1) ? "&rnd=" : "?rnd="
	_url = _url + rnd + Math.random();
	div = document.getElementById(_div);
	try{
		http.open("GET", _url, true);
		http.onreadystatechange = function(){
			handleHttpResponse(_action);
		};
		http.send(null);
	}
	catch(e){
		div.innerHTML = '<br/><div style="text-align: center; width: 100%; border: 1px solid red; font-size: 16px; margin: 48% 20px; color:#CC0000"><b>Página não encontrada!</b></div>';
	}

}
function handleHttpResponse(_action) {
	if (http.readyState == 4) {
		div.innerHTML = http.responseText;
		eval(_action);
	}
}




