/* 
#  $Header: /aplic/ITED/src/repository/aplic/ITED/www/htdocs/common/scripts/email.js,v 1.6 2002-04-10 14:41:18-03 b918145 Beta $
#  © Copyright HSBC Bank Brasil S.A. - Banco Múltiplo - All rights reserved
#  IT E-Channels E-Publishing
#  Description : Validar email.
#  Author      : LUCIANO MELEXENCO RIBAS
*/
function isEmail(email)
{
	//alert(email);
	var v=trim(email);
	// exp1: Trata erros grosseiros (@...@ , .. , .@ , etc.)
	// exp2: Garante carac. validos e estrutura: <usuario>@<maquina>
	// exp3: Garante no minimo um ponto depois do "@" 
	var exp1= /(\@.*\@)|(.*\.\..*)|(.*\@\..*)|(^\.)|(\.$)|(\@\/)|(.*\@\-.*)|(.*\.$)/;
	var exp2= /^[_\w\d][\w\d\_\/\-\.]*\@[\d\w\-\.]+[0-9A-z]$/;
	var exp3= /.*\@.*[\.].*/;
	return(!exp1.test(v)&& exp2.test(v)&& exp3.test(v));
}
