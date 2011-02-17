function createRequestObject()
{
    var xmlHttp;
    try
    {
       // Firefox, Opera 8.0+, Safari
       xmlHttp=new XMLHttpRequest();
    }
    catch (e)
    {
        // Internet Explorer
        try
        {
            xmlHttp=new ActiveXObject("Msxml2.XMLHTTP");
        }
        catch (e)
        {
            xmlHttp=new ActiveXObject("Microsoft.XMLHTTP");
        }
    }
    return xmlHttp;


}

function adicionaServidor(obj) 
{
	var newArray = new Array();
	var numeroElementos;
	var valorAtual;
	var divId;

	divId = document.getElementById('servidores');

	// html do campo
	html = "<table border='0' style='margin-left:5px;' id='tableServidores'><tr><td width='100' valign='top'>Local:</td><td><input type='text' name='local[]' style='width:200px;' value='' maxlength='255'></td></tr><tr><td width='100' valign='top'>IP:</td><td><input type='text' name='ip[]' style='width:90px;' value='' maxlength='255'></td></tr><tr><td width='100' valign='top'>Netmask:</td><td><input type='text' name='netmask[]' style='width:90px;' value='' maxlength='255'></td></tr><tr><td width='100' valign='top'>Gateway:</td><td><input type='text' name='gateway[]' style='width:90px;' value='' maxlength='255'></td></tr><tr><td width='100' valign='top'>Hostname:</td><td><input type='text' name='hostname[]' style='width:200px;' value='' maxlength='255'></td></tr></table>";
	
	espacamento = "<br /><br />";
	divId.innerHTML += espacamento + html;
}

function mostrarEsconder(obj1,obj2)
{
	if(document.getElementById(obj1).style.display=="none")
	{
		document.getElementById(obj1).style.display = "block";
		//document.getElementById(obj2).style.display = "block";
	}
	else
	{
		document.getElementById(obj1).style.display = "none";
		document.getElementById(obj2).style.display = "none";
	}
}

function downVolume(){
	var obj=document.getElementById("vol");
	var vol = parseInt(obj.innerHTML);
	var mute = document.getElementById("mute").alt;

	if(vol>=5)
		 vol-=5;
	else vol=0;

	req = createRequestObject();
	req.open('get', 'volume.php?vol='+vol+'&mute='+mute+'&canal=6');
	req.onreadystatechange = function()
	{
		if(req.readyState == 4)
		{
			var resp = req.responseText;
		}
	}
	req.send(null);

	if(vol.toString().length < 2) 
        //obj.innerHTML = "0" + vol.toString()+"%"; 
        obj.innerHTML = vol.toString()+"%"; 
	else 
        obj.innerHTML = vol.toString()+"%"; 

    // ativa o box de aguarde e trava o clique
    //boxAguarde();
}

