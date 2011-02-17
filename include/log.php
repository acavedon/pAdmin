<? 
/** 
 * Return a list of records 
 * 
 * @author: alexandre cavedon 
 * @date: 2009-09-24
**/ 
function listRecord($prmStrLoginUser,$prmStrModule="",$prmDateType="",$prmDtData="")
{ 
	global $dbi;

	$sql = "SELECT 
               user.name, 
               log.date,
               log.module,
               log.userAction,
               log.data
            FROM 
               log, 
               user 
            WHERE 
               log.user_coduser=user.coduser ";
               
            if($prmStrLoginUser!="All" || $prmStrModule!="All" || $prmDtData!="") 
            {
                $sql .= " AND ";
            }
            
            if($prmStrModule!="" && $prmStrModule!="All")
            {
                $sql .= "log.module='".$prmStrModule."'";

                if($prmStrLoginUser!="All") 
                {
                    $sql .= " AND ";
                }
            }

            switch($prmDateType)
            {
                case "equal":
                    $prmDtData = explode("/",$prmDtData);

                    $sql .= "YEAR(log.date)='".$prmDtData[2]."' AND MONTH(log.date)='".$prmDtData[1]."' AND DAY(log.date)='".$prmDtData[0]."' ";

                    if($prmStrLoginUser!="All") 
                    {
                        $varContent .= " AND ";
                    }
                break;
                case "before":
                    $prmDtData = explode("/",$prmDtData);
                    $prmDtData = $prmDtData[2]."-".$prmDtData[1]."-".$prmDtData[0];

                    $sql .= "log.date<'".$prmDtData."' ";
                    
                    if($prmStrLoginUser!="All") 
                    {
                        $varContent .= " AND ";
                    }
                break;
                case "after":
                    $sql .= "log.date>'".$prmDtData."' ";
                    
                    if($prmStrLoginUser!="All") 
                    {
                        $varContent .= " AND ";
                    }
                break;
                case "All":
                    // a principio nada a ser realizado
                break;
            }

            if($prmStrLoginUser!="All") 
            {
                $sql .= " user.login LIKE '%$prmStrLoginUser%' ";
            }
            $sql .= "ORDER BY 
                        log.date DESC";

    $varResult = mysql_query($sql,$dbi); 
    $varCount = mysql_num_rows($varResult);

	$varContent .= "<thead>\n";
	$varContent .= "  <tr align='center'>\n";
	$varContent .= "	    <th width='10%' align='left'>User's Name</th>\n ";
	$varContent .= "	    <th width='10%'>Date</th>\n ";
	$varContent .= "	    <th width='10%'>Module</th>\n ";
	$varContent .= "	    <th width='10%'>User's Action</th>\n ";
	$varContent .= "	    <th width='10%'>Data</th>\n ";
	$varContent .= "  </tr>\n ";
	$varContent .= "</thead>\n";

	$varContent .= "<input name='hideaction' type='hidden' id='hideaction' />\n";
	$varContent .= "<input name='cod' type='hidden' id='cod' />\n";
	$varContador = 0;

    $varContent .= "<tbody>\n";

    if($varCount==0)
    {
		$varContent .= "<tr>\n";
        $varContent .= "    <td align='center' colspan='5'>No records found.</td>\n";
        $varContent .= "</tr>\n";
    }

	while(list($varStrNameUser,$varDate,$varStrModule,$varStrUserAction,$varStrData)=mysql_fetch_row($varResult)) 
	{ 
        $varStrNameUser=stripslashes($varStrNameUser);
		$varStrModule=stripslashes($varStrModule);
		$varStrUserAction=stripslashes($varStrUserAction);
		$varStrData=stripslashes($varStrData);

		$varBgColor = ($varContador%2) ? "#CFDEFF" : "#ffffff";
		$varContent .= "<tr bgcolor=\"$varBgColor\">\n";
		$varContent .= "	<td valign='top'>$varStrNameUser</td>\n";
		$varContent .= "	<td align='center' valign='top'>$varDate</td>\n";
		$varContent .= "	<td align='center' valign='top'>$varStrModule</td>\n";
		$varContent .= "	<td align='center' valign='top'>$varStrUserAction</td>\n";
		$varContent .= "	<td align='center' valign='top'>$varStrData</td>\n";
		$varContent .= "</tr>\n";
		$varContador ++;
	} 

    $varContent .= "</tbody>\n";

	return $varContent; 
} 


/**
 * Return a list of users
 *
 * @author: alexandre cavedon
 * @date: 2009-09-24
**/
function listUser()
{
    global $dbi;

    $sql = "SELECT 
                coduser, 
                login 
            FROM 
                user";
    $varResult = mysql_query($sql,$dbi);
    $varCount = mysql_num_rows($varResult);

    $x=0;

    $varContent .= "All,";
    while(list($varCodUser,$varStrNameUser)=mysql_fetch_row($varResult))
    {
        $varStrNameUser = stripslashes($varStrNameUser);
        $varContent .= "$varStrNameUser";

        if($x!=($varCount-1))
        {
            $varContent .= ",";
        }

        $x++;
    }

    return $varContent;
}

/** 
 * Return user's code
 *
 * @author: alexandre cavedon
 * @date: 2009-09-24
**/
function returnCodUser($prmStrNameUser)
{
    global $dbi;

    $prmStrNameUser=stripslashes($prmStrNameUser);

    $sql = "SELECT 
                coduser 
            FROM 
                user 
            WHERE 
                name='$prmStrNameUser'";
    $varResult = mysql_query($sql,$dbi);
    list($varCodUser)=mysql_fetch_row($varResult);

    return $varCodUser;
}

?>
