<? include("../include/global.php"); ?>
<? include("../include/valida_login.php"); ?>
<? include("../include/permission.php"); ?>
<?
$varAction = $_REQUEST["hideaction"];
$varCodPermission = $_REQUEST["cod"];
switch($varAction)
{
	case "view":
		if($varCodPermission!="")
        {
            // return permission data
			viewPermission($varCodPermission);
		
			// list fix
			$varArrayIn = array("-", ".php","|");
			$varArrayOut	= array(" ", "<br/>","-");
			$varTxtPermission = str_replace($varArrayIn, $varArrayOut, $varTxtPermission);
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
    </script>
</head>
<body>
<? include("../include/admin/topo.php"); ?>
			<h2><?=_("Permission - View");?></h2>
			<ul class="botoes">
                <?if(validaPermissao(array("permission-add"),$arrPermissao)=="1"){?>
				<li><a href="permission-add.php"><img src="<?=$varCaminho;?>/images/admin/icons/list-add.gif" width="14" height="14" border="0" align="absmiddle"> <?=_("Add Permission");?></a></li>
                <?}?>
                <?if(validaPermissao(array("user"),$arrPermissao)=="1"){?>
				<li><a href="user.php"><img src="<?=$varCaminho;?>/images/admin/icons/format-justify-fill.gif" width="15" height="15" border="0" align="absmiddle"> <?=_("List Users");?></a></li>
                <?}?>
                <?if(validaPermissao(array("user-add"),$arrPermissao)=="1"){?>
				<li><a href="user-add.php"><img src="<?=$varCaminho;?>/images/admin/icons/list-add.gif" width="14" height="14" border="0" align="absmiddle"> <?=_("Add User");?></a></li>
                <?}?>
			</ul>
			<table cellpadding="3" border="0" width="100%">
				<form name="frm" method="post" action="<? echo $_SERVER['PHP_SELF']; ?>">
					<tr>
						<td width="100"><?=_("Name:");?></td>
						<td><?=$varStrNamePermission;?></td>
					</tr>
					<tr>
						<td valign="top"><?=_("Permission:");?></td>
						<td><?=$varTxtPermission;?></td>
					</tr>
					<tr>
						<td colspan="2" align="center">
							<input name="hideaction" type="hidden" id="hideaction" value="">
							<input name="cod" type="hidden" id="cod" value="<? echo $varCodPermissao; ?>">
							<input name="edit" type="button" id="edit" value="<?=_('Edit');?>" 
                                onClick="executar('editar','<? echo $varCodPermission; ?>','permission-edit.php')"> 
							<input name="back" type="button" id="back" value="<?=_('Back');?>" onClick="executar('','','permission.php')">
						</td>
					</tr>
				</form>
			</table>
		<? include("../include/admin/rodape.php"); ?>
</body>
</html>
