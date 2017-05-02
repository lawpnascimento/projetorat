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

	/*case 'responsavelautocomplete':
		$persistencia = new RATPersistencia();
    	$retorno = $persistencia->buscaResponsavelAutoComplete();

   	 	echo $retorno;

		break;*/


}


?>
