<?

/**
 * Retorna listagem dos usuários do sistema.
 *
 * @author: alexandre cavedon
 * @date: 2008-01-28
**/
function listUser()
{
    global $dbi;
    
    $sql = "SELECT DISTINCT 
                u.coduser,
                u.name as name,
                u.status as status, 
                p.name as permission 
            FROM 
                user u,
                permission p 
            WHERE 
                u.codpermission=p.codpermission 
            ORDER BY 
                u.name";

    
    $varResult = mysql_query($sql,$dbi);
    
    $varContent  = "<thead>\n";
    $varContent .= "    <tr>\n";
    $varContent .= "        <th align=\"center\" width=\"2%\">\n";
    $varContent .= "            <a href=\"javascript:selecionaTodos();\">\n";
    $varContent .= "                <img src=\"../images/admin/ico_marcar.gif\" border=\"0\" />\n";
    $varContent .= "            </a>\n";
    $varContent .= "        </th>\n";
    $varContent .= "        <th align=\"center\">Name</th>\n";
    $varContent .= "        <th align=\"center\" width=\"10%\">Permission</th>\n";
    $varContent .= "        <th align=\"center\" width=\"10%\">Status</th>\n";
    $varContent .= "        <th align=\"center\" width=\"10%\">Options</th>\n";
    $varContent .= "    </tr>\n";
    $varContent .= "</thead>\n";
    $varContent .= "<input name=\"hideaction\" type=\"hidden\" id=\"hideaction\" />\n";
    $varContent .= "<input name=\"cod\" type=\"hidden\" id=\"cod\" />\n";
    $varContador = 0;
    
    $varContent .= "<tbody>\n";
    
    while(list($varCodUser,$varStrUserName,$varIntUserStatus,$varStrPermissionName)=mysql_fetch_row($varResult))
    {
        $varBgColor = ($varContador%2) ? "#ffffcc" : "#ffffff";
        $varStatus = ($varIntUserStatus==0) ? "Disabled" : "Enabled";
        $varContent .= "<tr bgcolor=\"$varBgColor\">\n";
        $varContent .= "    <td align=\"center\">\n";
        $varContent .= "        <input type=\"checkbox\" name=\"selected[]\" value=\"$varCodUser\" />\n";
        $varContent .= "    </td>\n";
        $varContent .= "    <td>\n";
        $varContent .= "        <strong>\n";
        $varContent .= "            <a href=\"javascript:executar('view','$varCodUser','user-view.php')\">\n";
        $varContent .= "                $varStrUserName\n";
        $varContent .= "            </a>\n";
        $varContent .= "        </strong>\n";
        $varContent .= "    </td>\n";
        $varContent .= "    <td align=\"center\">$varStrPermissionName</td>\n";
        $varContent .= "    <td align=\"center\">$varStatus</td>\n";
        $varContent .= "    <td align=\"center\" class=\"nobr\">\n";
        $varContent .= "        <a href=\"javascript:executar('edit','$varCodUser','user-edit.php')\" class=\"edtButton\">\n";
        $varContent .= "            <img src=\"../images/admin/icons/edit.png\" width=\"16\" height=\"15\" border=\"0\" /> \n";
        $varContent .= "            Edit\n";
        $varContent .= "        </a>\n";
        $varContent .= "    </td>\n";
        $varContent .= "</tr>\n";
        $varContador++;
    }
    $varContent .= "</tbody>\n";
    $varContent .= "<tr>\n";
    $varContent .= "    <td height=\"30\" colspan=\"5\" class=\"nobr\">\n";
    $varContent .= "        <img src=\"../images/admin/ico_selecionados.gif\" width=\"38\" height=\"22\" border=\"0\" />\n";
    $varContent .= "        <a href=\"javascript: executar('exclude','','user-del.php','You sure about this?')\">\n";
    $varContent .= "            <img src=\"../images/admin/icons/user-trash.gif\" width=\"16\" height=\"16\" border=\"0\" />\n";
    $varContent .= "            Del selected\n";
    $varContent .= "        </a>\n";
    $varContent .= "    </td>\n";
    $varContent .= "</tr>\n";
    
    return $varContent;
}


/**
 * Exclui usuário do sistema.
 *
 * @author: alexandre cavedon
 * @date: 2008-01-28
**/
function delUser($prmCodUser)
{
    global $dbi;

    // return user's data
    $sqlLogger = "SELECT 
                    name,
                    email,
                    login,
                    status
                  FROM 
                    user 
                  WHERE 
                    coduser=".$prmCodUser;
    $varResultLogger = mysql_query($sqlLogger,$dbi);
    list($varStrNameUser,$varStrEmailUser,$varStrLoginUser,$varIntStatusUser)=mysql_fetch_row($varResultLogger);
    $data = "$varStrNameUser,$varStrEmailUser,$varStrLoginUser,$varIntStatusUser";

    // delete user
    $sql = "DELETE FROM 
                user 
            WHERE 
                coduser=$prmCodUser";
    
    mysql_query($sql, $dbi);
    
    // logger
    logger($_SESSION["codLogin"],"user","del","$data");
}


