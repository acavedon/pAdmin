<? include("../include/global.php"); ?>
<? include("../include/valida_login.php"); ?>
<? include("../include/user.php"); ?>
<?
$varAction = $_REQUEST["hideaction"];
switch($varAction)
{
	case "exclude":
		$varSelected = $_REQUEST["selected"];
		for($i=0;$i<count($varSelected);$i++)
        {
			delUser($varSelected[$i]);
		}
		header("location: ".$_SERVER['HTTP_REFERER']);
	break;
}
?>
