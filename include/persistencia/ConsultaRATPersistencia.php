<?php

require_once("../../estrutura/conexao.php");
require_once("../../estrutura/conf_email.php");

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
		$papel = $this->getModel()->getPapel();
		$usuarioLogado = $this->getModel()->getUsuarioLogado();

		if($papel == 1){

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
								WHERE 1 = 1";

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

			/*if($despesa != null){
					$sSql = $sSql . " AND dsp.codDsp = '" . $despesa ."'";
			}

			if($atividade != null){
					$sSql = $sSql . " AND ati.codAti = '" . $atividade ."'";
			}*/

			$sSql = $sSql . "ORDER BY rat.codRat desc";
		}else{
			$sSql = "SELECT rat.codRat
										 ,CONCAT(rat.Usuario_codUsu,' - ',usu.nomUsu, ' ' ,usu.sobrenomeUsu) Usuario_codUsu
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
							   WHERE rat.Usuario_codUsu = " . $usuarioLogado;

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

		$sSql = "SELECT codAti,
						DATE_FORMAT(datAti, '%d-%m-%Y') datAti,
						TIME_FORMAT(horIni,'%H:%i') horIni,
						TIME_FORMAT(horFin,'%H:%i') horFin,
						TIME_FORMAT(horTot,'%H:%i') horTot,
						desAti,
						tipFat
				 		from tbatividade 
				 		where RAT_codRAT = " . $codigo . "
				 		order by codAti";

		$resultado = mysql_query($sSql);

		$qtdLinhas = mysql_num_rows($resultado);

		$contador = 0;

		$retorno = '[';
		while ($linha = mysql_fetch_assoc($resultado)) {

			$contador = $contador + 1;

			$retorno = $retorno . '{"codAti": "'.$linha["codAti"].'"
														, "datAti" : "'.$linha["datAti"].'"
														, "horIni" : "'.$linha["horIni"].'"
														, "horFin" : "'.$linha["horFin"].'"
														, "horTot" : "'.$linha["horTot"].'"
														, "desAti" : "'.$linha["desAti"].'"
														, "tipFat" : "'.$linha["tipFat"].'"}';

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
					 		from tbdespesarat dsprat
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

	public function buscaSituacaoAutoComplete(){
		$this->getConexao()->conectaBanco();
		$termo = $this->getModel()->getTermo();

		$sSql = "SELECT CONCAT(codSit,'-',desSit) desSit
						   FROM tbsituacaorat
						  WHERE desSit LIKE '%". $termo ."%'";

		$resultado = mysql_query($sSql);

		$qtdLinhas = mysql_num_rows($resultado);

		$contador = 0;

		$retorno = null;

		while ($linha = mysql_fetch_assoc($resultado)) {

			$contador = $contador + 1;

			$retorno = $retorno . $linha["desSit"];

			//Para não concatenar a virgula no final do json
			if($qtdLinhas != $contador)
					$retorno = $retorno . ',';

		}

		$this->getConexao()->fechaConexao();

		return $retorno;

	}

	public function aprovaRAT(){
		$this->getConexao()->conectaBanco();

		$codigo = $this->getModel()->getCodigo();
		$situacao = $this->getModel()->getSituacao();

		$sSql = "UPDATE tbRAT rat
				 		SET Situacao_codSit = 3
				 		where codRAT = '" . $codigo . "'
				 		and Situacao_codSit = 2";

		$this->getConexao()->query($sSql);

		$this->getConexao()->fechaConexao();
	}

	public function reprovaRAT(){
		$this->getConexao()->conectaBanco();

		$codigo = $this->getModel()->getCodigo();
		$situacao = $this->getModel()->getSituacao();

		$sSql = "UPDATE tbRAT rat
				 		SET Situacao_codSit = 6
				 		where codRAT = '" . $codigo . "'
				 		and Situacao_codSit = 2";

		$this->getConexao()->query($sSql);

		$this->getConexao()->fechaConexao();
	}

	public function enviaEmailRAT(){
	  $this->getConexao()->conectaBanco();

	  $usuRAT = $this->getModel()->getUsuario();
	  $codRAT = $this->getModel()->getCodigo();
	  
      $sSql = "SELECT rat.codRat
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
				 AND usu.codUsu = " . $usuRAT;

      $resultado = mysql_query($sSql);

      while ($linha = mysql_fetch_assoc($resultado)) {

      	  $nomeUsuario = $linha["nomUsu"];
          $emailUsuario = $linha["desEml"];
          $razaoSocial = $linha["desRazaoSocial"];
          $nomeResponsavel = $linha["nomRes"];
          $emailResponsavel = $linha["emlRes"];

      }

      $assunto = "Gestão - RAT " . $codRAT . " ref. " . $razaoSocial . "";

      $mensagem	= "Olá " . $nomeResponsavel . ", Segue RAT lançado por " . $nomeUsuario . "";

	  $this->getConexao()->fechaConexao();

      $email = new Email();
      $email->enviaEmail($emailResponsavel,$mensagem,$assunto,$emailUsuario);
  	}

	public function atualizaEnvioRAT(){
		$this->getConexao()->conectaBanco();

		$codRAT = $this->getModel()->getCodigo();

		$sSql = "UPDATE tbRAT rat
				 		SET Situacao_codSit = 2
				 		where codRAT = '" . $codRAT . "'
				 		and Situacao_codSit in (1, 6)";

		$this->getConexao()->query($sSql);

		$this->getConexao()->fechaConexao();
	}

}
?>
