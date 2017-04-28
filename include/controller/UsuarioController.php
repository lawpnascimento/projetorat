<?php
require_once("../model/UsuarioModel.php");
require_once("../persistencia/UsuarioPersistencia.php");

switch($_POST["action"]){

	case 'cadastrar':
		$model = new UsuarioModel();

    $model->setNome($_POST["nomUsu"]);
    $model->setSobrenome($_POST["sobrenomeUsu"]);
    $model->setSenha($_POST["senUsu"]);
    $model->setEmail($_POST["desEml"]);
    $model->setPerfil($_POST["codPer"]);
    $model->setSituacao($_POST["codSit"]);

		$persistencia = new UsuarioPersistencia();
		$persistencia->setModel($model);
		$persistencia->inserirUsuario();

		break;

	case 'perfildropdown':
    $persistencia = new UsuarioPersistencia();
    $retorno = $persistencia->buscaPerfilDropDown();

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
    $model->setPerfil($_POST["codPer"]);
    $model->setSituacao($_POST["codSit"]);

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
	$model->setPerfil($_POST["codPer"]);
	$model->setSituacao($_POST["codSit"]);

		$persistencia = new UsuarioPersistencia();

		$persistencia->setModel($model);

		$persistencia->Atualizar();

		break;
}


?>
