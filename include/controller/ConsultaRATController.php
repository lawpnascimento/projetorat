<?php
require_once("../model/ConsultaRATModel.php");
require_once("../persistencia/ConsultaRATPersistencia.php");
session_start();

switch($_POST["action"]){

	case 'buscar':
	   	$model = new ConsultaRATModel();

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

	case 'aprovar':

		$model = new ConsultaRATModel();

		$model->setCodigo($_POST["codigo"]);
		$model->setSituacao($_POST["situacao"]);

		$persistencia = new ConsultaRATPersistencia();

	  	$persistencia->setModel($model);

	   	$retorno = $persistencia->aprovaRAT();

	  	echo $retorno;

	break;

	case 'reprovar':

		$model = new ConsultaRATModel();

		$model->setCodigo($_POST["codigo"]);
		$model->setSituacao($_POST["situacao"]);

		$persistencia = new ConsultaRATPersistencia();

	  	$persistencia->setModel($model);

	   	$retorno = $persistencia->reprovaRAT();

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

    case 'enviaemailrat':
    	/*echo gettype($_SESSION['codUsu']);
    	echo gettype($_POST['usuariorat']);
	    echo $_SESSION['codUsu'];
	    echo $_POST['usuariorat'];*/
	    
    	if ($_SESSION['codUsu'] == trim($_POST['usuariorat'])){

	    	$model = new ConsultaRATModel();

			$model->setUsuario($_POST["usuariorat"]);
			$model->setCodigo($_POST["codigorat"]);

			$persistencia = new ConsultaRATPersistencia();

			$persistencia->setModel($model);

			$persistencia->enviaEmailRAT();

			$persistencia->atualizaEnvioRAT();	
			
			echo '{"mensagem": "E-mail enviado com sucesso!"}';

		}
		else {  
			echo '{"mensagem": "Somente o usuário que lançou o RAT pode enviá-lo por e-mail.", "status" : "1" }';	    	
	    }
			
	break;

	case 'autocompletesituacao':

		$model = new ConsultaRATModel();

		$model->setTermo($_POST["termo"]);

		$persistencia = new ConsultaRATPersistencia();

		$persistencia->setModel($model);

		$retorno = $persistencia->buscaSituacaoAutoComplete();

		echo $retorno;

	break;

	case 'alterar':
	   	$model = new ConsultaRATModel();

			$model->setCodigo($_POST["codigo"]);
			$model->setSituacao($_POST["situacao"]);

	   	$persistencia = new ConsultaRATPersistencia();

	  	$persistencia->setModel($model);

	   	$retorno = $persistencia->buscaAlteraRAT();

	  	echo $retorno;

	break;

}

?>
