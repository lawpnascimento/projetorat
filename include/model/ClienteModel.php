<?php

class ClienteModel {
    private $codigo;
	private $razaoSocial;
	private $nomeFantasia;
	private $cnpj;
	private $inscricao;
	private $cep;
	private $cidade;
	private $telefone;
	private $termo;

	 public function setCodigo($codigo){
		 $this->codigo = $codigo;
	 }

	 public function getCodigo(){
		 return $this->codigo;
	 }

	public function setRazaoSocial($razaoSocial){
		$this->razaoSocial = $razaoSocial;
	}

	public function getRazaoSocial(){
		return $this->razaoSocial;
	}

	public function setNomeFantasia($nomeFantasia){
		$this->nomeFantasia = $nomeFantasia;
	}

	public function getNomeFantasia(){
		return $this->nomeFantasia;
	}

	public function setCnpj($cnpj){
		$this->cnpj = $cnpj;
	}

	public function getCnpj(){
		return $this->cnpj;
	}

	public function setInscricao($inscricao){
		$this->inscricao = $inscricao;
	}

	public function getInscricao(){
		return $this->inscricao;
	}

	public function setCep($cep){
		$this->cep = $cep;
	}

	public function getCep(){
		return $this->cep;
	}

	public function setCidade($cidade){
		$this->cidade = $cidade;
	}

	public function getCidade(){
		return $this->cidade;
	}

	public function setTelefone($telefone){
		$this->telefone = $telefone;
	}

	public function getTelefone(){
		return $this->telefone;
	}

	public function getTermo(){
		return $this->termo;
	}

	public function setTermo($termo){
		$this->termo = $termo;
	}

}
?>
