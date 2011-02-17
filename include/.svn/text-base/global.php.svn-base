<?include_once("var_global.php");?>
<?

///////////////////////////////
/// Funcoes globais
/////////////////////////////// 

/**
 * Criptografa String passada no parametro 
 * @param $prmTexto
 * @author: alexandre cavedon
 * @date: 2008-01-25
**/
function encrypt($prmTexto)
{
    global $key;
    
    // texto criptografado
    // return @mcrypt_ecb(MCRYPT_3DES, $key, $prmTexto, MCRYPT_ENCRYPT);

    // texto sem criptografia
    return $prmTexto;
}


/**
 * Descriptografa String passada no parametro 
 * @param $prmTexto
 * @author: alexandre cavedon
 * @date: 2008-01-25
**/
function decrypt($prmTexto)
{
    global $key;

    // texto criptografado
    // return @mcrypt_ecb(MCRYPT_3DES, $key, $prmTexto, MCRYPT_DECRYPT);

    // texto sem criptografia
    return $prmTexto;
}


/**
 * Retorna um alert javascript 
 * @param $string
 * @author: alexandre cavedon
 * @date: 2008-01-25
**/
function alertJavascript($string)
{ ?>
    <script type="text/javascript">
        alert("<?=$string ?>");
    </script><?
}

/**
 * Retorna a pagina especificada via javascript
 * @author: alexandre cavedon
 * @date: 2009-03-11
**/
function redirecionaJavascript($pagina)
{ ?>
    <script type="text/javascript">
            location.href="<?=$pagina; ?>"
    </script>
  <?
}

/**
 * Retorna uma tabela com a lista dos arquivos de uma pasta
 *
 * @author: alexandre cavedon
 * @date: 2008-01-25
**/
function listFiles($prmStrDir,$prmMaxCol,$prmSelecionados)
{
    global $path;
    
    $prmStrDir = "../admin"; /* fixme */
    $varStrDir  = opendir($prmStrDir);
    $varColuna = 1;

	$arrArquivos = array();
	$x=0;

	// armazena em um array
	while($varNomeArquivo = readdir($varStrDir))
	{
		// excessoes
        if($varNomeArquivo!="." && $varNomeArquivo!=".." && $varNomeArquivo!=".svn" && !strpos($varNomeArquivo,".swp"))
        {
			$arrArquivos[$x] = $varNomeArquivo;
			$x++;
		}
	}

	// ordena o array
	rsort($arrArquivos);

	// monta a tabela	
    $varContent  = "<table width=\"100%\" border=\"0\" cellspacing=\"0\" cellpadding=\"0\">\n";

	for($x=0;$x<count($arrArquivos);$x++)
	{
            if($varColuna==1)
            {
                $varContent .= "    <tr>\n";
            }

            $varArrayIn = array("-", ".php");
            $varArrayOut = array(" ", "");
            $varNomeExibe = str_replace($varArrayIn, $varArrayOut, $arrArquivos[$x]);


            $varSelecionado = "";
			
			for($varIntContador=0;$varIntContador<sizeof($prmSelecionados);$varIntContador++)
            {
                if($prmSelecionados[$varIntContador]==$arrArquivos[$x])
                {
                    $varSelecionado = " checked";
                    break;
                }
            }
			
			$varContent .= "        <td>\n";
			$varContent .= "			<input type=\"checkbox\" name=\"url[]\" value=\"$arrArquivos[$x]\" $varSelecionado />";
			$varContent .= "			$varNomeExibe\n";
			$varContent .= "		</td>\n";

            if($varColuna++==$prmMaxCol)
            {
                $varContent .= "    </tr>\n";
                $varColuna = 1;
            }
	}

    $varContent  .= "</table>\n";
    return $varContent;
}


