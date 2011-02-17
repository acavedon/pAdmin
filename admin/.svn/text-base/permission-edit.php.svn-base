<? include("../include/global.php"); ?>
<? include("../include/valida_login.php"); ?>
<? include("../include/permission.php"); ?>
<?
$varAction = $_REQUEST["hideaction"];
$varCodPermission = $_REQUEST["cod"];

switch($varAction)
{
    case "save":
        $varStrNamePermission = $_POST["name"];
        $varTxtPermission = $_POST["url"];

        if($varStrNamePermission!="" && sizeof($varTxtPermission)>0)
        {
            $varTxtUrl = "";
            
            for($varIntContador=0;$varIntContador<sizeof($varTxtPermission);$varIntContador++)
            {
                $varTxtUrl .= "|".$varTxtPermission[$varIntContador];
            }
            updatePermission($varCodPermission, $varStrNamePermission, $varTxtUrl);
            header("location: permission.php");
        } 
        elseif($varStrNamePermission!="" && sizeof($varTxtPermission)==0)
        {
            $varTxtUrl = "index.php|login.php";
            
            updatePermission($varCodPermission, $varStrNamePermission, $varTxtUrl);
            header("location: permission.php");
        }
        else
        {
            $varMensagem = _("Please fill all fields required!");
        }
    break;
    default:
        if($varCodPermission!="")
        {
            viewPermission($varCodPermission);
            $varTxtPermission = explode("|",$varTxtPermission);
        } 
        else 
        {
            header("location: permission.php");
        }
    break;
}
?>
<html>
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
    <title><? echo $titleSite; ?></title>
    <link href="<?=$varCaminho;?>/css/admin.css" rel="stylesheet" type="text/css" />
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
		)
        
        // valida o preenchimento dos campos
        function validaCampos()
        {
            if(document.frm.name.value == "")   
            {
              alert("The field 'name' is required!");
              document.frm.name.focus();
              return false;
            }
            else
            {
               return true;
            }
        }
    </script>
</head>

<body onload="document.getElementsByTagName('input')[0].focus();">
<? include("../include/admin/topo.php"); ?>
            <h2><?=_("Permission - Edit");?></h2>
            <ul class="botoes">
                <?if(validaPermissao(array("permission"),$arrPermissao)=="1"){?>
                <li><a href="permission.php"><img src="<?=$varCaminho;?>/images/admin/icons/format-justify-fill.gif" width="15" height="15" border="0" align="absmiddle"> <?=_("List Permission");?></a></li>
                <?}?>
                <?if(validaPermissao(array("user"),$arrPermissao)=="1"){?>
                <li><a href="user.php"><img src="<?=$varCaminho;?>/images/admin/icons/format-justify-fill.gif" width="15" height="15" border="0" align="absmiddle"> <?=_("List Users");?></a></li>
                <?}?>
                <?if(validaPermissao(array("user-add"),$arrPermissao)=="1"){?>
                <li><a href="user-add.php"><img src="<?=$varCaminho;?>/images/admin/icons/list-add.gif" width="14" height="14" border="0" align="absmiddle"> <?=_("Add User");?></a></li>
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
                        <td width="100"><?=_("Name:");?></td>
                        <td>
                            <input type="text" name="name" style="width: 300px;" value="<? echo $varStrNamePermission; ?>" 
                                maxlength="20" autocomplete="off" 
                                onKeyPress="return(validaConteudo(event,this,'text'));" 
                                onKeyUp="saltaCampoForms(event,this,'text',20);" 
                                onBlur="validaConteudo(event,this,'text');" 
                            />
                        </td>
                    </tr>
                    <tr>
                        <td width="100" valign="top"><?=_("Permission:");?> <a href="javascript:selecionaTodos();"><img src="../images/admin/ico_marcar.gif" width="15" height="14" border="0"></a> </td>
                        <td><?=listFiles("admin",5,$varTxtPermission);?></td>
                    </tr>
                    <tr>
                        <td colspan="2" align="center">
                        <input name="hideaction" type="hidden" id="hideaction" value="save">
                        <input name="cod" type="hidden" id="cod" value="<? echo $varCodPermission; ?>">
                        <input name="save" type="submit" id="save" value="<?=_('Submit');?>"></td>
                    </tr>
                </form>
            </table>
        <? include("../include/admin/rodape.php"); ?>
</body>
</html>
