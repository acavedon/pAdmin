/* 
#  $Header: /aplic/ITED/src/repository/aplic/ITED/www/htdocs/common/scripts/cpf.js,v 1.3 2001-09-11 14:44:49-03 b918145 EP $
#
#  HSBC Bank Brasil S.A. - IT E-Channels E-Publishing
#  Description : Validacao de CPF
#  Author      : LUCIANO MELEXENCO RIBAS
#  Created     : Tue Jul 24 14:33:59 AST 2001
*/
function isCPF(cpf)
{
	var OK;
	cpf= justNumbersStr(trim(cpf));
	if(onlySameNumber(cpf)) return false;
	var size=cpf.length;
	if(size>10)
	{
		var vr=cpf.substring(0,size-2)
		var resto= getVerificationDigit(vr);
		OK= resto==parseInt(cpf.charAt(size-2));
		if(OK)
		{
			vr+=resto;
			resto=getVerificationDigit(vr);
			OK= resto==parseInt(cpf.charAt(size-1));
		}
	}
	return OK;
}

function getVerificationDigit(S)
{
	var s=0,i;
	var inv=invertStr(justNumbersStr(S));
   for(i=0;i<inv.length;i++)
        s+=(i+2)*parseInt(inv.charAt(i));
   s*=10;
   return (s%11)%10;
}
