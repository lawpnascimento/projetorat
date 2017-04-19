<?php

class DespesaModel {

	private $descricao;
	private $valorUnitario;

	public function setDescricao($descricao){
		$this->descricao = $descricao;
	}
	public function getDescricao(){
		return $this->descricao;
	}

	public function setValorUnitario($valorUnitario){
		$this->$valorUnitario = $valorUnitario;
	}
	public function getValorUnitario(){
		return $this->$valorUnitario;
	}


}
?>
