<?php

session_start();
require_once("../../estrutura/conexao.php");
require_once("../../estrutura/conf_email.php");
require_once("../../phpjasper/vendor/autoload.php");

use JasperPHP\JasperPHP;

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


	public function buscaClienteAutoComplete(){
		$this->getConexao()->conectaBanco();
		$termo = $this->getModel()->getTermo();

		$sSql = "SELECT CONCAT(codCli,'-',nomCli) nomCli
		FROM tbcliente
		WHERE nomCli LIKE '%". $termo ."%'";

		$resultado = mysql_query($sSql);

		$qtdLinhas = mysql_num_rows($resultado);

		$contador = 0;

		$retorno = null;

		while ($linha = mysql_fetch_assoc($resultado)) {

			$contador = $contador + 1;

			$retorno = $retorno . $linha["nomCli"];

			//Para não concatenar a virgula no final do json
			if($qtdLinhas != $contador)
				$retorno = $retorno . ',';

		}

		$this->getConexao()->fechaConexao();

		return $retorno;

	}

	public function buscaUsuarioAutoComplete(){
		$this->getConexao()->conectaBanco();
		$termo = $this->getModel()->getTermo();

		$sSql = "SELECT CONCAT(codUsu,'-',nomUsu) nomUsu
		FROM tbusuario
		WHERE nomUsu LIKE '%". $termo ."%'";

		$resultado = mysql_query($sSql);

		$qtdLinhas = mysql_num_rows($resultado);

		$contador = 0;

		$retorno = null;

		while ($linha = mysql_fetch_assoc($resultado)) {

			$contador = $contador + 1;

			$retorno = $retorno . $linha["nomUsu"];

			//Para não concatenar a virgula no final do json
			if($qtdLinhas != $contador)
				$retorno = $retorno . ',';

		}

		$this->getConexao()->fechaConexao();

		return $retorno;

	}

	public function buscaResponsavelAutoComplete(){
		$this->getConexao()->conectaBanco();
		$termo = $this->getModel()->getTermo();

		$sSql = "SELECT CONCAT(codRes,'-',nomRes) nomRes
		FROM tbresponsavel
		WHERE nomRes LIKE '%". $termo ."%'";

		$resultado = mysql_query($sSql);

		$qtdLinhas = mysql_num_rows($resultado);

		$contador = 0;

		$retorno = null;

		while ($linha = mysql_fetch_assoc($resultado)) {

			$contador = $contador + 1;

			$retorno = $retorno . $linha["nomRes"];

			//Para não concatenar a virgula no final do json
			if($qtdLinhas != $contador)
				$retorno = $retorno . ',';

		}

		$this->getConexao()->fechaConexao();

		return $retorno;

	}

	public function buscaProjetoAutoComplete(){
		$this->getConexao()->conectaBanco();
		$termo = $this->getModel()->getTermo();

		$sSql = "SELECT CONCAT(codPrj,'-',nomPrj) nomPrj
		FROM tbprojeto
		WHERE nomPrj LIKE '%". $termo ."%'";

		$resultado = mysql_query($sSql);

		$qtdLinhas = mysql_num_rows($resultado);

		$contador = 0;

		$retorno = null;

		while ($linha = mysql_fetch_assoc($resultado)) {

			$contador = $contador + 1;

			$retorno = $retorno . $linha["nomPrj"];

			//Para não concatenar a virgula no final do json
			if($qtdLinhas != $contador)
				$retorno = $retorno . ',';

		}

		$this->getConexao()->fechaConexao();

		return $retorno;

	}

	public function buscaProdutoAutoComplete(){
		$this->getConexao()->conectaBanco();
		$termo = $this->getModel()->getTermo();

		$sSql = "SELECT CONCAT(codPro,'-',desPro) desPro
		FROM tbproduto
		WHERE desPro LIKE '%". $termo ."%'";

		$resultado = mysql_query($sSql);

		$qtdLinhas = mysql_num_rows($resultado);

		$contador = 0;

		$retorno = null;

		while ($linha = mysql_fetch_assoc($resultado)) {

			$contador = $contador + 1;

			$retorno = $retorno . $linha["desPro"];

			//Para não concatenar a virgula no final do json
			if($qtdLinhas != $contador)
				$retorno = $retorno . ',';

		}

		$this->getConexao()->fechaConexao();

		return $retorno;

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
		$dataRAT = $this->getModel()->getDtRAT();

		if($codigo == null){

			$sSql = "SELECT codRat
			,usuario_codUsu
			,cliente_codCli
			,responsavel_codRes
			,atividade_codAti
			,despesa_codDsp
			,projeto_codPrj
			,datRat
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

			if($dataRAT != null){
				$sSql = $sSql . " AND datRat = '" . $dataRAT ."')";
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
			,datRat
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
			, "datRat" : "'.$linha["datRat"].'"
			, "situacao_codSit" : "'.$linha["situacao_codSit"].'"}';

			//Para não concatenar a virgula no final do json
			if($qtdLinhas != $contador)
				$retorno = $retorno . ',';

		}
		$retorno = $retorno . "]";

		$this->getConexao()->fechaConexao();

		return $retorno;

	}

	public function inserirRat(){

		$this->getConexao()->conectaBanco();

		$usuario = $this->getModel()->getUsuario();
		$cliente = $this->getModel()->getCliente();
		$responsavel = $this->getModel()->getResponsavel();
		$projeto = $this->getModel()->getProjeto();
		$produto = $this->getModel()->getProduto();
		$dataRAT = $this->getModel()->getDtRAT();

		$sSql =  "INSERT INTO tbrat (Usuario_codUsu, Cliente_codCli, Responsavel_codRes, Projeto_codPrj, Produto_codPro, datRat, Situacao_codSit)
		VALUES (". $usuario ."
		,". $cliente ."
		,". $responsavel ."
		,". $projeto ."
		,". $produto ."
		,'". $dataRAT ."'
		,". 1 .")";

		$this->getConexao()->query($sSql);



		$this->getConexao()->fechaConexao();

	}

	public function buscaCodigoRatInserido(){
		$this->getConexao()->conectaBanco();

		$sSql = "SELECT MAX(codRat) codRat
		FROM tbrat";

		$resultado = mysql_query($sSql);

		while ($linha = mysql_fetch_assoc($resultado)) {
			$retorno = $linha["codRat"];
		}

		$this->getConexao()->fechaConexao();

		return $retorno;
	}

	public function inserirAtividade(){

		$this->getConexao()->conectaBanco();

		$codigo = $this->getModel()->getCodigo();
		$usuario = $this->getModel()->getUsuario();
		$hrInicial = date("H:i", strtotime($this->getModel()->gethrInicial()));
		$hrFinal = date("H:i", strtotime($this->getModel()->gethrFinal()));
		$hrTotal = date("H:i", strtotime($this->getModel()->gethrTotal()));
		$dtAtividade = date("d/m/y",strtotime(str_replace('/','-',$this->getModel()->getdtAtividade())));
		$dsAtividade = $this->getModel()->getdsAtividade();
		$idFaturar = $this->getModel()->getIdFaturar();

		$sSql =  "INSERT INTO tbatividade (RAT_codRAT, Usuario_codUsu, datAti, horIni, horFin, horTot, desAti, tipFat)
		VALUES (". $codigo ."
		,". $usuario ."
		, STR_TO_DATE('". $dtAtividade ."','%d/%m/%Y')
		,'". $hrInicial ."'
		,'". $hrFinal ."'
		,'". $hrTotal ."'
		,'". $dsAtividade ."'
		,". $idFaturar .")";

		$this->getConexao()->query($sSql);

		$this->getConexao()->fechaConexao();

	}

	public function inserirDespesa(){

		$this->getConexao()->conectaBanco();

		$codigo = $this->getModel()->getCodigo();
		$usuario = $this->getModel()->getUsuario();
		$cdDespesa = $this->getModel()->getCdDespesa();
		$dtDespesa = date("d/m/y",strtotime(str_replace('/','-',$this->getModel()->getDtDespesa())));
		$idDespesa = $this->getModel()->getIdDespesa();
		$vlDespesa = $this->getModel()->getVlDespesa();
		$qtDespesa = $this->getModel()->getQtDespesa();
		$totDespesa = $this->getModel()->getTotDespesa();
		$cdFaturamento = $this->getModel()->getCdFaturamento();
		$dsOberservacao = $this->getModel()->getDsOberservacao();


		$sSql =  "INSERT INTO tbdespesarat (RAT_codRAT, Usuario_codUsu, Despesa_codDsp, datDsp, qtdDsp, totDsp, obsDsp, Fatdespesa_codTipFat)
		VALUES (". $codigo ."
		,". $usuario ."
		,". $cdDespesa ."
		,STR_TO_DATE('". $dtDespesa ."','%d/%m/%Y')
		,". $qtDespesa ."
		,". $totDespesa ."
		,'". $dsOberservacao ."'
		,". $cdFaturamento .")";

		$this->getConexao()->query($sSql);

		$this->getConexao()->fechaConexao();

	}
	public function buscaDescricaoDespesa(){
		$this->getConexao()->conectaBanco();

		$sSql = "SELECT codDsp, desDsp
		FROM tbdespesa";

		$resultado = mysql_query($sSql);

		$qtdLinhas = mysql_num_rows($resultado);

		$contador = 0;

		$retorno = '[';
		while ($linha = mysql_fetch_assoc($resultado)) {

			$contador = $contador + 1;

			$retorno = $retorno . '{"codDsp": "'.$linha["codDsp"].'"
			, "desDsp" : "'.$linha["desDsp"].'"}';
        //Para não concatenar a virgula no final do json
			if($qtdLinhas != $contador)
				$retorno = $retorno . ',';

		}
		$retorno = $retorno . "]";

		$this->getConexao()->fechaConexao();

		return $retorno;

	}

	public function buscaTipoDespesa(){
		$this->getConexao()->conectaBanco();

		$codDsp = $this->getModel()->getCodigo();

		$sSql = "SELECT codTipDsp, desTipDsp
		FROM tbdespesa des
		JOIN tbtipodespesa tip
		ON des.Tipodespesa_CodTipDsp = tip.codTipDsp
		WHERE des.codDsp = " . $codDsp;

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

	public function buscaValorUnitarioDespesa(){
		$this->getConexao()->conectaBanco();

		$idDespesa = $this->getModel()->getIdDespesa();

		$sSql = "SELECT vlrUni
		FROM tbdespesa
		WHERE tipodespesa_codtipdsp = " . $idDespesa;

		$resultado = mysql_query($sSql);

		$retorno = null;

		while ($linha = mysql_fetch_assoc($resultado)) {

			$retorno = $retorno . $linha["vlrUni"];

		}

		$this->getConexao()->fechaConexao();

		return $retorno;

	}

	public function atualizaEnvioRAT($codRAT){
		$this->getConexao()->conectaBanco();

		$sSql = "UPDATE tbRAT rat
		SET Situacao_codSit = 2
		where codRAT = '" . $codRAT . "'
		and Situacao_codSit in (1, 6)";

		$this->getConexao()->query($sSql);

		$this->getConexao()->fechaConexao();
	}

	public function enviaEmailRAT($codUsu, $codRAT, $nmRelatorio){
		$this->getConexao()->conectaBanco();

		$sSql = "SELECT rat.codRat
		,usu.codUsu codUsu
		,cli.codCli codCli
		,res.codRes codRes
		,CONCAT(usu.nomUsu, ' ' ,sobrenomeUsu) nomUsu
		,usu.desEml desEml
		,cli.desRazaoSocial desRazaoSocial
		,res.nomRes nomRes
		,res.emlRes emlRes
		FROM tbrat rat
		JOIN tbusuario usu
		ON usu.codUsu = rat.Usuario_codUsu
		JOIN tbcliente cli
		ON cli.codCli = rat.Cliente_codCli
		JOIN tbresponsavel res 
		ON res.codRes = rat.Responsavel_codRes
		WHERE rat.codRat = " . $codRAT . "
		AND usu.codUsu = " . $codUsu;

		$resultado = mysql_query($sSql);

		while ($linha = mysql_fetch_assoc($resultado)) {

			$nomeUsuario = $linha["nomUsu"];
			$codCli = $linha["codCli"];
			$codRes = $linha["codRes"];
			$emailUsuario = $linha["desEml"];
			$razaoSocial = $linha["desRazaoSocial"];
			$nomeResponsavel = $linha["nomRes"];
			$emailResponsavel = $linha["emlRes"];

		}

		$assunto = "Gestão - RAT " . $codRAT . " ref. " . $razaoSocial . "";

		$mensagem	= "Olá " . $nomeResponsavel . ", Segue RAT lançado por " . $nomeUsuario . "";

		$this->getConexao()->fechaConexao();

		$input = 'C:\xampp\htdocs\projetorat\trunk\phpjasper\vendor\geekcom\phpjasper\templates\EnvioRAT.jrxml';
		$output = 'C:\xampp\htdocs\projetorat\trunk\phpjasper\vendor\geekcom\phpjasper\templates\pdf\\' . $nmRelatorio;
		$jdbc_dir = 'C:\xampp\htdocs\projetorat\trunk\phpjasper\vendor\geekcom\phpjasper\bin\jasperstarter\jdbc';

		$options = [
			'format' => ['pdf'],
			'locale' => 'en',
			'params' => ['txbRat' => $codRAT,
			'txbConsultor' => $codUsu,
			'txbCliente' => $codCli,
			'txbResponsavel' => $codRes],
			'db_connection' => [
				'driver' => 'mysql',
				'host' => 'localhost',
				'port' => '3306',
				'database' => 'dbprojetorat',
				'username' => 'root',
				'password' => 'root',
				'jdbc_driver' => 'com.mysql.jdbc.Driver',
				'jdbc_url' => 'jdbc:mysql://localhost:3306/dbprojetorat',
				'jdbc_dir' => $jdbc_dir
			]
		];

		$jasper = new JasperPHP;

		$jasper->process(
			$input,
			$output,
			$options
		)->execute();

		$anexo =  'C:\xampp\htdocs\projetorat\trunk\phpjasper\vendor\geekcom\phpjasper\templates\pdf\\' .  $nmRelatorio . ".pdf";

		$email = new Email();
		$email->enviaEmail($emailResponsavel,$mensagem,$assunto,$emailUsuario,$anexo);
	}

	public function alterarRat(){

		$this->getConexao()->conectaBanco();

		$codigo = $this->getModel()->getCodigo();
		$usuario = $this->getModel()->getUsuario();
		$cliente = $this->getModel()->getCliente();
		$responsavel = $this->getModel()->getResponsavel();
		$projeto = $this->getModel()->getProjeto();
		$produto = $this->getModel()->getProduto();
		$dataRAT = $this->getModel()->getDtRAT();

		$sSql =  "UPDATE tbrat
		SET Usuario_codUsu = '". $usuario ."'
		,Cliente_codCli = '". $cliente ."'
		,Responsavel_codRes = '". $responsavel ."'
		,Projeto_codPrj = '". $projeto ."'
		,Produto_codPro = '". $produto ."'
		,datRat = '". $dataRAT ."'
		WHERE codRat = " . $codigo;

		$this->getConexao()->query($sSql);

		$this->getConexao()->fechaConexao();

	}

	public function alterarAtividade(){

		$this->getConexao()->conectaBanco();

		$codigo = $this->getModel()->getCodigo();
		$atividade = $this->getModel()->getAtividade();
		$usuario = $this->getModel()->getUsuario();
		$hrInicial = date("H:i", strtotime($this->getModel()->gethrInicial()));
		$hrFinal = date("H:i", strtotime($this->getModel()->gethrFinal()));
		$hrTotal = date("H:i", strtotime($this->getModel()->gethrTotal()));
		$dtAtividade = date("d/m/y",strtotime(str_replace('/','-',$this->getModel()->getdtAtividade())));
		$dsAtividade = $this->getModel()->getdsAtividade();
		$idFaturar = $this->getModel()->getIdFaturar();

		$sSql =  "UPDATE tbatividade
		SET datAti = '". $dtAtividade ."'
		,horIni = '". $hrInicial ."'
		,horFin = '". $hrFinal ."'
		,horTot = '". $hrTotal ."'
		,desAti = '". $dsAtividade ."'
		,tipFat = '". $idFaturar ."'
		WHERE RAT_codRAT = '" . $codigo ."'
		AND codAti = '" . $atividade ."'
		AND Usuario_codUsu = " . $usuario;

		$this->getConexao()->query($sSql);

		$this->getConexao()->fechaConexao();

	}

	public function alterarDespesa(){

		$this->getConexao()->conectaBanco();

		$codigo = $this->getModel()->getCodigo();
		$despesa = $this->getModel()->getDespesa();
		$usuario = $this->getModel()->getUsuario();
		$cdDespesa = $this->getModel()->getCdDespesa();
		$dtDespesa = date("d/m/y",strtotime(str_replace('/','-',$this->getModel()->getDtDespesa())));
		$idDespesa = $this->getModel()->getIdDespesa();
		$vlDespesa = $this->getModel()->getVlDespesa();
		$qtDespesa = $this->getModel()->getQtDespesa();
		$totDespesa = $this->getModel()->getTotDespesa();
		$cdFaturamento = $this->getModel()->getCdFaturamento();
		$dsOberservacao = $this->getModel()->getDsOberservacao();

		$sSql =  "UPDATE tbdespesarat
		SET Despesa_codDsp = '". $cdDespesa ."'
		,Fatdespesa_codTipFat = '". $cdFaturamento ."'
		,datDsp = '". $dtDespesa ."'
		,obsDsp = '". $dsOberservacao ."'
		,qtdDsp = '". $qtDespesa ."'
		,totDsp = '". $totDespesa ."'
		WHERE RAT_codRAT = '" . $codigo ."'
		AND seqDsp = '" . $despesa ."'
		AND Usuario_codUsu = " . $usuario;

		$this->getConexao()->query($sSql);

		$this->getConexao()->fechaConexao();

	}

	public function excluirAtividade(){
		$this->getConexao()->conectaBanco();

		$codigo = $this->getModel()->getCodigo();
		$atividade = $this->getModel()->getAtividade();

		$sSql = "DELETE ati
		FROM tbatividade
		AS ati
		WHERE ati.codAti = '" . $atividade . "'
		and ati.RAT_codRAT = " . $codigo;

		$this->getConexao()->query($sSql);

		$this->getConexao()->fechaConexao();
	}

	public function excluirDespesa(){
		$this->getConexao()->conectaBanco();

		$codigo = $this->getModel()->getCodigo();
		$despesa = $this->getModel()->getDespesa();

		$sSql = "DELETE dsprat
		FROM tbdespesarat
		AS dsprat
		WHERE dsprat.seqDsp = '" . $despesa . "'
		and dsprat.RAT_codRAT = " . $codigo;

		$this->getConexao()->query($sSql);

		$this->getConexao()->fechaConexao();
	}

}

?>