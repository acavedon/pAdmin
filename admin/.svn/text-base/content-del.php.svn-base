<? include("../include/global.php"); ?>
<? include("../include/valida_login.php"); ?>
<? include("../include/content.php"); ?>
<?
$varAction = $_REQUEST["hideaction"];
switch($varAction)
{
	case "exclude":
		$varSelected = $_REQUEST["selected"];
		for($i=0;$i<count($varSelected);$i++)
        {
			delRecord($varSelected[$i]);
		}
		header("location: ".$_SERVER['HTTP_REFERER']);
	break;
}
?>
