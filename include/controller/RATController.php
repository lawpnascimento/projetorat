<?php
require_once("../model/RATModel.php");
require_once("../persistencia/RATPersistencia.php");

switch($_POST["action"]){

	case 'buscar':
	   	$model = new RATModel();

			if(isset($_POST["codigo"])){
					$model->setCodigo($_POST["codigo"]);
			}

			$model->setUsuario($_POST["usuario"]);
			$model->setCliente($_POST["cliente"]);
			$model->setResponsavel($_POST["responsavel"]);
			$model->setAtividade($_POST["atividade"]);
			$model->setDespesa($_POST["despesa"]);
			$model->setProjeto($_POST["projeto"]);
			$model->setSituacao($_POST["situacao"]);

	   	$persistencia = new RATPersistencia();

	  	$persistencia->setModel($model);

	   	$retorno = $persistencia->buscaRAT();

	  	echo $retorno;

	   	break;

	case 'autocompletecliente':
		$model = new RATModel();

		$model->setTermo($_POST["termo"]);

		$persistencia = new RATPersistencia();

		$persistencia->setModel($model);

		$retorno = $persistencia->buscaClienteAutoComplete();

		echo $retorno;

		break;

	case 'autocompleteusuario':
		$model = new RATModel();

		$model->setTermo($_POST["termo"]);

		$persistencia = new RATPersistencia();

		$persistencia->setModel($model);

		$retorno = $persistencia->buscaUsuarioAutoComplete();

		echo $retorno;

		break;

	case 'autocompleteresponsavel':
		$model = new RATModel();

	    $model->setCliente($_POST["cliente"]);
		$model->setTermo($_POST["termo"]);

		$persistencia = new RATPersistencia();

		$persistencia->setModel($model);

		$retorno = $persistencia->buscaResponsavelAutoComplete();

		echo $retorno;

		break;

	case 'autocompleteprojeto':
		$model = new RATModel();

		$model->setTermo($_POST["termo"]);

		$persistencia = new RATPersistencia();

		$persistencia->setModel($model);

		$retorno = $persistencia->buscaProjetoAutoComplete();

		echo $retorno;

		break;

	case 'autocompleteproduto':

		$model = new RATModel();

		$model->setTermo($_POST["termo"]);

		$persistencia = new RATPersistencia();

		$persistencia->setModel($model);

		$retorno = $persistencia->buscaProdutoAutoComplete();

		echo $retorno;

		break;

	case 'inserirrat':

		$model = new RATModel();
		$model->setUsuario($_SESSION["codUsu"]);
		$model->setCliente($_POST["cliente"]);
		$model->setResponsavel($_POST["responsavel"]);
		$model->setProjeto($_POST["projeto"]);
		$model->setProduto($_POST["produto"]);
		$model->setDtRAT($_POST["datarat"]);

		$persistencia = new RATPersistencia();

		$persistencia->setModel($model);

		$retorno = $persistencia->inserirRat();

		echo $retorno;

		break;

	case 'inseriratividade':
		$model = new RATModel();

		$persistencia = new RATPersistencia();

		$codRat = $persistencia->buscaCodigoRatInserido();

		$model->setCodigo($codRat);
		$model->setUsuario($_SESSION["codUsu"]);
		$model->setDtAtividade($_POST["dtAtividade"]);
		$model->setHrInicial($_POST["hrInicial"]);
		$model->setHrFinal($_POST["hrFinal"]);
		$model->setHrTotal($_POST["hrTotal"]);
		$model->setDsAtividade($_POST["dsAtividade"]);
		$model->setIdFaturar($_POST["idFaturar"]);

		$persistencia->setModel($model);

		$retorno = $persistencia->inserirAtividade();

		break;

	case 'inserirdespesa':
		$model = new RATModel();

		$persistencia = new RATPersistencia();

		$codRat = $persistencia->buscaCodigoRatInserido();

		$model->setCodigo($codRat);
		$model->setUsuario($_SESSION["codUsu"]);
		$model->setCdDespesa($_POST["cdDespesa"]);
		$model->setDtDespesa($_POST["dtDespesa"]);
		$model->setIdDespesa($_POST["idDespesa"]);
		$model->setVlDespesa($_POST["vlDespesa"]);
		$model->setQtDespesa($_POST["qtDespesa"]);
		$model->setTotDespesa($_POST["totDespesa"]);
		$model->setCdFaturamento($_POST["cdFaturamento"]);
		$model->setDsOberservacao($_POST["dsOberservacao"]);

		$persistencia->setModel($model);

		$retorno = $persistencia->inserirDespesa();

		break;

  case 'buscatipodespesadropdown':
		$model = new RATModel();

		$persistencia = new RATPersistencia();

		$model->setCodigo($_POST["codDsp"]);

		$persistencia->setModel($model);

		$retorno = $persistencia->buscaTipoDespesa();

		echo $retorno;

		break;

	case 'buscadescricaodespesa':
		$persistencia = new RATPersistencia();

		$retorno = $persistencia->buscaDescricaoDespesa();

		echo $retorno;

		break;

	case 'buscavalorunitariodespesa':
		$model = new RATModel();

		$persistencia = new RATPersistencia();

		$model->setIdDespesa($_POST["idDespesa"]);

		$persistencia->setModel($model);

		$retorno = $persistencia->buscaValorUnitarioDespesa();

		echo $retorno;

		break;

	case 'enviaemailrat':

		$persistencia = new RATPersistencia();

		$codRat = $persistencia->buscaCodigoRatInserido();

		$persistencia->enviaEmailRAT($_SESSION["codUsu"]
									,$codRat
									,$_POST["nmRelatorio"]);

		$persistencia->atualizaEnvioRAT($codRat);
			
	break;

	case 'enviaemailratalterado':

		$persistencia = new RATPersistencia();

		$persistencia->enviaEmailRAT($_SESSION["codUsu"]
									,$_POST["codigo"]
									,$_POST["nmRelatorio"]);

		$persistencia->atualizaEnvioRAT($_POST["codigo"]);
			
	break;

	case 'buscacodigoratinserido':
		$persistencia = new RATPersistencia();

		$codRat = $persistencia->buscaCodigoRatInserido();

		echo $codRat;

	break;

	case 'alterarrat':

		$model = new RATModel();
		$model->setCodigo($_POST["codigo"]);
		$model->setUsuario($_SESSION["codUsu"]);
		$model->setCliente($_POST["cliente"]);
		$model->setResponsavel($_POST["responsavel"]);
		$model->setProjeto($_POST["projeto"]);
		$model->setProduto($_POST["produto"]);
		$model->setDtRAT($_POST["datarat"]);

		$persistencia = new RATPersistencia();

		$persistencia->setModel($model);

		$retorno = $persistencia->alterarRat();

		echo $retorno;

		break;

	case 'alteraratividade':
		$model = new RATModel();

		$persistencia = new RATPersistencia();

		$model->setCodigo($_POST["codigo"]);
		$model->setAtividade($_POST["atividade"]);
		$model->setUsuario($_SESSION["codUsu"]);
		$model->setDtAtividade($_POST["dtAtividade"]);
		$model->setHrInicial($_POST["hrInicial"]);
		$model->setHrFinal($_POST["hrFinal"]);
		$model->setHrTotal($_POST["hrTotal"]);
		$model->setDsAtividade($_POST["dsAtividade"]);
		$model->setIdFaturar($_POST["idFaturar"]);

		$persistencia->setModel($model);

		$retorno = $persistencia->alterarAtividade();

		break;

	case 'alterardespesa':
		$model = new RATModel();

		$persistencia = new RATPersistencia();

		$model->setCodigo($_POST["codigo"]);
		$model->setDespesa($_POST["despesa"]);
		$model->setUsuario($_SESSION["codUsu"]);
		$model->setCdDespesa($_POST["cdDespesa"]);
		$model->setDtDespesa($_POST["dtDespesa"]);
		$model->setIdDespesa($_POST["idDespesa"]);
		$model->setVlDespesa($_POST["vlDespesa"]);
		$model->setQtDespesa($_POST["qtDespesa"]);
		$model->setTotDespesa($_POST["totDespesa"]);
		$model->setCdFaturamento($_POST["cdFaturamento"]);
		$model->setDsOberservacao($_POST["dsOberservacao"]);

		$persistencia->setModel($model);

		$retorno = $persistencia->alterarDespesa();

		break;

		case 'excluiratividade':
		$model = new RATModel();

		$persistencia = new RATPersistencia();

		$model->setCodigo($_POST["codigo"]);
		$model->setAtividade($_POST["atividade"]);

		$persistencia->setModel($model);

		$retorno = $persistencia->excluirAtividade();

		break;

		case 'excluirdespesa':
		$model = new RATModel();

		$persistencia = new RATPersistencia();

		$model->setCodigo($_POST["codigo"]);
		$model->setDespesa($_POST["despesa"]);

		$persistencia->setModel($model);

		$retorno = $persistencia->excluirDespesa();

		break;
}




?>
