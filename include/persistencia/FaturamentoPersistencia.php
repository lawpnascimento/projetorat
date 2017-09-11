<?php

require_once("../../estrutura/conexao.php");

class FaturamentoPersistencia{
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
										 ,DATE_FORMAT(datRat, '%d-%m-%Y') datRat
										 ,CONCAT(usu.perComCli, '%') perComCli
										 ,CONCAT(usu.perComInt, '%') perComInt
										 ,CONCAT(rat.Cliente_codCli, ' - ',cli.nomCli) Cliente_codCli
										 ,CONCAT(rat.Responsavel_codRes, ' - ',res.nomRes) Responsavel_codRes
										 ,CONCAT(rat.Projeto_codPrj, ' - ',prj.nomPrj) Projeto_codPrj
										 ,prj.vlrHorCom vlrHorCom
										 ,prj.vlrHorFat vlrHorFat
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
								WHERE rat.Situacao_codSit = 3";

			if($codigo != null){
					$sSql = $sSql . " AND rat.codRat = '" . $codigo ."'";
			}

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

			$sSql = $sSql . " ORDER BY rat.codRat desc";
		}else{
			$sSql = "SELECT rat.codRat
										 ,CONCAT(rat.Usuario_codUsu,' - ',usu.nomUsu, ' ' ,sobrenomeUsu) Usuario_codUsu
										 ,DATE_FORMAT(datRat, '%d-%m-%Y') datRat
										 ,CONCAT(usu.perComCli, '%') perComCli
										 ,CONCAT(usu.perComInt, '%') perComInt
										 ,CONCAT(rat.Cliente_codCli,' - ',cli.nomCli) Cliente_codCli
										 ,CONCAT(rat.Responsavel_codRes,' - ',res.nomRes) Responsavel_codRes
										 ,CONCAT(rat.Projeto_codPrj,' - ',prj.nomPrj) Projeto_codPrj
										 ,prj.vlrHorCom vlrHorCom
										 ,prj.vlrHorFat vlrHorFat
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
							   AND sit.Situacao_codSit = 3
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
														, "datRat" : "'.$linha["datRat"].'"
														, "perComCli" : "'.$linha["perComCli"].'"
														, "perComInt" : "'.$linha["perComInt"].'"
														, "codCli" : "'.$linha["Cliente_codCli"].'"
														, "codRes" : "'.$linha["Responsavel_codRes"].'"
														, "codPrj" : "'.$linha["Projeto_codPrj"].'"
														, "vlrHorCom" : "'.$linha["vlrHorCom"].'"
														, "vlrHorFat" : "'.$linha["vlrHorFat"].'"
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

	public function buscaAtividade(){
		$this->getConexao()->conectaBanco();

		$codigo = $this->getModel()->getCodigo();

		$sSql = "SELECT rat.codRat
										,(SELECT SEC_TO_TIME(TIME_TO_SEC(`horTot`))) horTot
										,(prj.vlrHorFat * cast(time_to_sec(horTot) / (60 * 60) as decimal(10, 1))) fatTot
										,(prj.vlrHorCom * cast(time_to_sec(horTot) / (60 * 60) as decimal(10, 1))) basCalCom
										,CONCAT('0.',usu.perComCli) * (prj.vlrHorCom * cast(time_to_sec(horTot) / (60 * 60) as decimal(10, 1))) comTot
										,(prj.vlrHorFat * cast(time_to_sec(horTot) / (60 * 60) as decimal(10, 1))) - CONCAT('0.',usu.perComCli) * (prj.vlrHorCom * cast(time_to_sec(horTot) / (60 * 60) as decimal(10, 1))) vlrLiq
								 	 FROM tbrat rat
								 	 JOIN tbatividade ati
								 	 	ON ati.RAT_codRAT = rat.codRat
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
						 				where rat.codRat = " . $codigo . "
						 				and ati.tipFat = 1 ";

		$resultado = mysql_query($sSql);

		$qtdLinhas = mysql_num_rows($resultado);

		$contador = 0;

		$retorno = '[';
		while ($linha = mysql_fetch_assoc($resultado)) {

			$contador = $contador + 1;

			$retorno = $retorno . '{"horTot": "'.$linha["horTot"].'"
														, "fatTot" : "'.$linha["fatTot"].'"
														, "basCalCom" : "'.$linha["basCalCom"].'"
														, "comTot" : "'.$linha["comTot"].'"
														, "vlrLiq" : "'.$linha["vlrLiq"].'"}';

			//Para não concatenar a virgula no final do json
			if($qtdLinhas != $contador)
					$retorno = $retorno . ',';

		}
		$retorno = $retorno . "]";

		$this->getConexao()->fechaConexao();

		return $retorno;
	}

	public function buscaTotalAtividade(){
		$this->getConexao()->conectaBanco();

		$codigo = $this->getModel()->getCodigo();

		$sSql = "SELECT rat.codRat		
										,(SELECT SEC_TO_TIME(SUM(TIME_TO_SEC(`horTot`)))) sumHorTot
										,SUM((prj.vlrHorFat * cast(time_to_sec(horTot) / (60 * 60) as decimal(10, 1)))) sumFatTot
										,SUM((prj.vlrHorCom * cast(time_to_sec(horTot) / (60 * 60) as decimal(10, 1)))) sumBasCalCom
										,SUM(CONCAT('0.',usu.perComCli) * (prj.vlrHorCom * cast(time_to_sec(horTot) / (60 * 60) as decimal(10, 1)))) sumComTot
										,SUM((prj.vlrHorFat * cast(time_to_sec(horTot) / (60 * 60) as decimal(10, 1))) - CONCAT('0.',usu.perComCli) * (prj.vlrHorCom * cast(time_to_sec(horTot) / (60 * 60) as decimal(10, 1)))) sumVlrLiq
								 	 FROM tbrat rat
								 	 JOIN tbatividade ati
								 	 	ON ati.RAT_codRAT = rat.codRat
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
						 				where rat.codRat = " . $codigo . "
						 				and ati.tipFat = 1 ";

		$resultado = mysql_query($sSql);

		$qtdLinhas = mysql_num_rows($resultado);

		$contador = 0;

		$retorno = '[';
		while ($linha = mysql_fetch_assoc($resultado)) {

			$contador = $contador + 1;

			$retorno = $retorno . '{"sumHorTot": "'.$linha["sumHorTot"].'"
														, "sumFatTot" : "'.$linha["sumFatTot"].'"
														, "sumBasCalCom" : "'.$linha["sumBasCalCom"].'"
														, "sumComTot" : "'.$linha["sumComTot"].'"
														, "sumVlrLiq" : "'.$linha["sumVlrLiq"].'"}';

			//Para não concatenar a virgula no final do json
			if($qtdLinhas != $contador)
					$retorno = $retorno . ',';

		}
		$retorno = $retorno . "]";

		$this->getConexao()->fechaConexao();

		return $retorno;
	}

	public function buscaDespesa(){
		$this->getConexao()->conectaBanco();

		$codigo = $this->getModel()->getCodigo();

		$sSql = "SELECT dsprat.seqDsp seqDsp
							    ,DATE_FORMAT(datDsp, '%d-%m-%Y') datDsp
							    ,dsp.desDsp desDsp
								,tipdsp.desTipDsp desTipDsp
								,dsp.vlrUni vlrUni
								,dsprat.qtdDsp qtdDsp
								,dsprat.totDsp totDsp
								,dsprat.obsDsp obsDsp
								,fatdsp.desFatDsp desFatDsp
								FROM tbrat rat
								JOIN tbdespesarat dsprat
								  ON rat.codRat = dsprat.RAT_codRAT
				 		        JOIN tbdespesa dsp
							      ON dsp.codDsp = dsprat.Despesa_codDsp
							    JOIN tbtipodespesa tipdsp
							      ON tipdsp.codTipDsp = dsp.Tipodespesa_CodTipDsp
							    JOIN tbfatdespesa fatdsp
							      ON fatdsp.codFatDsp = dsprat.Fatdespesa_codTipFat
					 		where RAT_codRAT = " . $codigo . "
					 		order by seqDsp";

		$resultado = mysql_query($sSql);

		$qtdLinhas = mysql_num_rows($resultado);

		$contador = 0;

		$retorno = '[';
		while ($linha = mysql_fetch_assoc($resultado)) {

			$contador = $contador + 1;

			$retorno = $retorno . '{"seqDsp": "'.$linha["seqDsp"].'"
														, "datDsp" : "'.$linha["datDsp"].'"
													    , "desDsp" : "'.$linha["desDsp"].'"
													    , "desTipDsp" : "'.$linha["desTipDsp"].'"
													    , "vlrUni" : "'.$linha["vlrUni"].'"
													    , "qtdDsp" : "'.$linha["qtdDsp"].'"
													    , "totDsp" : "'.$linha["totDsp"].'"
													    , "obsDsp" : "'.$linha["obsDsp"].'"
													    , "desFatDsp" : "'.$linha["desFatDsp"].'"
												}';

			//Para não concatenar a virgula no final do json
			if($qtdLinhas != $contador)
					$retorno = $retorno . ',';

		}
		$retorno = $retorno . "]";

		$this->getConexao()->fechaConexao();

		return $retorno;
	}

	public function buscaTotalDespesaFat(){
		$this->getConexao()->conectaBanco();

		$codigo = $this->getModel()->getCodigo();

		$sSql = "SELECT
						(SELECT SUM(totDsp) TotDspFR
								FROM tbrat rat
								JOIN tbdespesarat dsprat
								  ON rat.codRat = dsprat.RAT_codRAT
				 		        JOIN tbdespesa dsp
							      ON dsp.codDsp = dsprat.Despesa_codDsp
							    JOIN tbtipodespesa tipdsp
							      ON tipdsp.codTipDsp = dsp.Tipodespesa_CodTipDsp
							    JOIN tbfatdespesa fatdsp
							      ON fatdsp.codFatDsp = dsprat.Fatdespesa_codTipFat
					 		where rat.codRAT = " . $codigo . "
					 		AND (dsprat.Fatdespesa_codTipFat = 1 OR dsprat.Fatdespesa_codTipFat = 2))
					 		AS TotDspFat";

		$resultado = mysql_query($sSql);

		$qtdLinhas = mysql_num_rows($resultado);

		$contador = 0;

		$retorno = '[';
		while ($linha = mysql_fetch_assoc($resultado)) {

			$contador = $contador + 1;

			$retorno = $retorno . '{"TotDspFat": "'.$linha["TotDspFat"].'"}';

			//Para não concatenar a virgula no final do json
			if($qtdLinhas != $contador)
					$retorno = $retorno . ',';

		}
		$retorno = $retorno . "]";

		$this->getConexao()->fechaConexao();

		return $retorno;
	}

	public function buscaTotalDespesaRem(){
		$this->getConexao()->conectaBanco();

		$codigo = $this->getModel()->getCodigo();

		$sSql = "SELECT
						(SELECT SUM(totDsp) TotDspFR
								FROM tbrat rat
								JOIN tbdespesarat dsprat
								  ON rat.codRat = dsprat.RAT_codRAT
				 		        JOIN tbdespesa dsp
							      ON dsp.codDsp = dsprat.Despesa_codDsp
							    JOIN tbtipodespesa tipdsp
							      ON tipdsp.codTipDsp = dsp.Tipodespesa_CodTipDsp
							    JOIN tbfatdespesa fatdsp
							      ON fatdsp.codFatDsp = dsprat.Fatdespesa_codTipFat
					 		where rat.codRAT = " . $codigo . "
					 		AND (dsprat.Fatdespesa_codTipFat = 1 OR dsprat.Fatdespesa_codTipFat = 3))
					 		AS TotDspRem";

		$resultado = mysql_query($sSql);

		$qtdLinhas = mysql_num_rows($resultado);

		$contador = 0;

		$retorno = '[';
		while ($linha = mysql_fetch_assoc($resultado)) {

			$contador = $contador + 1;

			$retorno = $retorno . '{"TotDspRem": "'.$linha["TotDspRem"].'"}';

			//Para não concatenar a virgula no final do json
			if($qtdLinhas != $contador)
					$retorno = $retorno . ',';

		}
		$retorno = $retorno . "]";

		$this->getConexao()->fechaConexao();

		return $retorno;
	}

	public function processaFatRAT(){
		$this->getConexao()->conectaBanco();

		$codigo = $this->getModel()->getCodigo();
		$situacao = $this->getModel()->getSituacao();

		$sSql = "UPDATE tbRAT rat
				 		SET Situacao_codSit = 4
				 		where codRAT = '" . $codigo . "'
				 		and Situacao_codSit = 3";

		$this->getConexao()->query($sSql);

		$this->getConexao()->fechaConexao();
	}

	public function insereFatRAT(){
		$this->getConexao()->conectaBanco();

		$codigo = $this->getModel()->getCodigo();
		$usuario = $this->getModel()->getUsuario();
		$data = $this->getModel()->getDataFechamento();

		$sSql =  "INSERT INTO tbfaturamento (RAT_codRAT
																		,Usuario_codUsu
																		,datFec)
											VALUES ('". $codigo ."'
																	    ,'". $usuario ."'
																	    ,'". $data ."')";

		$this->getConexao()->query($sSql);

        $this->getConexao()->fechaConexao();
  }

  public function insereResumoAtividade(){
		$this->getConexao()->conectaBanco();

		$codigoRat = $this->getModel()->getCodigo();
		$codigoFat = $this->getModel()->getCodigoFat();

		$sSql =  "INSERT INTO tbresumoatividade (Faturamento_codFat
																		,sumHorTot
																		,sumFatTot
																		,sumBasCalCom
																		,sumComTot
																		,sumVlrLiq)
										(SELECT 
										" . $codigoFat . "
										,SEC_TO_TIME(SUM(TIME_TO_SEC(`horTot`))) sumHorTot
										,SUM((prj.vlrHorFat * cast(time_to_sec(horTot) / (60 * 60) as decimal(10, 1)))) sumFatTot
										,SUM((prj.vlrHorCom * cast(time_to_sec(horTot) / (60 * 60) as decimal(10, 1)))) sumBasCalCom
										,SUM(CONCAT('0.',usu.perComCli) * (prj.vlrHorCom * cast(time_to_sec(horTot) / (60 * 60) as decimal(10, 1)))) sumComTot
										,SUM((prj.vlrHorFat * cast(time_to_sec(horTot) / (60 * 60) as decimal(10, 1))) - CONCAT('0.',usu.perComCli) * (prj.vlrHorCom * cast(time_to_sec(horTot) / (60 * 60) as decimal(10, 1)))) sumVlrLiq
								 	 FROM tbrat rat
								 	 JOIN tbatividade ati
								 	 	ON ati.RAT_codRAT = rat.codRat
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
						 				where rat.codRat = " . $codigoRat . "
						 				and ati.tipFat = 1)";

		$this->getConexao()->query($sSql);

        $this->getConexao()->fechaConexao();
  }

public function buscaCodigoFatInserido(){
		$this->getConexao()->conectaBanco();

		$sSql = "SELECT MAX(codFat) codFat
							 FROM tbfaturamento";

	  $resultado = mysql_query($sSql);

		while ($linha = mysql_fetch_assoc($resultado)) {
			$retorno = $linha["codFat"];
		}

		$this->getConexao()->fechaConexao();

		return $retorno;
  }

}
?>
