<? include("../include/global.php"); ?>
<? include("../include/valida_login.php"); ?>
<? include("../include/navigation.php"); ?>
<?
$varAction = $_REQUEST["hideaction"];
$varCodMenu = $_REQUEST["cod"];

switch($varAction)
{
    case "save":
        $varStrName = $_POST["name"];

        if($varStrName!="")
        {
            updateRecord($varCodMenu, $varStrName);
            header("location: navigation.php");
        } 
        else
        {
            $varMensagem = _("Please fill all fields required!");
        }
    break;
    default:
        if($varCodMenu!="")
        {
            viewRecord($varCodMenu);
        } 
        else 
        {
            header("location: navigation.php");
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
                <?if(validaPermissao(array("navigation"),$arrPermissao)=="1"){?>
                <li><a href="navigation.php"><img src="<?=$varCaminho;?>/images/admin/icons/format-justify-fill.gif" width="15" height="15" border="0" align="absmiddle"> <?=_("List Menus");?></a></li>
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
                            <input type="text" name="name" style="width: 300px;" value="<? echo $varStrMenu; ?>" 
                                autocomplete="off" 
                                onKeyPress="return(validaConteudo(event,this,'text'));" 
                                onBlur="validaConteudo(event,this,'text');" 
                            />
                        </td>
                    </tr>
                    <tr>
                        <td colspan="2" align="center">
                        <input name="hideaction" type="hidden" id="hideaction" value="save">
                        <input name="cod" type="hidden" id="cod" value="<? echo $varCodMenu; ?>">
                        <input name="save" type="submit" id="save" value="<?=_('Submit');?>"></td>
                    </tr>
                </form>
            </table>
        <? include("../include/admin/rodape.php"); ?>
</body>
</html>
