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
								 	 ,usu.Perfil_codPer codPer
								 	 ,usu.nomUsu nomUsu
								 	 ,usu.senUsu senUsu
									 ,usu.codSit codSit
									 ,usu.desEml desEml
							 FROM tbusuario usu
					    WHERE usu.nomUsu = '" . $login . "'" .
							" AND usu.senUsu = '" . $senha . "'";

		$this->getConexao()->conectaBanco();

		if( $oDados = $this->getConexao()->fetch_query($sSql) ) {
      $_SESSION["codUsu"] = $oDados->codUsu;
		  $_SESSION["codSit"] = $oDados->codSit;
      $_SESSION["nomUsu"] = $oDados->nomUsu;
			$_SESSION["codPer"] = $oDados->codPer;
			$_SESSION["desEml"] = $oDados->desEml;
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
