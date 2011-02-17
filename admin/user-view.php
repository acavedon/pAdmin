<? include("../include/global.php"); ?>
<? include("../include/valida_login.php"); ?>
<? include("../include/user.php"); ?>
<? include("../include/permission.php"); ?>
<?
$varAction = $_REQUEST["hideaction"];
$varCodUser = $_REQUEST["cod"];

switch($varAction)
{
    case "view":
        if($varCodUser!="")
        {
            viewUser($varCodUser);
            $varStrUserPassword = "********";
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
    <title><? echo $titleSite; ?></title>
    <meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
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
            <h2><?=_("User - View");?></h2>
            <ul class="botoes">
                <?if(validaPermissao(array("usuario-adicionar"),$arrPermissao)=="1"){?>
                <li><a href="usuario-adicionar.php"><img src="<?=$varCaminho;?>/images/admin/icons/list-add.gif" width="14" height="14" border="0" align="absmiddle"> <?=_("User Add");?></a></li>
                <?}?>
                <?if(validaPermissao(array("permissao"),$arrPermissao)=="1"){?>
                <li><a href="permissao.php"><img src="<?=$varCaminho;?>/images/admin/icons/format-justify-fill.gif" width="15" height="15" border="0" align="absmiddle"> <?=_("Permission List");?></a> </li>
                <?}?>
                <?if(validaPermissao(array("permissao-adicionar"),$arrPermissao)=="1"){?>
                <li><a href="permissao-adicionar.php"><img src="<?=$varCaminho;?>/images/admin/icons/list-add.gif" width="14" height="14" border="0" align="absmiddle"> <?=_("Permission Add");?></a></li>
                <?}?>
            </ul>
            <table cellpadding="3" border="0" width="100%">
                <form name="frm" method="post" action="<? echo $_SERVER['PHP_SELF']; ?>">
                    <tr>
                        <td width="100"><?=_("Profile:");?></td>
                        <td><? echo $varStrPermissionName; ?></td>
                    </tr>
                    <tr>
                        <td><?=_("Name:");?></td>
                        <td><? echo $varStrUserName; ?></td>
                    </tr>
                    <tr>
                        <td><?=_("E-mail:");?></td>
                        <td><? echo $varStrEmailUser; ?></td>
                    </tr>
                    <tr>
                        <td><?=_("Login:");?></td>
                        <td><? echo $varStrLoginUser; ?></td>
                    </tr>
                    <tr>
                        <td><?=_("Password:");?></td>
                        <td><? echo $varStrUserPassword; ?></td>
                    </tr>
                    <tr>
                        <td><?=_("Status:");?></td>
                        <td><? echo ($varIntUserStatus==0) ? "Disabled" : "Enabled"; ?></td>
                    </tr>
                    <tr>
                        <td colspan="2" align="center">
                            <input name="hideaction" type="hidden" id="hideaction" value="">
                            <input name="cod" type="hidden" id="cod" value="">
                            <input name="edit" type="button" id="edit" value="<?=_('Edit');?>" onClick="executar('edit','<? echo $varCodUser; ?>','user-edit.php')"> 
                            <input name="back" type="button" id="back" value="<?=_('Back');?>" onClick="executar('','','user.php')">
                        </td>
                    </tr>
                </form>
            </table>
        <? include("../include/admin/rodape.php"); ?>
</body>
</html>
