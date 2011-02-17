<?

/**
 * Autentica Usuario no sistema
 * @param $prmLogin $prmSenha
 * @Author: Alexandre Cavedon
 * @Date:
 *
 * Codigo reorganizado por Luiz Fred. Gaertner 
 * @Date: 2008-01-28
 **/

function login($prmLogin,$prmSenha)
{
	global $dbi;
	
	$prmLogin = addslashes($prmLogin);
	$prmSenha = addslashes($prmSenha);
	
	$sql = "SELECT 
				coduser,
                name, 
				password 
			FROM 
				user 
			WHERE 
				login='$prmLogin' 
			AND 
				status=1";

    $varResult = mysql_query($sql, $dbi);
	$varExiste = mysql_num_rows($varResult);
	
	if($varExiste==0)
	{
		$msgUserError = htmlentities("User not found.");
		$varContent = $msgUserError;
	} 
	else 
	{
		while(list($varCodUsuario,$varStrUserName,$varStrSenhaUsuario)=mysql_fetch_row($varResult))
		{
			$varStrUserName = stripslashes($varStrUserName);
            $varStrSenhaUsuario = stripslashes($varStrSenhaUsuario);

			if($prmSenha==$varStrSenhaUsuario)
			{
				$_SESSION["codLogin"] = $varCodUsuario;
                $_SESSION["name"] = $varStrUserName;

                // logger
                $date = date('l jS \of F Y h:i:s A'); 
                $data = $_SESSION["name"].", $date";
                logger($_SESSION["codLogin"],"login","-","$data");
                
                header("location: index.php");
			} 
			else 
			{
				$msgSenhaError = htmlentities("Your password are incorrect!");
				$varContent = $msgSenhaError;
			}
		}
	}

	return $varContent;
}
?>
