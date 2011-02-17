<? include("../include/global.php"); ?>
<? include("../include/valida_login.php"); ?>
<? include("../include/content.php"); ?>
<?
$varAction = $_REQUEST["hideaction"];
$varCodContent = $_REQUEST["cod"];

switch($varAction)
{
    case "save":
        $varIdMenu = $_POST["menu"];
        $varStrDescription  = $_POST["description"];
        $varStrKeywords = $_POST["keywords"];
        $varStrTitle = $_POST["title"];
        $varTxtContent = $_POST["content"];

        if($varTxtContent!="")
        {
            updateRecord($varCodContent,$varIdMenu,$varStrKeywords,$varStrDescription,$varStrTitle,$varTxtContent);
            header("location: content.php");
        } 
        else
        {
            $varMensagem = _("Please fill all fields required!");
        }
    break;
    default:
        if($varCodContent!="")
        {
            viewRecord($varCodContent);
        } 
        else 
        {
            header("location: content.php");
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
    <script language="javascript" src="<?=$varCaminho;?>/scripts/ckeditor/ckeditor.js"></script>
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
            <h2><?=_("Content - Edit");?></h2>
            <ul class="botoes">
                <?if(validaPermissao(array("content"),$arrPermissao)=="1"){?>
                <li><a href="content.php"><img src="<?=$varCaminho;?>/images/admin/icons/format-justify-fill.gif" width="15" height="15" border="0" align="absmiddle"> <?=_("List Content");?></a></li>
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
                        <td width="100" valign="top">Menu:</td>
                        <td>
                            <select name="menu">
                                <? echo comboMenu($varIdMenu);?>
                            </select>
                        </td>
                    </tr>
                    <tr><td colspan="2">&nbsp;</td></tr>
                    <tr>
                        <td width="100"><?=_("Keywords:");?></td>
                        <td>
                            <input type="text" name="keywords" style="width: 300px;" value="<?=$varStrKeywords;?>" 
                                autocomplete="off" onKeyPress="return(validaConteudo(event,this,'text'));" 
                                onBlur="validaConteudo(event,this,'text');" 
                            />
                        </td>
                    </tr>
                    <tr>
                        <td width="100"><?=_("Description:");?></td>
                        <td>
                            <input type="text" name="description" style="width: 300px;" value="<?=$varStrDescription;?>" 
                                autocomplete="off" onKeyPress="return(validaConteudo(event,this,'text'));" 
                                onBlur="validaConteudo(event,this,'text');" 
                            />
                        </td>
                    </tr>
                    <tr><td colspan="2">&nbsp;</td></tr>
                    <tr>
                        <td width="100"><?=_("Title:");?></td>
                        <td>
                            <input type="text" name="title" style="width: 300px;" value="<?=$varStrTitle;?>" 
                                autocomplete="off" onKeyPress="return(validaConteudo(event,this,'text'));" 
                                onBlur="validaConteudo(event,this,'text');" 
                            />
                        </td>
                    </tr>
                    <tr>
                        <td width="100" valign="top">Content:</td>
                        <td>
                            <textarea cols="145" rows="5" id="content" name="content"><?=$varTxtContent;?></textarea>
                            <script type="text/javascript">
                                CKEDITOR.replace( 'content',{
                                    skin : 'office2003'
                                });
                            </script>
                        </td>
                    </tr>
                    <tr>
                        <td colspan="2" align="center">
                        <input name="hideaction" type="hidden" id="hideaction" value="save">
                        <input name="cod" type="hidden" id="cod" value="<? echo $varCodContent; ?>">
                        <input name="save" type="submit" id="save" value="<?=_('Submit');?>"></td>
                    </tr>
                </form>
            </table>
        <? include("../include/admin/rodape.php"); ?>
</body>
</html>
