<? include("../include/global.php"); ?>
<? include("../include/valida_login.php"); ?>
<html>
<head>
    <title><? echo $titleSite; ?></title>
    <link href="../css/admin.css" rel="stylesheet" type="text/css" />
    <link rel="stylesheet" type="text/css" href="../css/menu/superfish.css" media="screen" />
    <meta http-equiv="content-type" content="text/html;charset=utf-8">
    <link href="<?=$varCaminho;?>/css/admin.css" rel="stylesheet" type="text/css" />
    <link rel="stylesheet" type="text/css" href="<?=$varCaminho;?>/css/menu/superfish.css" media="screen" />
    <script language="javascript" src="<?=$varCaminho;?>/scripts/admin.js"></script>
    <script language="javascript" src="<?=$varCaminho;?>/scripts/jquery.js"></script>
    <script language="javascript" src="<?=$varCaminho;?>/scripts/menu/hoverIntent.js"></script>
    <script language="javascript" src="<?=$varCaminho;?>/scripts/menu/superfish.js"></script>
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
    <h2><?=_("Home");?></h2>
    <table cellpadding="3" border="0" width="100%">
        <form name="frm" method="get" action="">
            <tr>
                <td>&nbsp;</td>
            </tr>
        </form>
    </table>
    <? include("../include/admin/rodape.php"); ?>
</body>
</html>
