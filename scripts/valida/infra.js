/* 
#  $Header: /aplic/ITED/src/repository/aplic/ITED/www/htdocs/common/scripts/infra.js,v 1.60 2003-01-30 09:24:23-02 e007413 EP $
#  HSBC Bank Brasil S.A. - IT E-Channels E-Publishing
#  Description : Deteccao do browser do cliente
#  Author      : LUCIANO MELEXENCO RIBAS
*/
function Browser(){
this.name=this.platform="Unknown";
this.majorver=this.version=this.minorver="";
this.mozilla=false;
this.init=_Init;
this.getName=function(){return this.name};
this.getMinorver=function(){return this.minorver};
this.getMajorver=function(){return this.majorver};
this.getVersion=function(){return parseFloat(this.version,10)};
this.getPlatform=function(){return this.platform}; 
this.isIE=function(){return(this.name=="IE")};
this.isNetscape=function(){return(this.name=="Netscape")};
this.isMozilla=function(){return this.mozilla};
this.isWindows=function(){return _has(this.platform,["Windows","WinNT"])};
this.isWinNT=function(){return _has(this.platform,["WinNT","Windows NT"])};
this.isWin95=function(){return _has(this.platform,["Win95","Windows 95"])};
this.isWin98=function(){return _has(this.platform,["Win98","Windows 98"])};
this.isLinux=function(){return _has(this.platform,"Unix")};
this.isMac=function(){return _has(this.platform,"Mac");};
this.init();
}
function _Init(){
var ua=navigator.userAgent,t="",ts="",i,bv;
bv=ua.slice(0,ua.indexOf("("));
ts=ua.slice(ua.indexOf("(")+1,ua.indexOf(")")).split(";");
for(i=0;i<ts.length;i++){
	t=ts[i].trim();
	if(_has(t,["MSIE","Opera"]))bv=t;
	else if(_has(t,["X11","SunOS","Linux"]))this.platform="Unix";
	else if(_has(t,["Mac","PPC","Win"]))this.platform=t;
}
var idx=bv.indexOf("MSIE"),lo="";
if(idx>=0)bv=bv.slice(idx);
if(bv.slice(0,7)=="Mozilla"){
	lo="";
	this.name="Netscape";
	if(ua.indexOf("Gecko/")!=-1){
		if(/Netscape/.test(ua)){
			var v=/([^\/]+)\s*$/.exec(ua);
			if(v&&v.length>1)lo=v[1]+" ";
		}else{
			this.mozilla=true;
			var v=/rv:([^\)]+)\)/.exec(ua);
			if(v&&v.length>1)lo=v[1]+" ";
		}
	}
	if(lo=="")lo=bv.slice(8);
}else if (bv.slice(0,4)=="MSIE"){
	this.name="IE";lo=bv.slice(5);
}else if (bv.slice(0,27)=="Microsoft Internet Explorer"){
	this.name="IE";lo=bv.slice(28);
}else if (bv.slice(0,5)=="Opera"){
	this.name="Opera";lo=bv.slice(6);
}
lo=lo.trim();
i=lo.indexOf(" ");
if(i>=0)this.version=lo.slice(0,i);
else this.version=lo;
j=this.version.indexOf(".");
if(j>=0){
	this.majorver=this.version.slice(0,j);
	this.minorver=this.version.slice(j+1);
}else this.majorver=this.version;
}
function _has(s,a){
s=String(s);
if(typeof(a)=="string")return s.indexOf(a)!=-1;
else{
	for(var i=0;i<a.length;i++)if(s.indexOf(a[i])!=-1)return true;
	return false;
}
}
function _TRIM(){
var s=0,e=this.length;
while(s<e&&this.charAt(s)==' ')s++;
while(e>0&&this.charAt(e-1)==' ')e--;
return this.slice(s,e);
}
String.prototype.trim=_TRIM;
/* 
#  $Header: /aplic/ITED/src/repository/aplic/ITED/www/htdocs/common/scripts/infra.js,v 1.60 2003-01-30 09:24:23-02 e007413 EP $
#  © Copyright HSBC Bank Brasil S.A. - Banco Múltiplo - All rights reserved
#  Description : Contem ações comuns à todas as aplicações
#  Author      : LUCIANO MELEXENCO RIBAS
#                ANDERSON CESCONETTO
*/
//MSGBOX com titulo HSBC
function HSBCAlert(msg){parent.alert("HSBC BANK BRASIL S.A. - BANCO MÚLTIPLO  \n\n"+msg);} 
if(parent.frames&&parent.frames.length>0)window.alert=HSBCAlert;
function logout(app){
	function _cl(){if(parent.frames.length==0)window.close(); else parent.close();}
	if(!app){
		if(parent.finish)parent.finish();
		else{
			if(typeof getCanalID!="function")_cl();
			else if(getCanalID()==""||getCanalID()=="0")_cl();
			else parent.central.location.replace('/ITE/common/html/logout.htm?url=/HOB-PREMIER/servlets/Logout');
		}
	}else{
		if(app.indexOf("url=")==0)parent.central.location.replace('/ITE/common/html/logout.htm?'+app);			
		else _cl();
	}
}
function popupHelp(anchor){
	var width=750,height=460,url;	
	if(arguments.length>1){anchor=arguments[1];}
	if(getCanalID&&getCanalID()==15)url="/ITE/app/autofinance/help/help.htm?ancora=";
	else if(getCanalID&&getCanalID()==7){
		if(getProfileID&&getProfileID()==4)url="/ITE/app/seguros/help/helpJuridico.htm?ancora=";
		else url="/ITE/app/seguros/help/helpFisico.htm?ancora=";
	}else if(getCanalID&&(getCanalID()==8||getCanalID()==16)){url="/ITE/app/connect/help/help.html?ancora=";width=770;}
	else{ url="/ITE/app/ib/help/help.html?ancora="; width=770;}
	popup(url+(anchor?anchor:"")+"&profile="+(parent.getAppType&&parent.getAppType()!=null?parent.getAppType():getProfileID()),'HelpWind'+random(1,9999),'left=0,top=0,width='+width+',height='+height+',directories=no,location=no,menubar=no,resizable=no,scrollbars=yes,status=no');
}
function isAnchor(){
	if(window.currentLink){
		var obj=window.currentLink;
		if(obj.tagName=="IMG")obj=obj.parentElement;
		if(obj.tagName=="A"){
			var locAnchor=obj.href.split('#')[0],
			locWin=location.href.split('#')[0],
			re=new RegExp('Ap{1,2}lic');
			if(locAnchor==locWin ||re.test(obj.mimeType))return true;
		}
	}
	window.currentLink=null;
	return false;
}
function testAnchor(){if(window.event&&window.event.srcElement)window.currentLink=window.event.srcElement;}
/*
#  $Header: /aplic/ITED/src/repository/aplic/ITED/www/htdocs/common/scripts/infra.js,v 1.60 2003-01-30 09:24:23-02 e007413 EP $
#  © Copyright HSBC Bank Brasil S.A. - IT E-Channels E-Publishing
#  Description : Funcoes de utilizacao geral p/ aplicacoes
#  Author      : LUCIANO M RIBAS */
function popup(url,j,atr){var w= window.open(url,j,removeStr(atr," "));}
function random(r1,r2){return Math.round(Math.random()*(r2-r1))+ (r2>r1?r1:r2);}
function trim(s){return String(s).replace(/^\s+/,"").replace(/\s+$/,"");}
function autoSkip(field,orient){
	var ind=-1,f=field.form;
	for(i=0;i<f.elements.length;i++)
		if(field==f.elements[i]){ind=i;break;}
	focusCampByPos(f,ind,orient);
}
function autoFocus(f){focusCampByPos((arguments.length==0?document.forms[0]:f),-1);}
function focusCampByPos(fr,ind,orient){
	orient=orient?orient:"down";
	var iNext=(orient=="down"?1:-1),el;
	if((typeof fr.elements[ind+iNext])=="undefined"){
      if(ind!=-1)if(fr.elements[ind]&&fr.elements[ind].blur)fr.elements[ind].blur();
		return;
   }
	for(var i=ind+iNext;i<fr.elements.length;i+=iNext){
		el=fr.elements[i];
		if(/^(text|password|select.*|radio|checkbox.*)$/.test(el.type) && !el.disabled){el.focus();return;}
   }
	if(fr.elements[ind]&&fr.elements[ind].blur)fr.elements[ind].blur();
}
function isNumeric(v){return /^[0-9]+$/.test(v);}
function isAlfa(v){return /^[a-zA-ZáéíóúçãõâêôàÁÉÍÓÚÇÃÕÂÊÔÀ]+$/.test(v);}
function isAlfaNumeric(v){return /^[0-9a-zA-Z]+$/.test(v);}
function invertStr(s){
	var t="",i;
	for(i=0;i<s.length;i++)t=s.charAt(i)+t;
	return t;
}
function removeStr(src,arg){
	var v=(typeof arg=="string")?[arg]:arg;
	var r="";
	for(var i=0;i<v.length;i++)r=changeStr(src,v[i],"");
	return r;
}
function repeatStr(src,str,size,orient){
	var r=String(src);
	if(!orient)orient="left";
	while(r.length < size)r=orient.toLowerCase()=="right"?(r+str):(str+r);
	return r;
}
function changeStr(src,from,to)
{
	src=String(src);
	var i,li=0,lFrom= from.length,dst="";
	while((i=src.indexOf(from,li))!=-1){
		dst+=src.substring(li,i)+to;
		li=i+lFrom;
	}
	dst+=src.substring(li);
	return dst;
}
function justNumbersStr(s){return String(s).replace(/\D*/g,"");}
function onlySameNumber(s){return isNumeric(s)&& (new RegExp("^("+s.charAt(0)+")(\\1)*$")).test(s);}

