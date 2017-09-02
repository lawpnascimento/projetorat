<?php
require_once("../model/ConsultaRATModel.php");
require_once("../persistencia/ConsultaRATPersistencia.php");

switch($_POST["action"]){

	case 'buscar':
	   	$model = new ConsultaRATModel();

			if(isset($_POST["codigo"])){
					$model->setCodigo($_POST["codigo"]);
			}
			
			$model->setUsuario($_POST["usuario"]);
			$model->setCliente($_POST["cliente"]);
			$model->setResponsavel($_POST["responsavel"]);
			$model->setProjeto($_POST["projeto"]);
			$model->setProduto($_POST["produto"]);
			$model->setSituacao($_POST["situacao"]);
			//$model->setDespesa($_POST["despesa"]);
			//$model->setAtividade($_POST["atividade"]);

	   	$persistencia = new ConsultaRATPersistencia();

	  	$persistencia->setModel($model);

	   	$retorno = $persistencia->buscaRAT();

	  	echo $retorno;

	   	break;

	case 'buscaatividade':
		$model = new ConsultaRATModel();

			$model->setCodigo($_POST["codigo"]);

		$persistencia = new ConsultaRATPersistencia();

	  	$persistencia->setModel($model);

	   	$retorno = $persistencia->buscaAtividade();

	  	echo $retorno;

	   	break;

	case 'buscadespesa':
		$model = new ConsultaRATModel();

			$model->setCodigo($_POST["codigo"]);

		$persistencia = new ConsultaRATPersistencia();

	  	$persistencia->setModel($model);

	   	$retorno = $persistencia->buscaDespesa();

	  	echo $retorno;

	   	break;

}


?>
