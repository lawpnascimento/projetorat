<?php
require_once("../../estrutura/conexao.php");
session_start();
class LoginPersistencia {

	protected $conexao;
	protected $Model;

	function __construct(){
		$this->conexao = new Conexao();
	}

	public function getModel(){
		return $this->Model;
	}

	public function setModel($Model){
		$this->Model = $Model;
	}

	public function getConexao(){
		return $this->conexao;
	}

	public function validaLogin(){
    $login = $this->getModel()->getLogin();
    $senha = $this->getModel()->getSenha();

		$sSql = "SELECT usu.codUsu codUsu
								 	 ,usu.nomUsu nomUsu
								 	 ,usu.sobrenomeUsu sobrenomeUsu
								 	 ,usu.senUsu senUsu
								 	 ,usu.desEml desEml
									 ,usu.codSit codSit
									 ,usu.Papel_codPap codPap
							 FROM tbusuario usu
					    WHERE usu.desEml = '" . $login . "'" .
							" AND usu.senUsu = '" . $senha . "'";

		$this->getConexao()->conectaBanco();

		if( $oDados = $this->getConexao()->fetch_query($sSql) ) {
   			$_SESSION["codUsu"] = $oDados->codUsu;
   			$_SESSION["nomUsu"] = $oDados->nomUsu;
   			$_SESSION["sobrenomeUsu"] = $oDados->sobrenomeUsu;
	   		$_SESSION["codSit"] = $oDados->codSit;
				$_SESSION["desEml"] = $oDados->desEml;
				$_SESSION["codPap"] = $oDados->codPap;
				$logado = true;
		} else {
      Session_destroy();

			$logado = false;
		}
		$this->getConexao()->fechaConexao();

		return $logado;
	}
}
?>
