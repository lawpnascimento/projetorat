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

	public function inserirDespesa(){
		$this->getConexao()->conectaBanco();

		$descricao = $this->getModel()->getDescricao();
		$valorUnitario = $this->getModel()->getValorUnitario();

		$sSql =  "INSERT INTO tbcliente (desDsp
																		,vlrDsp)
														VALUES ('". $descricao ."'
															 		 ,'". $valorUnitario ."')";

	$this->getConexao()->query($sSql);

    $this->getConexao()->fechaConexao();
    
  }

}
?>