/**
 * Adiciona usuário no sistema.
 *
 * @author: alexandre cavedon
 * @date: 2008-01-28
**/
function addUser($prmStrUserName,$prmStrEmailUser,$prmStrUserLogin,$prmStrUserPassword,$prmCodPermission,$prmIntUserStatus)
{
    global $dbi;
    
    $prmStrUserName = addslashes($prmStrUserName);
    $prmStrEmailUser = addslashes($prmStrEmailUser);
    $prmStrUserLogin = addslashes($prmStrUserLogin);
    $prmStrUserPassword = addslashes($prmStrUserPassword);
    $prmCodPermission = addslashes($prmCodPermission);
    $prmIntUserStatus = addslashes($prmIntUserStatus);

    $sql ="INSERT INTO 
                user(
                    name,
                    email,
                    login,
                    password,
                    codpermission,
                    status) 
           VALUES(
              '$prmStrUserName',
              '$prmStrEmailUser',
              '$prmStrUserLogin',
              '$prmStrUserPassword',
              '$prmCodPermission',
              '$prmIntUserStatus')";

    mysql_query($sql, $dbi);
   
    // logger
    if(mysql_insert_id()!="")
    {
        $data = "$prmStrUserName,$prmStrEmailUser,$prmStrUserLogin,$prmStrUserPassword,$prmCodPermission,$prmIntUserStatus";
        logger($_SESSION["codLogin"],"user","add","$data");
    }

}


/**
 * Retorna dados do usuário para edição/exibição.
 *
 * @author: alexandre cavedon
 * @date: 2008-01-28
**/
function viewUser($prmCodUser)
{
    global $dbi,$varStrUserName,$varStrEmailUser,$varStrLoginUser,$varStrUserPassword,$varCodPermission,$varIntUserStatus,$varStrPermissionName;
    
    $sql = "SELECT DISTINCT 
                u.name,
                u.email,
                u.login,
                u.password,
                u.codpermission,
                u.status,
                p.name  
            FROM 
                user u, 
                permission p 
            WHERE 
                p.codpermission = u.codpermission 
            AND 
                u.coduser=$prmCodUser";

    $varResult = mysql_query($sql, $dbi);
    $varCount = mysql_num_rows($varResult);
    
    if($varCount>0)
    {
        list($varStrUserName,$varStrEmailUser,$varStrLoginUser,$varStrUserPassword,$varCodPermission,$varIntUserStatus,$varStrPermissionName) = mysql_fetch_row($varResult);
        
        $varStrUserName = stripslashes($varStrUserName);
        $varStrEmailUser = stripslashes($varStrEmailUser);
        $varStrLoginUser =  stripslashes($varStrLoginUser);
        $varStrUserPassword = decrypt(stripslashes($varStrUserPassword));
        $varCodPermission =  stripslashes($varCodPermission);
        $varIntUserStatus = stripslashes($varIntUserStatus);
        $varStrPermissionName = stripslashes($varStrPermissionName);
    }
}


/**
 * Atualiza dados de um usuário
 *
 * @author: alexandre cavedon
 * @date: 2008-01-28
**/
function updateUser($prmCodUser,$prmStrUserName,$prmStrEmailUser,$prmStrUserLogin,$prmStrUserPassword,$prmCodPermission,$prmIntUserStatus)
{
    global $dbi;
    
    $prmStrUserName = addslashes($prmStrUserName);
    $prmStrEmailUser = addslashes($prmStrEmailUser);
    $prmStrUserLogin = addslashes($prmStrUserLogin);
    $prmStrUserPassword = addslashes($prmStrUserPassword);
    $prmCodPermission = addslashes($prmCodPermission);
    $prmIntUserStatus = addslashes($prmIntUserStatus);
    
    $sql = "UPDATE 
                user 
            SET 
                name='$prmStrUserName', 
                email='$prmStrEmailUser', 
                login='$prmStrUserLogin', 
                password='$prmStrUserPassword', 
                codpermission='$prmCodPermission', 
                status='$prmIntUserStatus' 
            WHERE 
                coduser=$prmCodUser";

    mysql_query($sql, $dbi);
    
    // logger
    $data = "$prmStrUserName,$prmStrEmailUser,$prmStrUserLogin,$prmStrUserPassword,$prmCodPermission,$prmIntUserStatus";
    logger($_SESSION["codLogin"],"user","update","$data");
}
?>
