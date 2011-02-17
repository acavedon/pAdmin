<?include ("mysql.inc");?>
<?
/**
 * Classe responsavel por montar as funcoes
 *
 * @author: alexandre cavedon
 * @date: 2009-04-27
**/

class criaFuncao 
{
	function criaFuncao($varStrNomeTable,$arrCampos)
	{
		// abre o arquivo
		$varContent = "<? \r\n";

		//////////////////
		// cria a funcao que lista os registros
		//////////////////
		$varContent .= "/** \r\n";
		$varContent .= " * Return a list of records \r\n";
		$varContent .= " * \r\n";
		$varContent .= " * @author: alexandre cavedon \r\n";
		$varContent .= " * @date: ".date("Y-m-d")."\r\n";
		$varContent .= "**/ \r\n";

		$varContent .= "function listRecord()\r\n";
		$varContent .= "{ \r\n";
		$varContent .= "	global \$dbi;\r\n\r\n";

		$varContent .= "	\$sql = \"SELECT \r\n";
		
		for($x=0;$x<count($arrCampos);$x++)
		{
			$varContent .= "               ".$arrCampos[$x][nome];

			if($x!=(count($arrCampos)-1))
			{
				$varContent .= ",\r\n";
			}
		}

		$varContent .= "\r\n            FROM \r\n";
        $varContent .= "               $varStrNomeTable \"; \r\n";
		$varContent .= "	\$varResult = mysql_query(\$sql,\$dbi); \r\n\r\n";

		// gera o cabecalho da listagem
		$varContent .= "	\$varContent .= \"<thead>\\n\";\r\n";
		$varContent .= "	\$varContent .= \"  <tr align='center' bgcolor='#a8a887'>\\n\";\r\n";
		$varContent .= "	\$varContent .= \"	    <th align='center' class='nobr' width='2%'>\\n\";\r\n";
		$varContent .= "	\$varContent .= \"		    <a href=\\\"javascript:selecionaTodos();\\n\\\">\";\r\n";
		$varContent .= "	\$varContent .= \"			    <img src='../\$varCaminho/images/admin/ico_marcar.gif' border='0' />\\n\";\r\n";
		$varContent .= "	\$varContent .= \"		    </a>\\n\";\r\n";
		$varContent .= "	\$varContent .= \"	    </th>\\n\";\r\n";
	
		$varContent .= "	\$varContent .= \"	    <th class='nobr' width='100%'>Name</th>\\n \";\r\n";
		$varContent .= "	\$varContent .= \"	    <th class='nobr'>Options</th>\\n\";\r\n";
		$varContent .= "	\$varContent .= \"  </tr>\\n \";\r\n";
		$varContent .= "	\$varContent .= \"</thead>\\n\";\r\n\r\n";

		$varContent .= "	\$varContent .= \"<input name='hideaction' type='hidden' id='hideaction' />\\n\";\r\n";
		$varContent .= "	\$varContent .= \"<input name='cod' type='hidden' id='cod' />\\n\";\r\n";
		$varContent .= "	\$varContador = 0;\r\n\r\n";

        $varContent .= "    \$varContent .= \"<tbody>\\n\";\r\n\r\n";

		$varContent .= "	while(list(";
		
		for($x=0;$x<count($arrCampos);$x++)
		{
			if($arrCampos[$x][key]=="PRI")
			{
				$varContent .= "\$var".ucwords($arrCampos[$x][nome]);

				// armazena para uso no formulario
				$varChavePrimaria = "\$var".ucwords($arrCampos[$x][nome]);
				$varCampoChavePrimaria = $arrCampos[$x][nome];
			}
			else 
			{
				$arrCampos[$x][tipo] = explode("(",$arrCampos[$x][tipo]);
				$arrCampos[$x][tipo] = $arrCampos[$x][tipo][0];

				// trabalha o tipo de variavel e cria a nomenclatura correta
				if($arrCampos[$x][tipo]=="int" || $arrCampos[$x][tipo]=="bigint")
				{
					$varContent .= "\$varInt".ucwords($arrCampos[$x][nome]);
				} 
				elseif($arrCampos[$x][tipo]=="varchar" || $arrCampos[$x][tipo]=="char")
				{
					$varContent .= "\$varStr".ucwords($arrCampos[$x][nome]);
				}
				elseif($arrCampos[$x][tipo]=="bool")
				{
					$varContent .= "\$varBool".ucwords($arrCampos[$x][nome]);
				}
				else 
				{
					$varContent .= "\$var".ucwords($arrCampos[$x][nome]);
				}
			}

			if($x!=(count($arrCampos)-1))
			{
				$varContent .= ",";
			}
		}

		$varContent .= ")=mysql_fetch_row(\$varResult)) \r\n";
		$varContent .= "	{ \r\n";

		// interior do while
		for($x=0;$x<count($arrCampos);$x++)
		{
			if($arrCampos[$x][key]!="PRI")
			{
				if($arrCampos[$x][tipo]=="varchar" || $arrCampos[$x][tipo]=="char")
				{
					$varContent .= "		\$varStr".ucwords($arrCampos[$x][nome])."="."stripslashes("."\$varStr".ucwords($arrCampos[$x][nome]).");\r\n";
					if($varAux=="")
					{
						// pega o primeiro varchar para utilizar
						$varStrVarPrimeiroChar = "\$varStr".ucwords($arrCampos[$x][nome]); // variavel referente ao campo
						$varStrPrimeirChar = $arrCampos[$x][nome]; // campo da base (cru)
						$varAux=1;
					}
				}
			}
		}

		// trata o nome do arquivo a ser usado
		$varStrNomeTableSemTbl = str_replace("tbl","",$varStrNomeTable);

		$varContent .= "\r\n";

		$varContent .= "		\$varBgColor = (\$varContador%2) ? \"#ffffcc\" : \"#ffffff\";\r\n";
		$varContent .= "		\$varContent .= \"<tr bgcolor=\\\"\$varBgColor\\\">\\n\";\r\n";
		$varContent .= "		\$varContent .= \" 	<td align='center'>\\n\";\r\n";
        $varContent .= "        \$varContent .= \"      <input type='checkbox' name='selected[]' value='$varChavePrimaria' />\\n\";\r\n";
        $varContent .= "        \$varContent .= \"    </td>\\n\";\r\n";
		$varContent .= "		\$varContent .= \"	<td width='100%'>\\n\";\r\n";
        $varContent .= "        \$varContent .= \"      <strong><a href=\\\"javascript:executar('view','$varChavePrimaria','$varStrNomeTableSemTbl-view.php')\\\">$varStrVarPrimeiroChar</a></strong>\\n\";\r\n";
        $varContent .= "        \$varContent .= \"    </td>\\n\";\r\n";
		$varContent .= "		\$varContent .= \"	<td align='center' class='nobr'>\\n\";\r\n";
        $varContent .= "        \$varContent .= \"      <a href=\\\"javascript:executar('edit','$varChavePrimaria','$varStrNomeTableSemTbl-edit.php')\\\">\\n\";\r\n";
        $varContent .= "        \$varContent .= \"      <img src=\\\"../\$varCaminho/images/admin/icons/edit.png\\\" width='16' height='15' border='0' /> Edit</a>\\n\";\r\n";
        $varContent .= "        \$varContent .= \"    </td>\\n\";\r\n";
        $varContent .= "		\$varContent .= \"</tr>\\n\";\r\n";
		$varContent .= "		\$varContador ++;\r\n";

		$varContent .= "	} \r\n\r\n";
        
        $varContent .= "    \$varContent .= \"</tbody>\\n\";\r\n\r\n";

		$varContent .= "	\$varContent .= \"<tr>\\n\";\r\n";
		$varContent .= "	\$varContent .= \"	<td height='30' colspan='4' class='nobr'>\\n\";\r\n";
		$varContent .= "	\$varContent .= \"		<img src='../\$varCaminho/images/admin/ico_selecionados.gif' width='38' height='22' border='0' />\\n\";\r\n";
		$varContent .= "	\$varContent .= \"			<a href=\\\"javascript:executar('exclude','','$varStrNomeTableSemTbl-del.php','Do you sure about this?')\\\">\\n\";\r\n";
		$varContent .= "	\$varContent .= \"				<img src='../\$varCaminho/images/admin/icons/user-trash.gif' width='16' height='15' border='0' />\\n\";\r\n"; 
		$varContent .= "	\$varContent .= \"				Del selected\\n\";\r\n";
		$varContent .= "	\$varContent .= \"			</a>\\n\";\r\n";
		$varContent .= "	\$varContent .= \"	</td>\\n\";\r\n";

		$varContent .= "	\$varContent .= \"</tr>\\n\";\r\n";

		$varContent .= "	return \$varContent; \r\n";
		$varContent .= "} \r\n";

		$varContent .= "\r\n\r\n";
		
		//////////////////
		// cria a funcao de excluir registros
		//////////////////
		$varContent .= "/** \r\n";
		$varContent .= " * Deletes the record \r\n";
		$varContent .= " * \r\n";
		$varContent .= " * @author: alexandre cavedon \r\n";
		$varContent .= " * @date: ".date("Y-m-d")."\r\n";
		$varContent .= "**/ \r\n";

		$prmChavePrimaria = str_replace("var","prm",$varChavePrimaria);
		$varContent .= "function delRecord($prmChavePrimaria)\r\n";
		$varContent .= "{ \r\n";
		$varContent .= "	global \$dbi;\r\n\r\n";

		$varContent .= "	\$sql = \"DELETE FROM $varStrNomeTable WHERE $varCampoChavePrimaria=$prmChavePrimaria\";\r\n";
		$varContent .= "	mysql_query(\$sql,\$dbi);\r\n";
		
		$varContent .= "} \r\n";

		$varContent .= "\r\n\r\n";

		//////////////////
		// cria a funcao para adicionar registros
		//////////////////
		$varContent .= "/** \r\n";
		$varContent .= " * Adds the record in the database \r\n";
		$varContent .= " * \r\n";
		$varContent .= " * @author: alexandre cavedon \r\n";
		$varContent .= " * @date: ".date("Y-m-d")."\r\n";
		$varContent .= "**/ \r\n";

		// monta o recebimento dos parametros
		$varContent .= "function addRecord(";
		for($x=0;$x<count($arrCampos);$x++)
		{
			
			if($arrCampos[$x][key]=="PRI")
			{
				// armazena para uso no formulario
				$prmChavePrimaria = "\$prm".ucwords($arrCampos[$x][nome]);
				$prmCampoChavePrimaria = $arrCampos[$x][nome];
			}
			else 
			{
				$arrCampos[$x][tipo] = explode("(",$arrCampos[$x][tipo]);
				$arrCampos[$x][tipo] = $arrCampos[$x][tipo][0];

				// trabalha o tipo de variavel e cria a nomenclatura correta
				if($arrCampos[$x][tipo]=="int" || $arrCampos[$x][tipo]=="bigint")
				{
					$varContent .= "\$prmInt".ucwords($arrCampos[$x][nome]);
				} 
				elseif($arrCampos[$x][tipo]=="varchar" || $arrCampos[$x][tipo]=="char")
				{
					$varContent .= "\$prmStr".ucwords($arrCampos[$x][nome]);
				}
				elseif($arrCampos[$x][tipo]=="bool")
				{
					$varContent .= "\$prmBool".ucwords($arrCampos[$x][nome]);
				}
				else 
				{
					$varContent .= "\$prm".ucwords($arrCampos[$x][nome]);
				}
			
				if($x!=(count($arrCampos)-1))
				{
					$varContent .= ",";
				}
			}
		}
		$varContent .= ")\r\n";

		$varContent .= "{ \r\n";
		$varContent .= "	global \$dbi;\r\n\r\n";

		// trata os dados recebidos
		for($x=0;$x<count($arrCampos);$x++)
		{
			if($arrCampos[$x][key]!="PRI")
			{
				if($arrCampos[$x][tipo]=="varchar" || $arrCampos[$x][tipo]=="char")
				{
					$varContent .= "	\$prmStr".ucwords($arrCampos[$x][nome])."="."addslashes("."\$prmStr".ucwords($arrCampos[$x][nome]).");\r\n";
					if($varAux=="")
					{
						// pega o primeiro varchar para utilizar
						$varStrVarPrimeiroChar = "$prmStr".ucwords($arrCampos[$x][nome]); // variavel referente ao campo
						$varStrPrimeirChar = $arrCampos[$x][nome]; // campo da base (cru)
						$varAux=1;
					}
				}
			}
		}

		$varContent .= "\r\n";

		$varContent .= "	\$sql = \"INSERT INTO $varStrNomeTable(";
		
		// monta os campos da table
		for($x=0;$x<count($arrCampos);$x++)
		{
			if($arrCampos[$x][key]!="PRI")
			{
				$varContent .= $arrCampos[$x][nome];
	
				if($x!=(count($arrCampos)-1))
				{
					$varContent .= ",";
				}
			}
		}

		$varContent .= ") VALUES (";

		for($x=0;$x<count($arrCampos);$x++)
		{
			if($arrCampos[$x][key]!="PRI")
			{
				$arrCampos[$x][tipo] = explode("(",$arrCampos[$x][tipo]);
				$arrCampos[$x][tipo] = $arrCampos[$x][tipo][0];

				// trabalha o tipo de variavel e cria a nomenclatura correta
				if($arrCampos[$x][tipo]=="int" || $arrCampos[$x][tipo]=="bigint")
				{
					$varContent .= "\$prmInt".ucwords($arrCampos[$x][nome]);
				} 
				elseif($arrCampos[$x][tipo]=="varchar" || $arrCampos[$x][tipo]=="char")
				{
					$varContent .= "'\$prmStr".ucwords($arrCampos[$x][nome])."'";
				}
				elseif($arrCampos[$x][tipo]=="bool")
				{
					$varContent .= "\$prmBool".ucwords($arrCampos[$x][nome]);
				}
				else 
				{
					$varContent .= "\$prm".ucwords($arrCampos[$x][nome]);
				}
			
				if($x!=(count($arrCampos)-1))
				{
					$varContent .= ",";
				}
			}
		}
		$varContent .= ")\";\r\n";
		$varContent .= "	\$varResult = mysql_query(\$sql,\$dbi); \r\n";
		$varContent .= "	return mysql_errno(); \r\n";
		$varContent .= "} \r\n";

		$varContent .= "\r\n\r\n";

		//////////////////
		// cria a funcao para atualizar os registros
		//////////////////
		$varContent .= "/** \r\n";
		$varContent .= " * Updates the record \r\n";
		$varContent .= " * \r\n";
		$varContent .= " * @author: alexandre cavedon \r\n";
		$varContent .= " * @date: ".date("Y-m-d")."\r\n";
		$varContent .= "**/ \r\n";

		// monta o recebimento dos parametros
		$varContent .= "function updateRecord(";
		for($x=0;$x<count($arrCampos);$x++)
		{
			
			if($arrCampos[$x][key]=="PRI")
			{
				$varContent .= "\$prm".ucwords($arrCampos[$x][nome]);

				// armazena para uso no formulario
				$prmChavePrimaria = "\$prm".ucwords($arrCampos[$x][nome]);
				$prmCampoChavePrimaria = $arrCampos[$x][nome];
			}
			else 
			{
				$arrCampos[$x][tipo] = explode("(",$arrCampos[$x][tipo]);
				$arrCampos[$x][tipo] = $arrCampos[$x][tipo][0];

				// trabalha o tipo de variavel e cria a nomenclatura correta
				if($arrCampos[$x][tipo]=="int" || $arrCampos[$x][tipo]=="bigint")
				{
					$varContent .= "\$prmInt".ucwords($arrCampos[$x][nome]);
				} 
				elseif($arrCampos[$x][tipo]=="varchar" || $arrCampos[$x][tipo]=="char")
				{
					$varContent .= "\$prmStr".ucwords($arrCampos[$x][nome]);
				}
				elseif($arrCampos[$x][tipo]=="bool")
				{
					$varContent .= "\$prmBool".ucwords($arrCampos[$x][nome]);
				}
				else 
				{
					$varContent .= "\$prm".ucwords($arrCampos[$x][nome]);
				}
			}
			
			if($x!=(count($arrCampos)-1))
			{
				$varContent .= ",";
			}
		}
		$varContent .= ")\r\n";

		$varContent .= "{ \r\n";
		$varContent .= "	global \$dbi;\r\n\r\n";

		// trata os dados recebidos
		for($x=0;$x<count($arrCampos);$x++)
		{
			if($arrCampos[$x][key]!="PRI")
			{
				if($arrCampos[$x][tipo]=="varchar" || $arrCampos[$x][tipo]=="char")
				{
					$varContent .= "	\$prmStr".ucwords($arrCampos[$x][nome])."="."addslashes("."\$prmStr".ucwords($arrCampos[$x][nome]).");\r\n";
					if($varAux=="")
					{
						// pega o primeiro varchar para utilizar
						$varStrVarPrimeiroChar = "$prmStr".ucwords($arrCampos[$x][nome]); // variavel referente ao campo
						$varStrPrimeirChar = $arrCampos[$x][nome]; // campo da base (cru)
						$varAux=1;
					}
				}
			}
		}

		$varContent .= "\r\n";

		$varContent .= "	\$sql = \"UPDATE $varStrNomeTable \r\n";
        $varContent .= "                SET \r\n";
		
		for($x=0;$x<count($arrCampos);$x++)
		{
			if($arrCampos[$x][key]!="PRI")
			{
				$arrCampos[$x][tipo] = explode("(",$arrCampos[$x][tipo]);
				$arrCampos[$x][tipo] = $arrCampos[$x][tipo][0];

				// trabalha o tipo de variavel e cria a nomenclatura correta
				if($arrCampos[$x][tipo]=="int" || $arrCampos[$x][tipo]=="bigint")
				{
					$varContent .= "					".$arrCampos[$x][nome]."=\".\$prmInt".ucwords($arrCampos[$x][nome]);
				} 
				elseif($arrCampos[$x][tipo]=="varchar" || $arrCampos[$x][tipo]=="char")
				{
					$varContent .= "					".$arrCampos[$x][nome]."='\".\$prmStr".ucwords($arrCampos[$x][nome]).".\"'\"";
				}
				elseif($arrCampos[$x][tipo]=="bool")
				{
					$varContent .= "					".$arrCampos[$x][nome]."=\".\$prmBool".ucwords($arrCampos[$x][nome]);
				}
				else 
				{
					$varContent .= "					".$arrCampos[$x][nome]."=\".\$prm".ucwords($arrCampos[$x][nome]);
				}
			
				if($x!=(count($arrCampos)-1))
				{
					$varContent .= ".\",\r\n";
				}
			}
		}
		$varContent .= ".\"\r\n";
		$varContent .= "			    WHERE \r\n";
        $varContent .= "                    $varCampoChavePrimaria=\".$prmChavePrimaria;\r\n";
		$varContent .= "	mysql_query(\$sql,\$dbi);\r\n";
		$varContent .= "} \r\n";

		$varContent .= "\r\n\r\n";

		//////////////////
		// cria a funcao para exibir os registros
		//////////////////
		$varContent .= "/** \r\n";
		$varContent .= " * Returns the data record \r\n";
		$varContent .= " * \r\n";
		$varContent .= " * @author: alexandre cavedon \r\n";
		$varContent .= " * @date: ".date("Y-m-d")."\r\n";
		$varContent .= "**/ \r\n";

		// monta o recebimento dos parametros
		$varContent .= "function viewRecord($prmChavePrimaria)\r\n";
		$varContent .= "{\r\n";
		$varContent .= "	global \$dbi,";

		for($x=0;$x<count($arrCampos);$x++)
		{
			if($arrCampos[$x][key]!="PRI")
			{
				$arrCampos[$x][tipo] = explode("(",$arrCampos[$x][tipo]);
				$arrCampos[$x][tipo] = $arrCampos[$x][tipo][0];

				// trabalha o tipo de variavel e cria a nomenclatura correta
				if($arrCampos[$x][tipo]=="int" || $arrCampos[$x][tipo]=="bigint")
				{
					$varContent .= "\$varInt".ucwords($arrCampos[$x][nome]);
				} 
				elseif($arrCampos[$x][tipo]=="varchar" || $arrCampos[$x][tipo]=="char")
				{
					$varContent .= "\$varStr".ucwords($arrCampos[$x][nome]);
				}
				elseif($arrCampos[$x][tipo]=="bool")
				{
					$varContent .= "\$varBool".ucwords($arrCampos[$x][nome]);
				}
				else 
				{
					$varContent .= "\$var".ucwords($arrCampos[$x][nome]);
				}

				if($x!=(count($arrCampos)-1))
				{
					$varContent .= ",";
				}
			}
		}

		$varContent .= ";\r\n\r\n";
		
		$varContent .= "	\$sql = \"SELECT ";
		
		for($x=0;$x<count($arrCampos);$x++)
		{
			if($arrCampos[$x][key]!="PRI")
			{
				$varContent .= $arrCampos[$x][nome];

				if($x!=(count($arrCampos)-1))
				{
					$varContent .= ",";
				}
			}
		}

		$varContent .=  " FROM $varStrNomeTable WHERE $varCampoChavePrimaria=\".$prmChavePrimaria;\r\n";
		$varContent .= "	\$varResult = mysql_query(\$sql,\$dbi);\r\n\r\n";

		$varContent .= "	list(";
		
		for($x=0;$x<count($arrCampos);$x++)
		{
			
			if($arrCampos[$x][key]!="PRI")
			{
				$arrCampos[$x][tipo] = explode("(",$arrCampos[$x][tipo]);
				$arrCampos[$x][tipo] = $arrCampos[$x][tipo][0];

				// trabalha o tipo de variavel e cria a nomenclatura correta
				if($arrCampos[$x][tipo]=="int" || $arrCampos[$x][tipo]=="bigint")
				{
					$varContent .= "\$varInt".ucwords($arrCampos[$x][nome]);
				} 
				elseif($arrCampos[$x][tipo]=="varchar" || $arrCampos[$x][tipo]=="char")
				{
					$varContent .= "\$varStr".ucwords($arrCampos[$x][nome]);
				}
				elseif($arrCampos[$x][tipo]=="bool")
				{
					$varContent .= "\$varBool".ucwords($arrCampos[$x][nome]);
				}
				else 
				{
					$varContent .= "\$var".ucwords($arrCampos[$x][nome]);
				}

				if($x!=(count($arrCampos)-1))
				{
					$varContent .= ",";
				}
			}
		}

		$varContent .= ")=mysql_fetch_row(\$varResult); \r\n";
		
		for($x=0;$x<count($arrCampos);$x++)
		{
			if($arrCampos[$x][key]!="PRI")
			{
				if($arrCampos[$x][tipo]=="varchar" || $arrCampos[$x][tipo]=="char")
				{
					$varContent .= "	    \$varStr".ucwords($arrCampos[$x][nome])."="."stripslashes("."\$varStr".ucwords($arrCampos[$x][nome]).");\r\n";
					if($varAux=="")
					{
						// pega o primeiro varchar para utilizar
						$varStrVarPrimeiroChar = "\$varStr".ucwords($arrCampos[$x][nome]); // variavel referente ao campo
						$varStrPrimeirChar = $arrCampos[$x][nome]; // campo da base (cru)
						$varAux=1;
					}
				}
			}
		}

		$varContent .= "}\r\n";


		// fecha o arquivo
		$varContent .= "?>\r\n";

		// trata o nome do arquivo a ser usado
		$varStrNomeTable = str_replace("tbl","",$varStrNomeTable);

		// escreve o arquivo
		if (file_exists("include/")) 
		{
			$fl=fopen("include/".$varStrNomeTable.".php","a");
			if($fl)
			{
				fwrite($fl,$varContent);
				fclose($fl);
			}
		}
	}
}

// dados do banco
$database = "padmin";
$usuario = "root";
$senha = "123";
$server = "localhost";

$db = new db($server,$usuario,$senha,$database);
$arrTables = $db->listaTabela();
$varIntNumTables = count($arrTables);

// cria o diretorio 
if($varIntNumTables!="")
{
	if (!file_exists("include/")) 
	{
		mkdir("include/", 0755);
	}
}

// faz a chamada para a criacao dos arquivos
for($x=0;$x<$varIntNumTables;$x++)
{
	$arrCampos = $db->listaCampo($arrTables[$x]);
	new criaFuncao($arrTables[$x],$arrCampos);
}

?>
