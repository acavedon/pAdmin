<?

/**
 * Retorna listagem das permissoes de usuários do sistema.
 * @author: alexandre cavedon
 * @date: 2008-01-28
 *
 * Codigo reorganizado por Luiz Fred. Gaertner 
**/
function listPermission()
{
	global $dbi, $varOrdem, $varSequencia, $varLimite;
	
	$varSql = "SELECT 
					codpermission, 
					name 
			   FROM 
					permission";
	
	$varResult = mysql_query($varSql,$dbi);

    $varContent  = "<thead>\n";
	$varContent .= "    <tr>\n";
	$varContent .= "	    <th align=\"center\" class=\"nobr\" width=\"2%\">\n";
	$varContent .= "		    <a href=\"javascript: selecionaTodos();\">\n";
	$varContent .= "		    	<img src=\"../images/admin/ico_marcar.gif\" border=\"0\" />\n";
	$varContent .= "		    </a>\n";
	$varContent .= "	    </th>\n";
	$varContent .= "	    <th class=\"nobr\" width=\"100%\">Name</th>\n";
	$varContent .= "	    <th class=\"nobr\" width=\"10%\">Options</th>\n";
	$varContent .= "    </tr>\n";
    $varContent .= "</thead>\n";
	$varContent .= "<input name=\"hideaction\" type=\"hidden\" id=\"hideaction\" />\n";
	$varContent .= "<input name=\"cod\" type=\"hidden\" id=\"cod\" />\n";
	$varContador = 0;
    
    $varContent .= "<tbody>\n";
	
	while(list($varCodPermission, $varStrNameUser)=mysql_fetch_row($varResult))
	{
        // string's fix
        $varStrNameUser = stripslashes($varStrNameUser);

		$varBgColor = ($varContador%2) ? "#ffffcc" : "#ffffff";
		$varContent .= "<tr bgcolor=\"$varBgColor\">\n";
		$varContent .= " 	<td align=\"center\"><input type=\"checkbox\" name=\"selected[]\" value=\"$varCodPermission\" /></td>\n";
		$varContent .= "	<td width=\"100%\">\n";
		$varContent .= "		<strong>\n";
		$varContent .= "			<a href=\"javascript:executar('view','$varCodPermission','permission-view.php')\">\n";
		$varContent .= "				$varStrNameUser\n";
		$varContent .= "			</a>\n";
		$varContent .= "		</strong>\n";
		$varContent .= "	</td>\n";
		$varContent .= "	<td align=\"center\" class=\"nobr\">\n";
		$varContent .= "		<a href=\"javascript:executar('edit','$varCodPermission','permission-edit.php')\" class=\"edtButton\">\n";
		$varContent .= "			<img src=\"../images/admin/icons/edit.png\" width=\"16\" height=\"15\" border=\"0\" />\n";
		$varContent .= "			Edit\n";
		$varContent .= "		</a>\n";
		$varContent .= "	</td>\n";
		$varContent .= "</tr>\n";
		$varContador ++;
	}

    $varContent .= "</tbody>\n";
	$varContent .= "<tr>\n";
	$varContent .= "	<td height=\"30\" colspan=\"4\" class=\"nobr\">\n";
	$varContent .= "		<img src=\"../images/admin/ico_selecionados.gif\" width=\"38\" height=\"22\" border=\"0\" />\n";
	$varContent .= "		<a href=\"javascript: executar('exclude','','permission-del.php','You sure about this?')\">\n";
	$varContent .= "			<img src=\"../images/admin/icons/user-trash.gif\" width=\"16\" height=\"16\" border=\"0\" />\n";
	$varContent .= "			Del selected\n";
	$varContent .= "		</a>\n";
	$varContent .= "	</td>\n";
	$varContent .= "</tr>\n";
	$varContent .= "<input name=\"ordem\" type=\"hidden\" id=\"ordem\" value=\"$varOrdem\" />\n";
	$varContent .= "<input name=\"sequencia\" type=\"hidden\" id=\"sequencia\" value=\"$varSequencia\" />\n";

	return $varContent;
}


