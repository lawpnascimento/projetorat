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
		$uf = $this->getModel()->getUf();
		$cidade = $this->getModel()->getCidade();
		$bairro = $this->getModel()->getBairro();
		$rua = $this->getModel()->getRua();
		$numero = $this->getModel()->getNumero();
		$telefone = $this->getModel()->getTelefone();

		$sSql =  "INSERT INTO tbcliente (desRazaoSocial
																	,nomCli
																	,numCNPJ
																	,iesCli
																	,numCEP
																	,desUF
																	,desCid
															 	  ,desBai
																  ,desEnd
																  ,numEnd
																  ,telCli)
													VALUES ('". $razaoSocial ."'
														 		 ,'". $nomeFantasia ."'
																 ,'". $cnpj ."'
																 ,'". $inscricao ."'
																 ,'". $cep ."'
																 ,'". $uf ."'
																 ,'". $cidade ."'
																 ,'". $bairro ."'
																 ,'". $rua ."'
																 ,'". $numero ."'
																 ,'". $telefone ."')";

		$this->getConexao()->query($sSql);

    $this->getConexao()->fechaConexao();
  }

	public function buscaClientes(){
		$this->getConexao()->conectaBanco();


		$sSql = "SELECT codCli
									 ,desRazaoSocial
									 ,nomCli
									 ,numCNPJ
									 ,iesCli
									 ,numCEP
									 ,desUF
									 ,desCid
								   ,desBai
								   ,desEnd
								   ,numEnd
								   ,telCli
						 	 FROM tbcliente
							ORDER BY nomCli";

		$resultado = mysql_query($sSql);

		$qtdLinhas = mysql_num_rows($resultado);

		$contador = 0;

		$retorno = '[';
		while ($linha = mysql_fetch_assoc($resultado)) {

			$contador = $contador + 1;

			$retorno = $retorno . '{"codCli": "'.$linha["codCli"].'"
														, "desRazaoSocial" : "'.$linha["desRazaoSocial"].'"
														, "nomCli" : "'.$linha["nomCli"].'"
														, "numCNPJ" : "'.$linha["numCNPJ"].'"
														, "iesCli" : "'.$linha["iesCli"].'"
														, "numCEP" : "'.$linha["numCEP"].'"
														, "desUF" : "'.$linha["desUF"].'"
														, "desCid" : "'.$linha["desCid"].'"
														, "desBai" : "'.$linha["desBai"].'"
														, "desEnd" : "'.$linha["desEnd"].'"
														, "numEnd" : "'.$linha["numEnd"].'"
														, "telCli" : "'.$linha["telCli"].'"}';

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