function _SPLT(c){
   var r=[],t="",i,l=this.length;
   if(l==0)return null;
   for(i=0;i<l;i++){
      var ch=this.slice(i,i+1);
      if(ch==c){r.push(t);t="";}
      else t+=ch;
   }
   r.push(t);
   return r;
}
function _PSH(i){this[this.length]=i;return this.length;}
function _POP(){
	l=this[this.length-1];
	this.length=Math.max(this.length-1,0);
	return l;
}
function _SPLI(ind,c){
	var t=arguments.length,i;
	if(t==0)return ind;
	if(typeof ind!="number")ind=0;
	if(ind<0)ind=Math.max(0,this.length+ind);
	if(ind>this.length){
		if(t>2)ind=this.length;
		else return [];
	}
	if(t<2)c=this.length-ind;
	c=(typeof c=="number")?Math.max(0,c):0;
	rmv=this.slice(ind,ind+c);
	end=this.slice(ind+c);
	this.length=ind;
	for(i=2;i<t;i++)this[this.length]=arguments[i];
	for(i=0;i<end.length;i++)this[this.length]=end[i];
	return rmv;
}
function _SHF(){var r=this[0];this.splice(0,1);return r;}
Array.prototype.shift=_SHF;
Array.prototype.splice=_SPLI;
Array.prototype.pop=_POP;
Array.prototype.push=_PSH;
String.prototype.split=_SPLT;
/*
# $Header: /aplic/ITED/src/repository/aplic/ITED/www/htdocs/common/scripts/infra.js,v 1.60 2003-01-30 09:24:23-02 e007413 EP $
*/
var tIDP,_TimeP=5500,_Win,ObjP=null,_PEND,_Brow=new Browser(),_K=(typeof parent.isWebKiosk!="undefined"&&parent.isWebKiosk())||/\&kiosk=true/.test(location.href);
var _IMAC=_Brow.isMac()&&_Brow.isIE(),_lnx=_Brow.isLinux();
if(!canP())window.printFrame=_pFrm;
function _pFrm(f,of){
	if(!f)f=window;
	if(f.document.readyState!=="complete"){if(of)of();return;}
	var eS=printGetEventScope(f);
	window.printHelper=function(){
		var s="on error resume next: printWB.ExecWB "+(_K?"6,2,1":"6,1");
		_Win.execScript(s,"VBScript");
		printFireEvent(f,eS,"onafterprint");
		_Win.printWB.outerHTML="";
		window.printHelper=null;
	}
	_Win.document.body.insertAdjacentHTML("beforeEnd","<object id=\"printWB\" width=0 height=0 classid=\"clsid:8856F961-340A-11D0-A96B-00C04FD705A2\"></object>");
	printFireEvent(f,eS,"onbeforeprint");
	f.focus();
	window.printHelper=printHelper;
	setTimeout("window.printHelper()", 0);
}
if(!canP())window.printFireEvent=_pFire;
function _pFire(f,o,name){
	var handler=o[name];
	switch(typeof(handler)){
		case "string":f.execScript(handler);break;
		case "function":handler();
	}
	if(name=="onafterprint")if(_PEND)endP();
}
if(!canP())window.printGetEventScope=_pGE;
function _pGE(frm){
	var d=frm.document,f=d.all.tags("FRAMESET");
 	return f.length?f[0]:d.body;
}
function printPage(w,end){
	_PEND=(typeof end =="undefined"?true:end);
	_Win=w;
	if(!_Win)_Win=window;
	if(typeof end=="undefined")end=true;
	_Win.focus();
	if(_IMAC)return;
	if(!canP())printFrame(_Win);
	else{_Win.print();if(_PEND)endP();}
}
function closeP(){
var t=(typeof _Win.parent);
if(t!="unknown"&&t!="undefined")_Win.parent.close();
}
function endP(){
tIDP=(_lnx?setTimeout("if(parent.central&&parent.central._closePrnLnx)parent.central._closePrnLnx()",_TimeP):(parent.frames.length==0)?setTimeout("_Win.close();",_TimeP):setTimeout("closeP()",_TimeP));
}
function canP(){
	var ag=navigator.userAgent;var i=ag.indexOf("MSIE ")+5;
	return !_K&&(navigator.appName.indexOf("Netscape")!=-1||(parseInt(ag.substr(i))>=5&& ag.indexOf("5.0b1")<0));
}

