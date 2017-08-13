<?php

class DespesaModel {
	private $codigo;
	private $descricao;
	private $valorUnitario;
	private $tipoDespesa;

	public function setCodigo($codigo){
		 $this->codigo = $codigo;
	}
	public function getCodigo(){
		 return $this->codigo;
	}

	public function setDescricao($descricao){
		$this->descricao = $descricao;
	}
	public function getDescricao(){
		return $this->descricao;
	}

	public function setValorUnitario($valorUnitario){
		$this->valorUnitario = $valorUnitario;
	}
	public function getValorUnitario(){
		return $this->valorUnitario;
	}

	public function setTipoDespesa($tipoDespesa){
		$this->tipoDespesa = $tipoDespesa;
	}
	public function getTipoDespesa(){
		return $this->tipoDespesa;
	}

}
?>
