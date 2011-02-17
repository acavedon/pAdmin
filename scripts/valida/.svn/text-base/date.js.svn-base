/* 
#  $Header: /aplic/ITED/src/repository/aplic/ITED/www/htdocs/common/scripts/date.js,v 1.11 2002-01-07 11:19:27-02 b918145 EP $
#  © Copyright HSBC Bank Brasil S.A. - IT E-Channels E-Publishing
#  Description : Validacao de datas e funcoes uteis para utilizacao das mesmas
#  Author      : LUCIANO MELEXENCO RIBAS
*/
function DateValidation(d){
	this.dtSrc=d;
	this.dtValue="";
	this.isDate=_isDate;
	this.getDateValue=function() {return(this.dtValue);};
	this.getMonthDateValue=function() {return(this.dtValue.slice(3));} 
}
function _isDate(){
	var vrs=/^(0[1-9]|[1-2][0-9]|3[0-1])(0[1-9]|1[0-2])(\d{2}|19\d{2}|20\d{2})$/.exec(justNumbersStr(this.dtSrc));
	if(!vrs || vrs.length<4)return false;
	var d=parseInt(vrs[1],10),m=parseInt(vrs[2],10),a=parseInt(vrs[3],10);		
	if(a<100)a+=(a<30?2000:1900);
	if(/^(4|6|9|11)$/.test(m) && d==31)return false;
	if(m==2){
		var bissexto=(((a%4==0)&&a%100!=0)||a%400==0);
		if(d>29 ||(d==29 && !bissexto))return false;
	}
	this.dtValue=repeatStr(d,"0",2)+"/"+repeatStr(m,"0",2)+"/"+a;
	return true;
}
function DateObj(d){
	d=trim(d);
	if(!d)return;
	var t=d.length;
	if(t==10||t==8||t==6){
		this.isValid=true;
		this.srcDate=d;
		this.date=d.replace(/\//g,"");
		this.day=this.date.slice(0,2);
		this.month=this.date.slice(2,4);
		this.year=this.date.slice(4);
		var a=parseInt(this.year,10);
		if(a<100){a+=(a<30?2000:1900);this.year=String(a);}

		this.daysTo=_DaysTo;
		this.lesserThan=function(d){return Number(this.year+this.month+this.day) < Number(d.year+d.month+d.day)};
		this.biggerThan=function(d){return !this.lesserThan(d)&& !this.equal(d)};
		this.equal=function(d){return this.date==d.date.replace(/\//g,"");};
		this.biggerOrEqualThan=function(d){return this.biggerThan(d)||this.equal(d)};
		this.lesserOrEqualThan=function(d){return this.lesserThan(d)||this.equal(d)};
	}else this.isValid=false;
}
function _DaysTo(d){
	var msDay=24*60*60*1000;
	var s=new Date(this.month+"/"+this.day+"/"+this.year);
	var f=new Date(d.month+"/"+d.day+"/"+d.year);
	return Math.floor((f.getTime()-s.getTime())/msDay);
}
function isInInterval(dtIn,dtFi,pIn,pFi,msg1,msg2,msg3){
	var iDt=new DateObj(dtIn),fDt=new DateObj(dtFi);
	var iPer=new DateObj(pIn),fPer=new DateObj(pFi);
	if(!msg1||msg1=="")msg1='Data inicial maior que a data final. Digite novamente.';
	if(!msg2||msg2=="")msg2='Data inicial fora do período disponível. Digite novamente.';
	if(!msg3||msg3=="")msg3='Data final fora do período disponível. Digite novamente.';
	if(iDt.isValid&&fDt.isValid&&iPer.isValid&&fPer.isValid){
		if(fDt.lesserThan(iDt)){alert(msg1);return false;}
		else if(iDt.lesserThan(iPer)){alert(msg2);return false;}
		else if(fPer.lesserThan(fDt)){alert(msg3);return false;}
		return true;
	}
}
function isInDaysLimit(dtIn,dtFi,dias,msg){
	if(!msg)msg="O intervalo entre as datas não pode ultrapassar "+dias+(dias>1?" dias":" dia")+". Digite novamente.";
	var sDt=new DateObj(dtIn),fDt=new DateObj(dtFi);
	if(sDt.isValid && fDt.isValid){
		if((sDt.daysTo(fDt)+1)>dias){alert(msg);return false;}
		return true;
	}
}
