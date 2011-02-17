<? include("../include/global.php"); ?>
<? include("../include/valida_login.php"); ?>
<? include("../include/user.php"); ?>
<? include("../include/permission.php"); ?>
<?
$varAction = $_REQUEST["hideaction"];
$varCodUser = $_REQUEST["cod"];

switch($varAction)
{
    case "save":
        $varStrUserName = $_POST["name"];
        $varStrEmailUser = $_POST["email"];
        $varStrLoginUser = $_POST["login"];
        $varStrPasswordUser = $_POST["password"];
        $varCodPermission = $_POST["permission"];
        $varIntStatusUser = $_POST["status"];
        
        if($varStrUserName!="" && $varStrEmailUser!="" && $varStrLoginUser!="" && $varStrPasswordUser!="" && $varCodPermission!="" && 
           $varIntStatusUser!="")
        {
            updateUser($varCodUser,$varStrUserName,$varStrEmailUser,$varStrLoginUser,$varStrPasswordUser,$varCodPermission,$varIntStatusUser);
            header("location: user.php");
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
            header("location: user.php");
        }
    break;
}
?>
<html>
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
    <title><? echo $titleSite; ?></title>
    <link href="../css/admin.css" rel="stylesheet" type="text/css" />
    <link rel="stylesheet" type="text/css" href="<?=$varCaminho;?>/css/menu/superfish.css" media="screen" />
    <script language="javascript" src="<?=$varCaminho;?>/scripts/admin.js"></script>
    <script language="javascript" src="<?=$varCaminho;?>/scripts/jquery.js"></script>
    <script language="javascript" src="<?=$varCaminho;?>/scripts/menu/hoverIntent.js"></script>
    <script language="javascript" src="<?=$varCaminho;?>/scripts/menu/superfish.js"></script>
    <script language="javascript" src="<?=$varCaminho;?>/scripts/valida/validate.js"></script>
    <script language="javascript" src="<?=$varCaminho;?>/scripts/valida/validForm.js"></script>
    <script language="javascript">
        // carrega o menu
        $(document).ready(
            function() 
            { 
                $('ul.sf-menu').superfish();
            }
        );
        
        // valida o preenchimento dos campos
        function validaCampos()
        {
            if(document.frm.nome.value == "")   
            {
              alert("O campo Nome precisa ser preenchido!");
              document.frm.nome.focus();
              return false;
            }
            else if(document.frm.email.value == "") 
            {
              alert("O campo E-mail precisa ser preenchido!");
              document.frm.email.focus();
              return false;
            }
            else if(document.frm.login.value == "") 
            {
              alert("O campo Login precisa ser preenchido!");
              document.frm.login.focus();
              return false;
            }
            else if(document.frm.senha.value == "") 
            {
              alert("O campo Senha precisa ser preenchido!");
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
            <h2><?=_("User - Edit");?></h2>
            <ul class="botoes">
                <?if(validaPermissao(array("user"),$arrPermissao)=="1"){?>
                <li><a href="user.php"><img src="<?=$varCaminho;?>/images/admin/icons/format-justify-fill.gif" width="15" height="15" border="0" align="absmiddle"> <?=_("List Users");?></a></li>
                <?}?>
                <?if(validaPermissao(array("permission"),$arrPermissao)=="1"){?>
                <li><a href="permission.php"><img src="<?=$varCaminho;?>/images/admin/icons/format-justify-fill.gif" width="15" height="15" border="0" align="absmiddle"> <?=_("List Pemissions");?></a></li>
                <?}?>
                <?if(validaPermissao(array("permission-add"),$arrPermissao)=="1"){?>
                <li><a href="permission-add.php"> <img src="<?=$varCaminho;?>/images/admin/icons/list-add.gif" width="14" height="14" border="0" align="absmiddle"> <?=_("Add Permission");?></a></li>
                <?}?>
            </ul>
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
                        <td width="100"><?=_("Profile:");?></td>
                        <td>
                            <select name="permission">
                                <? echo comboPermission($varCodPermission); ?>
                            </select>
                        </td>
                    </tr>
                    <tr>
                        <td width="100"><?=_("Name:");?></td>
                        <td><input type="text" name="name" style="width: 300px;" value="<? echo $varStrUserName; ?>" 
                            maxlength="255" autocomplete="off" 
                            onKeyPress="return(validaConteudo(event,this,'text'));" 
                            onKeyUp="saltaCampoForms(event,this,'text',255);" 
                            onBlur="validaConteudo(event,this,'text');" ></td>
                    </tr>
                    <tr>
                        <td width="100"><?=_("E-mail:");?></td>
                        <td><input type="text" name="email" style="width: 300px;" value="<? echo $varStrEmailUser ?>" 
                            maxlength="255" autocomplete="off" onKeyPress="return(validaConteudo(event,this,'email'));" 
                            onKeyUp="saltaCampoForms(event,this,'email',255);" 
                            onBlur="formatCamp(this,'email');isEmail(this);"></td>
                    </tr>
                    <tr>
                        <td width="100"><?=_("Login:");?></td>
                        <td><input type="text" name="login" style="width: 100px;" value="<? echo $varStrLoginUser; ?>" 
                            maxlength="15" autocomplete="off" onKeyPress="return(validaConteudo(event,this,'text_entry'));" 
                            onKeyUp="saltaCampoForms(event,this,'text_entry',15);" 
                            onBlur="validaConteudo(event,this,'text_entry');" ></td>
                    </tr>
                    <tr>
                        <td width="100"><?=_("Password:");?></td>
                        <td><input type="password" name="password" style="width: 100px;" value="<? echo $varStrUserPassword; ?>" 
                            maxlength="15" autocomplete="off" onKeyPress="return(validaConteudo(event,this,'text_entry'));" 
                            onKeyUp="saltaCampoForms(event,this,'text_entry',15);" 
                            onBlur="validaConteudo(event,this,'text_entry');" ></td>
                    </tr>
                    <tr>
                        <td width="100"><?=_("Status");?></td>
                        <td>
                            <input name="status" type="radio" value="1" <?if($varIntUserStatus=="1"){echo "checked";}?>> Enabled
                            <input name="status" type="radio" value="0" <?if($varIntUserStatus=="0"){echo "checked";}?>> Disabled 
                        </td>
                    </tr>
                    <tr>
                        <td colspan="2" align="center">
                        <input name="hideaction" type="hidden" id="hideaction" value="save">
                        <input name="cod" type="hidden" id="cod" value="<? echo $varCodUser; ?>">
                        <input name="save" type="submit" id="save" value="<?=_('Save');?>"></td>
                    </tr>
                </form>
            </table>
        <? include("../include/admin/rodape.php"); ?>
</body>
</html>
