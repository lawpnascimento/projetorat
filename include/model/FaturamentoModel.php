<?php

class FaturamentoModel {

	private $codigo;
	private $usuario;
	private $cliente;
	private $responsavel;
	private $atividade;
	private $despesa;
	private $projeto;
	private $produto;
	private $situacao;
	private $termo;
	private $dataFechamento;
	private $codigoFat;

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

	public function getProduto(){
		return $this->produto;
	}

	public function setProduto($produto){
		$this->produto = $produto;
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

	public function getDataFechamento(){
		return $this->dataFechamento;
	}

	public function setDataFechamento($dataFechamento){
		$this->dataFechamento = $dataFechamento;
	}

	public function getCodigoFat(){
		return $this->codigoFat;
	}

	public function setCodigoFat($codigoFat){
		$this->codigoFat = $codigoFat;
	}

}
?>
