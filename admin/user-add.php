<? include("../include/global.php"); ?>
<? include("../include/valida_login.php"); ?>
<? include("../include/user.php"); ?>
<? include("../include/permission.php"); ?>
<?
$varAction = $_REQUEST["hideaction"];
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
            addUser($varStrUserName, $varStrEmailUser, $varStrLoginUser, $varStrPasswordUser, $varCodPermission, $varIntStatusUser);
            header("location: user.php");
        } 
        else 
        {
            $varMensagem = "Please fill all fields required!";
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
            if(document.frm.name.value == "")   
            {
              alert("The field 'name' is required!");
              document.frm.nome.focus();
              return false;
            }
            else if(document.frm.email.value == "") 
            {
              alert("The field 'e-mail' is required!");
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
              document.frm.password.focus();
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
            <h2><? echo htmlentities("User - Add");?></h2>
            <ul class="botoes">
                <?if(validaPermissao(array("user"),$arrPermissao)=="1"){?>
                <li><a href="user.php"><img src="<?=$varCaminho;?>/images/admin/icons/format-justify-fill.gif" width="15" height="15" border="0" align="absmiddle"> List Users</a></li>
                <?}?>
                <?if(validaPermissao(array("permission"),$arrPermissao)=="1"){?>
                <li><a href="permission.php"><img src="<?=$varCaminho;?>/images/admin/icons/format-justify-fill.gif" width="15" height="15" border="0" align="absmiddle"> List Permissions</a></li>
                <?}?>
                <?if(validaPermissao(array("permission-add"),$arrPermissao)=="1"){?>
                <li><a href="permission-add.php"> <img src="<?=$varCaminho;?>/images/admin/icons/list-add.gif" width="14" height="14" border="0" align="absmiddle"><? echo htmlentities(" Add Permission");?></a></li>
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
                        <td width="100">Profile:</td>
                        <td>
                            <select name="permission">
                                <? echo comboPermission($varCodPermission); ?>
                            </select>
                        </td>
                    </tr>
                    <tr>
                        <td width="100">Name:</td>
                        <td><input type="text" name="name" style="width: 300px;" value="<? echo $varStrUserName; ?>" 
                            maxlength="255" autocomplete="off" onKeyPress="return(validaConteudo(event,this,'text'));" 
                            onKeyUp="saltaCampoForms(event,this,'text',255);" 
                            onBlur="validaConteudo(event,this,'text');" ></td>
                    </tr>
                    <tr>
                        <td width="100">E-mail:</td>
                        <td><input type="text" name="email" style="width: 300px;" value="<? echo $varStrEmailUser ?>" 
                            maxlength="255" autocomplete="off" onKeyPress="return(validaConteudo(event,this,'email'));" 
                            onKeyUp="saltaCampoForms(event,this,'email',255);" 
                            onBlur="formatCamp(this,'email');isEmail(this);"></td>
                    </tr>
                    <tr>
                        <td width="100">Login:</td>
                        <td><input type="text" name="login" style="width: 100px;" value="<? echo $varStrLoginUser; ?>" 
                            maxlength="15" autocomplete="off" onKeyPress="return(validaConteudo(event,this,'text_entry'));" 
                            onKeyUp="saltaCampoForms(event,this,'text_entry',15);" 
                            onBlur="validaConteudo(event,this,'text_entry');" ></td>
                    </tr>
                    <tr>
                        <td width="100">Password:</td>
                        <td><input type="password" name="password" style="width: 100px;" value="<? echo $varStrPasswordUser; ?>" 
                            maxlength="15" autocomplete="off" onKeyPress="return(validaConteudo(event,this,'text_entry'));" 
                            onKeyUp="saltaCampoForms(event,this,'text_entry',15);" 
                            onBlur="validaConteudo(event,this,'text_entry');" ></td>
                    </tr>
                    <?
                        $varEnabled = "checked";
                        $varDisabled = "";
                        if($varIntStatusUser=="0")
                        {
                            $varEnabled = "";
                            $varDisabled = "checked";
                        }
                    ?>
                    <tr>
                        <td width="100">Status</td>
                        <td><input name="status" type="radio" value="1" <? echo $varEnabled; ?>>
                        Enabled
                            <input name="status" type="radio" value="0" <? echo $varDisabled; ?>> 
                        Disabled </td>
                    </tr>
                    <tr>
                        <td colspan="2" align="center">
                            <input name="hideaction" type="hidden" id="hideaction" value="save">
                            <input name="save" type="submit" id="save" value="Submit">
                        </td>
                    </tr>
                </form>
            </table>
        <? include("../include/admin/rodape.php"); ?>
</body>
</html>
