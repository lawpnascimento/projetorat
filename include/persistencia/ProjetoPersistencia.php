<?php

require_once("../../estrutura/conexao.php");

class ProjetoPersistencia{
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

	public function inserirProjeto(){
		$this->getConexao()->conectaBanco();

		$projeto = $this->getModel()->getProjeto();
        $produto = $this->getModel()->getProduto();
        $dataInicio = $this->getModel()->getDataInicio();
        $cliente = $this->getModel()->getCliente();
		
		$sSql = "INSERT INTO tbprojeto (nomPrj, nomPrd, codCli, datIni)
                          VALUES ('". $projeto ."'
                                 ,'". $produto ."'
                                 ,". $cliente ."
                                 ,'". $dataInicio ."')"; 

        $this->getConexao()->query($sSql);

        $this->getConexao()->fechaConexao();
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

public function buscaProdutoDropDown(){
        $this->getConexao()->conectaBanco();

        $sSql = "SELECT pro.codPro codPro
                       ,pro.desPro desPro
                   FROM tbproduto pro
                  ORDER BY pro.desPro";

        $resultado = mysql_query($sSql);

        $qtdLinhas = mysql_num_rows($resultado);

        $contador = 0;

        $retorno = '[';
        while ($linha = mysql_fetch_assoc($resultado)) {

            $contador = $contador + 1;

            $retorno = $retorno . '{"codPro": "'.$linha["codPro"].'"
                                   , "desPro" : "'.$linha["desPro"].'"}';
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