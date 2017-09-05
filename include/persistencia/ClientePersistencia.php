<?php

require_once("../../estrutura/conexao.php");

class ClientePersistencia{
	protected $model;
	protected $conexao;

	function __construct(){
        $this->conexao = new Conexao();
    }

	public function getModel(){

		return $this->model;

	}

	public function setModel($model){

		$this->model = $model;
	}

	public function getConexao(){
        return $this->conexao;
    }

	public function inserirCliente(){
		$this->getConexao()->conectaBanco();

		$razaoSocial = $this->getModel()->getRazaoSocial();
		$nomeFantasia = $this->getModel()->getNomeFantasia();
		$cnpj = $this->getModel()->getCnpj();
		$inscricao = $this->getModel()->getInscricao();
		$cep = $this->getModel()->getCep();
		$cidade = $this->getModel()->getCidade();
		$telefone = $this->getModel()->getTelefone();

		$sSql =  "INSERT INTO tbcliente (Cidade_seqCid
																		,desRazaoSocial
																		,nomCli
																		,numCNPJ
																		,iesCli
																		,numCEP
																	    ,telCli)
														VALUES ('". $cidade ."'
																	 ,'". $razaoSocial ."'
															 		 ,'". $nomeFantasia ."'
																	 ,'". $cnpj ."'
																	 ,'". $inscricao ."'
																	 ,'". $cep ."'
																	 ,'". $telefone ."')";

		$this->getConexao()->query($sSql);

