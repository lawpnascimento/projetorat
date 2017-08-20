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
										 ,CONCAT(rat.Usuario_codUsu,' - ',usu.nomUsu, ' ' ,sobrenomeUsu) Usuario_codUsu
										 ,CONCAT(rat.Cliente_codCli, ' - ',cli.nomCli) Cliente_codCli
										 ,CONCAT(rat.Responsavel_codRes, ' - ',res.nomRes) Responsavel_codRes
										 ,CONCAT(rat.Projeto_codPrj, ' - ',prj.nomPrj) Projeto_codPrj
									     ,CONCAT(rat.Produto_codPro,' - ',pro.desPro) Produto_codPro
										 ,CONCAT(rat.Situacao_codSit,' - ',sit.desSit) Situacao_codSit
							 	 FROM tbrat rat
							 	 JOIN tbusuario usu
							       ON usu.codUsu = rat.Usuario_codUsu
							     JOIN tbcliente cli
								   ON cli.codCli = rat.Cliente_codCli
								 JOIN tbresponsavel res 
								   ON res.codRes = rat.Responsavel_codRes
								 JOIN tbprojeto prj 
								   ON prj.codPrj = rat.Projeto_codPrj
								 JOIN tbproduto pro
								   ON pro.codPro = rat.Produto_codPro
								 JOIN tbsituacaorat = sit
								   ON sit.codSit = rat.Situacao_codSit
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
										 ,CONCAT(rat.Usuario_codUsu,' - ',usu.nomUsu, ' ' ,sobrenomeUsu) Usuario_codUsu
										 ,CONCAT(rat.Cliente_codCli,' - ',cli.nomCli) Cliente_codCli
										 ,CONCAT(rat.Responsavel_codRes,' - ',res.nomRes) Responsavel_codRes
										 ,CONCAT(rat.Projeto_codPrj,' - ',prj.nomPrj) Projeto_codPrj
									     ,CONCAT(rat.Produto_codPro,' - ',pro.desPro) Produto_codPro
										 ,CONCAT(rat.Situacao_codSit,' - ',sit.desSit) Situacao_codSit
							 	 FROM tbrat rat
							 	 JOIN tbusuario usu
							       ON usu.codUsu = rat.Usuario_codUsu
							     JOIN tbcliente cli
								   ON cli.codCli = rat.Cliente_codCli
								 JOIN tbresponsavel res 
								   ON res.codRes = rat.Responsavel_codRes
								 JOIN tbprojeto prj 
								   ON prj.codPrj = rat.Projeto_codPrj
								 JOIN tbproduto pro
								   ON pro.codPro = rat.Produto_codPro
								 JOIN tbsituacaorat = sit
								   ON sit.codSit = rat.Situacao_codSit
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
