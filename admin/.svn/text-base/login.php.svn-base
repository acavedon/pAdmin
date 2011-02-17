<? include("../include/global.php"); ?>
<? include("../include/login.php"); ?>
<?
$varAcao = $_REQUEST["acao"];
switch($varAcao)
{
    case "login":
        $varStrLogin = $_POST["login"];
        $varStrPassword = $_POST["password"];

        if($varStrLogin!="" && $varStrPassword!="")
        {
            $varMensagem = login($varStrLogin,$varStrPassword);
        } 
        else 
        {
            $varMensagem = _("All fields required.");
        }
    break;
    case "logout":
        // logger
        $date = date('l jS \of F Y h:i:s A'); 
        $data = $_SESSION["name"].", $date";
        logger($_SESSION["codLogin"],"logout","-","$data");

        $_SESSION["codLogin"] = "";

        session_destroy();
        $varMensagem = htmlentities("You left logout.");
    break;
    case "negado":
        ?>
            <script language="javascript">
                if(confirm("Your User is not allowed. \n\nBack to the previous screen?"))
                {
                    // ok
                    history.back();
                } 
                else 
                {
                    // if the answer is cancel
                    document.location = "index.php";
                }
            </script>
        <?
    break;
}
?>
<html>
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
    <title><? echo $titleSite; ?></title>
    <link href="<?=$varCaminho;?>/css/admin.css" rel="stylesheet" type="text/css" />
        <script>
            function setFocus() 
            {
                var loginForm = document.getElementById("frm")["login"].focus();
            }
        </script>

</head>

<body onLoad="setFocus();">

<? include("../include/admin/topo-login.php"); ?>
            <table cellpadding="3" border="0" width="100%" height="100%">
                <form name="frm" id="frm" method="post" action="">
                    <tr>
                        <td align="right" valign="bottom">
                            <table width="200" border="0" cellspacing="0" cellpadding="3" height="100" class="tableLogin">
                                <tr>
                                    <td>
                                        <table width="100%" border="0">
                                            <tr>
                                                <td colspan="2">
                                                    <h2 class="login"><?=_("User Identify");?></h2>
                                                </td>
                                            </tr>
                                            <tr>
                                                <td colspan="2" class="alerta" align="center"><? echo $varMensagem; ?></td>
                                            </tr>
                                            <tr>
                                                <td align="right"><?=_("Username:");?></td>
                                                <td>
                                                    <input type="text" name="login" id="login" style="width:150px" tabindex="1" value="<? echo $varStrLogin; ?>" />
                                                </td>
                                            </tr>
                                            <tr>
                                                <td align="right"><?=_("Password:");?></td>
                                                <td>
                                                    <input type="password" name="password" style="width:150px" tabindex="2" value="<? echo $varStrPassword; ?>" /> 
                                                </td>
                                            </tr>
                                            <tr>
                                                <td colspan="2" align="center">
                                                    <input type="submit" name="submit" value="submit" tabindex="3" /> 
                                                    <input type="hidden" name="acao" value="<?=_('login');?>" />
                                                </td>
                                            </tr>
                                        </table>
                                    </td>
                                </tr>
                            </table>
                        </td>
                    </tr>
                </form>
            </table>
<? include("../include/admin/rodape.php"); ?>
</body>
</html>
