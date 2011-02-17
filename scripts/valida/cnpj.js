/* 
#  $Header: /aplic/ITED/src/repository/aplic/ITED/www/htdocs/common/scripts/cnpj.js,v 1.3 2001-09-11 14:44:40-03 b918145 EP $
#
#  HSBC Bank Brasil S.A. - IT E-Channels E-Publishing
#  Description : Validacao de CNPJ
#  Author      : LUCIANO MELEXENCO RIBAS
#  Created     : Tue Jul 24 14:33:30 AST 2001
*/

function isCNPJ(cnpj) 
{
	if(cnpj.length==0) return false;
	cnpj= trim(cnpj);
	var digs=[],i;
	for(i=0; i<14; i++)
		digs[i]= parseInt(cnpj.charAt(i),10);
	var sDig=0,soma=0,resto=0,dVer1=-1,dVer2=-1;
	var fat1=[5,4,3,2,9,8,7,6,5,4,3,2];
	var fat2=[6,5,4,3,2,9,8,7,6,5,4,3,2];
	for(var i=0; i<12; i++)
		sDig+= (digs[i]*fat1[i]);
	resto= sDig % 11;
	dVer1= (resto==0)?0:(11 - resto)%10;
	if(digs[12]==dVer1) 
	{
		sDig=resto=0;
		for(i=0;i<13;i++) 
			sDig+= (digs[i]*fat2[i]);
		resto=sDig%11;
		dVer2=(resto==0)?0:(11-resto)%10;
	}
	return digs[12]==dVer1 && digs[13]==dVer2;
}
