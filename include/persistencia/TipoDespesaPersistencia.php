<?php

require_once("../../estrutura/conexao.php");

class TipoDespesaPersistencia{
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

	public function inserirTipoDespesa(){
		$this->getConexao()->conectaBanco();

		$descricao = $this->getModel()->getDescricao();

		$sSql =  "INSERT INTO tbtipodespesa (desTipDsp)
														VALUES ('". $descricao ."')";

	$this->getConexao()->query($sSql);

    $this->getConexao()->fechaConexao();
    
  }

	public function buscaTipoDespesas(){
		$this->getConexao()->conectaBanco();

		$codigo = $this->getModel()->getCodigo();
		$descricao = $this->getModel()->getDescricao();

		if($codigo == null){

			$sSql = "SELECT codTipDsp
										 ,desTipDsp
							 	 FROM tbtipodespesa
								WHERE 1 = 1";

			if($descricao != null){
					$sSql = $sSql . " AND UPPER(desTipDsp) LIKE UPPER('%" . $descricao ."%')";
			}

			$sSql = $sSql . " ORDER BY desTipDsp";
		}else{
			$sSql = "SELECT codTipDsp
										 ,desTipDsp
							 	 FROM tbtipodespesa
							  WHERE codTipDsp = " . $codigo . "
								ORDER BY desTipDsp";
		}

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
