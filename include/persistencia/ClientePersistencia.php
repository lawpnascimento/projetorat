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
   }

   public function consultarCliente(){
   		$file = fopen("../controller/clientedata.json","r");
		if(!$file)
	      echo("ERRO: Não foi possível abrir o arquivo");
	    else{
	      $buff = fread ($file,filesize("../controller/clientedata.json"));
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

        file_put_contents("clientedata.json", $retorno);

        $this->getConexao()->fechaConexao();

        return $retorno;

    }

}
?>