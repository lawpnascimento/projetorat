<?php
require_once("../model/ResponsavelModel.php");
require_once("../persistencia/ResponsavelPersistencia.php");

switch($_POST["action"]){

	case 'cadastrar':
		$model = new ResponsavelModel();

		$model->setNome($_POST["nomRes"]);
		$model->setEmail($_POST["email"]);
		$model->setCliente($_POST["codCli"]);

		$persistencia = new ResponsavelPersistencia();
		$persistencia->setModel($model);
		$persistencia->inserirResponsavel();

		break;

	case 'clientedropdown':
    $persistencia = new ResponsavelPersistencia();
    $retorno = $persistencia->buscaClienteDropDown();

    echo $retorno;

    break;
		case 'buscar':
	   	$model = new ResponsavelModel();

			if(isset($_POST["codigo"])){
					$model->setCodigo($_POST["codigo"]);
			}

			$model->setNome($_POST["nomRes"]);
			$model->setEmail($_POST["email"]);
			$model->setCliente($_POST["codCli"]);

	   	$persistencia = new ResponsavelPersistencia();

	  	$persistencia->setModel($model);

	   	$retorno = $persistencia->buscaResponsavel();

	  	echo $retorno;
	   	break;
		case 'atualizar':
			$model = new ResponsavelModel();

			$model->setCodigo($_POST["codigo"]);
			$model->setNome($_POST["nomRes"]);
			$model->setEmail($_POST["email"]);
			$model->setCliente($_POST["codCli"]);

			$persistencia = new ResponsavelPersistencia();

			$persistencia->setModel($model);

			$persistencia->Atualizar();

			break;
}


?>
