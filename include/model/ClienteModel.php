<?php

class ClienteModel {
    private $codigo;
	private $razaoSocial;
	private $nomeFantasia;
	private $cnpj;
	private $inscricao;
	private $cep;
	private $uf;
	private $cidade;
	private $bairro;
	private $rua;
	private $numero;
	private $telefone;

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

	public function setUf($uf){
		$this->uf = $uf;
	}

	public function getUf(){
		return $this->uf;
	}

	public function setCidade($cidade){
		$this->cidade = $cidade;
	}

	public function getCidade(){
		return $this->cidade;
	}

	public function setBairro($bairro){
		$this->bairro = $bairro;
	}

	public function getBairro(){
		return $this->bairro;
	}

	public function setRua($rua){
		$this->rua = $rua;
	}

	public function getRua(){
		return $this->rua;
	}

	public function setNumero($numero){
		$this->numero = $numero;
	}

	public function getNumero(){
		return $this->numero;
	}

	public function setTelefone($telefone){
		$this->telefone = $telefone;
	}

	public function getTelefone(){
		return $this->telefone;
	}

}
?>
