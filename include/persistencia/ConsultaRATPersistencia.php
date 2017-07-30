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
		$atividade = $this->getModel()->getAtividade();
		$despesa = $this->getModel()->getDespesa();
		$projeto = $this->getModel()->getProjeto();
		$situacao = $this->getModel()->getSituacao();

		if($codigo == null){

			$sSql = "SELECT rat.codRat
										 ,rat.Usuario_codUsu
										 ,rat.Cliente_codCli
										 ,rat.Projeto_codPrj
										 ,rat.Situacao_codSit
										 ,dsp.codDsp
										 ,ati.codAti
							 	 FROM tbrat rat
							 	 JOIN tbatividade ati
							 	 ON rat.codRat = ati.RAT_codRAT
							 	 JOIN tbdespesa dsp
							 	 ON rat.codRat = dsp.RAT_codRAT
								WHERE 1 = 1";

			if($usuario != null){
					$sSql = $sSql . " AND rat.Usuario_codUsu = '" . $usuario ."')";
			}

			if($cliente != null){
					$sSql = $sSql . " AND rat.Cliente_codCli = '" . $cliente ."')";
			}

			if($projeto != null){
					$sSql = $sSql . " AND rat.Projeto_codPrj = '" . $projeto ."'";
			}

			if($situacao != null){
					$sSql = $sSql . " AND rat.Situacao_codSit = '" . $situacao ."'";
			}

			if($despesa != null){
					$sSql = $sSql . " AND dsp.codDsp = '" . $despesa ."'";
			}

			if($atividade != null){
					$sSql = $sSql . " AND ati.codAti = '" . $atividade ."'";
			}

			$sSql = $sSql . " ORDER BY codRat desc";
		}else{
			$sSql = "SELECT rat.codRat
										 ,rat.Usuario_codUsu
										 ,rat.Cliente_codCli
										 ,rat.Projeto_codPrj
										 ,rat.Situacao_codSit
										 ,dsp.codDsp
										 ,ati.codAti
							 	 FROM tbrat rat
							 	 JOIN tbatividade ati
							 	 ON rat.codRat = ati.RAT_codRAT
							 	 JOIN tbdespesa des
							 	 ON rat.codRat = dsp.RAT_codRAT
							   WHERE codRat = " . $codigo . "
								ORDER BY codRat";
		}

		$resultado = mysql_query($sSql);

		$qtdLinhas = mysql_num_rows($resultado);

		$contador = 0;

		$retorno = '[';
		while ($linha = mysql_fetch_assoc($resultado)) {

			$contador = $contador + 1;

			$retorno = $retorno . '{"codRat": "'.$linha["codRat"].'"
														, "codUsu" : "'.$linha["codUsu"].'"
														, "codCli" : "'.$linha["codCli"].'"
														, "codPrj" : "'.$linha["codPrj"].'"
														, "codSit" : "'.$linha["codSit"].'"
														, "codDsp" : "'.$linha["codDsp"].'"
														, "codAti" : "'.$linha["codAti"].'"}';

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
