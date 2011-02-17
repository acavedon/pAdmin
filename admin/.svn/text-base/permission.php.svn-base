<? include("../include/global.php"); ?>
<? include("../include/valida_login.php"); ?>
<? include("../include/permission.php"); ?>
<html>
<head>
    <title><? echo $titleSite; ?></title>
    <meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
    <link href="<?=$varCaminho;?>/css/admin.css" rel="stylesheet" type="text/css" />
    <link href="<?=$varCaminho;?>/css/tablesorter-blue.css" rel="stylesheet" type="text/css" />
	<link rel="stylesheet" type="text/css" href="<?=$varCaminho;?>/css/menu/superfish.css" media="screen" />
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
                $("#tablePermissoes").tablesorter({sortList:[[1,1]], widgets: ['zebra'], headers: { 0:{sorter: false}, 2:{sorter: false}} });
                $("#tablePermissoes")
                    // .tablesorter({widthFixed: true, widgets: ['zebra']} ## resolve, aparentemente, um bug de ordenacao)
                    .tablesorterPager({container: $("#paginacao")});
            }
        );
    </script>
</head>
<body>
<? include("../include/admin/topo.php"); ?>
            <h2><?echo htmlentities("Permissions");?></h2>
            <ul class="botoes">
                <?if(validaPermissao(array("permission-add"),$arrPermissao)=="1"){?>
                <li><a href="permission-add.php"><img src="<?=$varCaminho;?>/images/admin/icons/list-add.gif" width="14" height="14" border="0" align="absmiddle"> Add Permission</a></li>
                <?}?>
                <?if(validaPermissao(array("user"),$arrPermissao)=="1"){?>
                <li><a href="user.php"><img src="<?=$varCaminho;?>/images/admin/icons/format-justify-fill.gif" width="15" height="15" border="0" align="absmiddle"> List Users</a></li>
                <?}?>
                <?if(validaPermissao(array("user-add"),$arrPermissao)=="1"){?>
                <li><a href="user-add.php"><img src="<?=$varCaminho;?>/images/admin/icons/list-add.gif" width="14" height="14" border="0" align="absmiddle"> Add User</a></li>
                <?}?>
            </ul>
            <form name="frm" method="get" action="<? echo $_SERVER['PHP_SELF']; ?>">
                <table cellpadding="3" id="tablePermissoes" class="tablesorter" border="0" width="100%">
                    <? echo listPermission(); ?>
                </table>
            </form>
            
            <div id="paginacao" class="pager">
	            <form>
            		<img src="../images/admin/first.gif" class="first"/>
            		<img src="../images/admin/prev.gif" class="prev"/>
            		<input type="text" class="pagedisplay"/>
            		<img src="../images/admin/next.gif" class="next"/>
            		<img src="../images/admin/last.gif" class="last"/>
               		<select class="pagesize">
            			<option selected="selected"  value="10">10</option>
            			<option value="20">20</option>
            			<option value="30">30</option>
            			<option  value="40">40</option>
            		</select>
            	</form>
            </div>
        <? include("../include/admin/rodape.php"); ?>
        <?if(validaPermissao(array("permission-edit"),$arrPermissao)!="1"){?>
            <script language="javascript">
                for (var i=0; i<document.getElementsByTagName("a").length; i++)
                {
                    if((document.getElementsByTagName("a")[i].className=="edtButton"))
                    {
                        document.getElementsByTagName("a")[i].removeAttribute("href");
                        document.getElementsByTagName("a")[i].style.color="#484848";
                        document.getElementsByTagName("a")[i].style.textDecoration="none";
                        document.getElementsByTagName("a")[i].innerHTML = "<img src=\"../images/admin/icons/edit-disabled.png\" width=\"16\" border=\"0\" height=\"15\"> Edit";
                    }
                }
            </script>
        <?}?>
</body>
</html>
