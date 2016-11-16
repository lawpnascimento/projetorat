<?php

require_once("../../estrutura/conexao.php");

class ClientePersistencia{
	protected $model;
	protected $conexao;

	function __construct(){
        $this->conexao = new Conexao();
    }

	public function getModel(){

		return $this->model;

	}

	public function setModel($model){
		
		$this->model = $model;
	}

	public function getConexao(){
        return $this->conexao;
    }

	public function inserirCliente(){
		$this->getConexao()->conectaBanco();

		$nome = $this->getModel()->getNome();
        $resp = $this->getModel()->getResp();
        $email = $this->getModel()->getEmail();
		
		$sSql = "INSERT INTO tbcliente (nomCli, nomRes, emlRes)
                          VALUES ('". $nome ."'
                                 ,'". $resp ."'
                                 ,'". $email ."')";

        $this->getConexao()->query($sSql);

        $this->getConexao()->fechaConexao();

		/*$myFile = "cliente.json";
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
	   else )
	        echo "Erro ao salvar os registros!";*/
   }

   public function consultarCliente(){
   		$file = fopen("../controller/teste.json","r");
		if(!$file)
	      echo("ERRO: Não foi possível abrir o arquivo");
	    else{
	      $buff = fread ($file,filesize("../controller/teste.json"));
	      echo $buff;
	    }
		
	}    

   public function buscarCliente(){
        $this->getConexao()->conectaBanco();

        $nome = $this->getModel()->getNome();
        $responsavel = $this->getModel()->getResp();
        $email = $this->getModel()->getEmail();

            $sSql = "SELECT cli.codCli
                        	 ,cli.nomCli
                       		 ,cli.nomRes
                      		 ,cli.emlRes
                       FROM tbcliente cli";

        $resultado = mysql_query($sSql);

        $qtdLinhas = mysql_num_rows($resultado);

        $contador = 0;

        $retorno = '[';
        while ($linha = mysql_fetch_assoc($resultado)) {

            $contador = $contador + 1;

            $retorno = $retorno . '{ "codCli": "'.$linha["codCli"].'"
                                   , "nomCli" : "'.$linha["nomCli"].'"
                                   , "nomRes" : "'.$linha["nomRes"].'"
                                   , "emlRes" : "'.$linha["emlRes"].'"}';
            //Para não concatenar a virgula no final do json
            if($qtdLinhas != $contador)
                $retorno = $retorno . ',';

        }
        $retorno = $retorno . "]";

        file_put_contents("teste.json", $retorno);

        $this->getConexao()->fechaConexao();

        return $retorno;

    }

}
?>