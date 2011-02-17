<? include("../include/global.php"); ?>
<? include("../include/valida_login.php"); ?>
<? include("../include/user.php"); ?>
<? include("../include/permission.php"); ?>
<?
$varAction = $_REQUEST["hideaction"];
$varCodUser = $_SESSION["codLogin"];

switch($varAction)
{
	case "save":
		$varStrUserName = $_POST["name"];
		$varStrEmailUser = $_POST["email"];
		$varStrLoginUser = $_POST["login"];
		$varStrPasswordUser = $_POST["password"];
		$varCodPermission = $_POST["permission"];
		$varIntStatusUser = $_POST["status"];

        if($varStrUserName!="" && $varStrEmailUser!="" && $varStrLoginUser!="" && $varStrPasswordUser!="" && $varCodPermission!="")
        {
			updateUser($varCodUser, $varStrUserName, $varStrEmailUser, $varStrLoginUser, $varStrPasswordUser, $varCodPermission, "1");
			header("location: index.php");
		} 
        else 
        {
			$varMensagem = _("Please fill all fields required!");
		}
	break;
	default:
		if($varCodUser!="")
        {
			viewUser($varCodUser);
		} 
        else 
        {
			header("location: index.php");
		}
	break;
}
?>
<html>
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
    <title><? echo $titleSite; ?></title>
    <link href="<?=$varCaminho;?>/css/admin.css" rel="stylesheet" type="text/css" />
    <link href="<?=$varCaminho;?>/css/tablesorter-blue.css" rel="stylesheet" type="text/css" />
    <link rel="stylesheet" type="text/css" href="../css/menu/superfish.css" media="screen" />
    <script language="javascript" src="<?=$varCaminho;?>/scripts/admin.js"></script>
    <script language="javascript" src="<?=$varCaminho;?>/scripts/jquery.js"></script>
    <script language="javascript" src="<?=$varCaminho;?>/scripts/jquery.tablesorter.js"></script>
    <script language="javascript" src="<?=$varCaminho;?>/scripts/jquery.tablesorter.pager.js"></script>
    <script language="javascript" src="<?=$varCaminho;?>/scripts/menu/hoverIntent.js"></script>
    <script language="javascript" src="<?=$varCaminho;?>/scripts/menu/superfish.js"></script>
    <script language="javascript">
        $(document).ready(
            function() 
            { 
				$('ul.sf-menu').superfish();
			}
		);
        function validaCampos()
        {
            if(document.frm.name.value == "")	
            {
              alert("The field 'name' is required!");
              document.frm.nome.focus();
              return false;
            }
            else if(document.frm.email.value == "")	
            {
              alert("The field 'email' is required!");
              document.frm.email.focus();
              return false;
            }
            else if(document.frm.login.value == "")	
            {
              alert("The field 'login' is required!");
              document.frm.login.focus();
              return false;
            }
            else if(document.frm.password.value == "")	
            {
              alert("The field 'password' is required!");
              document.frm.senha.focus();
              return false;
            }
            else
            {
               return true;
            }

        }
    </script>
</head>

<body>
<? include("../include/admin/topo.php"); ?>
			<h2>About Me</h2>
			<table cellpadding="3" border="0" width="100%">
				<form name="frm" method="post" action="<? echo $_SERVER['PHP_SELF']; ?>" onSubmit="return(validaCampos());">
					<?
					if(isset($varMensagem)){
					?>
					<tr>
						<td colspan="2" class="alerta"><? echo $varMensagem; ?></td>
					</tr>
					<?
					}
					?>
					<tr>
						<td width="100"><?=_("Name:");?></td>
						<td>
                            <input type="text" name="name" style="width: 300px;" value="<? echo $varStrUserName; ?>" 
							    maxlength="30" autocomplete="off" onKeyPress="return(validaConteudo(event,this,'text'));" 
							    onKeyUp="saltaCampoForms(event,this,'text',30);" 
							    onBlur="validaConteudo(event,this,'text');" 
                            />
                        </td>
					</tr>
					<tr>
    					<td width="100"><?=_("Email:");?></td>
						<td>
                            <input type="text" name="email" style="width: 300px;" value="<? echo $varStrEmailUser; ?>" 
							    maxlength="30" autocomplete="off" onKeyPress="return(validaConteudo(event,this,'email'));" 
							    onKeyUp="saltaCampoForms(event,this,'email',30);" 
							    onFocus="removeCaracs(this,'email');" 
							    onBlur="formatCamp(this,'email');isEmail(this);" 
                            />
                        </td>
					</tr>
					<tr>
						<td width="100"><?=_("Login:");?></td>
						<td>
                            <input type="text" name="login" style="width: 100px;" value="<? echo $varStrLoginUser; ?>" 
							    maxlength="15" autocomplete="off" onKeyPress="return(validaConteudo(event,this,'text_entry'));" 
							    onKeyUp="saltaCampoForms(event,this,'text_entry',15);" 
							    onFocus="removeCaracs(this,'text_entry');" 
							    onBlur="validaConteudo(event,this,'text_entry');" 
                            />
                        </td>
					</tr>
					<tr>
						<td width="100"><?=_("Password:");?></td>
						<td>
                            <input type="password" name="password" style="width: 100px;" value="<? echo $varStrUserPassword; ?>" 
						    	maxlength="15" autocomplete="off" onKeyPress="return(validaConteudo(event,this,'text_entry'));" 
						    	onKeyUp="saltaCampoForms(event,this,'text_entry',15);" 
						    	onFocus="removeCaracs(this,'text_entry');" 
						    	onBlur="validaConteudo(event,this,'text_entry');" 
                            />
                       </td>
					</tr>
					<tr>
						<td colspan="2" align="center">
						    <input name="permission" type="hidden" id="permission" value="<? echo $varCodPermission; ?>">
    						<input name="status" type="hidden" id="status" value="<? echo $varIntStatusUser; ?>">
	    					<input name="hideaction" type="hidden" id="hideaction" value="save">
		    				<input name="cod" type="hidden" id="cod" value="<? echo $varCodUser; ?>">
			    			<input name="save" type="submit" id="save" value="<?=_('Submit');?>">
                        </td>
					</tr>
				</form>
			</table>
		<? include("../include/admin/rodape.php"); ?>
</body>
</html>
