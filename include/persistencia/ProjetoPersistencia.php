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
        $valorHora = $this->getModel()->getValorHora();
        $obsProjeto = $this->getModel()->getObsProjeto();
		
		$sSql = "INSERT INTO tbprojeto (nomPrj, Produto_codPro, Cliente_codCli, datIni, vlrHor, obsPrj)
                          VALUES ('". $projeto ."'
                                 ,'". $produto ."'
                                 ,'". $cliente ."'
                                 ,'". $dataInicio ."'
                                 ,'". $valorHora ."'
                                 ,'". $obsProjeto ."')"; 

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
    $valorHora = $this->getModel()->getValorHora();
    $obsProjeto = $this->getModel()->getObsProjeto();

    if($codigo == null){

      $sSql = "SELECT codPrj
                     ,nomPrj
                     ,CONCAT(prj.Produto_codPro,' - ',pro.desPro) codPro
                     ,pro.desPro desPro
                     ,CONCAT(prj.Cliente_codCli,' - ',cli.nomCli) codCli
                     ,cli.nomCli nomCli
                     ,datIni
                     ,vlrHor
                     ,obsPrj
                 FROM tbprojeto prj
                 JOIN tbcliente cli
                   ON cli.codCli = prj.Cliente_codCli
                 JOIN tbproduto pro
                   ON pro.codPro = prj.Produto_codpro
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

      if($valorHora != null){
          $sSql = $sSql . " AND UPPER(vlrHor) LIKE UPPER('%" . $valorHora ."%')";
      }

      if($obsProjeto != null){
          $sSql = $sSql . " AND UPPER(obsPrj) LIKE UPPER('%" . $obsProjeto ."%')";
      }

      $sSql = $sSql . " ORDER BY codPrj desc";
    }else{
      $sSql = "SELECT codPrj
                     ,nomPrj
                     ,CONCAT(prj.Produto_codPro,' - ',pro.desPro) codPro
                     ,pro.desPro desPro
                     ,CONCAT(prj.Cliente_codCli,' - ',cli.nomCli) codCli
                     ,cli.nomCli nomCli
                     ,datIni
                     ,vlrHor
                     ,obsPrj
                 FROM tbprojeto prj
                 JOIN tbcliente cli
                   ON cli.codCli = prj.Cliente_codCli
                 JOIN tbproduto pro
                   ON pro.codPro = prj.Produto_codpro
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
                                                  , "codCli" : "'.$linha["codCli"].'"
                                                  , "nomCli" : "'.$linha["nomCli"].'"
                                                  , "codPro" : "'.$linha["codPro"].'"
                                                  , "desPro" : "'.$linha["desPro"].'"
                                                  , "datIni" : "'.$linha["datIni"].'"
                                                  , "vlrHor" : "'.$linha["vlrHor"].'"
                                                  , "obsPrj" : "'.$linha["obsPrj"].'"
                                                }';

      //Para não concatenar a virgula no final do json
      if($qtdLinhas != $contador)
          $retorno = $retorno . ',';

    }
    $retorno = $retorno . "]";

    $this->getConexao()->fechaConexao();
    echo $retorno;
    return $retorno;
  }

  public function atualizarProjeto(){
    $this->getConexao()->conectaBanco();

    $codigo = $this->getModel()->getCodigo();
    $projeto = $this->getModel()->getProjeto();
    $produto = $this->getModel()->getProduto();
    $dataInicio = $this->getModel()->getDataInicio();
    $cliente = $this->getModel()->getCliente();
    $valorHora = $this->getModel()->getValorHora();
    $obsProjeto = $this->getModel()->getObsProjeto();

    $sSql = "UPDATE tbprojeto
                  SET  nomPrj = '" . $projeto . "'
                       ,Produto_codPro = '" . $produto . "'
                       ,datIni = '" . $dataInicio . "'
                       ,Cliente_codCli = '". $cliente . "'
                       ,vlrHor = '" . $valorHora . "'
                       ,obsPrj = '" . $obsProjeto . "'
                  WHERE codPrj = " . $codigo;

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