<?php

require_once("../../estrutura/conexao.php");

class ConsultaRATPersistencia{
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

	public function buscaRAT(){
		$this->getConexao()->conectaBanco();

		$codigo = $this->getModel()->getCodigo();
		$usuario = $this->getModel()->getUsuario();
		$cliente = $this->getModel()->getCliente();
		$responsavel = $this->getModel()->getResponsavel();		
		$projeto = $this->getModel()->getProjeto();
		$produto = $this->getModel()->getProduto();
		$situacao = $this->getModel()->getSituacao();

		if($codigo == null){

			$sSql = "SELECT rat.codRat
										 ,rat.Usuario_codUsu
										 ,rat.Cliente_codCli
										 ,rat.Responsavel_codRes
										 ,rat.Projeto_codPrj
										 ,rat.Produto_codPro
										 ,rat.Situacao_codSit
							 	 FROM tbrat rat
								WHERE 1 = 1";

			if($usuario != null){
					$sSql = $sSql . " AND rat.Usuario_codUsu = '" . $usuario ."'";
			}

			if($cliente != null){
					$sSql = $sSql . " AND rat.Cliente_codCli = '" . $cliente ."'";
			}

			if($responsavel != null){
					$sSql = $sSql . " AND rat.Responsavel_codRes = '" . $responsavel ."'";
			}

			if($projeto != null){
					$sSql = $sSql . " AND rat.Projeto_codPrj = '" . $projeto ."'";
			}

			if($produto != null){
					$sSql = $sSql . " AND rat.Produto_codPro = '" . $produto ."'";
			}

			if($situacao != null){
					$sSql = $sSql . " AND rat.Situacao_codSit = '" . $situacao ."'";
			}

			/*if($despesa != null){
					$sSql = $sSql . " AND dsp.codDsp = '" . $despesa ."'";
			}

			if($atividade != null){
					$sSql = $sSql . " AND ati.codAti = '" . $atividade ."'";
			}*/

			$sSql = $sSql . " ORDER BY rat.codRat desc";
		}else{
			$sSql = "SELECT rat.codRat
										 ,rat.Usuario_codUsu
										 ,rat.Cliente_codCli
										 ,rat.Responsavel_codRes
										 ,rat.Projeto_codPrj
										 ,rat.Produto_codPro
										 ,rat.Situacao_codSit
							 	 FROM tbrat rat
							   WHERE rat.codRat = " . $codigo . "
								ORDER BY rat.codRat";
		}

		$resultado = mysql_query($sSql);

		$qtdLinhas = mysql_num_rows($resultado);

		$contador = 0;

		$retorno = '[';
		while ($linha = mysql_fetch_assoc($resultado)) {

			$contador = $contador + 1;

			$retorno = $retorno . '{"codRat": "'.$linha["codRat"].'"
														, "codUsu" : "'.$linha["Usuario_codUsu"].'"
														, "codCli" : "'.$linha["Cliente_codCli"].'"
														, "codRes" : "'.$linha["Responsavel_codRes"].'"
														, "codPrj" : "'.$linha["Projeto_codPrj"].'"
														, "codPro" : "'.$linha["Produto_codPro"].'"
														, "codSit" : "'.$linha["Situacao_codSit"].'"}';

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
