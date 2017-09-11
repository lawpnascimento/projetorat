<?php
require_once("../model/FaturamentoModel.php");
require_once("../persistencia/FaturamentoPersistencia.php");
session_start();

switch($_POST["action"]){

	case 'buscar':
	   	$model = new FaturamentoModel();

			if(isset($_POST["codigo"])){
					$model->setCodigo($_POST["codigo"]);
			}
			
			$model->setUsuario($_POST["usuario"]);
			$model->setCliente($_POST["cliente"]);
			$model->setProjeto($_POST["projeto"]);

	   	$persistencia = new FaturamentoPersistencia();

	  	$persistencia->setModel($model);

	   	$retorno = $persistencia->buscaRAT();

	  	echo $retorno;

	   	break;

	case 'buscaatividade':
		$model = new FaturamentoModel();

			$model->setCodigo($_POST["codigo"]);

		$persistencia = new FaturamentoPersistencia();

	  	$persistencia->setModel($model);

	   	$retorno = $persistencia->buscaAtividade();

	  	echo $retorno;

	   	break;

	case 'buscatotalatividade':
		$model = new FaturamentoModel();

			$model->setCodigo($_POST["codigo"]);

		$persistencia = new FaturamentoPersistencia();

	  	$persistencia->setModel($model);

	   	$retorno = $persistencia->buscaTotalAtividade();

	  	echo $retorno;

	   	break;

	case 'buscadespesa':
		$model = new FaturamentoModel();

		$model->setCodigo($_POST["codigo"]);

		$persistencia = new FaturamentoPersistencia();

	  	$persistencia->setModel($model);

	   	$retorno = $persistencia->buscaDespesa();

	  	echo $retorno;

	   	break;

	case 'buscatotaldespesafat':
		$model = new FaturamentoModel();

		$model->setCodigo($_POST["codigo"]);

		$persistencia = new FaturamentoPersistencia();

	  	$persistencia->setModel($model);

	   	$totalDespesaFat = $persistencia->buscaTotalDespesaFat();

	   	echo $totalDespesaFat;

	break;

	case 'buscatotaldespesarem':
		$model = new FaturamentoModel();

		$model->setCodigo($_POST["codigo"]);

		$persistencia = new FaturamentoPersistencia();

	  	$persistencia->setModel($model);

	   	$totalDespesaRem = $persistencia->buscaTotalDespesaRem();

	   	echo $totalDespesaRem;

	break;   	

	case 'processar':

		$model = new FaturamentoModel();

		$model->setCodigo($_POST["codigo"]);
		$model->setSituacao($_POST["situacao"]);

		$persistencia = new FaturamentoPersistencia();

	  	$persistencia->setModel($model);

	   	$retorno = $persistencia->processaFatRAT();

	  	echo $retorno;

	break;

	case 'inserirfatrat':

		$model = new FaturamentoModel();

		$model->setCodigo($_POST["codigo"]);
		$model->setUsuario($_POST["usuario"]);
		$model->setDataFechamento($_POST["dataFechamento"]);

		$persistencia = new FaturamentoPersistencia();

	  	$persistencia->setModel($model);

	   	$retorno = $persistencia->insereFatRAT();

	  	echo $retorno;

	break;

	case 'inserirresumoatividade':

		$model = new FaturamentoModel();

		$persistencia = new FaturamentoPersistencia();

		$codFat = $persistencia->buscaCodigoFatInserido();

		$model->setCodigo($_POST["codigoRat"]);
		$model->setCodigoFat($codFat);

		$persistencia->setModel($model);

		$retorno = $persistencia->insereResumoAtividade();

	break;

}

?>
