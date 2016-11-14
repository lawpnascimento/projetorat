<?php

class ClientePersistencia{
	protected $model;

	public function getModel(){

		return $this->model;

	}

	public function setModel($model){
		
		$this->model = $model;
	}

	public function inserirCliente(){
		$myFile = "cliente.json";
 		$arrData = array(); // empty array

		// json direto no array
		$jsonData = array('nome' => $this->getModel()->getNome(), 'resp' => $this->getModel()->getResp(), 'email' => $this->getModel()->getEmail());		

	   // "Pusha" a resposta do usuário para array originalmente vazio
	   array_push($arrData,$jsonData);

       //Convert updated array to JSON
	   $jsonData = json_encode($arrData, JSON_PRETTY_PRINT);
	     
	   //grava dados do json para o arquivo cliente.json
	   //APPEND = ACRESCENTAR
	   if(file_put_contents($myFile, $jsonData)){ 
	        echo 'Registro salvo com sucesso!';
	   }
	   else 
	        echo "Erro ao salvar os registros!";
   }

   public function consultarCliente(){
   		$file = fopen("../controller/cliente.json","r");
		if(!$file)
	      echo("ERRO: Não foi possível abrir o arquivo");
	    else{
	      $buff = fread ($file,filesize("../controller/cliente.json"));
	      echo $buff;
	    }
		
	}    

}
?>