<?php
require_once("../model/UsuarioModel.php");
require_once("../persistencia/UsuarioPersistencia.php");

switch($_POST["action"]){

	case 'cadastrar':
		$model = new UsuarioModel();
    $persistencia = new UsuarioPersistencia();

    $model->setNome($_POST["nomUsu"]);
    $model->setSobrenome($_POST["sobrenomeUsu"]);
    $model->setSenha($senha);
    $model->setEmail($_POST["desEml"]);
    $model->setPapel($_POST["codPap"]);
    $model->setSituacao($_POST["codSit"]);
    $model->setPercentualComissaoCli($_POST["perComCli"]);
    $model->setPercentualComissaoInt($_POST["perComInt"]);

		$persistencia->setModel($model);
		$persistencia->inserirUsuario();

		break;

	case 'papeldropdown':
    $persistencia = new UsuarioPersistencia();
    $retorno = $persistencia->buscaPapelDropDown();

    echo $retorno;

    break;

	case 'buscar':
   	$model = new UsuarioModel();

		if(isset($_POST["codigo"])){
				$model->setCodigo($_POST["codigo"]);
		}

    $model->setNome($_POST["nomUsu"]);
    $model->setSobrenome($_POST["sobrenomeUsu"]);
    $model->setSenha($_POST["senUsu"]);
    $model->setEmail($_POST["desEml"]);
    $model->setPapel($_POST["codPap"]);
    $model->setSituacao($_POST["codSit"]);
    $model->setPercentualComissaoCli($_POST["perComCli"]);
    $model->setPercentualComissaoInt($_POST["perComInt"]);

   	$persistencia = new UsuarioPersistencia();

  	$persistencia->setModel($model);

   	$retorno = $persistencia->buscaUsuario();

  	echo $retorno;

   	break;
	case 'atualizar':
		$model = new UsuarioModel();

		$model->setCodigo($_POST["codigo"]);
		$model->setNome($_POST["nomUsu"]);
		$model->setSobrenome($_POST["sobrenomeUsu"]);
        $model->setSenha($_POST["senUsu"]);
		$model->setEmail($_POST["desEml"]);
		$model->setPapel($_POST["codPap"]);
		$model->setSituacao($_POST["codSit"]);
        $model->setPercentualComissaoCli($_POST["perComCli"]);
        $model->setPercentualComissaoInt($_POST["perComInt"]);

		$persistencia = new UsuarioPersistencia();

		$persistencia->setModel($model);

		$persistencia->Atualizar();

		break;
}


?>
