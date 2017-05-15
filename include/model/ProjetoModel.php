<?php

class ProjetoModel {

	private $projeto;
	private $produto;
	private $dataInicio;
	private $cliente;

	public function setProjeto($projeto){
		$this->projeto = $projeto;
	}

	public function getProjeto(){
		return $this->projeto;
	}

	public function setProduto($produto){
		$this->produto = $produto;
	}

	public function getProduto(){
		return $this->produto;
	}

	public function setDataInicio($dataInicio){
		$this->dataInicio = $dataInicio;
	}
	
	public function getDataInicio(){
		return $this->dataInicio;
	}

	public function setCliente($cliente){
        $this->cliente = $cliente;
    }

    public function getCliente(){
        return $this->cliente;
    }

}
?>