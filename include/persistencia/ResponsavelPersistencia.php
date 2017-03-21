<?php

require_once("../../estrutura/conexao.php");

class ResponsavelPersistencia{
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

	public function inserirResponsavel(){
		$this->getConexao()->conectaBanco();

		    $nome = $this->getModel()->getNome();
        $email = $this->getModel()->getEmail();
        $cliente = $this->getModel()->getCliente();
		
		$sSql = "INSERT INTO tbprojeto (nomRes, emlRes, codCli,)
                          VALUES ('". $nome ."'
                                 ,'". $email ."'
                                 ,". $cliente ."')"; 

        $this->getConexao()->query($sSql);

        $this->getConexao()->fechaConexao();

		/* $myFile = "projeto.json";
 		$arrData = array(); // empty array

 		// json direto no array
 		$jsonData = array('projeto' => $this->getModel()->getProjeto(), 'produto' => $this->getModel()->getProduto(), 'dataInicio' => $this->getModel()->getDataInicio());				

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
	        echo "Error"; */
    }

   public function consultarProjeto(){
   		$myFile = "C:/xampp/htdocs/projetorat/include/controller/cliente.json";
		$json = file_get_contents($myFile);
		$data = json_decode($json, TRUE);
		echo $data;
	}
	
public function buscaClienteDropDown(){
        $this->getConexao()->conectaBanco();

        $sSql = "SELECT cli.codCli codCli
                       ,cli.nomCli nomCli
                        FROM tbcliente cli
                        ORDER BY cli.nomCli";

        $resultado = mysql_query($sSql);

        $qtdLinhas = mysql_num_rows($resultado);

        $contador = 0;

        $retorno = '[';
        while ($linha = mysql_fetch_assoc($resultado)) {

            $contador = $contador + 1;

            $retorno = $retorno . '{"codCli": "'.$linha["codCli"].'"
                                   , "nomCli" : "'.$linha["nomCli"].'"}';
            //Para não concatenar a virgula no final do json
            if($qtdLinhas != $contador)
               $retorno = $retorno . ',';

        }
        $retorno = $retorno . "]";

        $this->getConexao()->fechaConexao();

        return $retorno;
    }

}

?>