function getObjPrint(){return ObjP;}
function printWindow(attr){ObjP=new PrintWindow(attr);}
function PrintWindow(attr){
	this.attr=attr;
	this.getURL=_getURL;this.getParam=_getParam;this.getParms=_getParms;
	this.show=_show;this.init=_init;
	this.init();
}
function _init(){
	this.getParms("method,action,same_content,print_logo,submit_function,form,debug,orientation");
	var s=trim(this.same_content);
	this.same_content=((!s && !this.action)||s=="false")?false:true;
	this.debug=(!this.debug||this.debug=="no")?false:true;
	if(_IMAC)this.debug=true;
	this.m=(this.method?this.method.toLowerCase():"get");
	if(this.m=="post"){
		var f=this.form;
		if(!f||typeof(f)=="undefined"||f.length==0){alert('printWindow: The form attribute must be defined.');return;}
	}
	this.show();
}
function _show(){
	var o=this.orientation,msgL="Lembre-se: para imprimir, você deve "+(_IMAC?"acessar o menu File e clicar na opção Print.":"configurar sua impressora para o FORMATO PAISAGEM.");
	if(_IMAC||(o&&o.toLowerCase()=="landscape"))alert(msgL);  
  if(_IMAC&&this.same_content)openFPrint("/ITE/common/html/print/printIE.html",700,500,true);
  else if(!this.same_content&&(_IMAC ||this.debug))openFPrint(this.getURL(),700,500,true);
  else if(this.method=="get"&&this.same_content){
	  if(_Brow.isIE()||typeof document.getElementById=="function"){
			changeLogo(this.print_logo);
   		if(document.all&&parent.central){
				d=parent.central.document.all;
				if(d.ponto&&d.ponto.style)d.ponto.style.visibility="hidden";
				if(d.info_print&&d.info_print.style)d.info_print.style.visibility="hidden";
			}
    }
  	printPage(window,false);
  }else if(this.method=="get"&&!this.same_content)openFPrint(this.getURL(),403,200);
  else if(this.method=="post")openFPrint("/ITE/common/html/print/printpagepost.html",403,200);
}
function openFPrint(u,w,h,debug){
	var l=(screen.width-w)/2,t=(screen.height-h)/2;
	window.open((debug?u:'/ITE/common/html/print/frame.htm?central='+escape(u)),'PW'+random(1,9999),'left='+l+',top='+t+',width='+w+',height='+h+',directories=no,location=no,menubar=no,scrollbars='+(!debug?'no':'yes')+',status=no,resizable=no');
}
function _getURL(){
	var a=this.action;var h=a?a:document.location.href,mp="media=print";
	if(typeof getCurrentState=="function"){
		h=h.replace(/ServletState=[0-9]+\&?/,"").replace(/\?$/,"");
		mp+="&ServletState="+getCurrentState();
	}
	if(!this.form)this.form=0;
	var f=document.forms[this.form];
	if(this.m=="get"||(!f ||!f.media ||f.media.value!="print"))h+=h.indexOf("?")==-1?"?"+mp:"&"+mp;
	return h+(_K?'&kiosk=true':'');
}
function _getParam(prop,def){
	var re,p=trim(prop);
	if(p.toLowerCase()!="submit_function")re=new RegExp(".*" +p+"=([^,]*)(,.*|$)");
	else re=/.*submit_function=([^,]*\\(.*\\)[^,]*)(,.*|$)"/;
	var r=re.exec(trim(this.attr));
	if(!r||!r.length||r.length<2)return def?def:"";
	else return String(r[1]);
}
function _getParms(p){
	var a=String(p).split(","),i=0;
	for(i=0;i<a.length;i++)eval("this."+a[i]+"=this.getParam('"+a[i]+"')");
}
function changeLogo(print_logo){
if(print_logo){
 	var dI=document.images;
 	if(!(dI&&dI.LogoPrint))return;
	if(print_logo=="none"){dI.LogoPrint.style.width=0;dI.LogoPrint.style.height=0;
  }else{
		var s=dI.LogoPrint.src.replace(/http:\/\/[^\/]+/,"");
		if(s!=print_logo&&dI&&dI.LogoPrint)dI.LogoPrint.src=print_logo;   	
  }
}
}
/* 
#  $Header: /aplic/ITED/src/repository/aplic/ITED/www/htdocs/common/scripts/infra.js,v 1.60 2003-01-30 09:24:23-02 e007413 EP $
#  © Copyright HSBC Bank Brasil S.A. - IT E-Channels E-Publishing
#  Description : Funcoes para controle de Timeout
#  Author      : LUCIANO MELEXENCO RIBAS
*/
var CdTimeOut,_Page,NrMilli=0;
function timeoutControl(url,seg){
	if(arguments.length==0){seg=300;url="/ITE/common/html/telatimeout.htm";}
	NrMilli=seg*1000;
	_Page=url+(/\?/.test(url)?"&s=":"?s=")+seg;
	CdTimeOut=window.setTimeout("callTimeout()",NrMilli);
	if(parent.timeOUT&&parent.timeOUT.initInterval)parent.timeOUT.initInterval(NrMilli); 
}
function resetTimeOut(seg){
	if(typeof seg!="undefined")NrMilli=seg*1000;
	_Page=String(_Page).replace(/\?s=.*/,"?s="+seg);
	window.clearTimeout(CdTimeOut);
	CdTimeOut=window.setTimeout("callTimeout()",NrMilli);
	if(parent.timeOUT&&parent.timeOUT.initInterval)parent.timeOUT.initInterval(NrMilli);
}
function callTimeout(){document.location.replace(_Page);}
//  $Header: /aplic/ITED/src/repository/aplic/ITED/www/htdocs/common/scripts/infra.js,v 1.60 2003-01-30 09:24:23-02 e007413 EP $
function setCookie(name,value,dexp,path,domain,secure){
var expires=dexp;
if(typeof expires=="number"){expires=new Date();fixDate(expires);expires.setTime(expires.getTime()+dexp*60*60*1000);}
var curCookie=name+"="+escape(value)+((expires)?"; expires="+expires.toGMTString():"")+((path)?"; path="+path:"")+((domain)?"; domain="+domain:"")+((secure)?"; secure":"");
document.cookie=curCookie;
}
function getCookie(name){
var dc=document.cookie,prefix=name+"=",begin=dc.indexOf(prefix);
if(begin==-1)return null;
var end=document.cookie.indexOf(";",begin);
if(end==-1)end=dc.length;
return unescape(dc.substring(begin+prefix.length,end));
}
function deleteCookie(name,path,domain){
if(getCookie(name)){document.cookie=name+"="+((path)?"; path="+path:"")+((domain)?"; domain="+domain:"")+"; expires=Thu, 01-Jan-70 00:00:01 GMT";}
}
function verifyCookie(){
var valor,flag=0,nomeCookie="STCV";
setCookie(nomeCookie,"ligado");
if(getCookie(nomeCookie)!=null){flag=0;valor=1;deleteCookie(nomeCookie);
}else{if(!flag){flag=1;deleteCookie(nomeCookie);valor=0;}}
return valor;
}
function fixDate(date){
var base=new Date(0),skew=base.getTime();
if(skew>0)date.setTime(date.getTime()-skew);
}
