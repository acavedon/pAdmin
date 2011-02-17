<? include("../include/global.php"); ?>
<? include("../include/valida_login.php"); ?>
<? include("../include/content.php"); ?>
<?
$varAction = $_REQUEST["hideaction"];
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
            addRecord($varIdMenu,$varStrKeywords,$varStrDescription,$varStrTitle,$varTxtContent);
            header("location: content.php");
        } 
        else 
        {
            $varMensagem = _("Please fill all fields required!");
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
    <script language="javascript" src="<?=$varCaminho;?>/scripts/ckeditor/ckeditor.js"></script>
    <script language="javascript">
        $(document).ready(
            function() 
            { 
				$('ul.sf-menu').superfish();
			}
		);
    </script>
</head>

<body>
<? include("../include/admin/topo.php"); ?>
			<h2>Content</h2>
            <form name="frm" method="post" action="<? echo $_SERVER['PHP_SELF']; ?>" onSubmit="return(validaCampos());">
                <table cellpadding="3" border="0" width="100%">
                    <?if(isset($varMensagem)){?>
                    <tr>
                        <td colspan="2" class="alerta"><?=$varMensagem;?></td>
                    </tr>
                    <?}?>
                    <tr>
                        <td width="100" valign="top">Menu:</td>
                        <td>
                            <select name="menu">
                                <? echo comboMenu();?>
                            </select>
                        </td>
                    </tr>
                    <tr><td colspan="2">&nbsp;</td></tr>
                    <tr>
                        <td width="100"><?=_("Keywords:");?></td>
                        <td>
                            <input type="text" name="keywords" style="width: 300px;" value="<? echo $_REQUEST["keywords"]; ?>" 
                                maxlength="255" autocomplete="off" onKeyPress="return(validaConteudo(event,this,'text'));" 
                                onBlur="validaConteudo(event,this,'text');" 
                            />
                        </td>
                    </tr>
                    <tr>
                        <td width="100"><?=_("Description:");?></td>
                        <td>
                            <input type="text" name="description" style="width: 300px;" value="<? echo $_REQUEST["description"]; ?>" 
                                maxlength="255" autocomplete="off" onKeyPress="return(validaConteudo(event,this,'text'));" 
                                onBlur="validaConteudo(event,this,'text');" 
                            />
                        </td>
                    </tr>
                    <tr><td colspan="2">&nbsp;</td></tr>
                    <tr>
                        <td width="100"><?=_("Title:");?></td>
                        <td>
                            <input type="text" name="title" style="width: 300px;" value="<? echo $_REQUEST["title"]; ?>" 
                                maxlength="255" autocomplete="off" onKeyPress="return(validaConteudo(event,this,'text'));" 
                                onBlur="validaConteudo(event,this,'text');" 
                            />
                        </td>
                    </tr>
                    <tr>
                        <td width="100" valign="top">Content:</td>
                        <td>
                            <textarea cols="145" rows="5" id="content" name="content"></textarea>
                            <script type="text/javascript">
                                CKEDITOR.replace( 'content',{
                                    fullPage : false,
                                    skin : 'office2003'
                                });
                            </script>
                        </td>
                    </tr>
                    <tr>
                        <td colspan="2" align="center">
                            <input name="hideaction" type="hidden" id="hideaction" value="save">
                            <input name="save" type="submit" id="save" value="<?=_('save');?>">
                        </td>
                    </tr>
                </table>
            </form>
<? include("../include/admin/rodape.php"); ?>
</body>
</html>