/**
 * Exclui permissao do sistema.
 * @param $parCodPermissao
 * @author: alexandre cavedon
 * @date: 2008-01-28
**/
function delPermission($prmCodPermission)
{
	global $dbi;

	$sqlLogger = "SELECT 
					codpermission, 
					name 
			      FROM 
					permission 
                  WHERE 
                    codpermission=$prmCodPermission"; 
	
	$varResult = mysql_query($sqlLogger,$dbi);
	list($varCodPermission, $varStrNamePermission)=mysql_fetch_row($varResult);
    $data = $varStrNamePermission;

    // exclude user
	$sql = "DELETE FROM 
				permission 
			WHERE 
				codpermission=$prmCodPermission";

	mysql_query($sql, $dbi);
    
    // logger
    logger($_SESSION["codLogin"],"permission","del","$data");
}


/**
 * Função para listar as permissoes de usuários.
 *
 * @author: alexandre cavedon
 * @date: 2008-01-28
**/
function comboPermission($prmSelected=0)
{
	global $dbi;
	
	$sql = "SELECT 
				codpermission, 
				name 
			FROM 
				permission 
			ORDER BY 
				name 
			ASC";

	$varResult = mysql_query($sql, $dbi);
	
	while(list($varCodPermission,$varNamePermission)=mysql_fetch_row($varResult))
	{
		$varSel = ($prmSelected == $varCodPermission) ? " selected" : "";
		$varContent .= "<option value=\"$varCodPermission\"$varSel>$varNamePermission</option>\n";
	}
	return $varContent;
}


/**
 * Adiciona permissao no sistema.
 * @param $prmStrNome $prmTxtUrl
 * @author: alexandre cavedon
 * @date: 2008-01-28
 *
 * Codigo reorganizado por Luiz Fred. Gaertner 
**/
function addPermission($prmStrName,$prmTxtUrl)
{
	global $dbi;
	
	$prmStrName	= addslashes($prmStrName);
	$prmTxtUrl	= addslashes($prmTxtUrl);
	
	$sql = "INSERT INTO 
	    		permission (
		    		name,
					permission 
			    ) VALUES (
				   '$prmStrName',
				   '$prmTxtUrl')";

	mysql_query($sql,$dbi);
    
    // logger
    if(mysql_insert_id()!="")
    {
        $data = "$prmStrName,$prmTxtUrl";
        logger($_SESSION["codLogin"],"permission","add","$data");
    }
}


/**
 * Retorna dados do usuário para edição/exibição.
 * @param $prmCodPermissao
 * @author: alexandre cavedon
 * @date: 2008-01-28
**/
function viewPermission($prmCodPermission)
{
	global $dbi,$varStrNamePermission,$varTxtPermission;
	
	$sql = "SELECT 
				name, 
				permission 
			FROM 
				permission 
			WHERE 
				codpermission=$prmCodPermission";

	$varResult = mysql_query($sql, $dbi);
	$varCount = mysql_num_rows($varResult);
	
	if($varCount>0)
	{
		list($varStrNamePermission,$varTxtPermission) = mysql_fetch_row($varResult);
		$varStrNamePermission = stripslashes($varStrNamePermission);
		$varTxtPermission	= stripslashes($varTxtPermission);
	}
}


/**
 * Atualiza permissao no sistema
 *
 * @author: alexandre cavedon
 * @date: 2008-01-28
**/
function updatePermission($prmCodPermission,$prmStrNamePermission,$prmTxtUrlPermission)
{
	global $dbi;
	
	$prmStrNamePermission = addslashes($prmStrNamePermission);
	$prmTxtUrlPermission = addslashes($prmTxtUrlPermission);

	$sql = "UPDATE 
				permission 
			  SET 
				name='$prmStrNamePermission', 
				permission='$prmTxtUrlPermission' 
			  WHERE 
				codpermission=$prmCodPermission";

	mysql_query($sql, $dbi);
    
    // logger
    $data = "$prmStrNamePermission,$prmTxtUrlPermission";
    logger($_SESSION["codLogin"],"permission","update","$data");
}
?>
