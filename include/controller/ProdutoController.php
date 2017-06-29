<?php
require_once("../model/ProdutoModel.php");
require_once("../persistencia/ProdutoPersistencia.php");

switch($_POST["action"]){

	case 'cadastrar':
		$model = new ProdutoModel();

		$model->setDescricao($_POST["descricao"]);

		$persistencia = new ProdutoPersistencia();
		$persistencia->setModel($model);
		$persistencia->inserirProduto();
		break;

	case 'buscar':

   		$model = new ProdutoModel();

		if(isset($_POST["codigo"])){
				$model->setCodigo($_POST["codigo"]);
		}

		$model->setDescricao($_POST["descricao"]);

		$persistencia = new ProdutoPersistencia();
	  	$persistencia->setModel($model);
	   	$retorno = $persistencia->buscaProdutos();

	  	echo $retorno;

	   	break;
}


?>
