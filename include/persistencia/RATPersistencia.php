<?php

require_once("../../estrutura/conexao.php");

class RATPersistencia{
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

	/*
	public function buscaResponsavelAutoComplete(){
		$this->getConexao()->conectaBanco();


	}
	*/

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

			$sSql = "SELECT codRat
										 ,usuario_codUsu
										 ,cliente_codCli
										 ,responsavel_codRes
										 ,atividade_codAti
										 ,despesa_codDsp
										 ,projeto_codPrj
										 ,situacao_codSit
							 	 FROM tbrat
								WHERE 1 = 1";

			if($usuario != null){
					$sSql = $sSql . " AND usuario_codUsu = '" . $usuario ."')";
			}

			if($cliente != null){
					$sSql = $sSql . " AND cliente_codCli = '" . $cliente ."')";
			}

			if($responsavel != null){
					$sSql = $sSql . " AND responsavel_codRes = '" . $responsavel ."'";
			}

			if($atividade != null){
					$sSql = $sSql . " AND atividade_codAti = '" . $atividade ."'";
			}

			if($despesa != null){
					$sSql = $sSql . " AND despesa_codDsp = '" . $despesa ."'";
			}

			if($projeto != null){
					$sSql = $sSql . " AND projeto_codPrj = '" . $projeto ."'";
			}

			if($situacao != null){
					$sSql = $sSql . " AND situacao_codSit = '" . $situacao ."')";
			}

			$sSql = $sSql . " ORDER BY codRat";
		}else{
			$sSql = "SELECT codRat
										 ,usuario_codUsu
										 ,cliente_codCli
										 ,responsavel_codRes
										 ,atividade_codAti
										 ,despesa_codDsp
										 ,projeto_codPrj
										 ,situacao_codSit
							 	 FROM tbrat
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
														, "usuario_codUsu" : "'.$linha["usuario_codUsu"].'"
														, "cliente_codCli" : "'.$linha["cliente_codCli"].'"
														, "responsavel_codRes" : "'.$linha["responsavel_codRes"].'"
														, "atividade_codAti" : "'.$linha["atividade_codAti"].'"
														, "despesa_codDsp" : "'.$linha["despesa_codDsp"].'"
														, "projeto_codPrj" : "'.$linha["projeto_codPrj"].'"
														, "situacao_codSit" : "'.$linha["situacao_codSit"].'"
														, "desBai" : "'.$linha["desBai"].'"}';

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
