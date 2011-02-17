<?include_once("mysql.inc");?>
<?
session_start();

// dados de acesso ao banco
$user="root";
$host="localhost";
$password="123";
$database="padmin";

$db = new db($host,$user,$password,$database);
$dbi = $db->dbi;

///////////////////////////////
/// Configuracoes gerais
/////////////////////////////// 

// titulo geral 
$titleSite = htmlentities("pAdmin - Content Management");

// pagina onde eu estou...
$varOndeEstou	= $_SERVER["SCRIPT_NAME"];
$varReplace = array("admin","/");
$varOndeEstou	= str_replace($varReplace,"",$varOndeEstou);

// chave utilizada para criar (ou alterar) a senha
$key = "OMundoEBelo994*02152005";

// verifica se o usuario esta no dominio correto (contra fraudes de sistema)
$varDominioAtual =  "http://".$_SERVER['HTTP_HOST'];

// variaveis referentes a caminho (host,subdominio, etc)
$varDominio = "http://10.1.1.2";
$varDominioHttps = "http://10.1.1.2";
$varQueryString = ($_SERVER['QUERY_STRING']!="") ? "?".$_SERVER['QUERY_STRING'] : "";
$varPagina = $_SERVER['PHP_SELF'];
$varCaminho = "/~alexandre/padmin";
?>