/**
 * Cria thumbnail de imagens jpg.
 * @param $prmArquivo $prmX $prmY
 * @author: alexandre cavedon
 * @date: 2008-01-25
**/
function geraThumbnail($prmArquivo,$prmX,$prmY)
{
    $varAux = split("\.",$prmArquivo);
    $varExtensao = $varAux[count($varAux)-1];
    
    if(strtolower($varExtensao)=="jpg" || strtolower($varExtensao)=="jpeg")
    {
        // define a imagem da qual será gerada a miniatura
        $varImagem = "$prmArquivo"; // Tipo: JPG
        
        // definir o nome do arquivo para o thumbnail
        $varThumbnail = str_replace(".$varExtensao","_thumbnail.$varExtensao",$prmArquivo);
        
        // definir as dimensões para o thumbnail
        $varX = $prmX; // Largura
        $varY = $prmY; // Altura
        
        // lê a imagem de origem
        $varImagemOriginal = ImageCreateFromJPEG($varImagem);
        
        // pega as dimensões da imagem de origem
        $varX_Original = imagesx($varImagemOriginal); // Largura
        $varY_Original = imagesy($varImagemOriginal); // Altura
        
        // ESCOLHE A LARGURA MAIOR E, BASEADO NELA, GERA A LARGURA MENOR
        if($varX_Original > $varY_Original)
        { 
            // Se a largura for maior que a altura
            $varY = floor($varX * $varY_Original / $varX_Original); // A altura é recalculada
        } else { 
            // Se a altura for maior ou igual à largura
            $varX = floor($varY * $varX_Original / $varY_Original); // A largura é recalculada
        }
        
        // cria a imagem final para o thumbnail
        $varImagemFinal = imagecreatetruecolor($varX,$varY);
        
        // copia a imagem original para dentro do thumbnail
        ImageCopyResized($varImagemFinal, $varImagemOriginal, 0, 0, 0, 0, $varX, $varY, $varX_Original, $varY_Original);
        
        // salva o thumbnail
        ImageJPEG($varImagemFinal, $varThumbnail);
        
        // libera a memória
        ImageDestroy($varImagemOriginal);
        ImageDestroy($varImagemFinal);
        
        // retorna nome do thumbnail
        return "$varThumbnail";

    } else {
        return false;
    }
}


/**
 * Corrige strings (mesmo que htmlentities)
 * @param $prmString
 * @author: alexandre cavedon
 * @date: 2008-01-25
**/
function limpaString($prmString)
{
    $varInvalido = array("á","é","í","ó","ú","ã","õ","ñ","ç","â","ê","î","ô");
    
    $varValido   = array("&aacute;","&eacute;","&iacute;","&oacute;","&uacute;","&atilde;",
        "&otilde;","&ntilde;",'&ccedil;',"&acirc;","&rcirc;","&icirc;","&ocirc;");
    
    $varString = str_replace($varInvalido, $varValido, $prmString);
    return $varString;
}


/**
 * Reseta o seed do randomico.
 * @author: alexandre cavedon
 * @date: 2008-01-25
**/
function randSeed() 
{
   list($usec, $sec) = explode(' ', microtime());
   return (float) $sec + ((float) $usec * 100000);
}


/**
 * Gera número randomico de quantos digitos for especificado
 * @param $prmQtdeDigitos
 * @author: alexandre cavedon
 * @date: 2008-01-25
**/
function randNumb($prmQtdeDigitos)
{
    srand(randSeed());
    $varMin = 1;
    
    for($i=0;$i<$prmQtdeDigitos-1;$i++)
    {
        $varMin *= 10;
    }
    $varMax = ($varMin*10)-1;
    
    return rand($varMin,$varMax);
}


/**
 * Retorna codigo do cliente
 * @param $prmStrEmail $prmStrSenha
 * @author: alexandre cavedon
 * @date: 2008-01-25
 *
 * Codigo reorganizado por Luiz Fred. Gaertner 
**/
function validaLogin($prmStrEmail,$prmStrSenha)
{
    global $dbi;
    
    $_SESSION["varCodCliente"] = 0;
    $varStrEmail = addslashes($prmStrEmail);
    $varStrSenha = encrypt($prmStrSenha);
    
    $varSql = "SELECT 
                    codcliente,
                    senha 
                FROM 
                    tblcliente 
                WHERE 
                    strEmail='$varStrEmail'";

    $varResult  = mysql_query($varSql,$dbi);
    $varCount   = mysql_num_rows($varResult);
    
    if($varCount>0)
    {
        list($varCodCliente,$varStrSenhaAtual) = mysql_fetch_row($varResult);
        if($varStrSenhaAtual==$varStrSenha)
        {
            $_SESSION["varCodCliente"] = $varCodCliente;
        }
    }   
    return $_SESSION["varCodCliente"];
}

/** 
 * Funcao responsavel por recuperar a senha do usuario
 * 
 * @author: alexandre cavedon
 * @date: 2009-05-05
**/
function recuperaSenha($prmEmail)
{
    global $dbi;
    
    $varEmail = addslashes($prmEmail);
    $varResult = mysql_query("select name,password from user where email='$prmEmail'",$dbi);
    $varCount = mysql_num_rows($varResult);
    
    if($varCount>0)
    {
        list($varStrNome,$varStrSenha)=mysql_fetch_row($varResult);
        $varStrNome = stripslashes($varStrNome);
        $varStrSenha = stripslashes(decrypt($varStrSenha));
        $varMensagem = "Olá $varStrNome,\n\n"
            ."Sua senha de acesso ao site é $varStrSenha.\n\n";
        mail("$varEmail", "Senha de acesso", $varMensagem,"From:atendimento@dominioqualquer.com.br\n");
    }
    mysql_free_result($varResult);
}


