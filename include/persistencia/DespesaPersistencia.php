<?php

require_once("../../estrutura/conexao.php");

class DespesaPersistencia{
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

	public function inserirDespesa(){
		$this->getConexao()->conectaBanco();

		$tipoDespesa = $this->getModel()->getTipoDespesa();
		$descricao = $this->getModel()->getDescricao();
		$valorUnitario = $this->getModel()->getValorUnitario();

		$sSql =  "INSERT INTO tbdespesa (Tipodespesa_CodTipDsp
																		,desDsp
																		,vlrUni)
														VALUES ('". $tipoDespesa ."'
																	 ,'". $descricao ."'
															 		 ,'". $valorUnitario ."')";

	$this->getConexao()->query($sSql);

    $this->getConexao()->fechaConexao();
    
  }

	public function buscaDespesas(){
		$this->getConexao()->conectaBanco();

		$codigo = $this->getModel()->getCodigo();
		$tipoDespesa = $this->getModel()->getTipoDespesa();
		$descricao = $this->getModel()->getDescricao();
		$valorUnitario = $this->getModel()->getValorUnitario();

		if($codigo == null){

			$sSql = "SELECT codDsp
										 ,concat(Tipodespesa_CodTipDsp,' - ',tipdsp.desTipDsp) codTipDsp
										 ,tipdsp.desTipDsp desTipDsp
										 ,desDsp desDsp
										 ,vlrUni vlrUni
							 	 FROM tbdespesa dsp
							 	 JOIN tbtipodespesa tipdsp
							 	   ON tipdsp.codTipDsp = dsp.Tipodespesa_CodTipDsp
								WHERE 1 = 1";

			if($descricao != null){
					$sSql = $sSql . " AND UPPER(desDsp) LIKE UPPER('%" . $descricao ."%')";
			}

			$sSql = $sSql . " ORDER BY desDsp";
		}else{
			$sSql = "SELECT codDsp
										 ,concat(Tipodespesa_CodTipDsp,' - ',tipdsp.desTipDsp) codTipDsp
										 ,tipdsp.desTipDsp desTipDsp
										 ,desDsp desDsp
										 ,vlrUni vlrUni
							 	 FROM tbdespesa dsp
							 	 JOIN tbtipodespesa tipdsp
							 	   ON tipdsp.codTipDsp = dsp.Tipodespesa_CodTipDsp
							     WHERE codDsp = " . $codigo . "
							   ORDER BY desDsp";
		}

		$resultado = mysql_query($sSql);

		$qtdLinhas = mysql_num_rows($resultado);

		$contador = 0;

		$retorno = '[';
		while ($linha = mysql_fetch_assoc($resultado)) {

			$contador = $contador + 1;

			$retorno = $retorno . '{"codDsp": "'.$linha["codDsp"].'"
														, "codTipDsp" : "'.$linha["codTipDsp"].'"
														, "desTipDsp" : "'.$linha["desTipDsp"].'"
														, "desDsp" : "'.$linha["desDsp"].'"
														, "vlrUni" : "'.$linha["vlrUni"].'"}';

			//Para não concatenar a virgula no final do json
			if($qtdLinhas != $contador)
					$retorno = $retorno . ',';

		}
		$retorno = $retorno . "]";

		$this->getConexao()->fechaConexao();

		return $retorno;

	}

  	public function atualizarDespesa(){
	    $this->getConexao()->conectaBanco();

		$codigo = $this->getModel()->getCodigo();
		$tipoDespesa = $this->getModel()->getTipoDespesa();
		$descricao = $this->getModel()->getDescricao();
		$valorUnitario = $this->getModel()->getValorUnitario();

	    $sSql = "UPDATE tbdespesa
	                  SET  Tipodespesa_CodTipDsp = '" . $tipoDespesa . "'
	                       ,desDsp = '" . $descricao . "'
	                       ,vlrUni = '". $valorUnitario . "'
	                  WHERE codDsp = " . $codigo;

	    $this->getConexao()->query($sSql);

	    $this->getConexao()->fechaConexao();
  }

    public function buscaTipoDespesaDropDown(){
    $this->getConexao()->conectaBanco();

    $sSql = "SELECT tipdsp.codTipDsp codTipDsp
                   ,tipdsp.desTipDsp desTipDsp
               FROM tbtipodespesa tipdsp
               ORDER BY tipdsp.codTipDsp";

    $resultado = mysql_query($sSql);

    $qtdLinhas = mysql_num_rows($resultado);

    $contador = 0;

    $retorno = '[';
    while ($linha = mysql_fetch_assoc($resultado)) {

        $contador = $contador + 1;

        $retorno = $retorno . '{"codTipDsp": "'.$linha["codTipDsp"].'"
                               , "desTipDsp" : "'.$linha["desTipDsp"].'"}';
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
