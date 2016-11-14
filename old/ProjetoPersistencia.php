<?php

class ProjetoPersistencia{
	protected $model;

	public function getModel(){

		return $this->model;

	}

	public function setModel($model){
		
		$this->model = $model;
	}

	public function inserirProjeto(){
		$myFile = "projeto.json";
 		$arrData = array(); // empty array

 			// json direto no array
 			$jsonData = array('projeto' => $this->getModel()->getProjeto(), 'produto' => $this->getModel()->getProduto(), 'dataInicio' => $this->getModel()->getDataInicio());	

					/* não fica totalmente no modelo do json
		$jsonData = '{"clientes":[' . '{"nome":"' . $this->getModel()->getNome() . '","resp":"' . $this->getModel()->getResp() . '","email":"' . $this->getModel()->getEmail() . '" }]}';	
		*/
		
					/* problema formatação (espaços \n\f)
		$jsonData = '{"clientes":[' . '{"nome":"' . $this->getModel()->getNome() . '","
										"resp":"' . $this->getModel()->getResp() . '","
										"email":"' . $this->getModel()->getEmail() . '" }]}';	
		*/	

	   // "Pusha" a resposta do usuário para array originalmente vazio
	   array_push($arrData,$jsonData);
	   	echo $jsonData;
		echo $arrData;

       //Convert updated array to JSON
	   $jsonData = json_encode($arrData, JSON_PRETTY_PRINT);
	   
	   //grava dados do json para o arquivo projeto.json
	   if(file_put_contents($myFile, $jsonData)) {
	        echo 'Data successfully saved';
	    }
	   else 
	        echo "Error";
   }

   public function consultarProjeto(){
   		$myFile = "C:/xampp/htdocs/projetorat/include/controller/cliente.json";
		$json = file_get_contents($myFile);
		$data = json_decode($json, TRUE);
		echo $data;
	}
	
}
?>