/**
 * Valida login do usuario
 *
 * @author: alexandre cavedon
 * @date: 2008-01-28
**/
function validaLoginAdmin($prmCodLogin)
{
    global $dbi;

    if($prmCodLogin!="")
    {
        $sql = "SELECT 
                    u.name, 
                    p.permission 
                FROM 
                    user u, 
                    permission p 
                WHERE 
                    p.codpermission=u.codpermission 
                AND 
                    u.coduser=$prmCodLogin";

        $varResult = mysql_query($sql, $dbi);
        $varExiste = mysql_num_rows($varResult);

        if($varExiste>0)
        {
            list($varStrNomeUsuario,$varTxtPermissao) = mysql_fetch_row($varResult);            

            // limpa o resultado anterior (para evitar erros ou fraudes)
            mysql_free_result($varResult);

            $varStrNomeUsuario = stripslashes($varStrNomeUsuario);
            $varTxtPermissao = stripslashes($varTxtPermissao);
    
            // verifica a permissao do usuario para a pagina acessada
            if(strpos($varTxtPermissao,basename($_SERVER['PHP_SELF']))===false && basename($_SERVER['PHP_SELF'])!="index.php")
            {
                if(!$prmAjax)
                {
                    header("location: login.php?acao=negado");
                    exit();
                }
                else
                {
                    die("Acesso Negado!!!");
                    exit();
                }
            }
            else 
            {
                $arrPermissao = explode("|",$varTxtPermissao);
                return $arrPermissao;
            }
        }
        else 
        {
            /// se o usuario nao existe na base
            header("location: login.php");
            exit();
        }
    } 
    else 
    {
        /// se nao foi passado nenhum parametro para a funcao
        header("location: login.php");
        exit();
    }
}

/**
 * Verifica se o array de permissoes passadas por parametro existe
 * no array de permissoes retornada do banco (param 2)
 * @param1: arrPermissoesParaVerificacao @param2: arrPermissoesBanco
 *
 * @author: alexandre cavedon
 * @date: 2009-08-24
**/

function validaPermissao($prmArrPermissaoReq,$prmArrPermissaoBanco)
{
    // percorre o array solicitado
    for($x=0;$x<count($prmArrPermissaoReq);$x++)
    {
        // percorre o array passado
        for($y=0;$y<count($prmArrPermissaoBanco);$y++)
        {
            // percorre o array do banco
            if($prmArrPermissaoBanco[$y]!="")
            {
                // caso a string passada exista em alguma posicao do array do banco
                if(strpos($prmArrPermissaoBanco[$y],$prmArrPermissaoReq[$x])===false)
                {
                    ## retorno falso
                }
                else
                {
                    ## retorno verdadeiro
                    return "1";
                }
            }
        }
    }
}

/**
 * Return message to mysql errors
 *
 * @author: alexandre cavedon
 * @date: 2009-09-12
**/

function mysqlMessage($prmCodError)
{
    switch($prmCodError)
    {
        case "1062":
            return "The record already exists!";
        break;
        case "1064":
            return "You have an error in your SQL syntax.";
        break;
        case "1452":
            return "Cannot add or update - Foreign key constraint fails.";
        break;
    }
}

/** 
 * log a system activitie
 *
 * @autor: alexandre cavedon
 * @date: 2009-09-19
**/

function logger($prmCodUser,$prmStrModule,$prmStrAction,$prmStrData)
{
    global $dbi;

    $sql = "INSERT INTO 
                `log`(
                    `date`, 
                    `user_coduser`,
                    `module`,
                    `userAction`, 
                    `data`) 
                VALUES(
                    now(),
                    $prmCodUser,
                    '$prmStrModule',
                    '$prmStrAction',
                    '$prmStrData')";

    $varResult = mysql_query($sql,$dbi) or die(mysql_error()."<br /><br /> :: A system error was found. Please contact sysadmin.");
}

// use i18n
$lang = "pt_BR";
putenv("LANG=$lang");
setlocale(LC_ALL, $lang);

// Configura o text domain como 'messages'
$domain = $lang;
bindtextdomain($domain, "locale/");
textdomain($domain);

?>
