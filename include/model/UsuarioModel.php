<?php

class UsuarioModel {

	private $codigo;
	private $nome;
	private $sobrenome;
	private $senha;
	private $email;
	private $papel;
	private $situacao;
	private $percentualComissaoCli;
	private $percentualComissaoInt;

	public function setCodigo($codigo){
 		$this->codigo = $codigo;
  }

  public function getCodigo(){
 		return $this->codigo;
  }

	public function setNome($nome){
		$this->nome = $nome;
	}

	public function getNome(){
		return $this->nome;
	}

	public function setSobrenome($sobrenome){
		$this->sobrenome = $sobrenome;
	}

	public function getSobrenome(){
		return $this->sobrenome;
	}

	public function setSenha($senha){
		$this->senha = $senha;
	}

	public function getSenha(){
		return $this->senha;
	}

	public function setEmail($email){
		$this->email = $email;
	}

	public function getEmail(){
		return $this->email;
	}

	public function setPapel($papel){
		$this->papel = $papel;
	}

	public function getPapel(){
		return $this->papel;
	}

	public function setSituacao($situacao){
		$this->situacao = $situacao;
	}

	public function getSituacao(){
		return $this->situacao;
	}

	public function setpercentualComissaoCli($percentualComissaoCli){
		$this->percentualComissaoCli = $percentualComissaoCli;
	}

	public function getpercentualComissaoCli(){
		return $this->percentualComissaoCli;
	}

	public function setpercentualComissaoInt($percentualComissaoInt){
		$this->percentualComissaoInt = $percentualComissaoInt;
	}

	public function getpercentualComissaoInt(){
		return $this->percentualComissaoInt;
	}
}
?>
