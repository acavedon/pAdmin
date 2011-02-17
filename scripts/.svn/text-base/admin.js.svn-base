function ordenar(criterio,form){
	form = (form==undefined || form=='') ? "frm" : form;
	if(document.forms[form].ordem.value==criterio){
		if(document.forms[form].sequencia.value=="asc"){
			document.forms[form].sequencia.value="desc";
		} else {
			document.forms[form].sequencia.value="asc";
		}
	} else {
		document.forms[form].ordem.value=criterio;
	}
	document.forms[form].submit();
}
function executar(oque,qual,onde,confirma,form){
	form = (form==undefined || form=='') ? "frm" : form;
	
    if(confirma!="" && confirma!=undefined){
		if(confirm(confirma)){
			if (onde!="" && onde!=undefined){
				document.forms[form].action = onde;		
			}
			document.forms[form].hideaction.value=oque;
			document.forms[form].cod.value=qual;
			document.forms[form].submit();
		}
	} else {
		if (onde!="" && onde!=undefined){
			document.frm.action = onde;		
		}

		document.forms[form].hideaction.value=oque;
		document.forms[form].cod.value=qual;
		document.forms[form].submit();
	}
}
function limita(quantos,qual){
	if(qual.value.length > quantos){
		qual.value = qual.value.substr(0,quantos);
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
