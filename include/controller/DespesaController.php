<?php
require_once("../model/DespesaModel.php");
require_once("../persistencia/DespesaPersistencia.php");

switch($_POST["action"]){

	case 'cadastrar':
		$model = new DespesaModel();

		$model->setDescricao($_POST["descricao"]);
		$model->setValorUnitario($_POST["valorUnitario"]);

		$persistencia = new DespesaPersistencia();
		$persistencia->setModel($model);
		$persistencia->inserirDespesa();
		break;


	case 'buscar':
		$model = new DespesaModel();

		if(isset($_POST["codigo"])){
				$model->setCodigo($_POST["codigo"]);
		}

		$model->setDescricao($_POST["descricao"]);
		$model->setValorUnitario($_POST["valorUnitario"]);

		$persistencia = new DespesaPersistencia();
	  	$persistencia->setModel($model);
	   	$retorno = $persistencia->buscaDespesas();

	  	echo $retorno;

	   	break;
}


?>
