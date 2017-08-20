<?php
require_once("../model/ProjetoModel.php");
require_once("../persistencia/ProjetoPersistencia.php");

switch($_POST["action"]){

	case 'cadastrar':
		$model = new ProjetoModel();

		$model->setProjeto($_POST["projeto"]);
		$model->setProduto($_POST["produto"]);
		$model->setDataInicio($_POST["dataInicio"]);
		$model->setCliente($_POST["cliente"]);
		$model->setValorHora($_POST["valorHora"]);
		$model->setObsProjeto($_POST["obsProjeto"]);

		$persistencia = new ProjetoPersistencia();
		$persistencia->setModel($model);
		$persistencia->inserirProjeto();

	break;

	case 'buscar':
   	$model = new ProjetoModel();

		if(isset($_POST["codigo"])){
				$model->setCodigo($_POST["codigo"]);
		}

		$model->setProjeto($_POST["projeto"]);
		$model->setProduto($_POST["produto"]);
		$model->setDataInicio($_POST["dataInicio"]);
		$model->setCliente($_POST["cliente"]);
		$model->setValorHora($_POST["valorHora"]);
		$model->setObsProjeto($_POST["obsProjeto"]);

	$persistencia = new ProjetoPersistencia();

	$persistencia->setModel($model);

	$retorno = $persistencia->buscarProjetos();

   	break;

	case 'atualizar':
   	$model = new ProjetoModel();

   		if(isset($_POST["codigo"])){
				$model->setCodigo($_POST["codigo"]);
		}

		$model->setProjeto($_POST["projeto"]);
		$model->setProduto($_POST["produto"]);
		$model->setDataInicio($_POST["dataInicio"]);
		$model->setCliente($_POST["cliente"]);
		$model->setValorHora($_POST["valorHora"]);
		$model->setObsProjeto($_POST["obsProjeto"]);

	$persistencia = new ProjetoPersistencia();

	$persistencia->setModel($model);

	$retorno = $persistencia->atualizarProjeto();

	break;

	case 'clientedropdown':
        $persistencia = new ProjetoPersistencia();
        $retorno = $persistencia->buscaClienteDropDown();

        echo $retorno;

        break;

	case 'produtodropdown':
	
        $persistencia = new ProjetoPersistencia();

        $retorno = $persistencia->buscaProdutoDropDown();

        echo $retorno;

        break;
}

?>