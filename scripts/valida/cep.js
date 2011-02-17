function isCEP(cep)
{
	var OK;
	cep= justNumbersStr(trim(cep));
	if(onlySameNumber(cep)) return false;
	var size=cep.length;
	if(size !=8)
	{
	  return false;
	}
	else
	{
		return true;
	}
}
