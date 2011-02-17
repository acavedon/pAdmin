function flashMe(id,src,width,height,wmode){
	document.write('<OBJECT name="'+id+'" id="'+id+'" codeBase="http://download.macromedia.com/pub/shockwave/cabs/flash/swflash.cab#version=6,0,0,0" height="'+height+'" width="'+width+'" classid="clsid:D27CDB6E-AE6D-11cf-96B8-444553540000" VIEWASTEXT>');
	document.write('<PARAM NAME="Movie" VALUE="'+src+'">');
	document.write('<PARAM NAME="WMode" VALUE="'+wmode+'">');
	document.write('<PARAM NAME="swLiveConnect" VALUE="true">');
	document.write('<EMBED name="'+id+'" id="'+id+'" src="'+src+'" quality="high" bgcolor="#FFFFFF" WIDTH="'+width+'" HEIGHT="'+height+'" TYPE="application/x-shockwave-flash" PLUGINSPAGE="http://www.macromedia.com/go/getflashplayer" wmode="'+wmode+'" swLiveConnect="true"></EMBED>');
	document.write('</OBJECT>');
}
perguntaSelecionada = "";
function mostraPergunta(qual){
	pergunta = document.getElementById(qual);
	if(perguntaSelecionada!=""){
		perguntaSelecionada.className = perguntaSelecionada.className.replace(" selecionado","");
	}
	pergunta.className += " selecionado";
	perguntaSelecionada = pergunta;
}
function mostraFoto(qual){
	aux = fotos[qual].split("\|");
	document.getElementById("preview").src = aux[0];
	document.getElementById("legenda").innerHTML = aux[1];
}
descricaoSelecionada = "";
tituloSelecionado = "";
function mostraDescricao(qual){
	descricao = document.getElementById(qual);
	titulo = document.getElementById("t"+qual)
	if(descricaoSelecionada!=""){
		descricaoSelecionada.className = "";
		tituloSelecionado.className = "";
	}
	descricao.className = "selecionado";
	titulo.className = "selecionado";
	descricaoSelecionada = descricao;
	tituloSelecionado = titulo;
}

function preview(qual,action){
	if(action=="on"){
		if(qual.className==""){
			qual.className = "selecionado";
		} else {
			qual.className = "primeiro selecionado";
		}
	} else {
		if(qual.className=="primeiro selecionado"){
			qual.className = "primeiro";
		} else {
			qual.className = "";
		}
	}
}
var itensSelecionados = Array();
function selecionaTodos(qual){
	qual = (qual==undefined || qual=='') ? "frm" : qual;
	itensSelecionados[qual] = (itensSelecionados[qual]==undefined) ? true : ((itensSelecionados[qual]==false) ? true : false);
	for(i=0;i<document.forms[qual].elements.length; i++){
		if (document.forms[qual].elements[i].type=="checkbox"){
			document.forms[qual].elements[i].checked = itensSelecionados[qual];
		}
	}
}
function lembrar_senha(qual){
	qual = (qual==undefined || qual=='') ? "frm" : qual;
	if(document.forms[qual].email.value!=""){
		document.forms[qual].acao.value = "esqueci";
		document.forms[qual].submit();
	} else {
		alert("Favor preencher o campo e-mail e clicar em \"esqueci minha senha\"");
	}
	
}