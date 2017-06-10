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
		
		$sSql = "INSERT INTO tbprojeto (nomPrj, Produto_codPro, Cliente_codCli, datIni)
                          VALUES ('". $projeto ."'
                                 ,'". $produto ."'
                                 ,". $cliente ."
                                 ,'". $dataInicio ."')"; 

        $this->getConexao()->query($sSql);

        $this->getConexao()->fechaConexao();

  }
	
  public function buscarProjetos(){
    $this->getConexao()->conectaBanco();

    $codigo = $this->getModel()->getCodigo();
    $projeto = $this->getModel()->getProjeto();
    $produto = $this->getModel()->getProduto();
    $dataInicio = $this->getModel()->getDataInicio();
    $cliente = $this->getModel()->getCliente();

    if($codigo == null){

      $sSql = "SELECT codPrj
                     ,nomPrj
                     ,Produto_codPro
                     ,Cliente_codCli
                     ,datIni
                 FROM tbprojeto
                WHERE 1 = 1";

      if($projeto != null){
          $sSql = $sSql . " AND UPPER(nomPrj) LIKE UPPER('%" . $projeto ."%')";
      }

      if($produto != null){
          $sSql = $sSql . " AND UPPER(Produto_codPro) LIKE UPPER('%" . $produto ."%')";
      }

      if($dataInicio != null){
          $sSql = $sSql . " AND UPPER(datIni) LIKE UPPER ('%" . $dataInicio . "%')";
      }

      if($cliente != null){
          $sSql = $sSql . " AND UPPER(Cliente_codCli) LIKE UPPER('%" . $cliente ."%')";
      }

      $sSql = $sSql . " ORDER BY codPrj desc";
    }else{
      $sSql = "SELECT codPrj
                     ,nomPrj
                     ,Produto_codPro
                     ,Cliente_codCli
                     ,datIni
                 FROM tbprojeto
                WHERE codPrj = " . $codigo . "
                ORDER BY codPrj desc";
    }

    $resultado = mysql_query($sSql);

    $qtdLinhas = mysql_num_rows($resultado);

    $contador = 0;

    $retorno = '[';
    while ($linha = mysql_fetch_assoc($resultado)) {

      $contador = $contador + 1;

      $retorno = $retorno . '{"codPrj": "'.$linha["codPrj"].'"
                                                  , "nomPrj" : "'.$linha["nomPrj"].'"
                                                  , "Produto_codPro" : "'.$linha["Produto_codPro"].'"
                                                  , "Cliente_codCli" : "'.$linha["Cliente_codCli"].'"
                                                  , "datIni" : "'.$linha["datIni"].'"}';

      //Para não concatenar a virgula no final do json
      if($qtdLinhas != $contador)
          $retorno = $retorno . ',';

    }
    $retorno = $retorno . "]";

    $this->getConexao()->fechaConexao();
    echo $retorno;
    return $retorno;
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