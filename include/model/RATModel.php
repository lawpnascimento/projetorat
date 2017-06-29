<?php

class RATModel {

	private $codigo;
	private $usuario;
	private $cliente;
	private $responsavel;
	private $atividade;
	private $despesa;
	private $projeto;
	private $situacao;
	private $termo;


	 public function setCodigo($codigo){
		 $this->codigo = $codigo;
	 }

	 public function getCodigo(){
		 return $this->codigo;
	 }

	public function setUsuario($usuario){
		$this->usuario = $usuario;
	}
	public function getUsuario(){
		return $this->usuario;
	}

	public function setCliente($cliente){
		$this->cliente = $cliente;
	}
	public function getCliente(){
		return $this->cliente;
	}

	public function getResponsavel(){
		return $this->responsavel;
	}

	public function setResponsavel($responsavel){
		$this->responsavel = $responsavel;
	}

	public function getAtividade(){
		return $this->atividade;
	}

	public function setAtividade($atividade){
		$this->atividade = $atividade;
	}

	public function getDespesa(){
		return $this->despesa;
	}

	public function setDespesa($despesa){
		$this->despesa = $despesa;
	}

	public function getProjeto(){
		return $this->projeto;
	}

	public function setProjeto($projeto){
		$this->projeto = $projeto;
	}

	public function getSituacao(){
		return $this->situacao;
	}

	public function setSituacao($situacao){
		$this->situacao = $situacao;
	}

	public function getTermo(){
		return $this->termo;
	}

	public function setTermo($termo){
		$this->termo = $termo;
	}

}
?>
