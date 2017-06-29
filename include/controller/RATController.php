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
}


?>
