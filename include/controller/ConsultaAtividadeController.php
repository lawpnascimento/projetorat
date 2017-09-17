<?php
require_once("../model/ConsultaAtividadeModel.php");
require_once("../persistencia/ConsultaAtividadePersistencia.php");
session_start();

switch($_POST["action"]){

	case 'buscar':
	   	$model = new ConsultaAtividadeModel();

			if(isset($_POST["codigo"])){
					$model->setCodigo($_POST["codigo"]);
			}
			if(isset($_SESSION["codUsu"])){
					$model->setUsuarioLogado($_SESSION["codUsu"]);
			}
			if(isset($_SESSION["codPap"])){
					$model->setPapel($_SESSION["codPap"]);
			}

			$model->setUsuario($_POST["usuario"]);
			$model->setCliente($_POST["cliente"]);
			$model->setResponsavel($_POST["responsavel"]);
			$model->setProjeto($_POST["projeto"]);
			$model->setProduto($_POST["produto"]);

	   	$persistencia = new ConsultaAtividadePersistencia();

	  	$persistencia->setModel($model);

	   	$retorno = $persistencia->buscaRAT();

	  	echo $retorno;

	break;

	case 'buscaatividade':
		$model = new ConsultaAtividadeModel();

			$model->setCodigo($_POST["codigo"]);

		$persistencia = new ConsultaAtividadePersistencia();

	  	$persistencia->setModel($model);

	   	$retorno = $persistencia->buscaAtividade();

	  	echo $retorno;

	break;

	case 'verificapapelusuario':
		//administrador
		if ($_SESSION["codPap"] == "1"){
			   echo '{"status" : "1" }';
	  }
	  	//consultor
		if ($_SESSION["codPap"] == "2"){
			   echo '{"status" : "2" }';
	  }

    break;

}

?>
