<? 
/** 
 * Return a list of records 
 * 
 * @author: alexandre cavedon 
 * @date: 2010-07-17
**/ 
function listRecord()
{ 
	global $dbi;

	$sql = "SELECT 
               id,
               menu
            FROM 
               navigation "; 
	$varResult = mysql_query($sql,$dbi); 

	$varContent .= "<thead>\n";
	$varContent .= "  <tr align='center' bgcolor='#a8a887'>\n";
	$varContent .= "	    <th align='center' class='nobr' width='2%'>\n";
	$varContent .= "		    <a href=\"javascript:selecionaTodos();\n\">";
	$varContent .= "			    <img src='../$varCaminho/images/admin/ico_marcar.gif' border='0' />\n";
	$varContent .= "		    </a>\n";
	$varContent .= "	    </th>\n";
	$varContent .= "	    <th class='nobr' width='100%'>Name</th>\n ";
	$varContent .= "	    <th class='nobr'>Options</th>\n";
	$varContent .= "  </tr>\n ";
	$varContent .= "</thead>\n";

	$varContent .= "<input name='hideaction' type='hidden' id='hideaction' />\n";
	$varContent .= "<input name='cod' type='hidden' id='cod' />\n";
	$varContador = 0;

    $varContent .= "<tbody>\n";

	while(list($varId,$varStrMenu)=mysql_fetch_row($varResult)) 
	{ 
		$varStrMenu=stripslashes($varStrMenu);

		$varBgColor = ($varContador%2) ? "#ffffcc" : "#ffffff";
		$varContent .= "<tr bgcolor=\"$varBgColor\">\n";
		$varContent .= " 	<td align='center'>\n";
        $varContent .= "      <input type='checkbox' name='selected[]' value='$varId' />\n";
        $varContent .= "    </td>\n";
		$varContent .= "	<td width='100%'>\n";
        $varContent .= "      <strong><a href=\"javascript:executar('view','$varId','navigation-view.php')\">$varStrMenu</a></strong>\n";
        $varContent .= "    </td>\n";
		$varContent .= "	<td align='center' class='nobr'>\n";
        $varContent .= "      <a href=\"javascript:executar('edit','$varId','navigation-edit.php')\">\n";
        $varContent .= "      <img src=\"../$varCaminho/images/admin/icons/edit.png\" width='16' height='15' border='0' /> Edit</a>\n";
        $varContent .= "    </td>\n";
		$varContent .= "</tr>\n";
		$varContador ++;
	} 

    $varContent .= "</tbody>\n";

	$varContent .= "<tr>\n";
	$varContent .= "	<td height='30' colspan='4' class='nobr'>\n";
	$varContent .= "		<img src='../$varCaminho/images/admin/ico_selecionados.gif' width='38' height='22' border='0' />\n";
	$varContent .= "			<a href=\"javascript:executar('exclude','','navigation-del.php','Do you sure about this?')\">\n";
	$varContent .= "				<img src='../$varCaminho/images/admin/icons/user-trash.gif' width='16' height='15' border='0' />\n";
	$varContent .= "				Del selected\n";
	$varContent .= "			</a>\n";
	$varContent .= "	</td>\n";
	$varContent .= "</tr>\n";
	return $varContent; 
} 


/** 
 * Deletes the record 
 * 
 * @author: alexandre cavedon 
 * @date: 2010-07-17
**/ 
function delRecord($prmId)
{ 
	global $dbi;

	$sql = "DELETE FROM navigation WHERE id=$prmId";
	mysql_query($sql,$dbi);
} 


/** 
 * Adds the record in the database 
 * 
 * @author: alexandre cavedon 
 * @date: 2010-07-17
**/ 
function addRecord($prmStrMenu)
{ 
	global $dbi;

	$prmStrMenu=addslashes($prmStrMenu);

	$sql = "INSERT INTO navigation(menu) VALUES ('$prmStrMenu')";
	$varResult = mysql_query($sql,$dbi); 
	return mysql_errno(); 
} 


/** 
 * Updates the record 
 * 
 * @author: alexandre cavedon 
 * @date: 2010-07-17
**/ 
function updateRecord($prmId,$prmStrMenu)
{ 
	global $dbi;

	$prmStrMenu=addslashes($prmStrMenu);

	$sql = "UPDATE navigation 
                SET 
					menu='".$prmStrMenu."'"."
			    WHERE 
                    id=".$prmId;
	mysql_query($sql,$dbi);
} 


/** 
 * Returns the data record 
 * 
 * @author: alexandre cavedon 
 * @date: 2010-07-17
**/ 
function viewRecord($prmId)
{
	global $dbi,$varStrMenu;

	$sql = "SELECT menu FROM navigation WHERE id=".$prmId;
	$varResult = mysql_query($sql,$dbi);

	list($varStrMenu)=mysql_fetch_row($varResult); 
	    $varStrMenu=stripslashes($varStrMenu);
}
?>
