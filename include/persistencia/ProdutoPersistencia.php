<?php

require_once("../../estrutura/conexao.php");

class ProdutoPersistencia{
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

	public function inserirProduto(){
		$this->getConexao()->conectaBanco();

		$descricao = $this->getModel()->getDescricao();

		$sSql =  "INSERT INTO tbproduto (desPro)
							   VALUES ('$descricao')";

		$this->getConexao()->query($sSql);

    $this->getConexao()->fechaConexao();

	}

	public function buscaProdutos(){
		$this->getConexao()->conectaBanco();

		$codigo = $this->getModel()->getCodigo();
		$descricao = $this->getModel()->getDescricao();

		if($codigo == null){

			$sSql = "SELECT codPro
										 ,desPro
							 	 FROM tbproduto
								WHERE 1 = 1";

			if($descricao != null){
					$sSql = $sSql . " AND UPPER(desPro) LIKE UPPER('%" . $descricao ."%')";
			}

			$sSql = $sSql . " ORDER BY codPro DESC";
		}else{
			$sSql = "SELECT codPro
										 ,desPro
							 	 FROM tbproduto
							  WHERE codPro = " . $codigo . "
								ORDER BY codPro DESC";
		}

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
