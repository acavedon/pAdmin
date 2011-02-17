<?
/**
 * Camada de acesso ao db
 * 
 * @author: alexandre cavedon
 * @date: 2009-04-22
**/

class db
{
	private $hostDb;
	private $userDb;
	private $passDb;
	private $nameDb;
	public $msgErro;
	public $dbi;

	/**
	 * Conecta com o banco de dados
	**/
	public function mysqlConnect()
	{
		if(($this->dbi = mysql_connect( $this->hostDb, $this->userDb, $this->passDb, $this->nameDb)))
		{	
			if(mysql_select_db( $this->nameDb, $this->dbi))
			{
				return true;
			}
		}

		$this->msgErro = mysql_error();
		return false;
	}
	
	/** 
	 * Classe construtora (recebe os dados e solicita a conexao)
	**/
	public function db($prmHost,$prmUser,$prmPass,$prmDbNome)
	{
		if($prmHost!="" && $prmUser!="" && $prmDbNome!="")
		{
			$this->hostDb = $prmHost;
			$this->userDb = $prmUser;
			$this->passDb = $prmPass;
			$this->nameDb = $prmDbNome;

			if($this->mysqlConnect())
			{
				return true;
			}

			return false;
		}
	}
	
	/** 
	 * Disconecta do banco 
	**/
	public function mysqlDisconnect()
	{
		if($this->dbi!=0)
		{
			mysql_close($this->dbi);
			$this->dbInsertId="";
			return true;
		}
		return false;
	}
	
	/**
	 * Retorna informacoes do campo solicitado por parametro)
	 *
	 * @author: alexandre cavedon
	 * @date: 2009-04-27
	**/ 	
	public function campoPorNome($prmStrNomeCampo,$prmCodCampo="")
	{
		if($this->dbi && $prmStrNomeCampo!="")
		{
			$resp = mysql_result($this->res_id, $this->row_id , $FieldName);
			return $resp;
		}
		return false;
	}

	/**
	 * Processa a query e retorna um array (caso seja um select) ou um id (caso seja um insert)
	 *
	 * @return arrayRegistros ou insert_id
	 * @author: alexandre cavedon
	 * @date: 2009-04-22
	**/
	public function processaQuery($Query="")
	{
		if($Query!="")
		{
			$this->bd_qry=$Query;
		}
	}
	
	/** 
	 * Retorna o total de registros 
	 *
	 * @author: alexandre cavedon
	 * @date: 2009-04-22
   **/
	private function countQuery($query="")
	{
		if($this->dbi)
		{			
			$resp = mysql_num_rows($query);
			return $resp;
		}
		return 0;
	}

	/** 
	 * Retorna o ultimo registro inserido
	 *
	 * @author: alexandre cavedon
	 * @date: 2009-04-22
	**/
	public function ultimoRegistro()
	{
		return mysql_insert_id($this->dbi);
	}

	/** 
	 * Retorna um array das tabelas do db
	 *
	 * @author: alexandre cavedon
	 * @date: 2009-04-27
	**/
	public function listaTabela()
	{
		$sql = "SHOW TABLES";
		$varResult = mysql_query($sql,$this->dbi);

		$varArrayTables = array();
		$x=0;

		while(list($varStrNomeTable) = mysql_fetch_row($varResult))
		{
			$varArrayTables[$x] = $varStrNomeTable;
			$x++;
		}

		return $varArrayTables;
	}

	/**
	 * Retorna os campos (com dados sobre o mesmo)
	 *
	 * @author: alexandre cavedon
	 * @date: 2009-04-27
	 **/
	 public function listaCampo($prmStrNomeTable)
	 {
	 	$sql = "SHOW COLUMNS FROM ".$prmStrNomeTable;
		$varResult = mysql_query($sql,$this->dbi);

		$arrCampo = array();
		$x=0;
		while(list($varStrNomeCampo,$varStrTipoCampo,$varStrNullCampo,$varStrChavePrimCampo,$varStrDefaultCampo,$varStrExtraCampo)=mysql_fetch_row($varResult))
		{
			$arrCampo[$x]['nome'] = $varStrNomeCampo;
			$arrCampo[$x]['tipo'] = $varStrTipoCampo;
			$arrCampo[$x]['null'] = $varStrNullCampo;
			$arrCampo[$x]['key'] = $varStrChavePrimCampo;
			$arrCampo[$x]['default'] = $varStrDefaultCampo;
			$arrCampo[$x]['extra'] = $varStrExtraCampo;
		
			$x++;			
		}

		return $arrCampo;
	 }
}
?>
