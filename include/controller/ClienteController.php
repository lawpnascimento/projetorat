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

	//consultar no grid da tela do cliente
	case 'consultar':
		$persistencia = new ClientePersistencia();
		$persistencia->consultarCliente();
		break;

	//select na tabela do cliente e concatena em json
	case 'buscar':
     	$model = new ClienteModel();
     	$persistencia = new ClientePersistencia();

		$model->setNome($_POST["nome"]);
		$model->setResp($_POST["resp"]);
		$model->setEmail($_POST["email"]);

      	$persistencia->setModel($model);

     	$retorno = $persistencia->buscarCliente();

      	echo $retorno;
     	break;
}


?>