<?php
require_once("../model/TipoDespesaModel.php");
require_once("../persistencia/TipoDespesaPersistencia.php");

switch($_POST["action"]){

	case 'cadastrar':
		$model = new TipoDespesaModel();

		$model->setDescricao($_POST["descricao"]);

		$persistencia = new TipoDespesaPersistencia();
		$persistencia->setModel($model);
		$persistencia->inserirTipoDespesa();
		break;


	case 'buscar':
		$model = new TipoDespesaModel();

		if(isset($_POST["codigo"])){
				$model->setCodigo($_POST["codigo"]);
		}

		$model->setDescricao($_POST["descricao"]);

		$persistencia = new TipoDespesaPersistencia();
	  	$persistencia->setModel($model);
	   	$retorno = $persistencia->buscaTipoDespesas();

	  	echo $retorno;

	   	break;
}


?>
