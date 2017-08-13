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
		$model->setDsAtividade($_POST["dsAtividade"]);
		$model->setIdFaturar($_POST["idFaturar"]);

		$persistencia->setModel($model);

		$retorno = $persistencia->inserirAtividade();

		break;
}




?>
