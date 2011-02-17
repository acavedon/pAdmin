<? include("../include/global.php"); ?>
<? include("../include/valida_login.php"); ?>
<? include("../include/log.php"); ?>
<?
$users = listUser();
$varAction = $_POST["hideaction"];

switch($varAction)
{
    case "view":
        $varStrLoginUser = $_POST["user"];
        $varStrModule = $_POST["module"];
        $varDateType = $_POST["datetype"];
        $varDtData = $_POST["datapicker1"];

        if($varStrLoginUser!="")
        {
            $varResult = listRecord($varStrLoginUser,$varStrModule,$varDateType,$varDtData);
        }
    break;
    default:
    break;
}
?>
<html>
<head>
    <title><? echo $titleSite; ?></title>
    <meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
    <link href="<?=$varCaminho;?>/css/admin.css" rel="stylesheet" type="text/css" />
    <link href="<?=$varCaminho;?>/css/tablesorter-blue.css" rel="stylesheet" type="text/css" />
	<link rel="stylesheet" type="text/css" href="<?=$varCaminho;?>/css/menu/superfish.css" media="screen" />
	<link rel="stylesheet" type="text/css" href="<?=$varCaminho;?>/css/ui.all.css" media="screen" />
	<link rel="stylesheet" type="text/css" href="<?=$varCaminho;?>/css/jquery-ui-1.7.2.custom.css" media="screen" />
	<link rel="stylesheet" type="text/css" href="<?=$varCaminho;?>/css/jquery.autocomplete.css" media="screen" />
    <script language="javascript" src="<?=$varCaminho;?>/scripts/admin.js"></script>
    <script language="javascript" src="<?=$varCaminho;?>/scripts/jquery.js"></script>
    <script language="javascript" src="<?=$varCaminho;?>/scripts/jquery.tablesorter.js"></script>
    <script language="javascript" src="<?=$varCaminho;?>/scripts/jquery.tablesorter.pager.js"></script>
    <script language="javascript" src="<?=$varCaminho;?>/scripts/menu/hoverIntent.js"></script>
    <script language="javascript" src="<?=$varCaminho;?>/scripts/menu/superfish.js"></script>
    <script language="javascript" src="<?=$varCaminho;?>/scripts/ui.core.js"></script>
    <script language="javascript" src="<?=$varCaminho;?>/scripts/ui.datepicker.js"></script>
    <script language="javascript" src="<?=$varCaminho;?>/scripts/jquery.autocomplete.js"></script>
    <script language="javascript">
        $(document).ready(
            function() 
            { 
                $('ul.sf-menu').superfish();
                $("#tableLogs").tablesorter({sortList:[[1,1]], widgets: ['zebra'], headers: { 0:{sorter: false}, 4:{sorter: false}} });
                $("#tableLogs")
                    .tablesorterPager({container: $("#paginacao")});

                var data = "<?=$users;?>".split(",");
                $("#user").autocomplete(data);
               
                $("#datepicker1").datepicker({ dateFormat: 'dd/mm/yy' });
            }
        );


        function validaCampos()
        {
            if(document.frm.user.value == "") 
            {
              alert("The field 'Username' is required!");
              document.frm.user.focus();
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
            <h2><?=_("Logs History");?></h2>
            <form name="frm" method="post" action="<? echo $_SERVER['PHP_SELF']; ?>" onSubmit="return(validaCampos());">
                <table cellpadding="3" border="0" width="30%" class="tableSearchLog">
                    <tr>
                        <td><?=_("Username:");?></td>
                        <td>
                            <input type="text" name="user" id="user" size="40" value="<?=$varStrLoginUser;?>" /> 
                        </td>
                    </tr>
                    <tr>
                        <td><?=_("Module:");?></td>
                        <td>
                            <select name="module" id="module">
                                <option value="All" <?if($varStrModule=="All"){echo "selected";}?>>All</option>
                                <option value="permission" <?if($varStrModule=="permission"){echo "selected";}?>>Permission</option>
                                <option value="user" <?if($varStrModule=="user"){echo "selected";}?>>User</option>
                            </select>
                        </td>
                    </tr>
                    <tr>
                        <td><?=_("Date:");?></td>
                        <td>
                            <select name="datetype">
                                <option value="All" <?if($varDateType=="All"){echo "selected";}?>>All</option>
                                <option value="equal" <?if($varDateType=="equal"){echo "selected";}?>>Equal</option>
                                <option value="before" <?if($varDateType=="before"){echo "selected";}?>>Before</option>
                                <option value="after" <?if($varDateType=="after"){echo "selected";}?>>After</option>
                            </select>
                            <input type="text" id="datepicker1" name="datapicker1" size="10" value="<?=$varDtData;?>" readonly />
                        </td>
                    </tr>
                    <tr>
                        <td colspan="2" align="center">
                            <input type="hidden" name="hideaction" id="hideaction" value="view" />
                            <input type="submit" value="<?=_('Submit');?>" />
                        </td>
                    </tr>
                </table>
            </form>

            <?if($varResult!=""){?>
            <br />
            <ul class="botoes">
            </ul>
            <h2><?=_("Result");?></h2>
            <table cellpadding="3" name="tableLogs" id="tableLogs" class="tablesorter" border="0" width="100%">
                <? echo $varResult; ?>
            </table>

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
            <?}?>
        <? include("../include/admin/rodape.php"); ?>
</body>
</html>
