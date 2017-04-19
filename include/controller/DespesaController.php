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

}


?>