    $this->getConexao()->fechaConexao();
  }

	public function buscaClientes(){
		$this->getConexao()->conectaBanco();

		$codigo = $this->getModel()->getCodigo();
		$razaoSocial = $this->getModel()->getRazaoSocial();
		$nomeFantasia = $this->getModel()->getNomeFantasia();
		$cnpj = $this->getModel()->getCnpj();
		$inscricao = $this->getModel()->getInscricao();
		$cep = $this->getModel()->getCep();
		$cidade = $this->getModel()->getCidade();
		$telefone = $this->getModel()->getTelefone();

		if($codigo == null){

			$sSql = "SELECT codCli
										 ,CONCAT(cli.Cidade_seqCid,'-',cid.desCid) Cidade_seqCid
										 ,desRazaoSocial
										 ,nomCli
										 ,CONCAT(SUBSTRING(numCNPJ, 1,2), '.', SUBSTRING(numCNPJ,3,3), '.', SUBSTRING(numCNPJ,6,3), '/', SUBSTRING(numCNPJ,9,4), '-', SUBSTRING(numCNPJ,13, 2)) numCNPJ
										 ,iesCli
										 ,numCEP
									     ,CONCAT(SUBSTRING(telCli, 1,0), '(', SUBSTRING(telCli,1,2), ')', ' ', SUBSTRING(telCli,3,4), '-', SUBSTRING(telCli,7,4)) telCli
							 	 FROM tbcliente cli
							 	 JOIN tbcidade cid
							 	 ON cid.seqCid = cli.Cidade_seqCid
								WHERE 1 = 1";

			if($razaoSocial != null){
					$sSql = $sSql . " AND UPPER(desRazaoSocial) LIKE UPPER('%" . $razaoSocial ."%')";
			}

			if($nomeFantasia != null){
					$sSql = $sSql . " AND UPPER(nomCli) LIKE UPPER('%" . $nomeFantasia ."%')";
			}

			if($cnpj != null){
					$sSql = $sSql . " AND numCNPJ = '" . $cnpj ."'";
			}

			if($inscricao != null){
					$sSql = $sSql . " AND UPPER(iesCli) LIKE UPPER('%" . $inscricao ."%')";
			}

			if($cep != null){
					$sSql = $sSql . " AND numCEP = '" . $cep ."'";
			}

			if($cidade != null){
					$sSql = $sSql . " AND Cidade_seqCid = '" . $cnpj ."'";
			}

			if($telefone != null){
					$sSql = $sSql . " AND telCli = '" . $telefone ."'";
			}

			$sSql = $sSql . " ORDER BY nomCli";
		}else{
			$sSql = "SELECT codCli
										 ,CONCAT(cli.Cidade_seqCid,'-',cid.desCid) Cidade_seqCid
										 ,desRazaoSocial
										 ,nomCli
										 ,CONCAT(SUBSTRING(numCNPJ, 1,2), '.', SUBSTRING(numCNPJ,3,3), '.', SUBSTRING(numCNPJ,6,3), '/', SUBSTRING(numCNPJ,9,4), '-', SUBSTRING(numCNPJ,13, 2)) numCNPJ
										 ,iesCli
										 ,numCEP
									     ,CONCAT(SUBSTRING(telCli, 1,0), '(', SUBSTRING(telCli,1,2), ')', ' ', SUBSTRING(telCli,3,4), '-', SUBSTRING(telCli,7,4)) telCli
							 	 FROM tbcliente cli
							 	 JOIN tbcidade cid
							 	 ON cid.seqCid = cli.Cidade_seqCid
							  WHERE codCli = " . $codigo . "
								ORDER BY nomCli";
		}

		$resultado = mysql_query($sSql);

		$qtdLinhas = mysql_num_rows($resultado);

		$contador = 0;

		$retorno = '[';
		while ($linha = mysql_fetch_assoc($resultado)) {

			$contador = $contador + 1;

			$retorno = $retorno . '{"codCli": "'.$linha["codCli"].'"
														, "Cidade_seqCid" : "'.$linha["Cidade_seqCid"].'"
														, "desRazaoSocial" : "'.$linha["desRazaoSocial"].'"
														, "nomCli" : "'.$linha["nomCli"].'"
														, "numCNPJ" : "'.$linha["numCNPJ"].'"
														, "iesCli" : "'.$linha["iesCli"].'"
														, "numCEP" : "'.$linha["numCEP"].'"
														, "telCli" : "'.$linha["telCli"].'"}';

			//Para não concatenar a virgula no final do json
			if($qtdLinhas != $contador)
					$retorno = $retorno . ',';

		}
		$retorno = $retorno . "]";

		$this->getConexao()->fechaConexao();

		return $retorno;

	}

	public function Atualizar(){
			$this->getConexao()->conectaBanco();

			$codigo = $this->getModel()->getCodigo();
			$razaoSocial = $this->getModel()->getRazaoSocial();
			$nomeFantasia = $this->getModel()->getNomeFantasia();
			$cnpj = $this->getModel()->getCnpj();
			$inscricao = $this->getModel()->getInscricao();
			$cep = $this->getModel()->getCep();
			$cidade = $this->getModel()->getCidade();
			$telefone = $this->getModel()->getTelefone();

			$sSql = "UPDATE tbcliente
									SET desRazaoSocial = '" . $razaoSocial ."'
										 ,Cidade_seqCid = '" . $cidade ."'
										 ,nomCli = '" . $nomeFantasia ."'
										 ,numCNPJ = '" . $cnpj ."'
										 ,iesCli = '" . $inscricao ."'
										 ,numCEP = '" . $cep ."'
										 ,telCli = '" . $telefone ."'
								WHERE codcli = " . $codigo;

			$this->getConexao()->query($sSql);

			$this->getConexao()->fechaConexao();
	}

	public function buscaCidadeAutoComplete(){
		$this->getConexao()->conectaBanco();
		$termo = $this->getModel()->getTermo();

		$sSql = "SELECT CONCAT(seqCid,'-',desCid) desCid
						   FROM tbcidade
						  WHERE desCid LIKE '%". $termo ."%'";

		$resultado = mysql_query($sSql);

		$qtdLinhas = mysql_num_rows($resultado);

		$contador = 0;

		$retorno = null;

		while ($linha = mysql_fetch_assoc($resultado)) {

			$contador = $contador + 1;

			$retorno = $retorno . $linha["desCid"];

			//Para não concatenar a virgula no final do json
			if($qtdLinhas != $contador)
					$retorno = $retorno . ',';

		}

		$this->getConexao()->fechaConexao();

		return $retorno;
	}

	public function buscaEstado(){
		$this->getConexao()->conectaBanco();

		$seqCid = $this->getModel()->getCodigo();

		$sSql = "SELECT seqEst, desEst, ufEst
						  FROM tbestado est
						  JOIN tbcidade cid
						   ON cid.Estado_seqEst = est.seqEst
						 WHERE cid.seqCid = " . $seqCid;

		$resultado = mysql_query($sSql);

	    $qtdLinhas = mysql_num_rows($resultado);

	    $contador = 0;

	    $retorno = '[';
	    while ($linha = mysql_fetch_assoc($resultado)) {

	        $contador = $contador + 1;

	        $retorno = $retorno . '{"seqEst": "'.$linha["seqEst"].'"
	                               , "desEst" : "'.$linha["desEst"].'"}';
	        //Para não concatenar a virgula no final do json
	        if($qtdLinhas != $contador)
	           $retorno = $retorno . ',';

	    }
	    $retorno = $retorno . "]";

	    $this->getConexao()->fechaConexao();

	    return $retorno;

	}

}
?>
