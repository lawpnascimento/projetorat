<?php

class ResponsavelModel {

	private $codigo;
	private $nome;
	private $email;
	private $cliente;

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

	public function setEmail($email){
		$this->email = $email;
	}

	public function getEmail(){
		return $this->email;
	}

	public function setCliente($cliente){
        $this->cliente = $cliente;
    }

    public function getCliente(){
        return $this->cliente;
    }

}
?>
