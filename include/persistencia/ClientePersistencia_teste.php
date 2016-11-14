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

	public function buscarCliente(){
		$this->getConexao()->conectaBanco();

		$nome = $this->getModel()->getNome();
        $resp = $this->getModel()->getResp();
        $email = $this->getModel()->getEmail();
		
		$sSql = mysqli_query("SELECT nomCli, nomRes, emlRes 
									from tbcliente;");
		$this->getConexao()->query($sSql);
		
		echo $sSql;

		$this->getConexao()->fechaConexao();

	
  								  }

				}    
?>