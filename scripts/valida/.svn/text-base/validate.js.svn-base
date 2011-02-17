/* 
#  $Id: validate.js,v 1.44 2003-01-30 13:53:21-02 b918145 Beta $
*/
var objBrow,LAST_ERR_VALUE="",errorCode=0;
var ERRO=REPET_ERR=false;
var LAST_FIELD=CURRENT_FIELD=LAST_ERR_FIELD=null;
var SZ_DATE=8,
SZ_CEP=8,
SZ_ACCOUNT=7,
SZ_AG_ACCOUNT=11,
SZ_AG_SAVINGS=SZ_AG_ACCOUNT, 
SZ_MONEY=10,
SZ_FLOAT=10,
SZ_CPF=11,
SZ_CNPJ=14,
SZ_CPF_CNPJ=SZ_CNPJ,
SZ_PERCENT=6,
SZ_BRANCH=4,
SZ_MONTH_YEAR=6,
SZ_TIME=4,
MAX_VALUE=9999999.99;
function formatCamp(campo,tp,par1,par2,par3){
var ie=(brow().isIE()&&!brow().isMac()),v=brow().getVersion();
var b=parent.buttons;
if(ie&&(v>=5 && v<5.2)&&b&&b.myBarra&&b.myBarra.clicked==true){
	parent.buttons.myBarra.clicked=false;
	eval("try{campo.focus();}catch(e){}");
	return false;
}
var nArg=formatCamp.arguments.length;
ERRO=false;
var vr=trim(campo.value);
if(!campo|| !vr ||vr.length==0){
	if(/^(neg_)?(money|money2)$/.test(tp))campo.value="0,00";
	return false;
}
if(nArg==2)par1="";
if(tp=="interval"){
	if(nArg<=4)par3="";
	return formatType(campo,tp,par3,par1,par2);
}else return formatType(campo,tp,par1);
}
function formatType(f,tp,msgErr,adarg1,adarg2){
if(tp=="none"){f.value=removeSpcChars(f.value);return true;}
var vr=unformatField(f.value,tp,f.type);
LAST_FIELD=f;
var ret=isValidValue(vr,tp,adarg1,adarg2);
if(!ret){showError(tp,msgErr);return false;}
else if(!_isRE(tp))f.value=getFmtValue((typeof ret=="boolean")?vr:ret,tp);
ERRO=false;
return true;
}
function removeSpcChars(vr,type){
var ret="",re=/197|198|208|215|216|222|223|229|230|240|247|248/,c=0,s=String(vr);
for(var i=0;i<s.length;i++){
	c=s.charCodeAt(i);
	if((c>31&&c<253&&(c<127||c>191)&&!re.test(c))||(type=="textarea"&& (c==9||c==13||c==10)))ret+=s.charAt(i);
}
return ret;
}
function validaConteudo(event,el,tp){
var t=(typeof event.which!="undefined"&& event.which!=null?event.which:event.keyCode),key;
if(tp=='none' || t<20)return true;
key=removeSpcChars(String.fromCharCode(t),el.type);
if(key=="")return false;
var tp_sp=/^sp_/.test(tp);
if(_isRE(tp))return tp.test(key);
else if(/^(percent|(neg_)?(numeric|float(\d{0,1})|money(\d{0,1})))$/.test(tp)){
	return isNumeric(key)||(!/numeric/.test(tp)&&key==","&&el.value.indexOf(",")==-1)||(/^neg_/.test(tp)&&key=="-" && el.value.indexOf("-")==-1);
}else if(/^(sp_)?alfanumeric$/.test(tp))
	return isAlfaNumeric(key)||(tp_sp && key==" ");
else if(/^(sp_)?textnumber$/.test(tp))
	return isTextNumber(key)||(tp_sp && key==" ");
else{
	switch(tp){
	case "email":return true;
	case "uppercase":return true;
	case "text": case "full_name":return isAlfa(key)|| /[-," ",.]/.test(key);
	case "text_entry":return isTextNumber(key)||/[\.\-\/\,=]|\s/.test(key);
	case "num":return isNumeric(key);
	case "valor":return isNumeric(key)|| /[,]/.test(key);
	case "default":return !/'|"/.test(key);	
	default:return isNumeric(key);
	}
}
}
function _getNDec(t){
	var arr=t.match(/(\d+)\s*$/);
	return arr?parseInt(arr[1],10):2;
}
function unformatField(valor,tipo,inputType){
var t=(arguments.length<1)?"default":String(tipo),
vr=trim(removeSpcChars((typeof valor=="object"?valor.value:valor),(inputType?inputType:valor.type)));
if(!vr||vr.length==0)return "";
if(/^(date|month_year|time|ag_account|ag_savings|branch|account|cep|(neg_)?numeric|interval)$/.test(t))
	vr=(/^neg_/.test(t)&&vr.indexOf("-")==0?"-":"")+justNumbersStr(vr);
else if(/^(percent|(neg_)?(float(\d{0,1})|money(\d{0,1})))$/.test(t))vr=toFloat(vr,_getNDec(t));
else{
	if(/^(cpf|cnpj|cpf_cnpj)$/.test(t)){
		vr=justNumbersStr(vr);
		var isCPF=tipo=="cpf"||(tipo=="cpf_cnpj" && vr.length<=SZ_CPF);
		vr=repeatStr(vr,"0",isCPF?SZ_CPF:SZ_CNPJ);
		if(parseInt(vr,10)==0)vr="";
	}else if(t=="email")vr=trim(vr)
}
if(typeof valor=="object")valor.value=vr;
return vr;
}
function removeCaracs(f,type){
if(_isRE(type))return;
var vr=unformatField(f.value,type,f.type);
if(f.value!=vr)f.value=vr;
focusNetscape(f);
}
function _isRE(re){return typeof re=="object" && typeof re.test=="function";}
function isValidValue(vr,tp,adarg1,adarg2){
var re,isNum=isNumeric(vr);
if(_isRE(tp))return tp.test(vr);
else if(/^(ag_account|ag_savings|account|branch|cep)$/.test(tp))
	return isNum && vr.length==eval("SZ_"+tp.toUpperCase());
else if(/^(percent|(neg_)?(float(\d{0,1})|money(\d{0,1})))$/.test(tp))
	return (!/^neg_/.test(tp)&&vr.indexOf("-")!=-1?false:isFloatNumber(vr));
else if(/textnumber$/.test(tp))
	return isTextNumber((tp.indexOf("sp_")==0)?removeStr(vr," "):vr);
else if(/text_entry$/.test(tp))
	return isTextNumber(vr.replace(/[\.\-\/\,=]|\s/g,""));
else if(/alfanumeric$/.test(tp))
	return isAlfaNumeric((tp.indexOf("sp_")==0)?removeStr(vr," "):vr);
else{
	switch(tp){
	case "time":
		switch(vr.length){
		case 1:vr="0"+vr+"00";break;
		case 2:vr+="00";break;
		case 3:vr="0"+vr+"0";break;
		}
		vr=repeatStr(vr,"0",4,"right");
		return(isNum && /^([0-1]\d[0-5]\d)|(2[0-3][0-5]\d)$/.test(vr))?vr:null;
	case "date":var obj=new DateValidation(vr);return (isNum && obj.isDate())?obj:null;
	case "month_year":var obj=new DateValidation("01"+vr);return (isNum && obj.isDate())?obj:null;
	case "text":return isAlfa(vr.replace(/[ ]/g,""));
	case "full_name":return isFullName(vr);
	case "email":return isEmail(vr);
    case "cep":return isCEP(vr);
    case "cpf":return isCPF(vr);
	case "cnpj":return isCNPJ(vr);
	case "cpf_cnpj":return (vr.length <=SZ_CPF)?isCPF(vr):isCNPJ(vr);
	case "interval":vr=parseInt(vr,10);return vr>=adarg1 && vr<=adarg2;
	case "default":return !/'|"/.test(vr);
	default:return true;
	}
}
}
function getFmtValue(vr,tp){
	if(tp=="cpf_cnpj")tp=(vr.length <=SZ_CPF)?"cpf":"cnpj";
	if(/^(neg_)?money/.test(tp))return fmtMoney(vr,_getNDec(tp));
	else{
		switch(tp){
		case "time":return vr.slice(0,2)+":"+vr.slice(2,4); 
		case "date":return vr.getDateValue();
		case "month_year":return vr.getMonthDateValue();
		case "ag_account":return vr.slice(0,4)+"-"+vr.slice(4,9)+"-"+vr.slice(9,11);
		case "ag_savings":return vr.slice(0,4)+"-"+vr.slice(4,10)+"-"+vr.slice(10,11);
		case "account":return vr.slice(0,5)+"-"+vr.slice(5,7);
		case "cep":return vr.slice(0,5)+"-"+vr.slice(5,8);
		case "uppercase":case "full_name": return vr.toUpperCase();
		case "cpf":return vr.slice(0,3)+"."+vr.slice(3,6)+"."+ vr.slice(6,9)+ "-"+vr.slice(9,11);
		case "cnpj":return vr.slice(0,2)+"."+vr.slice(2,5)+"."+vr.slice(5,8)+"/"+vr.slice(8,12)+"-"+vr.slice(12,14);
		default:return vr;
		}
	}
}
function fmtMoney(vr,ndec){
var neg=vr.indexOf("-")==0;
if(verifyMaxValue(vr)){ERRO=true;return "0,00";}
vr=toFloat(vr,ndec);
var vraux="",p,pDec=vr.indexOf(","),vrDec=vr.slice(pDec+1);
for(var i=pDec;i>(neg?1:0);i--){
	p=i-pDec;
	if(i!=pDec&&(p%3==0))vraux+=".";
	vraux+=vr.charAt(i-1);
}
return (neg?"-":"")+invertStr(vraux)+","+vrDec;
}
function setMaxValue(vr){MAX_VALUE=vr;}
function verifyMaxValue(vr){return vr.length>0 &&(parseFloat(vr)>MAX_VALUE);}
function toFloat(src,ndec){
src=trim(src);
if(!/^\-?([0-9]|\.)*\,{0,1}[0-9]*$/.test(src)||src.charAt(0)==".")return src;
var tam=src.length,pDec=src.indexOf(",");
if(src.length==0)src="0";
if(pDec==-1){
	var p=src.indexOf(".");
	if(p!=-1&&p==(tam-ndec-1))src=src.replace(/\.(\d*)$/,",$1");
	else return removeStr(src,".")+","+repeatNStr("0",ndec);
	pDec=src.indexOf(",");
}
src=removeStr(src,".");
if(pDec==0)return "0"+src+repeatNStr("0",ndec+1-src.length);
else{
	if(pDec>(tam-ndec-1))src+=repeatNStr("0",pDec-(tam-ndec-1));
	pDec=src.indexOf(",");
	return parseInt(src.slice(0,pDec),10)+src.slice(pDec,pDec+ndec+1);
}
}
function saltaCampo(ev,field,tp,size){
var tc,max=size,nargs=saltaCampo.arguments.length;
if(/^(neg_)?float/.test(tp))max=(nargs>3)?size:SZ_FLOAT;
else if(/^(neg_)?money/.test(tp)){
	if(!verifyMaxValue(field.value))max=(nargs>3)?size:SZ_MONEY;
	else field.value="0,00";
}else if(/^(date|month_year|time|cpf|cnpj|cpf_cnpj|cep|account|branch|percent|ag_account|ag_savings)$/.test(tp))
	max=eval("SZ_"+tp.toUpperCase());
/*
else if(/^(full_name|text|text_entry|uppercase|interval|(sp_)?alfanumeric|(sp_)?textnumber|default|(neg_)?numeric|email)$/.test(tp))
	max=size;
*/
tc=brow().isNetscape()?ev.which:ev.keyCode;
if(String(field.value).length>=max && tc>=48){autoSkip(field);return true;}
else return false;
}
function showError(type,msgU){
ERRO=true;
var b=brow(),canShow=true;
if(typeof type=="object" && !_isRE(type)){alert(msgU);focusCamp(type);return;}
if(b.isIE() && parseInt(b.getMajorver(),10)<5){
	if(CURRENT_FIELD && LAST_ERR_FIELD==CURRENT_FIELD && LAST_ERR_VALUE==CURRENT_FIELD.value){
		REPET_ERR=true;
		CURRENT_FIELD.value=LAST_ERR_VALUE="";
		LAST_ERR_FIELD=null;
		canShow=false;
	}else{
		LAST_ERR_FIELD=CURRENT_FIELD;
		LAST_ERR_VALUE=(CURRENT_FIELD?CURRENT_FIELD.value:null);
		REPET_ERR=false;
	}
}
if(canShow){
	var m=". Digite novamente.";
	switch(type){
	case "date":msg="Data inválida"+m;break;
	case "time":msg="Hora inválida"+m;break;
	case "ag_account":msg="Agência/Conta corrente incorretos"+m;break;
	case "ag_savings":msg="Agência/Conta poupança incorretos"+m;break;
	case "branch":msg="Agência inválida"+m;break;
	case "account":msg="Conta corrente inválida"+m;break;
	case "cep":msg="CEP inválido"+m;break;
	case "email":msg="E-mail incorreto"+m;break;
	case "cpf":msg="CPF inválido"+m;break;
	case "cnpj":msg="CNPJ inválido"+m;break;
	case "cpf_cnpj":msg="CPF/CNPJ inválido"+m;break;
	case "month_year":msg="Mês e ano inválidos"+m;break;
	case "full_name":
		switch(errorCode){
			case 0:msg="Nome inválido."+m;break;
			case 1:msg="Informe sobrenome.";break;
			case 2:msg="Informe primeiro nome com mais de 2 caracteres.";break;
			case 3:msg="Informe nome sem caracteres repetidos mais de 3 vezes.";break;
		}
		break;
	default:msg="Valor inválido"+m;
	}
	alert((!msgU || msgU=="")?msg:msgU);
}
if(brow().isNetscape())LAST_FIELD.value="";
if(LAST_FIELD)LAST_FIELD.focus();
}
function focusCamp(f){
if(brow().isNetscape())f.value="";
else f.focus();
ERRO=true;
}
function focusNetscape(f){
CURRENT_FIELD=f;
var b=brow();
if(b.isNetscape()){
	if(ERRO){LAST_FIELD.focus();ERRO=false;}
}else if(b.isIE()&& parseInt(b.getMajorver(),10)>4)if(f.select)f.select();
}
function focusField(f){
if(!f){alert("focusField: Campo não encontrado.");return;}
var ie=(brow().isIE()&&!brow().isMac()),v=brow().getVersion(),b=parent.buttons;
if(ie&&(v>=5 && v<5.2)&&b&&b.myBarra){
	var tp=f.type;
	if(tp && /^(text|password)$/.test(tp)&& f.onblur&&/formatCamp\(/.test(f.onblur)){
	  if(!window.event)window.focus();
	}else b.myBarra.clicked=false; 
}
f.focus();
}
function brow(){if(typeof objBrow!="object")objBrow=new Browser();return objBrow;}
function repeatNStr(vr,n){
var r="",i;
for(i=0;i<n;i++)r+=vr;
return r;
}
function unformatFields(form){
var f,i,tp;
if(!form)return;
for(i=0;i<form.length;i++){
	f=form.elements[i];
	if(f.type=="text"){
		tp=getFieldType(f);
		if(tp){vr=unformatField(f.value,tp);f.value=(!vr?"":vr);}
	}
}
}
function getFieldType(f){
var blur=f.onblur;
if(!blur)return null;
var c=changeStr(removeStr(blur.toString()," "),"\'","\"");
c=c.replace(/[\n\t]/g,"").toLowerCase();
var ret=/^.*formatcamp\((.*)\).*$/.exec(c)[1];
return ret.split("\"")[1];
}
function isTextNumber(v){return /^[0-9a-zA-ZáéíóúçãõâêôàÁÉÍÓÚÇÃÕÂÊÔÀ]+$/.test(v);}
function isFloatNumber(n){return /^\-?\d+(,\d+|\d*)$/.test(n);}
