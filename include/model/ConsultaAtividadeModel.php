<?php

class ConsultaAtividadeModel {

	private $codigo;
	private $usuario;
	private $cliente;
	private $responsavel;
	private $atividade;
	private $projeto;
	private $produto;
	private $termo;
	private $papel;
	private $usuarioLogado;


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

	public function getProjeto(){
		return $this->projeto;
	}

	public function setProjeto($projeto){
		$this->projeto = $projeto;
	}

	public function getProduto(){
		return $this->produto;
	}

	public function setProduto($produto){
		$this->produto = $produto;
	}

	public function getTermo(){
		return $this->termo;
	}

	public function setTermo($termo){
		$this->termo = $termo;
	}

	public function getPapel(){
		return $this->papel;
	}

	public function setPapel($papel){
		$this->papel = $papel;
	}

	public function getUsuarioLogado(){
		return $this->usuarioLogado;
	}

	public function setUsuarioLogado($usuarioLogado){
		$this->usuarioLogado = $usuarioLogado;
	}

}
?>
