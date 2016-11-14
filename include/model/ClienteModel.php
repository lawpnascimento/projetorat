<?php

class ClienteModel {
	//public function __construct($nome = '', $resp = '', $email = '') {}
	private $nome;
	private $resp;
	private $email;

	public function setNome($nome){
		$this->nome = $nome;
	}

	public function getNome(){
		return $this->nome;
	}

	public function setResp($resp){
		$this->resp = $resp;
	}

	public function getResp(){
		return $this->resp;
	}

	public function setEmail($email){
		$this->email = $email;
	}
	
	public function getEmail(){
		return $this->email;
	}
}
?>