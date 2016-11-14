<?php
require_once("../model/ClienteModel.php");
require_once("../persistencia/ClientePersistencia.php");

switch($_POST["action"]){
	case 'inserir':
		$model = new ClienteModel();
		$model->setNome($_POST["nome"]);
		$model->setResp($_POST["resp"]);
		$model->setEmail($_POST["email"]);

		$persistencia = new ClientePersistencia();
		$persistencia->setModel($model);
		$persistencia->inserirCliente();
		break;
	case 'consultar':
		$persistencia = new ClientePersistencia();
		$persistencia->consultarCliente();
		break;
}


?>